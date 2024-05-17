<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../auxiliar/validator.php');
// Se incluye la clase padre.
require_once('../../modelos/handler/talla_handler.php');
/*
 *	Clase para manejar el encapsulamiento de los datos de la tabla PRODUCTO.
 */
class TallaData extends TallaHandler
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
            $this->id_talla = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la talla es incorrecta';
            return false;
        }
    }

    public function setTalla($value, $min = 1, $max = 9)
    {
        if (Validator::validateShoeSize($value)) {
            $this->tamano_talla = $value;
            return true;
        } elseif (!Validator::validateLength($value, $min, $max)) {
            $this->tamano_talla = $value;
            return true;
        } else {
            // La talla no es válida y tiene la longitud incorrecta
            $this->data_error = 'La talla debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    /*
     *  Métodos para obtener los atributos adicionales.
     */
    public function getDataError()
    {
        return $this->data_error;
    }

    public function getFilename()
    {
        return $this->filename;
    }
}
