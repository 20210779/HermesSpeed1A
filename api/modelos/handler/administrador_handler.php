<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../auxiliar/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla administrador.
 */
class AdministradorHandler
{
    /*
     *  Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $apellido = null;
    protected $correo = null;
    protected $alias = null;
    protected $clave = null;
    protected $fechaRegistro=null;

    /*
     *  Métodos para gestionar la cuenta del administrador.
     */
    public function checkUser($username, $password)
    {
        $sql = 'SELECT id_admin, alias_admin, clave_admin
                FROM administradores
                WHERE  alias_admin = ?';
        $params = array($username);
        if (!($data = Database::getRow($sql, $params))) {
            return false;
        } elseif (password_verify($password, $data['clave_admin'])) {
            $_SESSION['idAdmin'] = $data['id_admin'];
            $_SESSION['aliasAdmin'] = $data['alias_admin'];
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT clave_admin
                FROM administradores
                WHERE id_admin = ?';
        $params = array($_SESSION['idAdmin']);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['clave_admin'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $sql = 'UPDATE administradores
                SET clave_admin = ?
                WHERE id_admin = ?';
        $params = array($this->clave, $_SESSION['idAdmin']);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT id_admin, nombre_admin, apellido_admin, correo_admin, alias_admin
                FROM administradores
                                WHERE id_admin = ?';
        $params = array($_SESSION['idAdmin']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE administradores
                SET nombre_admin = ?, apellido_admin = ?, correo_admin = ?, alias_admin = ?
                WHERE id_admin = ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->alias, $_SESSION['idAdmin']);
        return Database::executeRow($sql, $params);
    }

    /*  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT id_admin, nombre_admin, apellido_admin, correo_admin, alias_admin
                FROM administradores
                WHERE apellido_admin LIKE ? OR nombre_admin LIKE ?
                ORDER BY apellido_admin';
        $params = array($value, $value);
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO administradores(nombre_admin, apellido_admin, correo_admin, alias_admin, clave_admin)
                VALUES(?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->alias, $this->clave);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_admin, nombre_admin, apellido_admin, correo_admin, alias_admin
                FROM administradores
                ORDER BY apellido_admin';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT id_admin, nombre_administrador, apellido_admin, correo_admin, alias_admin
                FROM administradores
                WHERE id_admin = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE administradores
                SET nombre_admin = ?, apellido_admin = ?, correo_admin = ?
                WHERE id_admin = ?';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM administradores
                WHERE id_admin = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
