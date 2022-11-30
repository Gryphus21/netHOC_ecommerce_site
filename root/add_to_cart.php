<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");
    //require_once("include/checklogin.php");

    if (!(sessionIsSet("userID") 
            and sessionIsSet("firstname") 
            and sessionIsSet("email")
            and isset($_GET["s"])
        ))
        redirectOnErrorPage_onlyError("Nessun elemento selezionato", 1);

    $userID = sessionGet("userID");
    $service = intval($_GET["s"]);
    


    // ### Controllo se il DB è raggiungibile ###
    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", "Il DB non è raggiungibile");
    }

    // Ottengo l'ID del primo prodotto
    $sql = "SELECT serviceID FROM services_internet ORDER BY serviceID ASC LIMIT 1";
    if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) > 0) {
        $service_first = mysqli_fetch_assoc($response)["serviceID"];

    } else {
        redirectOnErrorPage_onlyError("Houston, we have a problem. Problema con la query", 1);
    }

    // Ottengo l'ID dell'ultimo prodotto
    $sql = "SELECT serviceID FROM services_internet ORDER BY serviceID DESC LIMIT 1";
    if (mysqli_num_rows($response = mysqli_query($nethocdb, $sql)) > 0) {
        $service_last = mysqli_fetch_assoc($response)["serviceID"];

    } else {
        redirectOnErrorPage_onlyError("Houston, we have a problem. Problema con la query", 1);
    }   


    if (is_int($service) and is_int($service) and ($service >= $service_first and $service <= $service_last)) {
        
        // Controllo se il prodotto esiste già
        $sql = "SELECT FK_serviceID FROM cart WHERE FK_serviceID = '$service'";
        if (mysqli_num_rows(mysqli_query($nethocdb, $sql)) > 0) {
            redirectOnErrorPage_all("services.php", "Il prodotto è già nel carrello");
        }

        // Inserire servizio nel carrello
        $sql = "INSERT INTO cart(cartID, FK_userID, FK_serviceID) VALUES ('Null', '$userID', '$service')";
        if (!mysqli_query($nethocdb, $sql)==1) {
            redirectOnErrorPage_all("services.php", "Il prodotto NON è stato aggiunto al carrello");
        }

    } else
        redirectOnErrorPage_onlyError("Errore con i dati inseriti, riprova", 1);
    
    redirectOn("services.php");
?>