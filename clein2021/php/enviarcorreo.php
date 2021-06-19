<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \Soundasleep\Html2Text;
// Load Composer's autoloader
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';


function enviarcorreo($to,$nombre,$subject,$body)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'mail.clein.org';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'casiion@clein.org';                     // SMTP username
        $mail->Password = 'lLKs9~cU@0.@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        //Recipients
        $mail->setFrom('casiion@clein.org', 'CASII-ON');
        $mail->addAddress($to, $nombre);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('contacto@clein.org', 'Contacto CLEIN');
//    $mail->addCC('cc@example.com');
        $mail->addBCC('casiion@clein.org');

        // Attachments
//    $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . "/bootcamp/certificado/ene2021/$id.pdf");         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;

        $mail->Body = $body;
        $mail->AltBody = Html2Text::convert($body);

        $mail->send();
        return "<p>Mensaje Enviado a $to</p>";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function enviarcorreoadjunto($to,$nombre,$subject,$body,$archivo)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'mail.clein.org';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'casiion@clein.org';                     // SMTP username
        $mail->Password = 'lLKs9~cU@0.@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        //Recipients
        $mail->setFrom('casiion@clein.org', 'CASII-ON');
        $mail->addAddress($to, $nombre);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('contacto@clein.org', 'Contacto CLEIN');
//    $mail->addCC('cc@example.com');
        $mail->addBCC('casiion@clein.org');

        // Attachments
        $mail->addAttachment($archivo,str_replace("/home/aleiiafc/app.clein.org/certificados/casiion/","",$archivo));         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;

        $mail->Body = $body;
        $mail->AltBody = Html2Text::convert($body);

        $mail->send();
        return "<p>Mensaje Enviado a $to</p>";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
