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

    $mail->addAddress('tirado.pla09@gmail.com');
    //$mail->addAddress('aarok_ny224@hotmail.com');
    $mail->Subject = "Confirmación de asistencia: " . htmlspecialchars($_POST["nombre"]);

    if($_POST["assist"] == "y") {
        $mail->Body = "<h1>";
        $mail->Body .= "¡" . htmlspecialchars($_POST["nombre"]) . " asistirá!";
        $mail->Body .= "</h1>";
        $mail->Body .= "<h2>Llevara ". htmlspecialchars($_POST["acompañantes"]) . " acompañante(s)</h2>";
        $mail->Body .= "<br><h2>Bebida preferida</h2>";
        $mail->Body .= "<p>" . htmlspecialchars($_POST["bebida"]) . "</p>";
    } 
    else if ($_POST["assist"] == "p"){
        $mail->Body = "<h1>";
        $mail->Body .= htmlspecialchars($_POST["nombre"]) . " esta pendiente de confirmar su asistencia";
        $mail->Body .= "</h1>";
        $mail->Body .= "<h2>posiblemente lleve ". htmlspecialchars($_POST["acompañantes"]) . " acompañante(s)</h2>";
    }
    else {
        $mail->Body = "<h1>";
        $mail->Body .= htmlspecialchars($_POST["nombre"]) . " no podrá asistir a tu evento.";
        $mail->Body .= "</h1>";
    }
    $mail->Body .= "<h2>Mensaje para la los novios:</h2>";
    $mail->Body .= "<p>" . htmlspecialchars($_POST["mensaje"]) . "</p>";

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
