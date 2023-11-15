<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir la biblioteca PHPMailer
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración del servidor de correo
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contacto@degliasoluciones.com'; // Cambiar a tu dirección de correo
    $mail->Password = 'TostadaconManteca.8'; // Cambiar a tu contraseña
    $mail->SMTPSecure = 'ssl'; // Puedes cambiar a 'ssl' si es necesario
    $mail->Port = 465; // Puedes cambiar el puerto según la configuración de tu servidor

    // Destinatario del correo
    $receiving_email_address = 'contacto@degliasoluciones.com';

    // Recuperar datos del formulario
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);

    // Configuración del correo
    $mail->setFrom($email, $name);
    $mail->addAddress($receiving_email_address);
    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        // Enviar el correo
        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'No enviado, reintentar.';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
