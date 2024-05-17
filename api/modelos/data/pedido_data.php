<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../auxiliar/validator.php');
// Se incluye la clase padre.
require_once('../../modelos/handler/pedido_handler.php');
/*
 *	Clase para manejar el encapsulamiento de los datos de la tabla Pedido.
 */
class PedidoData extends PedidoHandler
{
    /*
     *  Atributos adicionales.
     */
    private $data_error = null;
    private $filename = null;

     /*
     *   Métodos para validar y establecer los datos.
     */
    public function setId($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->id_pedido = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del pedido es incorrecto';
            return false;
        }
    }

    
    public function setCliente($value, $min = 2, $max = 50)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El cliente debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->cliente_pedido = $value;
            return true;
        } else {
            $this->data_error = 'El cliente debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setDireccion($value, $min = 2, $max = 250)
    {
        if (!Validator::validateString($value)) {
            $this->data_error = 'La dirección contiene caracteres prohibidos';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->direccion_pedido = $value;
            return true;
        } else {
            $this->data_error = 'La dirección debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setEstado($value,$enum_Options)
    {
        if (Validator::validateEnum($value,$enum_Options)) {
            $this->estado_pedido = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto';
            return false;
        }
    }

    public function setFecha($value)
    {
        if (Validator::validateDate($value)) {
            $this->fecha_pedido = $value;
            return true;
        } else {
            $this->data_error = 'La fecha de registro no es valida';
            return false;
        }
    }

     /*
     *  Método para obtener los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error;
    }


}