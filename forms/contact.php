<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiving_email_address = 'contacto@degliasoluciones.com'; 

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (Gmail)
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contacto@degliasoluciones.com'; 
        $mail->Password = 'TostadaconManteca.8'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Configuración del correo
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Enviar el correo
        $mail->send();

        echo 'Enviado con éxito. Gracias por contactarte con nosotros!';
    } catch (Exception $e) {
        echo 'Error';
    }
} else {
    echo 'Acceso no permitido.';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
