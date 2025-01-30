<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/contacts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <script src="bg-change.js"></script>
</head>
<body>
    <div class="opening">
        <?php include 'header-nav.html'?>
        <div class="opening-text">
            Kontakt
            <p>
                Küsi nõu oma ala spetsialistidelt
            </p>
        </div>
    </div>

    <div class="content-contacts" id="section-contact">
        <div class="contacts-main">
            <h1>Meie inimesed</h1>
            <div class="contacts-people">
                <div class="tonu">
                    <img src="contact-pics/tonu.png" alt="Tõnu Sepp">
                    <br>
                    <h1>TÕNU SEPP</h1>
                    <br>
                    <strong>
                        Juhatuse liige
                    </strong>
                    <p>
                        +372 5032325
                    </p>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let user = "&#115;&#101;&#112;&#112;";
                            let domain = "&#109;&#101;&#116;&#115;&#97;&#107;&#111;&#104;&#105;&#110;&#46;&#101;&#101;";
                            let email = user + "&#64;" + domain;
                            document.getElementById("email-link-1").innerHTML = '<a href="mailto:' + email + '">' + email + '</a>';
                        });
                    </script>
                    <span id="email-link-1">See e-posti aadress on spämmirobotite eest kaitstud. Selle nägemiseks peab su veebilehitsejas olema JavaSkript sisse lülitatud.</span>
                    <p>
                        Haridus: Tootmis- ja transporditehnika insener (Tallinna Tehnikaülikool)
                    </p>
                    <br>
                    <p>
                        Metsatöö kogemus üle 20 aasta.
                    </p>
                </div>
                <div class="silja">
                    <img src="contact-pics/silja.png" alt="Silja Sepp">
                    <br>
                    <h1>SILJA SEPP</h1>
                    <br>
                    <strong>
                        Juhatuse liige
                    </strong>
                    <p>
                        +372 5210507
                    </p>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let user = "&#115;&#105;&#108;&#106;&#97;";
                            let domain = "&#109;&#101;&#116;&#115;&#97;&#107;&#111;&#104;&#105;&#110;&#46;&#101;&#101;";
                            let email = user + "&#64;" + domain;
                            document.getElementById("email-link-2").innerHTML = '<a href="mailto:' + email + '">' + email + '</a>';
                        });
                    </script>
                    <span id="email-link-2">See e-posti aadress on spämmirobotite eest kaitstud. Selle nägemiseks peab su veebilehitsejas olema JavaSkript sisse lülitatud.</span>
                    <p>
                        Haridus: tehnika-teaduste bakalaureus ja loodusteaduste magister (Tallinna Tehnikaülikool)
                    </p>
                </div>
                <div class="tanel">
                    <img src="contact-pics/tanel.png" alt="Tanel Tuuleveski">
                    <br>
                    <h1>TANEL TUULEVESKI</h1>
                    <br>
                    <strong>
                        Juhatuse liige
                    </strong>
                    <p>
                        +372 5131533
                    </p>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let user = "&#116;&#97;&#110;&#101;&#108;";
                            let domain = "&#109;&#101;&#116;&#115;&#97;&#107;&#111;&#104;&#105;&#110;&#46;&#101;&#101;";
                            let email = user + "&#64;" + domain;
                            document.getElementById("email-link-3").innerHTML = '<a href="mailto:' + email + '">' + email + '</a>';
                        });
                    </script>
                    <span id="email-link-3">See e-posti aadress on spämmirobotite eest kaitstud. Selle nägemiseks peab su veebilehitsejas olema JavaSkript sisse lülitatud.</span>
                    <p>
                        Haridus: Metsatööstuse eriala (Eesti Maaülikool)
                    </p>
                    <br>
                    <p>
                        Metsandusega tegelenud ca 20 aastat
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>
</html>