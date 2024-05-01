<?php

require_once '../clases/auth.class.php';
require_once '../clases/respuestas.class.php';
require_once '../clases/token.class.php';

$_auth = new auth;
$_respuestas = new respuestas;
$token = new token;

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Recibir datos
    $postBody = file_get_contents("php://input");

    // Enviar datos
    $datosArray = $_auth->login($postBody);

    // Devolver respuesta
    header('Content-Type: application/json');
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }

    // Devolver los datos como un array
    echo json_encode($datosArray, JSON_PRETTY_PRINT);

} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Obtener el tokenID de la URL
    $tokenID = $_GET['tokenID'];

    // Buscar el token en la base de datos
    $busquedaToken = $token->buscarToken($tokenID);

    // Devolver el resultado de la búsqueda
    echo json_encode($busquedaToken);

} else {
    // Manejar otros métodos no permitidos
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>