<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");

    if (!(  isset($_GET["email"]) 
            and isset($_GET["password"]) 
            and isset($_GET["firstname"]) 
            and isset($_GET["lastname"])
            and isset($_GET["residence"])
            and isset($_GET["city"])
            and isset($_GET["cap"])
            and isset($_GET["cf"]) 
        ))
        redirectOnIndexPage();

    $email = $_GET["email"];
    $password = $_GET["password"];

    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $residence = $_GET["residence"];
    $city = $_GET["city"];
    $cap = $_GET["cap"];
    $cf = $_GET["cf"];

    /*echo 
        "email: " . $email . "<br>" .
        "password: " . $password . "<br>" .
        "firstname: " . $firstname . "<br>" .
        "lastname: " . $lastname . "<br>" .
        "residence: " . $residence . "<br>" .
        "city: " . $city . "<br>" .
        "cap: " . $cap . "<br>" .
        "cf: " . $cf . "<br><br><br>";
    */

    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", "Il DB non è raggiungibile");
    }

    // ### Verifica della disponibilità della email ###
    $emailAvailable = true;

    $sql = "SELECT email 
            FROM users
            WHERE email = '$email'";
    if (mysqli_num_rows(mysqli_query($nethocdb, $sql)) > 0) {
        $emailAvailable = false;
    }

    // Se la email è disponibile: procede; altrimenti ti reindirizza alla Access page
    if ($emailAvailable) { 
        $salt = random_int(1, 1000000000); /*1 - 1.000.000.000*/
        $psw_salt = $password . $salt;
        $psw_md5 = md5($psw_salt);

        $sql = "INSERT INTO users (userID,  firstname,    lastname,     email,     password,     salt,     residence,    city,    cap,    cf,    type)
                           VALUES (Null  , '$firstname', '$lastname', '$email',   '$psw_md5',   '$salt',  '$residence', '$city', '$cap', '$cf', '1')";
        if (mysqli_query($nethocdb, $sql)) {

            $sql = "SELECT userID, firstname, email, type  
                    FROM users 
                    WHERE email='$email' AND password='$psw_md5'";
                    
            if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) > 0) {
                $response_assoc = mysqli_fetch_assoc($response);
            
                /*echo "ID:" . $response_assoc["userID"] . "<br>";
                echo "firstname:" . $response_assoc["firstname"] . "<br>";
                echo "email:" . $response_assoc["email"] . "<br>";*/

                // ### Loggo l'utente ###
                //TODO: Usare una funzione per loggare l'utente
                sessionSet("userID", $response_assoc["userID"]);
                sessionSet("firstname", $response_assoc["firstname"]);
                sessionSet("email", $response_assoc["email"]);
                sessionSet("type", $response_assoc["type"]);
                
                // ### Redirect ###
                redirectOnIndexPage();

            } else
                redirectOnErrorPage_all("access.php", "Errore interno");
        } else {
            redirectOnErrorPage_all("access.php", "Ci sono stati problemi con la registrazione, ritenta");
        }
            
    } else {
        redirectOnAccessPage(SIGNIN_EMAIL_WRONG, SIGNIN_EMAIL_ID);
    }
?>