<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");


    function randTransCode() {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randomString = "";

        for ($i=0; $i < 17; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    if (sessionIsSet("userID") 
        and sessionIsSet("firstname") 
        and sessionIsSet("email") 
        and sessionIsSet("type")) {

        $userID = sessionGet("userID");
        $firstname = sessionGet("firstname");
        $email = sessionGet("email");
        $usrType = sessionGet("type");
        
    } else {
        redirectOnErrorPage_onlyError("Non puoi accedere a questa pagina.", 1);
    }

    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", "Il DB non è raggiungibile.");
    }


    

    $sql = "SELECT FK_userID, FK_serviceID FROM cart WHERE FK_userID = '$userID'";
    $response = mysqli_query($nethocdb, $sql);
    if (!$response) {  
        redirectOnErrorPage_all("index.php", "Errore con la query.");
    }
    $services_in_cart = false;
    while ($row = mysqli_fetch_assoc($response)) {
        $services_in_cart[] = $row['FK_serviceID'];
    }



    if (!$services_in_cart) {
        redirectOnErrorPage_onlyError("Non ci sono servizi da acquistare.", 1);
    }
    
    
    // Verificare se nella tabella pagamenti sono presenti servizi già comprati
    $sql = "SELECT FK_userID, FK_serviceID FROM cart WHERE FK_userID = '$userID'";
    $response = mysqli_query($nethocdb, $sql);
    $list_service_ids_in_cart = false;
    while ($row = mysqli_fetch_assoc($response)) {
        $list_service_ids_in_cart[] = $row['FK_serviceID'];
    }

    $sql = "SELECT FK_userID, FK_serviceID FROM payments WHERE FK_userID = '$userID'";
    $response = mysqli_query($nethocdb, $sql);
    $list_service_ids_in_payments = false;
    while ($row = mysqli_fetch_assoc($response)) {
        $list_service_ids_in_payments[] = $row['FK_serviceID'];
    }
    
    // Controllo di resenza servizi già acquistati
    if (is_array($list_service_ids_in_payments) and is_array($list_service_ids_in_cart)) { //TODO: Sistemare qui
        foreach($list_service_ids_in_cart as $service_id) {
            if (is_int(array_search($service_id, $list_service_ids_in_payments))) {
                redirectOnErrorPage_all("view_cart.php", "Ci sono servizi a cui sei già abbonato.");
            }
        }
    }
    

    // Aggiungere gli ordini alla tabella dei pagamenti
    $transaction_code = randTransCode();
    foreach ($services_in_cart as $cart_serviceID) {
        $sql = "INSERT INTO  payments (FK_userID, FK_serviceID, transaction_code)
                VALUES ('$userID', '$cart_serviceID', '$transaction_code');
                ";
        mysqli_query($nethocdb, $sql); //TODO: Aggiungere un controllo sulla query
    }


    // Rimuovere i servizi dal carrello
    $sql = "DELETE FROM cart WHERE FK_userID = '$userID'";
    mysqli_query($nethocdb, $sql);

    //TODO: Aggiungere una pagina di conferma ordine effettuato
    redirectOnIndexPage();
?>