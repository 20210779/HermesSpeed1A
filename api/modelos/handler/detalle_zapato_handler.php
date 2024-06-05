<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class DetalleZapatoHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id_zapato = null;
    protected $cantidad_talla = null;
    protected $imagen_producto = null;
    protected $color_zapato = null;
    protected $marca_zapato = null; 
    protected $id_valoracion = null; 

    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/productos/';

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_zapato, nombre_producto, precio_producto, imagen_producto, tamano_talla,
         color_zapato,existencias_producto, estado_producto,nombre_marca
        FROM detalle_zapatos
        INNER JOIN productos USING(id_producto)
        INNER JOIN tallas USING(id_talla)
        INNER JOIN colores USING(id_color)
        INNER JOIN marcas USING(id_marca)
        WHERE nombre_producto LIKE ? OR color_zapato LIKE ? 
        ORDER BY nombre_producto';
        $params = array($value,$value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO detalle_zapatos(id_talla, id_color, id_marca)
                VALUES(?, ?, ?)';
        $params = array($this->cantidad_talla, $this->color_zapato, $this->marca_zapato);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_zapato, nombre_producto, precio_producto, imagen_producto, tamano_talla,
         color_zapato,existencias_producto, estado_producto,nombre_marca, calificacion_producto
        FROM detalle_zapatos
        INNER JOIN productos USING(id_producto)
        INNER JOIN tallas USING(id_talla)
        INNER JOIN colores USING(id_color)
        INNER JOIN marcas USING(id_marca)
        INNER JOIN valoraciones USING(id_valoracion)
        ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_zapato, nombre_producto, precio_producto, imagen_producto, tamano_talla, color_zapato,existencias_producto, estado_producto,nombre_marca
                FROM detalle_zapatos
                INNER JOIN productos USING(id_producto)
                INNER JOIN tallas USING(id_talla)
                INNER JOIN colores USING(id_color)
                INNER JOIN marcas USING(id_marca)
                WHERE id_zapato = ?';
        $params = array($this->id_zapato);
        return Database::getRow($sql, $params);
    }

    public function readFilename()
    {
        $sql = 'SELECT imagen_producto
                FROM imagenes
                WHERE id_imagen = ?';
        $params = array($this->imagen_producto);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE detalle_zapatos
                SET id_talla = ?, id_color = ?, id_marca = ?
                WHERE id_producto = ?';
        $params = array($this->cantidad_talla, $this->color_zapato, $this->marca_zapato, $this->id_zapato);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM detalle_zapatos
                WHERE id_zapato = ?';
        $params = array($this->id_zapato);
        return Database::executeRow($sql, $params);
    }
}
