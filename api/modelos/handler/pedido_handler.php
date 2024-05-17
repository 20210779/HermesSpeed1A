<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class PedidoHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id_pedido = null;
    protected $estado_pedido = null;
    protected $fecha_pedido = null;
    protected $direccion_pedido = null;
    protected $cliente_pedido = null;


    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/pedidos';

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_pedido, nombre_cliente, direccion_pedido, fecha_pedido, estado_pedido
                FROM pedidos
                INNER JOIN clientes USING(id_cliente)
                WHERE nombre_cliente LIKE ? OR direccion_pedido LIKE ?
                ORDER BY nombre_cliente';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO pedidos(estado_pedido, fecha_pedido, direccion_pedido, id_cliente)
                VALUES(?, ?, ?, ?)';
        $params = array($this->estado_pedido, $this->fecha_pedido, $this->direccion_pedido, $this->cliente_pedido);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_pedido, nombre_cliente, direccion_pedido, fecha_pedido, estado_pedido
                FROM pedidos
                INNER JOIN clientes USING(id_cliente)';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_pedido, id_cliente, direccion_pedido, fecha_pedido, estado_pedido
                FROM pedidos
                WHERE id_pedido = ?';
        $params = array($this->id_pedido);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE pedidos
                SET  estado_pedido = ?
                WHERE id_pedido = ?';
        $params = array($this->estado_pedido, $this->id_pedido);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM pedidos
                WHERE id_pedido = ?';
        $params = array($this->id_pedido);
        return Database::executeRow($sql, $params);
    }

    public function readPedidosClientes()
    {
        $sql = 'SELECT id_pedido, nombre_cliente, direccion_pedido, fecha_pedido, estado_pedido
            FROM pedidos
            INNER JOIN clientes USING(id_cliente)
            WHERE id_cliente = ? AND estado_pedido = ?
            ORDER BY nombre_cliente';
        $params = array($this->cliente_pedido, $this->estado_pedido);
        return Database::getRows($sql, $params);
    }
}
