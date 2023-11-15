<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contacto@degliasoluciones.com'; 
    $mail->Password = 'TostadaconManteca.8'; 
    $mail->SMTPSecure = 'ssl'; 
    $mail->Port = 465; 

    //Mail donde llega el contacto
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
