<?php

require_once 'conexion/conexion.php';

class token extends conexion
{
    private $table = "Token";

    /**
     * Busca el token asociado a un usuario
     * @param int $usuarioID El ID del usuario
     * @return array|false Los datos del token encontrado o false si no se encontró
     */
    public function buscarToken($usuarioID)
    {
        $query = "SELECT tokenID FROM Token WHERE usuarioID = '$usuarioID'";
        return parent::obtenerDatos($query);
    }

    /**
     * Actualiza la fecha de un token dado su ID
     * @param string $tokenID El ID del token
     * @return int|false El número de filas afectadas por la actualización o false si ocurrió un error
     */
    private function actualizarToken($tokenID)
    {
        $date = date("Y-m-d H:i");
        $query = "UPDATE Token SET Fecha = '$date' WHERE tokenID = '$tokenID'";
        $resp = parent::nonQuery(($query));

        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}

?>