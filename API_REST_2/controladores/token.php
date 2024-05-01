<?php

require_once '../clases/respuestas.class.php';
require_once '../clases/token.class.php';

$_respuestas = new respuestas;
$_token = new token;

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Verificar si se proporcionó el usuarioID
    if (isset($_GET['usuarioID'])) {
        $tokenID = $_GET['usuarioID'];
        $token = $_token->buscarToken($tokenID);

        // Verificar si se encontró el token
        if ($token) {
            // Devolver el token como respuesta
            header("Content-Type: application/json");
            echo json_encode($token);
            http_response_code(200);
        } else {
            // Error interno del servidor
            header('Content-Type: application/json');
            $datosArray = $_respuestas->error_500();
            echo json_encode($datosArray);
        }
    } else {
        // Datos incompletos
        header('Content-Type: application/json');
        $datosArray = $_respuestas->error_400();
        echo json_encode($datosArray);
    }
} else {
    // Método no permitido
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>