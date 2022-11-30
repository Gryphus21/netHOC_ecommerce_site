<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");

    if (!(isset($_GET["email"]) and isset($_GET["psw"])))
        redirectOnIndexPage();

    $email = $_GET["email"];
    $password = $_GET["psw"];


    /*
    var_dump($_GET["from"]);
    die("FINE");

    if (isset($_GET["from"])) 
        $from = base64_decode($_GET["from"]);
    else
        $from = "";
    */

    /*
    echo "email: " . $email . "<br>" .
    "password: " . $password . "<br>";
    */

    // ### Controllo se il DB è raggiungibile ###
    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", mysqli_connect_error());
    }

    // ### Controllo della email ###
    $sql = "SELECT email FROM users WHERE email = '$email'";
    if ((mysqli_num_rows(mysqli_query($nethocdb, $sql))) == 0) { // Nessuna corrispondenza
        redirectOnAccessPage(LOGIN_EMAIL_WRONG, LOGIN_EMAIL_ID);
    }

    // ### Controllo della password ###
    // Ottengo il SALT
    $sql = "SELECT salt FROM users WHERE email = '$email'";
    if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) > 0) {
        $salt = mysqli_fetch_assoc($response)["salt"];

    } else {
        redirectOnErrorPage_onlyError("Houston, we have a problem. Nessun SALT nel DB", 1);
    }

    $psw_md5 = md5($password . $salt);

    /*
    echo "password: " . $password . "<br>" .
        "salt: " . $salt . "<br>" . 
        "psw_md5: " . $psw_md5 . "<br>";

    die("--");
    */

    $sql = "SELECT userID, firstname, email, type
            FROM users
            WHERE email='$email' AND password='$psw_md5'";

    if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) > 0) {
        $response_assoc = mysqli_fetch_assoc($response);

        // ### Loggo l'utente ###
        sessionSet("userID", $response_assoc["userID"]);
        sessionSet("firstname", $response_assoc["firstname"]);
        sessionSet("email", $response_assoc["email"]);
        sessionSet("type", $response_assoc["type"]);

        // ### Redirect ###

        if (sessionGet("type") == "1")
            redirectOnIndexPage();
        else
            redirectOn("admin.php");
        /*var_dump($from);
        die();
        redirectOn($from);*/
        

    } else {
        redirectOnAccessPage(LOGIN_PASSWORD_WRONG, LOGIN_PASSWORD_ID);
    }
?>