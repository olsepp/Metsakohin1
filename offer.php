<?php
session_start();
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
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            let form = document.getElementById("offer-form");
            if (form) {
                form.submit();
            } else {
                console.error("Form not found.");
            }
        }
    </script>
</head>
<body class="no-css">
    <div class="opening">

        <?php include 'header-nav.html'?>

        <div id="notification" class="notification" style="display: none;"></div>

        <?php
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $success = $_SESSION['success'];
            // Set notification background color based on success
            $bgColor = $success ? "green" : "red";
            echo "<script>
                document.getElementById('notification').textContent = '$message';
                document.getElementById('notification').style.display = 'block';
                document.getElementById('notification').style.backgroundColor = '$bgColor';
              </script>";

            // Clear session variables so the message does not show after a refresh
            unset($_SESSION['message']);
            unset($_SESSION['success']);
        }
        ?>

        <div class="opening-text">
            Küsi pakkumist
            <p>
                Anname vastuse esimesel võimalusel
            </p>
        </div>
    </div>
    <div class="content-area" id="section-offer">
        <div class="offer-wrapper">
            <div class="offer">
                <div class="offer-card">
                    <h1>Küsige pakkumist</h1>
                    <div class="input-area">
                        <form id="offer-form" method="post" action="verification.php">
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
                            <button type="submit" name="send" class="send g-recaptcha"
                                    data-sitekey="6Leh38kqAAAAAFUjA-TO4BRKQqPJ2pnn2CtdkmFt"
                                    data-callback="onSubmit"
                                    data-action="send">Saada</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </div>
    <script>
        // Auto-hide notification after 5 seconds
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);

        if (document.getElementById('notification').style.display === 'block') {
            const form = document.getElementById('section-offer');
            if (form) {
                form.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</body>
</html>
