<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once('../../auxiliar/phpmailer_config.php');
require_once('../../modelos/data/email_data.php');


if (isset($_GET['action'])) {
    session_start();
    $user = new EmailData;
    $result = array('status' => 0, 'message' => null, 'error' => null);

    switch ($_GET['action']) {
        case 'requestOTP':
            $_POST = Validator::validateForm($_POST);
            if (!$user->setEmail($_POST['correo'])) {
                $result['error'] = $user->getDataError();
            } else {
                $otp = rand(100000, 999999);
                $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                if ($user->saveOTP($otp, $expiry)) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.example.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'tu_correo@example.com';
                        $mail->Password = 'tu_contraseña';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('tu_correo@example.com', 'Soporte');
                        $mail->addAddress($_POST['correo']);

                        $mail->isHTML(true);
                        $mail->Subject = 'Código de restablecimiento de contraseña';
                        $mail->Body    = "Tu código OTP es: $otp";

                        $mail->send();
                        $result['status'] = 1;
                        $result['message'] = 'OTP enviado al correo';
                    } catch (Exception $e) {
                        $result['error'] = 'No se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
                    }
                } else {
                    $result['error'] = 'No se pudo guardar el OTP';
                }
            }
            break;

        case 'verifyOTP':
            $_POST = Validator::validateForm($_POST);
            if (!$user->setEmail($_POST['correo']) || !$user->setOTP($_POST['otp'])) {
                $result['error'] = $user->getDataError();
            } elseif ($user->validateOTP($_POST['otp'])) {
                $_SESSION['reset_email'] = $_POST['correo'];
                $result['status'] = 1;
                $result['message'] = 'OTP verificado correctamente';
            } else {
                $result['error'] = 'OTP inválido o expirado';
            }
            break;

        case 'resetPassword':
            if (!isset($_SESSION['reset_email'])) {
                $result['error'] = 'No se ha verificado el OTP';
            } else {
                $_POST = Validator::validateForm($_POST);
                if (!$user->setEmail($_SESSION['reset_email']) || !$user->setNewPassword($_POST['clave'])) {
                    $result['error'] = $user->getDataError();
                } elseif ($user->resetPassword($_POST['clave'])) {
                    unset($_SESSION['reset_email']);
                    $result['status'] = 1;
                    $result['message'] = 'Contraseña restablecida correctamente';
                } else {
                    $result['error'] = 'No se pudo restablecer la contraseña';
                }
            }
            break;

        default:
            $result['error'] = 'Acción no disponible';
    }
    echo json_encode($result);
}
?>
