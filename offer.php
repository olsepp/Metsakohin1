<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
    $katastrinumber = htmlspecialchars($_POST['katastrinumber'], ENT_QUOTES, 'UTF-8');
    $hinnasoov = htmlspecialchars($_POST['hinnasoov'], ENT_QUOTES, 'UTF-8');
    $lisainfo = htmlspecialchars($_POST['lisainfo'], ENT_QUOTES, 'UTF-8');


    if (!$email) {
        $message = "Palun sisestage kehtiv e-posti aadress!";
    }
    else {
        $data = "$name;$email;$phone;$katastrinumber;$hinnasoov;$lisainfo\n";

        $file = 'customers.txt';
        if (file_put_contents($file, $data, FILE_APPEND)) {
            $message = "Saadetud!";

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();  // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
                $mail->SMTPAuth = true;  // Enable SMTP authentication
                $mail->Username = '';  // SMTP username
                $mail->Password = '';  // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
                $mail->Port = 587;  // TCP port to connect to

                //Recipients
                $mail->setFrom('example@gmail.com', 'Name');
                $mail->addAddress('example@gmail.com', 'Name');  // Add a recipient

                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Pakkumine lehelt metsakohin.ee';
                $mail->Body    = 'Name: ' . $name . '<br>Email: ' . $email . '<br>Phone: ' . $phone . '<br>Katastrinumber: ' . $katastrinumber . '<br>Lisainfo: ' . $lisainfo;
                $mail->AltBody = 'This is the plain-text version of the email content.';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }
        elseif (empty($name) || empty($email) || empty($phone)) {
            $message = "Täitke kohustuslikud väljad!";
        } else {
            $message = "Ilmnes viga, proovi uuesti!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Küsi pakkumist</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/offer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</head>
<body class="no-css">
    <div class="opening">

        <?php include 'header-nav.html'?>

        <?php if ($message): ?>
            <div class="notification" id="notification"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div class="opening-text">
            Küsi pakkumist
            <p>
                Anname vastuse esimesel võimalusel
            </p>
        </div>
    </div>
    <div class="content-area" id="section-about">
        <div class="offer-wrapper">
            <div class="offer">
                <div class="offer-card">
                    <h1>Küsige pakkumist</h1>
                    <div class="input-area">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nimi*</label>
                                    <input type="text" id="name" name="name" placeholder="Sisestage oma nimi" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-post*</label>
                                    <input type="email" id="email" name="email" placeholder="Sisestage oma e-post" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Telefon*</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Sisestage oma telefoninumber" required>
                                </div>
                                <div class="form-group">
                                    <label for="katastrinumber">Katastrinumber</label>
                                    <input type="text" id="katastrinumber" name="katastrinumber" placeholder="Sisestage katastrinumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hinnasoov">Hinnasoov</label>
                                <input type="text" id="hinnasoov" name="hinnasoov" placeholder="Sisestage hinnasoov">
                            </div>
                            <div class="form-group">
                                <label for="lisainfo">Lisainfo</label>
                                <textarea id="lisainfo" name="lisainfo" placeholder="Kirjeldage lisainfot" rows="4"></textarea>
                                <p class="field">* - kohustuslik väli</p>
                            </div>
                            <button type="submit" name="send" class="send">Saada</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </div>
    <script>
        // Display notification for 5 seconds if present
        const notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000); // Hide after 5 seconds
        }

        window.addEventListener('load', () => {
            const content = document.querySelector('.content-area');
            if (content) {
                // Adjust this number (in pixels) to control how much less it scrolls
                const scrollOffset = 70; // e.g. scroll 150px less — change as you like

                // Calculate scroll position relative to content area
                const elementTop = content.getBoundingClientRect().top + window.scrollY;

                // Scroll smoothly to slightly above the element
                window.scrollTo({
                    top: elementTop - scrollOffset,
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>
</html>
