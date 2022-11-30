<?php
    /*
        0: SIGNIN_EMAIL_WRONG
        1: LOGIN_EMAIL_WRONG
        2: LOGIN_PASSWORD_WRONG
    */

    if (isset($_GET["errNo"]))
        $errNo = intval($_GET["errNo"]);
    else
        $errNo = -1;


    /*
    if (isset($_GET["from"]))
        $from_encoded = $_GET["from"];
    else
        $from_encoded = "";
    */

    /*var_dump($from_encoded);
    die();*/
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Accesso</title>

        <link rel="shortcut icon" href="img/favicon.ico"/>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/access.css">
        
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
                </ul>
            </nav>

            <div class="line"></div>
        </header>

        <div class="body_content">
            <h1 class="main_titles">Accedi</h1>
                <h2 class="main_titles">Esegui l'accesso per usufruire dei nostri servizi</h2>
                <h3 class="disclaimer">Ricorda che accedendo acconsenti all'uso dei Cookie e allo stoccaggio dei dati personali su un database pieno di falle di sicurezza</h3>

                <div class="div_access">
                    <section class="section sec_login">
                        <h3>Accedi</h3>
                        <p>Hai già un profilo? Accedi qui!</p><br>

                        <!-- LOGIN --> <!--    < ?php echo (boolval($from_encoded)) ? '?'.$from_encoded : "?x=0"; ?>    -->
                        <form class="form form_login" method="GET" action="login.php">
                            <!-- EMAIL -->
                            <label for="in_log_email" id="label_login_email"><i class="fas fa-envelope"></i> EMAIL</label>
                            <input type="email" name="email" id="in_log_email" placeholder="Inserisci la tua email" maxlength="25" required>
                <?php
                    if ($errNo == 1) 
                        echo '
                            <div class="tooltip login_email_tooltip">
                                <i class="fas fa-exclamation-triangle alert_icon"></i>
                                <span class="tooltiptext">Email è errata</span>
                            </div> 
                            ';
                ?> 
                            
                            <br>

                            <!-- PASSWORD -->
                            <label for="in_log_pass" id="label_login_password"><i class="fas fa-lock"></i> PASSWORD</label>
                            <input type="password" name="psw" id="in_log_pass" placeholder="Inserisci la tua password" maxlength="20" required>       
                <?php
                    if ($errNo == 2) 
                        echo '
                            <div class="tooltip login_password_tooltip">
                                <i class="fas fa-exclamation-triangle alert_icon"></i>
                                <span class="tooltiptext">La password è errata</span>
                            </div>
                            ';
                ?>   
                            
                            <br>

                            <a href="#"><button class="button">ACCEDI</button></a>
                        </form>
                    </section>

                    <section class="section sec_register">
                        <h3>Registrati</h3>
                        <p>Non hai un profilo ? Registrati ora!</p><br>

                        <!-- SIGNIN --> <!--  < ?php echo (boolval($from_encoded)) ? '?'.$from_encoded : ""; ?>  -->
                        <form class="form form_registration" method="GET" action="register.php">
                            <!-- EMAIL -->
                            <label for="in_reg_email" id="label_signin_email"><i class="fas fa-envelope"></i> EMAIL</label>
                            <input type="email" name="email" id="in_reg_email" placeholder="Inserisci la tua email" maxlength="25" required>
                <?php
                    if ($errNo == 0) 
                        echo '
                            <div class="tooltip signin_email_tooltip">
                                <i class="fas fa-exclamation-triangle alert_icon"></i>
                                <span class="tooltiptext">Email già registrata</span>
                            </div> 
                            ';
                ?>       
                            
                            <br>

                            <!-- PASSWORD -->
                            <label for="in_reg_psw"><i class="fas fa-lock"></i> PASSWORD</label>
                            <input value="" type="password" name="password" id="in_reg_psw" placeholder="Inserisci la tua password" maxlength="20" required>
                            <br>
                            
                            <!-- PASSWORD CONFERMA -->
                            <label for="in_reg_psw_conf"><i class="fas fa-lock"></i> PASSWORD</label>
                            <input value="" type="password" name="password2" id="in_reg_psw_conf" placeholder="Ripeti password" maxlength="20" required>

                            <br><br><br>

                            <!-- NOME -->
                            <label for="in_reg_firstname"><i class="fas fa-pencil-alt"></i> NOME</label>
                            <input value="" type="text" name="firstname" id="in_reg_firstname" placeholder="Inserisci il tuo nome" maxlength="10" required>
                            <br>

                            <!-- COGNOME -->
                            <label for="in_reg_lastname"><i class="fas fa-pencil-alt"></i> COGNOME</label>
                            <input value="" type="text" name="lastname" id="in_reg_lastname" placeholder="Inserisci il tuo cognome" maxlength="10" required>
                            <br>
                            
                            <!-- VIA DI ABITAZIONE -->
                            <label for="in_reg_residence"><i class="fas fa-home"></i> VIA DI ABITAZIONE</label>
                            <input value="" type="text" name="residence" id="in_reg_residence" placeholder="Inserisci la Via/Piazza n°" maxlength="30" required>
                            <br>

                            <!-- CITTÀ -->
                            <label for="in_reg_city"><i class="fas fa-city"></i> CITTÀ</label>
                            <input value="" type="text" name="city" id="in_reg_city" placeholder="Inserisci la tua Città" maxlength="30" required>
                            <br>

                            <!-- CAP -->
                            <label for="in_reg_cap"><i class=""></i> CAP</label>
                            <input value="" type="text" name="cap" id="in_reg_cap" placeholder="Inserisci il CAP della tua città" pattern="[0-9]{5}" maxlength="5" required>
                            <br>

                            <!-- CODICE FISCALE -->
                            <label for="in_reg_cf"><i class="fas fa-id-card"></i> CODICE FISCALE</label>
                            <input value="" type="text" name="cf" id="in_reg_cf" placeholder="Inserisci il Codice Fiscale" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" maxlength="16" required>
                            <br>
                            <span style="color: black;">RSSMRA70A41F205Z</span>
                            <br>

                            <button class="button" type="submit">REGISTRATI</button>
                        </form>
                    </section>
                </div>

                <?php require_once("include/resource/fixed.html"); ?>
        </div> <!-- FINE body_content -->

        <?php 
            require_once("include/resource/footer/footer.html"); 
        ?>
    </body>

    <script src="js/javascript.js"></script>
    <script>
        var password = document.getElementById("in_reg_psw");
        var password_conf = document.getElementById("in_reg_psw_conf");

        function validatePassword() {
            if(password.value != password_conf.value) 
                password_conf.setCustomValidity("La password non corrisponde");
            else 
                password_conf.setCustomValidity("");
        }

        password.onchange = validatePassword;
        password_conf.onkeyup = validatePassword;
    </script>
</html>