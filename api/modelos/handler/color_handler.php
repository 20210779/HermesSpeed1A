<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class ColorHandler
{
    protected $id_color = null;
    protected $color_zapato = null;


    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_color, color_zapato
                FROM colores
                WHERE color_zapato LIKE ?';
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO colores(color_zapato)
                VALUES(?)';
        $params = array($this->color_zapato);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_color, color_zapato
                FROM colores
                ORDER BY color_zapato';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_color, color_zapato
                FROM colores
                WHERE id_color = ?';
        $params = array($this->id_color);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE colores
                SET color_zapato = ?
                WHERE id_color = ?';
        $params = array($this->color_zapato, $this->id_color);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM colores
                WHERE id_color = ?';
        $params = array($this->id_color);
        return Database::executeRow($sql, $params);
    }
}