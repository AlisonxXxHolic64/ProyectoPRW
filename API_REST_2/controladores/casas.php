<?php

require_once '../clases/respuestas.class.php';
require_once '../clases/casas.class.php';

$_respuestas = new respuestas;
$_casas = new casas;

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // Obtener la lista de casas
    $casas = $_casas->listarCasas();

    // Devolver la lista de casas como respuesta
    header("Content-Type: application/json");
    echo json_encode($casas);
    http_response_code(200);

} else {
    // Manejar otros métodos no permitidos
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>