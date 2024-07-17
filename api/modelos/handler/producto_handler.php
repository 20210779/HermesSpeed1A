<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
*	Clase para manejar el comportamiento de los datos de la tabla PRODUCTO.
*/
class ProductoHandler
{
    /*
    *   Declaración de atributos para el manejo de datos.
    */
    protected $id_producto = null;
    protected $nombre_producto = null;
    protected $descripcion_producto = null;
    protected $precio_producto = null;
    protected $imagen_producto = null;
    protected $estado_producto = null;
    protected $existencias_producto = null;
    protected $fecha_registro = null;
    protected $categoria_producto = null;
    protected $marca = null;

    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/productos/';

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
    */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, imagen_producto, nombre_categoria, estado_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_producto LIKE ? OR descripcion_producto LIKE ?
                ORDER BY nombre_producto';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, imagen_producto, estado_producto, existencias_producto, id_categoria, id_admin)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_producto, $this->descripcion_producto, $this->precio_producto, $this->imagen_producto, $this->estado_producto, $this->existencias_producto, $this->categoria_producto, $_SESSION['idAdmin']);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, nombre_categoria, estado_producto, id_categoria, nombre_categoria
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, imagen_producto, id_categoria, estado_producto
                FROM productos
                WHERE id_producto = ?';
        $params = array($this->id_producto);
        return Database::getRow($sql, $params);
    }

    public function readFilename()
    {
        $sql = 'SELECT imagen_producto
                FROM productos
                WHERE id_producto = ?';
        $params = array($this->id_producto);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE productos
                SET imagen_producto = ?, nombre_producto = ?, descripcion_producto = ?, precio_producto = ?, estado_producto = ?, id_categoria = ?
                WHERE id_producto = ?';
        $params = array($this->imagen_producto, $this->nombre_producto, $this->descripcion_producto, $this->precio_producto, $this->estado_producto, $this->categoria_producto, $this->id_producto);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM productos
                WHERE id_producto = ?';
        $params = array($this->id_producto);
        return Database::executeRow($sql, $params);
    }

    public function readProductosCategoria()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE id_categoria = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosID()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                WHERE id_producto = ? AND estado_producto = true
                ORDER BY nombre_producto';
        $params = array($this->id_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHFutbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Football" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        return Database::getRows($sql);
    }

    public function readProductosCategoriaMFutbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Football" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNFutbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Football" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHBasquetboll()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Basketball" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaMBasquetboll()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Basketball" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNBasquetboll()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Basketball" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHBeisbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Baseball" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaMBeisbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Baseball" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNBeisbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Baseball" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHVoleibol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Voleyball" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaMVoleibol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Voleyball" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNVoleibol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Voleyball" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHTenis()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Tennis" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaMTenis()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Tennis" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNTenis()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Tennis" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHDeportivos()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Deportivo" AND nombre_genero = "Hombre"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaMDeportivos()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Deportivo" AND nombre_genero = "Mujer"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaNDeportivos()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto, nombre_genero
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                INNER JOIN generos USING(id_genero)
                WHERE nombre_categoria = "Deportivo" AND nombre_genero = "Niño"
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }
    /*
    *   Métodos para generar gráficos.
    */
    public function cantidadProductosCategoria()
    {
        $sql = 'SELECT nombre_categoria, COUNT(id_producto) cantidad
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                GROUP BY nombre_categoria ORDER BY cantidad DESC LIMIT 5';
        return Database::getRows($sql);
    }

    public function porcentajeProductosCategoria()
    {
        $sql = 'SELECT nombre_categoria, ROUND((COUNT(id_producto) * 100.0 / (SELECT COUNT(id_producto) FROM producto)), 2) porcentaje
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                GROUP BY nombre_categoria ORDER BY porcentaje DESC';
        return Database::getRows($sql);
    }

    public function mayorCantidadVentas()
    {
        $sql = 'SELECT p.nombre_producto, SUM(dp.cantidad_producto) AS total_vendido
    FROM productos p
    JOIN detalle_zapatos dz ON p.id_producto = dz.id_producto
    JOIN detalle_pedidos dp ON dz.id_zapato = dp.id_zapato
    GROUP BY p.nombre_producto
    ORDER BY total_vendido DESC;
    ';
        return Database::getRows($sql);
    }

    public function clientesFrecuentes()
    {
        $sql = 'SELECT CONCAT_WS(" ", c.nombre_cliente, c.apellido_cliente ) AS "nombre_cliente", COUNT(p.id_pedido) AS total_pedidos
    FROM clientes c
    JOIN pedidos p ON c.id_cliente = p.id_cliente
    GROUP BY c.id_cliente
    ORDER BY total_pedidos DESC;
    ';
        return Database::getRows($sql);
    }

    public function estadoPedidoGrafico()
    {
        $sql = 'SELECT estado_pedido, COUNT(*) AS total_pedidos
            FROM pedidos
            GROUP BY estado_pedido;
    ';
        return Database::getRows($sql);
    }

    public function valoracionProductosGrafico()
    {
        $sql = 'SELECT p.nombre_producto, AVG(v.calificacion_producto) AS calificacion_promedio
        FROM productos p
        JOIN detalle_zapatos dz ON p.id_producto = dz.id_producto
        JOIN detalle_pedidos dp ON dz.id_zapato = dp.id_zapato
        JOIN valoraciones v ON dp.id_detalle = v.id_detalle
        GROUP BY p.nombre_producto
        ORDER BY calificacion_promedio DESC;
        ';
        return Database::getRows($sql);
    }
    public function ingresosMensualesGrafico()
    {
        $sql = 'SELECT DATE_FORMAT(p.fecha_pedido, "%Y-%m") AS mes, SUM(dp.precio_producto * dp.cantidad_producto) AS ingresos
        FROM pedidos p
        JOIN detalle_pedidos dp ON p.id_pedido = dp.id_pedido
        GROUP BY mes
        ORDER BY mes';
        return Database::getRows($sql);
    }
    

    /*
    *   Métodos para generar reportes.
    */
    public function productosCategoria()
    {
        $sql = 'SELECT nombre_producto, precio_producto, estado_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE id_categoria = ?
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    //Para el reporte
    public function productosMarca()
    {
        $sql = 'SELECT nombre_producto, precio_producto, estado_producto
                FROM productos
                INNER JOIN marcas USING(id_marca)
                WHERE id_marca = ?
                ORDER BY nombre_producto';
        $params = array($this->marca);
        return Database::getRows($sql, $params);
    }
}

