<?php
require_once('../../auxiliar/database.php');

class EmailHandler {
    protected $id = null;
    protected $email = null;
    protected $otp = null;
    protected $otp_expiry = null;
    protected $clave = null;

    public function findUserByEmail($email) {
        $sql = 'SELECT id_usuario, correo FROM usuarios WHERE correo = ?';
        $params = array($email);
        $data = Database::getRow($sql, $params);
        if ($data) {
            $this->id = $data['id_usuario'];
            $this->email = $data['correo'];
            return true;
        } else {
            return false;
        }
    }

    public function saveOTP($otp, $expiry) {
        $this->otp = $otp;
        $this->otp_expiry = $expiry;
        $sql = 'UPDATE usuarios SET otp = ?, otp_expiry = ? WHERE id_usuario = ?';
        $params = array($this->otp, $this->otp_expiry, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function validateOTP($otp) {
        $sql = 'SELECT otp_expiry FROM usuarios WHERE id_usuario = ? AND otp = ?';
        $params = array($this->id, $otp);
        $data = Database::getRow($sql, $params);
        if ($data && strtotime($data['otp_expiry']) > time()) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword($new_password) {
        $sql = 'UPDATE usuarios SET clave = ?, otp = NULL, otp_expiry = NULL WHERE id_usuario = ?';
        $params = array(password_hash($new_password, PASSWORD_DEFAULT), $this->id);
        return Database::executeRow($sql, $params);
    }
}
?>
