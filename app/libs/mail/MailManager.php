<?php

namespace app\libs\mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

final class MailManager{

    public static function createMail($email, $url): void{
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mHuenchur1@gmail.com';                     //SMTP username
            $mail->Password   = 'xshcoblsrhtynuum';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mHuenchur1@gmail.com', 'Administrador del SISTEMA AGENDA');
            $mail->addAddress($email, 'Usuario');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cambio de clave';
            $mail->Body    = 'http://localhost/ldp_agenda/autenticacion/resetPage/'. $url ;

            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("No se pudo enviar el correo");
        }

    }



}