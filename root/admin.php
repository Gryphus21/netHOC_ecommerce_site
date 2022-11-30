<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");

    //TODO: Sistemare le query
    //TODO: Aggiungere tabella carrello
    
    if (sessionIsSet("userID") 
        and sessionIsSet("firstname") 
        and sessionIsSet("email") 
        and sessionIsSet("type")
        and sessionGet("type") == "0") {

        $userID = sessionGet("userID");
        $firstname = sessionGet("firstname");
        $email = sessionGet("email");
        $usrType = sessionGet("type");
        
    } else {
        redirectOnErrorPage_onlyError("Non puoi accedere a questa pagina", 1);
    }
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Pagina riservata</title>
        <link rel="shortcut icon" href="img/favicon.ico"/>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/admin.css">

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
                <a href="logout.php"><button class="button username_btn">Logout</button></a>
            </nav>
            
            <div class="line"></div>
        </header>
        

        <div class="body_content">
            <h1 class="main_titles">Pagina riservata</h1>
            
            <div class="line"></div>

            <h2 class="main_titles">Utenti registrati</h2>
            <table>
                <tr>
                    <th>ID utente</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Sale</th>
                    <th>Residenza</th>
                    <th>Città</th>
                    <th>CAP</th>
                    <th>Codice Fiscale</th>
                    <th>Tipo di utente</th>
                </tr>

                <?php
                    // ### Controllo se il DB è raggiungibile ###
                    if (!$nethocdb) {
                        redirectOnErrorPage_onlyError(mysqli_connect_error(), 0);
                    }

                    $sql = "SELECT * FROM users";
                    if ((mysqli_num_rows($response = mysqli_query($nethocdb, $sql))) > 0) { // Nessuna corrispondenza
                        
                        while ($arr = mysqli_fetch_assoc($response)) {
                            echo '<tr>';
                            foreach ($arr as $elem) {
                                echo '<td>' . $elem . '</td>';
                            }
                            echo '<tr>';
                        }

                    } else {
                        echo '<tr>';
                        for ($i=0; $i < 10; $i++) {
                            echo '<td>Vuoto</td><br>';
                        } 
                        echo '<tr>';
                    }
                ?>
            </table>
            
            <div class="line"></div>

            <h2 class="main_titles">Pagamenti</h2>
            <table>
                <tr>
                    <th>ID del pagamento</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Nome servizio</th>
                    <th>Codice della transazione</th>
                </tr>

                <?php
                    // ### Controllo se il DB è raggiungibile ###
                    if (!$nethocdb) {
                        redirectOnErrorPage_onlyError(mysqli_connect_error(), 0);
                    }

                    //$sql = "SELECT * FROM payments";
                    $sql = "SELECT payments.paymentID, users.firstname, users.lastname, users.email, services_internet.service_name, payments.transaction_code
                            FROM payments

                            INNER JOIN users
                            ON users.userID = payments.FK_userID

                            INNER JOIN services_internet
                            ON services_internet.serviceID = payments.FK_serviceID;
                            ";
                    if ((mysqli_num_rows($response = mysqli_query($nethocdb, $sql))) > 0) { // Nessuna corrispondenza
                        
                        while ($arr = mysqli_fetch_assoc($response)) {
                            echo '<tr>';
                            foreach ($arr as $elem) {
                                echo '<td>' . $elem . '</td>';
                            }
                            echo '<tr>';
                        }

                    } else {
                        echo '<tr>';
                        for ($i=0; $i < 4; $i++) {
                            echo '<td>Vuoto</td><br>';
                        } 
                        echo '<tr>';
                    }
                ?>
            </table>

            <?php require_once("include/resource/fixed.html"); ?>
        </div> <!-- FINE body_content -->

        <?php 
            require_once("include/resource/footer/footer.html"); 
        ?>
    </body>

    <script src="js/javascript.js"></script>
</html>