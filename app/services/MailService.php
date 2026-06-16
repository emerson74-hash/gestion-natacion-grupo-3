<?php
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function sendEmailResetPassword($toEmail, $token)
    {
        $mail = new PHPMailer(true);

        try {
            // CONFIG SMTP
            $mail->isSMTP();
            $mail->Host       = Env::get('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = Env::get('MAIL_USERNAME');
            $mail->Password   = Env::get('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = Env::get('MAIL_PORT');

            $mail->setFrom(Env::get('MAIL_FROM'), 'Soporte Escuela de Natación');
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Recuperación de contraseña';

            $baseUrl = rtrim(Env::get('APP_URL'), '/');
            $resetLink = $baseUrl . '/?url=reset-password&token=' . $token;

          
            $color = '#4FD1E8';

            $mail->Body = "
            <div style='font-family:Arial;background:#f4f7f9;padding:30px'>
                <div style='max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden'>
                    
                    <div style='background:$color;padding:20px;text-align:center;color:white'>
                        <h2>Recuperación de contraseña</h2>
                    </div>

                    <div style='padding:30px;text-align:center'>
                        <p>Hacé clic en el botón para restablecer tu contraseña</p>

                        <a href='$resetLink'
                           style='display:inline-block;margin-top:20px;padding:12px 20px;
                           background:$color;color:white;text-decoration:none;border-radius:6px'>
                           Restablecer contraseña
                        </a>

                        <p style='margin-top:20px;font-size:12px;color:#888'>
                            Este enlace expira en 1 hora
                        </p>
                    </div>
                </div>
            </div>";

            //quitar debug en producción
            $mail->SMTPDebug = 0;

            return $mail->send();

        } catch (Exception $e) {
            error_log("MAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }


    //Admin: Mail alta de coach
   public function sendCoachCredentials($email, $nombre, $password)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = Env::get('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = Env::get('MAIL_USERNAME');
        $mail->Password   = Env::get('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = Env::get('MAIL_PORT');

        $mail->setFrom(
            Env::get('MAIL_FROM'),
            'Sistema Natación'
        );

        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Subject = 'Credenciales de acceso';

        $mail->Body = "
            <div style='font-family:Arial;padding:20px'>
                <h2>Bienvenido {$nombre}</h2>

                <p>Tu cuenta fue creada correctamente.</p>

                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Contraseña:</strong> {$password}</p>

                <hr>

                <p style='font-size:12px;color:#777'>
                    Sistema Escuela de Natación
                </p>
            </div>
        ";

        $mail->SMTPDebug = 0;

        return $mail->send();

    } catch (Exception $e) {

        error_log("MAIL ERROR: " . $e->getMessage());

        return false;
    }
}


}