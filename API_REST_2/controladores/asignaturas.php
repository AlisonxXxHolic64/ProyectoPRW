<?php

require_once '../clases/respuestas.class.php';
require_once '../clases/asignaturas.class.php';

$_respuestas = new respuestas;
$_asignaturas = new asignaturas;

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // Obtener la lista de asignaturas
    $asignaturas = $_asignaturas->listarAsignaturas();

    // Devolver la lista de asignaturas
    header("Content-Type: application/json");
    echo json_encode($asignaturas);
    http_response_code(200);

    // Manejar otros métodos no permitidos
} else {
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>