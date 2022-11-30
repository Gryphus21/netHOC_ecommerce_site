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
        $sql = "DELETE FROM cart WHERE FK_serviceID='$service'";
        
        $response = mysqli_query($nethocdb, $sql);
        if (!$response) {
            redirectOnErrorPage_all("view_cart.php", "Non è stato possibile rimuovere il prodotto dal carrello");
        }

        //if (mysqli_num_rows($response) > 0) { 
            redirectOn("view_cart.php");
        //} else {
        //    redirectOnErrorPage_onlyError("Non è stato rimosso il prodotto dal carrello", 1);
        //}
    }
?>