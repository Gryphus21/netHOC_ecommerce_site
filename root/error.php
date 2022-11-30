<?php
    if (isset($_GET["err"])) 
        $error_decoded = base64_decode($_GET["err"]);
    else
        $error_decoded = "#NONE#";


    if ($fromSetted = isset($_GET["from"])) {
        $from_decoded = base64_decode($_GET["from"]);
        header("refresh:5; url=$from_decoded");
    }


    if (isset($_GET["home"])) {
        $homeEnable = boolval($_GET["home"]);
    } else
        $homeEnable = false;
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Errore</title>
        <link rel="shortcut icon" href="img/favicon.ico"/>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/error.css">

        <style>
            .navbar img {
                cursor: url("img/lightning.png") 20 15, auto;
            }

            <?php
                if (!$fromSetted) // Aggiungo un ulteriore margine
                    echo '
                        .footer {
                            margin-top: 275px !important;
                        }
                    ';
            ?>
        </style>
    </head>
    <body>
        <header class="header">
            <nav class="navbar">
                <img src="img/netHOC_logo.png" alt="Impossibile visualizzare il logo aziendale">
                <?php
                    if ($homeEnable)
                        echo '
                        <ul class="navbar_links">
                            <li><a href="/index.php">Home</a></li>
                        </ul>
                        ';
                ?>
            </nav>

            <div class="line"></div>
        </header>

        <div class="body_content">
            <h1 class="main_titles">Errore imprevisto</h1>
            <h3 class="main_titles"><?php echo $error_decoded;?></h3>
            <br><br>
            <h3 class="main_titles">Contatta l'assistenza se l'errore persiste</h3>
            <?php
                if ($fromSetted) {
                    echo '<h3 class="main_titles">Sarai reindirizzato entro 5 secondi... Altrimenti premi <a href=' . $from_decoded . '>QUI</a></h3>';
                }
            ?>
            

        </div> <!-- FINE body_content -->

        <?php 
            require_once("include/resource/footer/footer.html"); 
        ?>
    </body>

    <script src="../js/javascript.js"></script>
</html>