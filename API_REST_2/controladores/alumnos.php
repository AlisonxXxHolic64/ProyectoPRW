<?php

require_once '../clases/respuestas.class.php';
require_once '../clases/alumnos.class.php';

$_respuestas = new respuestas;
$_alumnos = new alumnos;

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // Verificar si se solicita una página específica de alumnos
    if (isset($_GET["page"])) {
        $pagina = $_GET["page"];
        $listaAlumnos = $_alumnos->listaAlumnos($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaAlumnos);
        http_response_code(200);

        // Verificar si se solicita un alumno específico por su código
    } else if (isset($_GET['codigoAlumno'])) {
        $codigoAlumno = $_GET["codigoAlumno"];
        $datosAlumno = $_alumnos->obtenerAlumno($codigoAlumno);
        header("Content-Type: application/json");
        echo json_encode($datosAlumno);
        http_response_code(200);
    }

    // Procesar solicitudes POST
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Obtener el cuerpo de la solicitud
    $postBody = file_get_contents("php://input");

    // Procesar la solicitud POST
    $datosArray = $_alumnos->post($postBody);

    // Devolver la respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);

    // Procesar solicitudes PUT
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    // Obtener el cuerpo de la solicitud
    $postBody = file_get_contents("php://input");

    // Procesar la solicitud PUT
    $datosArray = $_alumnos->put($postBody);

    // Devolver la respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);

    // Procesar solicitudes DELETE
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    // Obtener el cuerpo de la solicitud
    $postBody = file_get_contents("php://input");

    // Procesar la solicitud DELETE
    $datosArray = $_alumnos->delete($postBody);

    // Devolver la respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);

    // Manejar otros métodos no permitidos
} else {
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>