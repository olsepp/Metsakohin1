<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $recaptchaSecret = $_ENV["CAPTCHA_SECRET"];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptcha = file_get_contents($recaptchaUrl . "?secret=" . $recaptchaSecret
        . "&response=" . $recaptchaResponse);
    $recaptcha = json_decode($recaptcha, true);

    if ($recaptcha["success"] == 1 AND $recaptcha["score"] >= 0.5
        AND $recaptcha["action"] == "send") {
        //reCAPTCHA verified. Proceed to send email.

        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
        $katastrinumber = htmlspecialchars(trim($_POST['katastrinumber']), ENT_QUOTES, 'UTF-8') ?? '';
        $hinnasoov = htmlspecialchars(trim($_POST['hinnasoov']), ENT_QUOTES, 'UTF-8') ?? '';
        $lisainfo = htmlspecialchars(trim($_POST['lisainfo']), ENT_QUOTES, 'UTF-8') ?? '';

        if (!$email) {
            $_SESSION["success"] = false;
            $_SESSION["message"] = 'Kehtetu e-post!';
            header("Location: offer.php");
            exit;
        }

// Email recipient
        $to = $_ENV['MAIL_TO'];

// Email subject
        $subject = 'Pakkumine lehelt metsakohin.ee';

// Email headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Email body
        $body = "
    <strong>Nimi:</strong> $name <br>
    <strong>Email:</strong> $email <br>
    <strong>Telefon:</strong> $phone <br>
    <strong>Katastrinumber:</strong> $katastrinumber <br>
    <strong>Hinnasoov:</strong> $hinnasoov <br>
    <strong>Lisainfo:</strong> $lisainfo";

        if (mail($to, $subject, $body, $headers)) {
            $_SESSION["success"] = true;
            $_SESSION["message"] = "Saadetud!";
        } else {
            $_SESSION["success"] = false;
            $_SESSION["message"] = "Midagi läks valesti!";
        }

    } else {
        $_SESSION["success"] = false;
        $_SESSION["message"] = "Captcha verification failed!";

        // reCAPTCHA not verified. Do not send email, show error message
    }
    header("Location:offer.php");
    exit;
}









