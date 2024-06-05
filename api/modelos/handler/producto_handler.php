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
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, nombre_categoria, estado_producto
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

    public function readProductosCategoriaHFutbol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_categoria = "futbol" AND id_categoria IN (SELECT id_categoria FROM categorias WHERE nombre_categoria = "hombres")
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }
    
    public function readProductosCategoriaHBasquetboll()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_categoria = "basquetboll" AND id_categoria IN (SELECT id_categoria FROM categorias WHERE nombre_categoria = "hombres")
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }
    
    public function readProductosCategoriaHVoleibol()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_categoria = "voleibol" AND id_categoria IN (SELECT id_categoria FROM categorias WHERE nombre_categoria = "hombres")
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHTenis()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_categoria = "tenis" AND id_categoria IN (SELECT id_categoria FROM categorias WHERE nombre_categoria = "hombres")
                ORDER BY nombre_producto';
        $params = array($this->categoria_producto);
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoriaHDeportivos()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, existencias_producto
                FROM productos
                INNER JOIN categorias USING(id_categoria)
                WHERE nombre_categoria = "calsado_deportivos" AND id_categoria IN (SELECT id_categoria FROM categorias WHERE nombre_categoria = "hombres")
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
}
