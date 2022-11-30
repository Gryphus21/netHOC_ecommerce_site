<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");
    
    if (sessionIsSet("userID") 
        and sessionIsSet("firstname") 
        and sessionIsSet("email") 
        and sessionIsSet("type")) {

        $userLogged = true;

        $userID = sessionGet("userID");
        $firstname = sessionGet("firstname");
        $email = sessionGet("email");
        $usrType = sessionGet("type");
        
    } else {
        $userLogged = false;
    }

    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", "Il DB non è raggiungibile");
    }
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Servizi</title>

        <link rel="shortcut icon" href="img/favicon.ico"/>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/services.css">

        <style>
            .navbar img {
                cursor: url("img/lightning.png") 20 15, auto;
            }
        </style>
    </head>
    <body>
        <header class="header">
            <nav class="navbar">
                <img src="img/netHOC_logo.png" alt="Impossibile visualizzare il logo aziendale">

                <ul class="navbar_links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#Internet">Internet</a></li>
                    <li><a href="#Networking">Networking</a></li>
                </ul>

                <div class="btn_containar">
                    <?php
                        if ($userLogged) {
                            echo '
                                <a href="logout.php"><button class="button username_btn">' . $firstname . ', logout</button></a>
                                <a href="view_cart.php"><button class="button cart"><i class="fa fa-shopping-cart"></i> Carrello</button></a> 
                            ';
                        } else {
                            //$from = base64_encode("services.php");
                            // <a href="access.php?from=' . $from . '"><button class="button">ACCEDI</button></a>
                            echo '
                                <a href="access.php"><button class="button">ACCEDI</button></a>
                            ';
                        }
                    ?>
                </div>
            </nav>
            
            <div class="line"></div>
        </header>
        

        <div class="body_content">
            <h1 class="main_titles">I nostri servizi</h1>
            <h2 class="main_titles">Qui sotto tutti i nostri servizi</h2>

            <section class="section sec_internet">
                <h3 id="Internet">Internet</h3>

                <div class="card_deck">

                    <?php
                        $sql = "SELECT * FROM services_internet";
                        if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) == 0)
                            redirectOnErrorPage_all("services.php", "Impossibile trovare risultati per servizi Internet");
                        
                        while ($service = mysqli_fetch_assoc($response)) {
                            echo '
                                <div class="card">
                                    <img src="' . $service["img_path"] . '" alt="Impossibile caricare l\'immagine">
                                
                                    <div class="card_body">
                                        <h3>' . $service["service_name"] . '</h3>
                                        <h4>DESCRIZIONE</h4>
                                        <p class="p_service">
                                            ' . $service["description"] . '
                                        </p><br>

                                        <h4>VANTAGGI</h4>
                                        <p class="p_service">
                                            <ul class="ser_benefit">
                            '; //                     |
                            if ($service["advantage_1"] != null) echo '                                    <li>' . $service["advantage_1"] . '</li>';
                            if ($service["advantage_2"] != null) echo '                                    <li>' . $service["advantage_2"] . '</li>';
                            if ($service["advantage_3"] != null) echo '                                    <li>' . $service["advantage_3"] . '</li>';
                            echo '          </ul>
                                        </p><br>

                                        <h4>COSTO</h4>
                                        <p class="p_service">
                                            ' . $service["price"] . ' Euro/mese
                                        </p><br>
                                ';
                            if ($userLogged) echo '      <a href="add_to_cart.php?s=' . $service["serviceID"] . '"><button class="button">Aggiungi al carrello</button></a>';
                            else             echo '      <a href="error.php?from=' . base64_encode("access.php") . '&err=' . base64_encode("Non hai fatto l'accesso") . '"><button class="button">Aggiungi al carrello</button></a>';
                            echo '  </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </section>
            

            <div class="line"></div> <!-- --------------------------------- -->


            <section class="section sec_networking">
                <h3 id="Networking">Networking</h3>

                <div class="card_deck">
                    <div class="card">
                        <img src="img/services/networking/network_home.jpg" alt="Impossibile caricare l'immagine">
                    
                        <div class="card_body">
                            <h3>Reti casalinghe</h3>
                            <h4>DESCRIZIONE</h4>
                            <p class="p_service">
                                Soluzione ideale per chi vuole disegnata una rete casalinga struturata in meno di 50mq.
                            </p><br>

                            <h4>COME PROCEDERE</h4>
                            <p class="p_service">
                                Contattacci per metterci d'accordo sulle specifiche di progetto
                            </p><br>

                            <a href="index.php#Contatti"><button class="button">Procedi</button></a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <img src="img/services/networking/network_little_industry.jpg" alt="Impossibile caricare l'immagine">
                    
                        <div class="card_body">
                            <h3>Reti per piccole aziende</h3>
                            
                            <h4>DESCRIZIONE</h4>
                            <p class="p_service">
                                Soluzione di rete per piccole aziende, che non superi i 150mq.
                            </p><br>

                            <h4>COME PROCEDERE</h4>
                            <p class="p_service">
                                Contattacci per metterci d'accordo sulle specifiche di progetto
                            </p><br>

                            <a href="index.php#Contatti"><button class="button">Procedi</button></a>
                        </div>
                    </div>

                    <div class="card">
                        <img src="img/services/networking/network_medium_industry.jpg" alt="Impossibile caricare l'immagine">
                    
                        <div class="card_body">
                            <h3>Reti per aziende medie</h3>
                            
                            <h4>DESCRIZIONE</h4>
                            <p class="p_service">
                                Soluzione per grandi aziende, che non superi i 600mq.
                            </p><br>

                            <h4>COME PROCEDERE</h4>
                            <p class="p_service">
                                Contattacci per metterci d'accordo sulle specifiche di progetto
                            </p><br>

                            <a href="index.php#Contatti"><button class="button">Procedi</button></a>
                        </div>
                    </div>
                </div>
            </section>

            <?php require_once("include/resource/fixed.html"); ?>
        </div> <!-- FINE body_content -->

        <?php 
            require_once("include/resource/footer/footer.html");
        ?>
    </body>

    <script src="js/javascript.js"></script>
</html>