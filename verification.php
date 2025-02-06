<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $recaptchaSecret = "6Leh38kqAAAAAAOfYMIqBs8KjQGuyxXu68IGhkRI";
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
        $katastrinumber = htmlspecialchars(trim($_POST['katastrinumber']), ENT_QUOTES, 'UTF-8');
        $hinnasoov = htmlspecialchars(trim($_POST['hinnasoov']), ENT_QUOTES, 'UTF-8');
        $lisainfo = htmlspecialchars(trim($_POST['lisainfo']), ENT_QUOTES, 'UTF-8');

//        $smtp_host = "smtp.zone.eu"; // Change to your SMTP server
//        $smtp_username = "your_email@yourdomain.com"; // Your SMTP username
//        $smtp_password = "your_password"; // Your SMTP password
//        $smtp_port = 587; // Usually 465 (SSL) or 587 (TLS)
//
//        // Email Content
//        $to = "info@metsakohin.ee";
//        $subject = "Pakkumine lehelt metsakohin.ee";
//        $message_body = "
//    Nimi: $name
//    Email: $email
//    Telefon: $phone
//    Katastrinumber: $katastrinumber
//    Hinnasoov: $hinnasoov
//    Lisainfo: $lisainfo
//    ";
//
//        // Headers
//        $headers = "From: " . $smtp_username . "\r\n";
//        $headers .= "Reply-To: " . $email . "\r\n";
//        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
//
//        // Send email using SMTP (fsockopen)
//        $smtp_conn = fsockopen($smtp_host, $smtp_port, $errorCode, $errorMessage, 30);

//        if (!$smtp_conn) {
//            $response["message"] = "Ei saanud SMTP serveriga ühendust: $errorMessage ($errorCode)";
//            echo json_encode($response);
//            exit;
//        }
//
//        fputs($smtp_conn, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
//        fputs($smtp_conn, "AUTH LOGIN\r\n");
//        fputs($smtp_conn, base64_encode($smtp_username) . "\r\n");
//        fputs($smtp_conn, base64_encode($smtp_password) . "\r\n");
//        fputs($smtp_conn, "MAIL FROM: <$smtp_username>\r\n");
//        fputs($smtp_conn, "RCPT TO: <$to>\r\n");
//        fputs($smtp_conn, "DATA\r\n");
//        fputs($smtp_conn, "Subject: $subject\r\n$headers\r\n$message_body\r\n.\r\n");
//        fputs($smtp_conn, "QUIT\r\n");
//
//        fclose($smtp_conn);

        $response["success"] = true;
        $response["message"] = "Saadetud!";

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    } else {
        $response["success"] = false;
        $response["message"] = "Captcha verification failed!";

        // reCAPTCHA not verified. Do not send email, show error message
    }
}









