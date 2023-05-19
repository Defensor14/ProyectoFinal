<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../../../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = false;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->isHTML(true);
    $mail->isSMTP();

    $mail->Host       = 'ssl://mail.invitacionesinteligente.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'confirmaciones@invitacionesinteligente.com';
    $mail->Password   = 'N@e11c$[6l6(';
    $mail->SMTPSecure = false;
    $mail->SMTPAutoTLS = false;
    $mail->Port       = 465;

    $mail->setFrom('confirmaciones@invitacionesinteligente.com', 'Invitaciones Digitales');

    $mail->ClearReplyTos();
    $mail->AddReplyTo('invitacionesparabodamx@gmail.com', 'Invitaciones Digitales');

    $mail->addAddress('aarok_ny224@hotmail.com');
    $mail->Subject = "Comentarios de: " . htmlspecialchars($_POST["nombre"]);

    if($_POST["assist"] == "y") {
        $mail->Body = "<h1>";
        $mail->Body .= "¡ A " . htmlspecialchars($_POST["nombre"]) . " le ha gustado la pagina!";
        $mail->Body .= "</h1>";
        $mail->Body .= "<h2>Ademas la calificaria con ". htmlspecialchars($_POST["acompañantes"]) . " </h2>";
    } 
    else {
        $mail->Body = "<h1>";
        $mail->Body .= "¡ A" . htmlspecialchars($_POST["nombre"]) . " no le ha gustado la pagina!";
        $mail->Body .= "</h1>";
        $mail->Body .= "<h2>Y la calificaria con ". htmlspecialchars($_POST["acompañantes"]) . " :( </h2>";
    }
    $mail->Body .= "<h2>Comentarios y sugerencias:</h2>";
    $mail->Body .= "<p>" . htmlspecialchars($_POST["mensaje"]) . "</p><br>";
    $mail->Body .= "<h2>FAVOR DE NO CONTESTAR ESTE CORREO, EL USUARIO DE ENVIO ES SOLO TEMPORAL</h2>";

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
