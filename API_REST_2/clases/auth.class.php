<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';
require_once 'alumnos.class.php';

class auth extends conexion
{
    /**
     * Maneja el proceso de inicio de sesión
     * @param string $json Los datos de inicio de sesión en formato JSON
     * @return array La respuesta del proceso de inicio de sesión
     */
    public function login($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (!isset($datos['usuario']) || !isset($datos['password'])) {
            //Error con los campos
            return $_respuestas->error_400();
        } else {
            //Sin errores con los campos
            $usuario = $datos['usuario'];
            $password = $datos['password'];

            $datos = $this->obtenerDatosUsuario($usuario);

            if ($datos) {
                if ($password == $datos[0]['password']) {

                    $verificar = $this->insertarToken($datos[0]['usuarioID']);

                    if ($verificar) {

                        //Si se ha guardado:
                        $result = $_respuestas->response;
                        $result["result"] = array(
                            "token" => $verificar,
                            "usuarioID" => $datos[0]['usuarioID']
                        );

                        return $result;

                    } else {
                        //Error al guardar:
                        return $_respuestas->error_500("Error interno. No se ha podido guardar.\n");

                    }
                } else {
                    //Si la contraseña es incorrecta:
                    return $_respuestas->error_200("La contraseña es incorrecta.\n");
                }

            } else {
                //Si no existe el usuario:
                return $_respuestas->error_200("El usuario $usuario no existe.\n");
            }
        }
    }

    /**
     * Obtiene los datos del usuario por su email
     * @param string $email El email del usuario
     * @return array|null Los datos del usuario si existe, de lo contrario null
     */
    private function obtenerDatosUsuario($email)
    {
        $query = "SELECT usuarioID,password FROM Usuario WHERE email ='$email'";
        $datos = parent::obtenerDatos(($query));
        if (isset($datos[0]['usuarioID'])) {
            return $datos;
        } else {
            return null;
        }
    }

    /**
     * Inserta un token para el usuario en la base de datos
     * @param int $usuarioID El ID del usuario
     * @return string|null El token generado si se guarda correctamente, de lo contrario null
     */
    private function insertarToken($usuarioID)
    {
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");
        $dateExp = date("Y-m-d H:i", strtotime('+3 days'));
        $query = "INSERT INTO Token (usuarioID, tokenID, fecha, fechaExpiracion) 
            VALUES ('$usuarioID', '$token', '$date', '$dateExp')";
        $verifica = parent::nonQuery($query);

        if ($verifica) {
            return $token;
        } else {
            return 0;
        }
    }

}


?>