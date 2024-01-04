<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Utiliza __DIR__ para obtener el directorio actual del script
require __DIR__ . '/vendor/autoload.php';  // Requiere la biblioteca Dotenv
require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cargar variables de entorno desde el archivo .env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER']; 
    $mail->Password = $_ENV['SMTP_PASS']; 
    $mail->SMTPSecure = 'ssl'; 
    $mail->Port = 465;

    //Mail donde llega el contacto
    $receiving_email_address = 'tomicampos2233@gmail.com';

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
