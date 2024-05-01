<?php
class respuestas
{
    public $response = [
        "status" => "OK",
        "result" => array()
    ];

    /**
     * Retorna un mensaje de error 405 para una petición con método no permitido
     * @return array La respuesta con el mensaje de error
     */
    public function error_405()
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "405",
            "error_msg" => "Método no permitido"
        );
        return $this->response;
    }

    /**
     * Retorna un mensaje de error 200 con un valor predeterminado
     * @param string $valor El mensaje de error personalizado
     * @return array La respuesta con el mensaje de error
     */
    public function error_200($valor = "Datos incorrectos")
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "200",
            "error_msg" => $valor
        );
        return $this->response;
    }

    /**
     * Retorna un mensaje de error 400 para datos incompletos o con formato incorrecto
     * @return array La respuesta con el mensaje de error
     */
    public function error_400()
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "400",
            "error_msg" => "Datos enviados incompletos o con formato incorrecto"
        );
        return $this->response;
    }

    /**
     * Retorna un mensaje de error 500 con un valor predeterminado
     * @param string $valor El mensaje de error personalizado
     * @return array La respuesta con el mensaje de error
     */
    public function error_500($valor = "Error interno del servidor")
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "500",
            "error_msg" => $valor
        );
        return $this->response;
    }

    /**
     * Retorna un mensaje de error 401 con un valor predeterminado
     * @param string $valor El mensaje de error personalizado
     * @return array La respuesta con el mensaje de error
     */
    public function error_401($valor = "No autorizado (token inválido)")
    {
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "500",
            "error_msg" => $valor
        );
        return $this->response;
    }

}

?>