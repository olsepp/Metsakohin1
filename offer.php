<?php
require 'config/env.php';

$message = "";
$messageType = "success";
$debugInfo = []; // Debug array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Debug: Check if secret key exists
    $recaptchaSecret = env('CAPTCHA_SECRET');
    $debugInfo[] = "Secret key exists: " . ($recaptchaSecret ? 'YES' : 'NO');
    $debugInfo[] = "Secret key length: " . ($recaptchaSecret ? strlen($recaptchaSecret) : '0');

    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    $debugInfo[] = "Token received: " . ($recaptchaResponse ? 'YES (length: ' . strlen($recaptchaResponse) . ')' : 'NO');

    // Verify reCAPTCHA
    $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($verifyURL . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);

    $debugInfo[] = "file_get_contents response: " . ($response === false ? 'FAILED' : 'SUCCESS');

    if ($response !== false) {
        $responseData = json_decode($response);
        $debugInfo[] = "JSON decode: " . ($responseData ? 'SUCCESS' : 'FAILED');
        $debugInfo[] = "Full response: " . print_r($responseData, true);

        if (!$responseData->success) {
            $errorCodes = isset($responseData->{'error-codes'}) ? implode(', ', $responseData->{'error-codes'}) : 'unknown error';
            $debugInfo[] = "Error codes: " . $errorCodes;
            $message = "reCAPTCHA verification failed. Error: " . $errorCodes;
            $messageType = "error";
        } elseif (isset($responseData->score) && $responseData->score < 0.5) {
            $debugInfo[] = "Score too low: " . $responseData->score;
            $message = "reCAPTCHA score too low: " . $responseData->score;
            $messageType = "error";
        } else {
            // Sanitize inputs
            $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
            $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8');
            $katastrinumber = htmlspecialchars($_POST['katastrinumber'] ?? '', ENT_QUOTES, 'UTF-8');
            $hinnasoov = htmlspecialchars($_POST['hinnasoov'] ?? '', ENT_QUOTES, 'UTF-8');
            $lisainfo = htmlspecialchars($_POST['lisainfo'] ?? '', ENT_QUOTES, 'UTF-8');

            // Validate required fields
            if (empty($name) || !$email || empty($phone)) {
                $message = "Palun täitke kõik kohustuslikud väljad!";
                $messageType = "error";
            } else {
                // Send email using mail()
                $to = env('MAIL_TO') ?: 'test@example.com';
                $subject = 'Uus pakkumise päring - metsakohin.ee';

                $emailBody = "Uus pakkumise päring\n\n";
                $emailBody .= "Nimi: $name\n";
                $emailBody .= "E-post: $email\n";
                $emailBody .= "Telefon: $phone\n";
                $emailBody .= "Katastrinumber: " . ($katastrinumber ?: 'Ei määratud') . "\n";
                $emailBody .= "Hinnasoov: " . ($hinnasoov ?: 'Ei määratud') . "\n";
                $emailBody .= "Lisainfo: " . ($lisainfo ?: 'Ei määratud') . "\n\n";
                $emailBody .= "Saadetud: " . date('d.m.Y H:i:s') . "\n";

                $headers = "From: " . (env('MAIL_FROM') ?: 'noreply@metsakohin.ee') . "\r\n";
                $headers .= "Reply-To: $email\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                if (mail($to, $subject, $emailBody, $headers)) {
                    $message = "Täname! Teie päring on edukalt saadetud.";
                    $messageType = "success";
                } else {
                    $message = "E-kirja saatmine ebaõnnestus.";
                    $messageType = "error";
                }
            }
        }
    } else {
        $message = "Cannot connect to reCAPTCHA servers.";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Küsi pakkumist - Metsakohin OÜ</title>
    <meta name="description" content="Küsige pakkumist meie pakutavate teenuste kohta.">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/offer.css">
    <link rel="icon" href="icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6Leh38kqAAAAAFUjA-TO4BRKQqPJ2pnn2CtdkmFt"></script><script src="https://www.google.com/recaptcha/api.js?render=6Leh38kqAAAAAFUjA-TO4BRKQqPJ2pnn2CtdkmFt"></script>    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</head>
<body class="no-css">
<div class="opening">
    <?php include 'header-nav.html'?>

    <?php if ($message): ?>
        <div class="notification notification-<?php echo $messageType; ?>" id="notification">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="opening-text">
        Küsi pakkumist
        <p>Anname vastuse esimesel võimalusel</p>
    </div>
</div>
<div class="content-area" id="section-about">
    <div class="offer-wrapper">
        <div class="offer">
            <div class="offer-card">
                <h1>Küsige pakkumist</h1>
                <div class="input-area">
                    <form method="post" action="" id="offerForm">
                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nimi*</label>
                                <input type="text" id="name" name="name" placeholder="Sisestage oma nimi" required value="<?php echo $_POST['name'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-post*</label>
                                <input type="email" id="email" name="email" placeholder="Sisestage oma e-post" required value="<?php echo $_POST['email'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Telefon*</label>
                                <input type="tel" id="phone" name="phone" placeholder="Sisestage oma telefoninumber" required value="<?php echo $_POST['phone'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="katastrinumber">Katastrinumber</label>
                                <input type="text" id="katastrinumber" name="katastrinumber" placeholder="Sisestage katastrinumber" value="<?php echo $_POST['katastrinumber'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hinnasoov">Hinnasoov</label>
                            <input type="text" id="hinnasoov" name="hinnasoov" placeholder="Sisestage hinnasoov" value="<?php echo $_POST['hinnasoov'] ?? ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lisainfo">Lisainfo</label>
                            <textarea id="lisainfo" name="lisainfo" placeholder="Kirjeldage lisainfot" rows="4"><?php echo $_POST['lisainfo'] ?? ''; ?></textarea>
                            <p class="field">* - kohustuslik väli</p>
                        </div>
                        <button
                                type="button"
                                class="send"
                                onclick="submitFormWithRecaptcha()">
                            Saada
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</div>
<script>
    // reCAPTCHA callback function
    function submitFormWithRecaptcha() {
        grecaptcha.ready(function() {
            grecaptcha.execute('6Leh38kqAAAAAFUjA-TO4BRKQqPJ2pnn2CtdkmFt', {action: 'submit'})
                .then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    document.getElementById('offerForm').submit();
                });
        });
    }


    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.style.display = 'none', 300);
        }, 5000);
    }

    window.addEventListener('load', () => {
        const content = document.querySelector('.content-area');
        if (content) {
            const elementTop = content.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({ top: elementTop - 70, behavior: 'smooth' });
        }
    });
</script>
</body>
</html>