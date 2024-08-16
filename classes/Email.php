<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('cuentas@newproject.com' , 'NewProject.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = ('Confirmar tu cuenta');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola: " . $this->nombre . "</strong> <br> Has creado una cuenta en NewProject, para confirmar tu cuenta ve al siguiente enlace.</p>";
        $contenido .= "<p>Hacer clic aquí: <a href='" . $_ENV['PROJECT_URL'] . "/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "Si tu no creaste esta cuenta, favor de ignorar este mensaje";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('cuentas@newproject.com' , 'NewProject.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = ('Actualizar Contraseña');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola: " . $this->nombre . "</strong> <br> Para actualizar tu contraseña en NewProyect ve al siguiente enlace.</p>";
        $contenido .= "<p>Hacer clic aquí: <a href='" . $_ENV['PROJECT_URL'] . "/reestablecer?token=" . $this->token . "'>Actualizar Contraseña</a></p>";
        $contenido .= "Si tu no creaste esta cuenta, favor de ignorar este mensaje";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();
    }
}