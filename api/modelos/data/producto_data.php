<?php
// Se incluye la clase para validar los datos de entrada.
require_once('../../auxiliar/validator.php');
// Se incluye la clase padre.
require_once('../../modelos/handler/producto_handler.php');
/*
 *	Clase para manejar el encapsulamiento de los datos de la tabla PRODUCTO.
 */
class ProductoData extends ProductoHandler
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
            $this->id_producto = $value;
            return true;
        } else {
            $this->data_error = 'El identificador del producto es incorrecto';
            return false;
        }
    }

    public function setNombre($value, $min = 2, $max = 50)
    {
        if (!Validator::validateAlphanumeric($value)) {
            $this->data_error = 'El nombre debe ser un valor alfanumérico';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->nombre_producto = $value;
            return true;
        } else {
            $this->data_error = 'El nombre debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setDescripcion($value, $min = 2, $max = 250)
    {
        if (!Validator::validateString($value)) {
            $this->data_error = 'La descripción contiene caracteres prohibidos';
            return false;
        } elseif (Validator::validateLength($value, $min, $max)) {
            $this->descripcion_producto = $value;
            return true;
        } else {
            $this->data_error = 'La descripción debe tener una longitud entre ' . $min . ' y ' . $max;
            return false;
        }
    }

    public function setPrecio($value)
    {
        if (Validator::validateMoney($value)) {
            $this->precio_producto = $value;
            return true;
        } else {
            $this->data_error = 'El precio debe ser un valor numérico';
            return false;
        }
    }

    public function setExistencias($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->existencias_producto = $value;
            return true;
        } else {
            $this->data_error = 'El valor de las existencias debe ser numérico entero';
            return false;
        }
    }

    public function setImagen($file, $filename = null)
    {
        if (Validator::validateImageFile($file, 1000)) {
            $this->imagen_producto = Validator::getFileName();
            return true;
        } elseif (Validator::getFileError()) {
            $this->data_error = Validator::getFileError();
            return false;
        } elseif ($filename) {
            $this->imagen_producto = $filename;
            return true;
        } else {
            $this->imagen_producto = 'default.png';
            return true;
        }
    }

    public function setCategoria($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->categoria_producto = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la categoría es incorrecto';
            return false;
        }
    }

    public function setMarca($value)
    {
        if (Validator::validateNaturalNumber($value)) {
            $this->marca = $value;
            return true;
        } else {
            $this->data_error = 'El identificador de la marca es incorrecto';
            return false;
        }
    }


    public function setEstado($value)
    {
        if (Validator::validateBoolean($value)) {
            $this->estado_producto = $value;
            return true;
        } else {
            $this->data_error = 'Estado incorrecto';
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
