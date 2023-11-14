<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiving_email_address = 'tomicampos2233@gmail.com';

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);

    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $success = mail($receiving_email_address, $subject, $message, $headers);

    if ($success) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
