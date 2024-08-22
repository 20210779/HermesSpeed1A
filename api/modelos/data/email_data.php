<?php
require_once('../../auxiliar/validator.php');
require_once('../../modelos/handler/email_handler.php');

class EmailData extends EmailHandler {
    private $data_error = null;

    public function setEmail($value) {
        if (!Validator::validateEmail($value)) {
            $this->data_error = 'Correo no válido';
            return false;
        } else {
            return $this->findUserByEmail($value);
        }
    }

    public function setOTP($value) {
        if (Validator::validateNaturalNumber($value) && strlen($value) == 6) {
            $this->otp = $value;
            return true;
        } else {
            $this->data_error = 'Código OTP inválido';
            return false;
        }
    }

    public function setNewPassword($value) {
        if (Validator::validatePassword($value)) {
            $this->clave = password_hash($value, PASSWORD_DEFAULT);
            return true;
        } else {
            $this->data_error = Validator::getPasswordError();
            return false;
        }
    }

    public function getDataError() {
        return $this->data_error;
    }
}
?>
