<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class ValoracionHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id_valoracion = null;
    protected $calificacion_producto = null;
    protected $comentario_producto = null;
    protected $fecha_valoracion = null;
    protected $estado_comentario = null;
    protected $id_producto = null;

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_valoracion, calificacion_producto, comentario_producto, fecha_valoracion,estado_comentario
                FROM valoraciones
                WHERE calificacion_producto LIKE ? OR comentario_producto LIKE ?
                ORDER BY comentario_producto';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }


    public function readAll()
    {
        $sql = 'SELECT id_valoracion, calificacion_producto, comentario_producto, fecha_valoracion,estado_comentario
                FROM valoraciones
                ORDER BY comentario_producto';
        return Database::getRows($sql);
    }

    public function readAllComment()
    {
        $sql = 'SELECT id_valoracion,titulo_comentario, calificacion_producto, comentario_producto,fecha_valoracion, id_producto,nombre_cliente  
        FROM valoraciones 
        INNER JOIN clientes USING(id_cliente)
        WHERE id_producto = ?';
        $params = array($this->id_producto);
        return Database::getRows($sql,$params);
    }
    
    public function readOne()
    {
        $sql = 'SELECT id_valoracion, calificacion_producto, comentario_producto, fecha_valoracion,estado_comentario
                FROM valoraciones
                WHERE id_valoracion = ?';
        $params = array($this->id_valoracion);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE valoraciones
                SET  estado_comentario= ?
                WHERE id_valoracion = ?';
        $params = array($this->estado_comentario, $this->id_valoracion);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM valoracion
                WHERE id_valoracion = ?';
        $params = array($this->id_valoracion);
        return Database::executeRow($sql, $params);
    }
}
