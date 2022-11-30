<?php
    require_once("include/session.php");
    require_once("include/redirect.php");


    if (sessionIsSet("userID") and sessionIsSet("firstname") and sessionIsSet("email") and sessionIsSet("type")) {
        $userLogged = true;

        $userID = sessionGet("userID");
        $firstname = sessionGet("firstname");
        $email = sessionGet("email");
    }
    else
        $userLogged = false;

    if (sessionGet("type") == "0")
        redirectOn("admin.php");
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Benvenuto nel futuro</title>
        
        <link rel="shortcut icon" href="img/favicon.ico">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/dropdown.css">

        <?php
            if($userLogged)
                echo '<link rel="stylesheet" href="css/index_logged.css">';
        ?>

        <style>
            .navbar img {
                cursor: url("img/lightning.png") 20 15, auto;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <?php
            if ($userLogged) 
                require_once("include/resource/header/header_index_logged.php");
            else
                require_once("include/resource/header/header_index.html");
        ?>

        <div class="body_content">
            <h1 class="main_titles">Benvenuto nel futuro</h1>
            <h2 class="main_titles">Benvenuto su <span style="color: #004e6c;">net</span><span style="color: #403e3f;">HOC</span></h2>
            
            <!-- CHI SIAMO -->
            <section class="section sec_chi_siamo">
                <h3 id="Chi_siamo">Chi siamo</h3>
                <p id="p_chi_siamo">
                    Siamo un gruppo di esperti nel settore, che si occupano di offrire ai propri clienti servizi di internet innovativi, semplici e soprattutto veloci.<br>
                    Siamo nati nel 2005 e da allora non facciamo altro che rendere i nostri clienti felici. <br>
                    L’accordo rappresenta una delle più importanti operazioni di fusione e acquisizione avvenute nel nostro paese negli ultimi anni. Non solo contribuisce alla crescita del Paese, grazie all’erogazione di investimenti per 6 miliardi di euro in infrastrutture digitali, ma permette anche alle controllate 3 ITALIA e WIND di acquisire la dimensione e l’efficienza necessarie per continuare a offrire servizi di telecomunicazione innovativi a prezzi competitivi, sempre più affidabili, veloci e dotati della copertura 4G/LTE.
                </p>
                <div class="icon_group">
                    <figure>
                        <img src="img/icons/develop.png" alt="Icona non disponibile"> 
                        <figcaption>Produttività</figcaption>
                    </figure>

                    <figure>
                        <img src="img/icons/partners-claping-hands.png" alt="Icona non disponibile">
                        <figcaption>Partners</figcaption>
                    </figure>

                    <figure>
                        <img src="img/icons/teamwork.png" alt="Icona non disponibile">
                        <figcaption>Gestione</figcaption>
                    </figure>
                </div>
            </section>
            <div class="line"></div>

            <!-- COSA FACCIAMO -->
            <section class="section sec_cosa_facciamo">
                <h3 id="Cosa_facciamo">Cosa facciamo</h3>
                <p id="p_cosa_facciamo">
                    Ci occupiamo di fornire svariati servizi di rete ai nostri clienti.<br>
                    Rendiamo disponibili i nostri consulenti che ti aiuteranno a scegliere il giusto compromesso per te.<br>
                    Oltre a questo progettiamo anche reti per te, contattaci e vedremo di metterci d'accordo sulle specifiche.
                </p>
                <div class="icon_group">
                    <figure>
                        <img src="img/icons/signal.png" alt="Icona non disponibile"> 
                        <figcaption>Connessione</figcaption>
                    </figure>

                    <figure>
                        <img src="img/icons/global.png" alt="Icona non disponibile">
                        <figcaption>Internet</figcaption>
                    </figure>

                    <figure>
                        <img src="img/icons/user.png" alt="Icona non disponibile">
                        <figcaption>Accounts</figcaption>
                    </figure>
                </div>
            </section>
            <div class="line"></div>

            <!-- DOVE SIAMO -->
            <section class="section sec_dove_siamo">
                <h3 id="Dove_siamo">Dove siamo</h3>
                <p id="p_dove_siamo">
                    Puoi visionare la località qui sotto, ti aspettiamo in sede.<br>
                    Siamo sempre aperti!<br>
                    Ci trovi in "<span style="color: #0090b4;">Via non saprei</span>" n°<span style="color: #0090b4;">113</span>, <span style="color: #0090b4;">Altrove</span>, <span style="color: #0090b4;">USA</span>
                </p>
                <br><br>
                <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.5731487796747!2d-77.05641711345595!3d38.87101728054059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDUyJzE1LjQiTiA3N8KwMDMnMjEuNSJX!5e1!3m2!1sit!2sit!4v1620404468989!5m2!1sit!2sit" width="600" height="450" allowfullscreen="" loading="lazy"></iframe>
            </section>
            <div class="line"></div>

            <!-- I NOSTRI SERVIZI -->
            <section class="section sec_i_nostri_servizi">
                <h3 id="I_nostri_servizi">I nostri servizi</h3>
                <div class="card_deck">
                    <a class="invisible_link" href="services.php">
                        <div class="card">
                            <img src="img/services/internet.jpg" alt="Impossibile caricare l'immagine">
                        
                            <div class="card_body">
                                <h3>Internet</h3>
                                <p class="p_service">
                                    Scopri tutti i vantaggi nel scegliere netHOC come gestore dei tuoi servizi di internet.<br>
                                    Scopri come usufruire al massimo delle nostre tariffe.<br>
                                    Premi qui per saperne di più.
                                </p><br>
                            <a href="services.php#Internet"><button class="button">Scopri di più</button></a>
                            </div>
                        </div>
                    </a>

                    <a class="invisible_link" href="services.php">
                        <div class="card">
                            <img src="img/services/network.jpg" class="service_images" alt="Impossibile caricare l'immagine">
                        
                            <div class="card_body">
                                <h3>Networking</h3>
                                <p class="p_service">
                                    Ti aiuteremo noi a progettare la tua rete infrastrutturale!<br>
                                    Siamo perfettamente in grado di ideare e costruire per te la tua rete telematica<br>
                                    anche per piccole/medie imprese!
                                </p><br>
                                <a href="services.php#Networking"><button class="button">Scopri di più</button></a>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <div class="line"></div>

            <!-- CONTATTI -->
            <section class="section sec_contatti">
                <h3 id="Contatti">Contatti</h3>
                
                <div>
                    <p>
                        <span class="title_contatti">CONTATTI TELEFONICI</span><br>
                        <span style="color: #0090b4;">Sede aziendale</span>: 555-2368<br>
                        <span style="color: #0090b4;">Centro assistenza</span>: 555-2369
                    </p><br>
                    <p>
                        <span class="title_contatti">CONTATTI VIA EMAIL</span><br>
                        <span style="color: #0090b4;">Assistenza tecnica</span>: assistenza@nethoc.hyper<br>
                        <span style="color: #0090b4;">Assistenza sopralluogo</span>: sopralluoghi@nethoc.hyper
                    </p>
                </div>
            </section>
            
            <?php require_once("include/resource/fixed.html"); ?>
        </div> <!-- FINE body_content -->

        <?php require_once("include/resource/footer/footer.html"); ?>
    </body>

    <script src="js/javascript.js"></script>
</html>