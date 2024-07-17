<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class TallaHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id_talla = null;
    protected $tamano_talla = null;
    protected $producto_talla = null;

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_talla, tamano_talla, nombre_producto
                FROM tallas     
                INNER JOIN productos USING(id_producto)
                WHERE nombre_producto LIKE ? 
                ORDER BY nombre_producto';
        $params = array($value);
        return Database::getRows($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_talla, tamano_talla, nombre_producto 
                FROM tallas
                INNER JOIN productos USING(id_producto)
                ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_talla, tamano_talla, id_producto
                FROM tallas
                WHERE id_talla = ?';
        $params = array($this->id_talla);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tallas
                SET tamano_talla = ?
                WHERE id_talla = ?';
        $params = array($this->tamano_talla,  $this->id_talla);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tallas
                WHERE id_talla = ?';
        $params = array($this->id_talla);
        return Database::executeRow($sql, $params);
    }
}
