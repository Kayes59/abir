<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $phpmailer = new PHPMailer(true);

    try {

        // SMTP setup
        $phpmailer->isSMTP();
        $phpmailer->Host       = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = 2525;

        // Mailtrap credentials
        $phpmailer->Username   = '2e4d4780e41f3a';
        $phpmailer->Password   = 'bbb4e3f6fdcbe9';

        // Email settings
        $phpmailer->setFrom('noreply@portfolio.com', 'Portfolio Website');
        $phpmailer->addAddress('abdullahalkayes59@gmail.com');

        $phpmailer->Subject = "New Contact Form Message";

        $phpmailer->Body =
        "New message from website:\n\n" .
        "Name: $name\n" .
        "Email: $email\n\n" .
        "Message:\n$message";

        $phpmailer->send();

        echo "<script>
                alert('Message Sent Successfully (Mailtrap)');
                window.location='index.html';
              </script>";

    } catch (Exception $e) {

        echo "<script>
                alert('Message Failed!');
                window.location='index.html';
              </script>";

        echo "Error: " . $phpmailer->ErrorInfo;
    }
}
?>