<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Metsakohin, Metsa, Kohin, metsakohin, mets, müük, ost" />
    <meta name="description" content="Metsakohin OÜ" />
    <title>Metsakohin OÜ - Küsi pakkumist</title>
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

        <?php
        $message = "";
        $bgColor = "";

        if (isset($_GET['email'])) {
            if ($_GET['email'] == 'sent') {
                $message = "Saadetud!";
                $bgColor = "seagreen";
            } else {
                $message = "Midagi läks valesti!";
                $bgColor = "red";
            }
        } elseif (isset($_GET['captcha']) && $_GET['captcha'] == 'failed') {
            $message = "Captcha verification failed.";
            $bgColor = "red";
        }

        if (!empty($message)) {
            echo "<div id='notification' style='display: block; background-color: $bgColor; padding: 10px; color: white; text-align: center;'>
            $message
          </div>";
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
        document.addEventListener("DOMContentLoaded", function () {
            const notification = document.getElementById("notification");

            if (notification) {
                // Scroll to the form section
                const form = document.getElementById("section-offer");
                if (form) {
                    form.scrollIntoView({ behavior: "smooth" });
                }

                // Auto-hide notification after 5 seconds
                setTimeout(() => {
                    notification.style.display = "none";
                }, 5000);
            }
        });
    </script>

    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</body>
</html>
