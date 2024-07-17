<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../auxiliar/validator.php');
// Se incluye la clase padre.
require_once('../../modelos/handler/valoracion_handler.php');
/*
 *	Clase para manejar el encapsulamiento de los datos de la tabla PRODUCTO.
 */
class ValoracionData extends ValoracionHandler
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
            $this->id_valoracion = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la valoracion es incorrecto';
            return false;
        }
    }

    public function setCalificacion($value, $min = 1, $max = 5)
    {
        if (Validator::validateStar($value)) {
            $this->calificacion_producto = $value;
            return true;
        } elseif (!Validator::validateLength($value, $min, $max)) {
            $this->calificacion_producto = $value;
            return true;
        } else {
            // La talla no es válida y tiene la longitud incorrecta
            $this->data_error = 'La calificacion debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setComentario($value, $min = 2, $max = 50)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El comentario debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->comentario_producto = $value;
            return true;
        } else {
            $this->data_error = 'El comentario debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setFecha($value)
    {
        if (Validator::validateDate($value)) {
            $this->fecha_valoracion = $value;
            return true;
        } else {
            $this->data_error = 'La fecha de valoracion es incorrecta';
            return false;
        }
    }

    public function setEstado($value)
    {
        if (Validator::validateBoolean($value)) {
            $this->estado_comentario = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto';
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
