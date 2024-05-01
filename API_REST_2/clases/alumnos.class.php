<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class alumnos extends conexion
{
    private $table = "Alumno";
    private $codigoAlumno = "";
    private $nombre = "";
    private $apellidos = "";
    private $codigoCasa = "";
    private $edad = "";
    private $curso = "";
    private $token = "";

    /**
     * Método para listar los alumnos por páginas de 10
     * @param int $pagina El número de página a mostrar
     * @return array Un array con los datos de los alumnos
     */
    public function listaAlumnos($pagina = 1)
    {
        $cantidad = 10;
        $inicio = ($pagina - 1) * $cantidad;

        $query = "SELECT * FROM " . $this->table . " LIMIT $inicio, $cantidad";
        $datos = parent::obtenerDatos($query);
        return $datos;
    }

    /**
     * Método para obtener los datos de un alumno específico
     * @param string $codigoAlumno El código del alumno a buscar
     * @return array Los datos del alumno encontrado
     */
    public function obtenerAlumno($codigoAlumno)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE codigoAlumno = '$codigoAlumno'";
        return parent::obtenerDatos($query);
    }

    /**
     * Método para agregar un nuevo alumno
     * @param string $json Los datos del alumno en formato JSON
     * @return array La respuesta de la solicitud
     */
    public function post($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (
            !isset($datos['nombre']) || !isset($datos['apellidos']) || !isset($datos['codigoCasa']) ||
            !isset($datos['edad']) || !isset($datos['curso'])
        ) {
            return $_respuestas->error_400();
        } else {
            $this->nombre = $datos['nombre'];
            $this->apellidos = $datos['apellidos'];
            $this->codigoCasa = $datos['codigoCasa'];
            $this->edad = $datos['edad'];
            $this->curso = $datos['curso'];
            $resp = $this->insertarAlumno();

            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "codigoAlumno" => $resp
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    /**
     * Método para insertar un nuevo alumno en la base de datos
     * @return int|string El código del alumno insertado o 0 si falla
     */
    public function insertarAlumno()
    {
        $query = "INSERT INTO " . $this->table . " (nombre, apellidos, codigoCasa, edad, curso) VALUES
        ('" . $this->nombre . "','" . $this->apellidos . "','" . $this->codigoCasa . "','" . $this->edad . "','" . $this->curso . "')";
        $resp = parent::nonQueryId($query);

        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }

    /**
     * Método para actualizar los datos de un alumno
     * @param string $json Los datos del alumno en formato JSON
     * @return array La respuesta de la solicitud
     */
    public function put($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        if (!isset($datos['codigoAlumno'])) {
            return $_respuestas->error_400();
        } else {
            $this->codigoAlumno = $datos['codigoAlumno'];

            if (isset($datos['nombre'])) {
                $this->nombre = $datos['nombre'];
            }
            if (isset($datos['apellidos'])) {
                $this->apellidos = $datos['apellidos'];
            }
            if (isset($datos['codigoCasa'])) {
                $this->codigoCasa = $datos['codigoCasa'];
            }
            if (isset($datos['edad'])) {
                $this->edad = $datos['edad'];
            }
            if (isset($datos['curso'])) {
                $this->curso = $datos['curso'];
            }

            $resp = $this->modificarAlumno();

            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "codigoAlumno" => $this->codigoAlumno
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    /**
     * Método para modificar los datos de un alumno en la base de datos
     * @return int|string El número de filas afectadas o 0 si falla
     */
    public function modificarAlumno()
    {
        $query = "UPDATE " . $this->table . " SET nombre='" . $this->nombre . "', apellidos = '" . $this->apellidos . "', codigoCasa = '" . $this->codigoCasa . "', edad = '" . $this->edad . "', curso = '" .
            $this->curso . "' WHERE codigoAlumno = '" . $this->codigoAlumno . "'";
        $resp = parent::nonQuery($query);
        print_r($resp);

        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    /**
     * Método para eliminar un alumno de la base de datos
     * @param string $json Los datos del alumno en formato JSON
     * @return array La respuesta de la solicitud
     */
    public function delete($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        if (!isset($datos['codigoAlumno'])) {
            return $_respuestas->error_400();
        } else {
            $this->codigoAlumno = $datos['codigoAlumno'];
            $resp = $this->eliminarAlumno();

            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "codigoAlumno" => $this->codigoAlumno
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    /**
     * Método privado para eliminar un alumno de la base de datos
     * @return int|string El número de filas afectadas o 0 si falla
     */
    private function eliminarAlumno()
    {
        $query = "DELETE FROM " . $this->table . " WHERE codigoAlumno = '" . $this->codigoAlumno . "'";
        $resp = parent::nonQuery($query);

        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }

    }
}

?>