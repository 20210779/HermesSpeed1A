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
    protected $id_detalle = null;
    protected $estado_pedido = null;
    protected $producto = null;
    protected $precio_pedido = null;
    protected $cantidad = null;
    protected $fecha_pedido = null;
    protected $color_pedido = null;
    protected $talla_pedido = null;
    protected $direccion_pedido = null;
    protected $cliente_pedido = null;




    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/pedidos';


    // Método para verificar si existe un pedido en proceso con el fin de iniciar o continuar una compra.
    public function getOrder()
    {
        $this->estado_pedido = 'en_proceso';
        $sql = 'SELECT id_pedido
                FROM pedidos
                WHERE estado_pedido = ? AND id_cliente = ?';
        $params = array($this->estado_pedido, $_SESSION['idCliente']);
        if ($data = Database::getRow($sql, $params)) {
            $_SESSION['idPedido'] = $data['id_pedido'];
            return true;
        } else {
            return false;
        }
    }

    // Método para iniciar un pedido en proceso.
    public function startOrder()
    {
        if ($this->getOrder()) {
            return true;
        } else {
            $sql = 'INSERT INTO pedidos(direccion_pedido, id_cliente)
                    VALUES((SELECT direccion_cliente FROM clientes WHERE id_cliente = ?), ?)';
            $params = array($_SESSION['idCliente'], $_SESSION['idCliente']);
            // Se obtiene el ultimo valor insertado de la llave primaria en la tabla pedido.
            if ($_SESSION['idPedido'] = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }
    // Método para agregar un producto al carrito de compras.
    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalle_pedidos(cantidad_producto, precio_producto, id_producto, id_color, id_talla, id_pedido)
        VALUES(?,(SELECT precio_producto FROM productos WHERE id_producto = ?), ?, ?, ?, ?)';
        $params = array($this->cantidad, $this->producto, $this->producto, $this->color_pedido, $this->talla_pedido, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */


    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function readDetail()
    {
        $sql = 'SELECT id_detalle, nombre_producto, detalle_pedidos.precio_producto, detalle_pedidos.cantidad_producto, colores.color_zapato, tallas.tamano_talla
        FROM detalle_pedidos
        INNER JOIN pedidos USING(id_pedido)
        INNER JOIN productos USING(id_producto)
        INNER JOIN colores USING(id_color)
        INNER JOIN tallas USING(id_talla)
        WHERE id_pedido = ?';
        $params = array($_SESSION['idPedido']);
        return Database::getRows($sql, $params);
    }


    // Método para finalizar un pedido por parte del cliente.
    public function finishOrder()
    {
        $this->estado_pedido = 'finalizado';
        $sql = 'UPDATE pedidos
                SET estado_pedido = ?
                WHERE id_pedido = ?';
        $params = array($this->estado_pedido, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE detalle_pedidos
                SET cantidad_producto = ?
                WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }



    public function deleteDetail()
    {
        $sql = 'DELETE FROM detalle_pedidos
                WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->id_detalle, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

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







    

    
    
    

    

    
    

    

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    

