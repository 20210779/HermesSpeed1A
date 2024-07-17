<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../auxiliar/validator.php');
// Se incluye la clase padre.
require_once('../../modelos/handler/detalle_zapato_handler.php');
/*
 *	Clase para manejar el encapsulamiento de los datos de la tabla PRODUCTO.
 */
class DetalleZapatoData extends DetalleZapatoHandler
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
            $this->id_zapato = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del producto es incorrecto';
            return false;
        }
    }

    public function setTalla($value, $min = 1, $max = 9)
    {
        if (Validator::validateShoeSize($value)) {
            $this->cantidad_talla = $value;
            return true;
        } elseif (!Validator::validateLength($value, $min, $max)) {
            $this->cantidad_talla = $value;
            return true;
        } else {
            // La talla no es válida y tiene la longitud incorrecta
            $this->data_error = 'La talla debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setColor($value, $min = 2, $max = 50)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El color debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->color_zapato = $value;
            return true;
        } else {
            $this->data_error = 'El color debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setMarca($value)
    {
        if (Validator::validateAlphabetic($value)) {
            $this->marca_zapato = $value;
            return true;
        } else {
            $this->data_error = 'La marca debe ser selecionada';
            return false;
        }
    }


    public function setFilename()
    {
        if ($data = $this->readFilename()) {
            $this->filename = $data['imagen_producto'];
            return true;
        } else {
            $this->data_error = 'Producto inexistente';
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
