<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'e582e0265198c4';
        $mail->Password = 'e9b3bd68cbea77';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'utf-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en App
        Salon, solo debes confirmarla precionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aquí:<a href='http://localhost:3000/confirmar-cuenta?token=" 
        . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .=  "<p>Si tu no solicitaste esta cuenta, puedes ingnorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        
        // Enviar el email
        $mail->send();
        
    }

    public function enviarInstrucciones(){
        // Crear el objeto de email
         // Crear el objeto de email
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = 'sandbox.smtp.mailtrap.io';
         $mail->SMTPAuth = true;
         $mail->Port = 2525;
         $mail->Username = 'e582e0265198c4';
         $mail->Password = 'e9b3bd68cbea77';
 
         $mail->setFrom('cuentas@appsalon.com');
         $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
         $mail->Subject = 'Reestablece tu password';
 
         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'utf-8';
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, 
         sigue el siguiente enlace para hacerlo.</p>";
         $contenido .= "<p> Presiona aquí:<a href='http://localhost:3000/recuperar?token=" 
         . $this->token . "'>Reestablecer password</a></p>";
         $contenido .=  "<p>Si tu no solicitaste esta cuenta, puedes ingnorar el mensaje</p>";
         $contenido .= "</html>";
         $mail->Body = $contenido;
         
         // Enviar el email
         $mail->send();
         

    }
}
