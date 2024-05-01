<?php
class conexion
{
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    /**
     * Constructor de la clase, establece la conexión con la base de datos
     */
    function __construct()
    {
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }

        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);

        if ($this->conexion->connect_errno) {
            echo "Algo va mal con la conexión.";
            die();
        }
    }

    /**
     * Obtiene los datos de conexión desde un archivo de configuración JSON
     * @return array Los datos de conexión
     */
    private function datosConexion()
    {
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "/" . "config");
        return json_decode($jsondata, true);
    }

    /**
     * Convierte los datos obtenidos de la base de datos a UTF-8
     * @param array $array El array con los datos obtenidos de la base de datos
     * @return array El array convertido a UTF-8
     */
    private function convertirUTF($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1');
            }
        });
        return $array;
    }

    /**
     * Ejecuta una consulta SQL y devuelve los resultados
     * @param string $sqlstr La consulta SQL a ejecutar
     * @return array Los resultados de la consulta
     */
    public function obtenerDatos($sqlstr)
    {
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $this->convertirUTF($resultArray);
    }

    /**
     * Ejecuta una consulta SQL que no devuelve resultados
     * @param string $sqlstr La consulta SQL a ejecutar
     * @return int El número de filas afectadas por la consulta
     */
    public function nonQuery($sqlstr)
    {
        $results = $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

    /**
     * Ejecuta una consulta SQL de inserción y devuelve el ID generado
     * @param string $sqlstr La consulta SQL de inserción a ejecutar
     * @return int|string El ID generado por la inserción o 0 si falla
     */
    public function nonQueryId($sqlstr)
    {
        $results = $this->conexion->query($sqlstr);
        $filas = $this->conexion->affected_rows;
        if ($filas >= 1) {
            return $this->conexion->insert_id;
        } else {
            return 0;
        }
    }

}

?>