<?php

namespace mail;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Mailer
{






    function enviarEmail(string $remitente , string  $destinatario ,string $body, string $destinatarioCC='' , string $pathFile='')
    {

        $mail = new PHPMailer(true);

        try {
            //Server settings
           ;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'guillermomartinez1222@gmail.com';                     //SMTP username
            $mail->Password   = 'mjcvkskvcgmgeicd';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($remitente, 'Mailer');
            $mail->addAddress($destinatario);     //Add a recipient
          
           if($destinatarioCC!='')
            $mail->addCC($destinatarioCC);

          

            //Attachments
            if($pathFile!='')
             $mail->addAttachment($pathFile);         //Add attachments
          
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Pedido realizado';
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
       
    }


   
    
}
