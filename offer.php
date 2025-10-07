<?php
session_start();
?>
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
        session_start();

        $message = "";
        $bgColor = "";
        $formData = [];
        $messageType = "";

        if (isset($_SESSION['form_data'])) {
            $formData = $_SESSION['form_data'];
        }

        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message']['text'];
            $messageType = $_SESSION['message']['type'];
            $bgColor = $messageType === "success" ? "seagreen" : "red";
        }

        if (!empty($message)) {
            echo "<div id='notification' style='background-color: $bgColor;'>
            $message
          </div>";
        }

        if ($messageType === 'success') {
            unset($_SESSION['form_data']);
            $formData = [];
        }

        // Clear the message after displaying
        unset($_SESSION['message']);
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
                                    <input type="text" id="name" name="name"
                                           placeholder="Sisestage oma nimi" required
                                            value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-post*</label>
                                    <input type="email" id="email" name="email"
                                           placeholder="Sisestage oma e-post" required
                                            value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Telefon*</label>
                                    <input type="tel" id="phone" name="phone"
                                           placeholder="Sisestage oma telefoninumber" required
                                            value="<?php echo isset($formData['phone']) ? htmlspecialchars($formData['phone']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="katastrinumber">Katastrinumber</label>
                                    <input type="text" id="katastrinumber" name="katastrinumber"
                                           placeholder="Sisestage katastrinumber"
                                            value="<?php echo isset($formData['katastrinumber']) ? htmlspecialchars($formData['katastrinumber']) : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hinnasoov">Hinnasoov</label>
                                <input type="text" id="hinnasoov" name="hinnasoov"
                                       placeholder="Sisestage hinnasoov"
                                        value="<?php echo isset($formData['hinnasoov']) ? htmlspecialchars($formData['hinnasoov']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lisainfo">Lisainfo</label>
                                <textarea id="lisainfo" name="lisainfo" placeholder="Kirjeldage lisainfot" rows="4"><?php echo isset($formData['lisainfo']) ? htmlspecialchars($formData['lisainfo']) : ''; ?></textarea>
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
            else {
                const form = document.getElementById("section-offer");
                if (form) {
                    form.scrollIntoView({ behavior: "smooth" });
                }
            }
        });
    </script>

    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</body>
</html>
