<?php

require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class casas extends conexion
{

    private $table = "Casa";

    /**
     * Lista todas las casas disponibles
     * @return array Los datos de todas las casas
     */
    public function listarCasas()
    {
        $query = "SELECT * FROM " . $this->table;
        return parent::obtenerDatos($query);
    }

}

?>