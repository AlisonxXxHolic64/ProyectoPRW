<?php

require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class asignaturas extends conexion
{

    private $table = "Asignatura";

    /**
     * Lista todas las asignaturas disponibles
     * @return array Los datos de las asignaturas
     */
    public function listarAsignaturas()
    {
        $query = "SELECT * FROM " . $this->table;
        return parent::obtenerDatos($query);
    }

}

?>