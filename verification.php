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
            header("Location:offer.php");
            exit;
        }

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth   = true;

            $mail->Host       = $_ENV['SMTP_HOST'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['SMTP_PORT'];

            $mail->Username   = $_ENV['SMTP_USERNAME'];
            $mail->Password   = $_ENV['SMTP_PASSWORD'];

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($_ENV['MAIL_TO'], 'Veebileht');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Pakkumine lehelt metsakohin.ee';
            $mail->Body    = "
        <strong>Nimi:</strong> $name <br>
        <strong>Email:</strong> $email <br>
        <strong>Telefon:</strong> $phone <br>
        <strong>Katastrinumber:</strong> $katastrinumber <br>
        <strong>Hinnasoov:</strong> $hinnasoov <br>
        <strong>Lisainfo:</strong> $lisainfo";

            $mail->AltBody = "
            Nimi: $name
            Email: $email
            Telefon: $phone
            Katastrinumber: $katastrinumber
            Hinnasoov: $hinnasoov
            Lisainfo: $lisainfo";

            $mail->send();

            $_SESSION["success"] = true;
            $_SESSION["message"] = "Saadetud!";

        } catch (Exception $e) {

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









