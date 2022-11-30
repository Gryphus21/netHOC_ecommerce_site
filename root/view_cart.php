<?php
    require_once("include/dbinfo.php");
    require_once("include/session.php");
    require_once("include/redirect.php");
    
    if (sessionIsSet("userID") 
        and sessionIsSet("firstname") 
        and sessionIsSet("email") 
        and sessionIsSet("type")) {

        $userID = sessionGet("userID");
        $firstname = sessionGet("firstname");
        $email = sessionGet("email");
        $usrType = sessionGet("type");
        
    } else {
        redirectOnErrorPage_onlyError("Non puoi accedere a questa pagina", 1);
    }

    if (!$nethocdb) {
        redirectOnErrorPage_all("access.php", "Il DB non è raggiungibile");
    }

    $services_in_cart = false;

    $sql = "SELECT services_internet .serviceID, services_internet.service_name, services_internet.description, services_internet.advantage_1, services_internet.advantage_2, services_internet.advantage_3, services_internet.price, services_internet.img_path FROM services_internet INNER JOIN cart ON services_internet.serviceID = cart.FK_serviceID WHERE cart.FK_userID = '$userID'";
    $response = mysqli_query($nethocdb, $sql);
    if (!$response) {  
        redirectOnErrorPage_all("index.php", "Errore con la query");
    }
    while ($row = mysqli_fetch_assoc($response)) {
        $services_in_cart[] = $row;
    }

    if ($services_in_cart) {
        // Verificare se alcuni o tutti i servizi nel carrello sono già stati comprati

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

        
        $buyed_services = false;
        if (is_array($list_service_ids_in_payments)) { //TODO: Sistemare questo rattoppo orrendo
            foreach($list_service_ids_in_cart as $service_id) {
                if (is_int(array_search($service_id, $list_service_ids_in_payments))) {
                    $buyed_services[] = $service_id;
                }
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>netHOC - Carrello</title>

        <link rel="shortcut icon" href="img/favicon.ico"/>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/view_cart.css">
        
        <style>
            .navbar img {
                cursor: url("img/lightning.png") 20 15, auto;
            }
        </style>
    </head>
    <body>
        <?php 
            require_once("include/resource/header/header_view_cart.php");
        ?>
        

        <div class="body_content">
            <h1 class="main_titles">Carrello</h1>
            
            <?php   
                if ($services_in_cart) {
                    echo '<h2 class="main_titles">Qui sotto tutti i servizi nel carrello</h2>';
                } else {
                    echo '<h2 class="main_titles">Carrello vuoto</h2>';
                }
            ?>
            
            <section class="section sec_cart">
                <?php
                    if ($services_in_cart) {
                        $tot_price = 0.0;

                        foreach ($services_in_cart as $i=>$service) {
                            $tot_price += floatval($service["price"]);

                            echo '
                                <div class="card">
                                    <img src="' . $service["img_path"] . '" alt="Impossibile caricare l\'immagine">
                                        
                                    <div class="card_body">
                                        <h3>' . $service["service_name"] . '</h3>
                                                
                                        <h4>DESCRIZIONE</h4>
                                        <p class="p_service">
                                            ' . $service["description"] . '
                                        </p><br>

                                        <h4>COSTO</h4>
                                        <p class="p_service">
                                            ' . $service["price"] . ' Euro/mese
                                        </p>

                                        <a href="remove_from_cart.php?s=' . $service["serviceID"] . '"><button class="button">Rimuovi</button></a>
                                ';
                            if (is_array($buyed_services))
                                if (is_int(array_search($service["serviceID"], $buyed_services)))
                                    echo '
                                        <div class="tooltip login_email_tooltip">
                                            <i class="fas fa-exclamation-triangle alert_icon"></i>
                                            <span class="tooltiptext">Sei già abbonato a questo servizio, si prega di rimuoverlo</span>
                                        </div>
                                    ';

                            echo '
                                    </div>
                                </div>
                            ';
                        }
                    }
                ?>
            </section>
            
            <?php
                if ($services_in_cart) {
                    echo '
                        <div class="line"></div> <!-- --------------------------------- -->

                        <section class="section tot_price">
                            <h3>Totale: <span>' . $tot_price . '</span> Euro/mese</h3> 
                        </section>
            
                        <div class="line"></div> <!-- --------------------------------- -->
            
                        ';

                echo '      <section class="section">';

                if (!$buyed_services)
                    echo '
                            <h3 class="main_titles">Procedi con il pagamento</h3>
                            <h2 class="main_titles">Usa <span style="color: #00457C;">Pay</span><span style="color: #0079C1;">Pal</span> per effettuare il pagamento</h2>
            
                            <br><br><br>
                            
                    
                                <div id="smart-button-container">
                                    <div style="text-align: center;">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                    ';
                else 
                    echo '
                        <h3 class="main_titles">Servizi già acquistati</h3>
                        <h2 class="main_titles">Ricontrolla il carrello</h2>    
                    ';
                    
                    echo '
                
                                <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
                            </section>
                        ';
                }
            ?>
            
            <?php require_once("include/resource/fixed.html"); ?>
        </div> <!-- FINE body_content -->

        <?php 
            require_once("include/resource/footer/footer.html"); 
        ?>
    </body>

    <script src="js/javascript.js"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                shape: "pill",
                color: "gold",
                layout: "horizontal",
                label: "paypal",
                },

                createOrder: function(data, actions) {
                    location.href = "paymant.php";
                    /*return actions.order.create({
                        purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
                    });*/
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert("Transaction completed by " + details.payer.name.given_name + "!");
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render("#paypal-button-container");
        }
        initPayPalButton();
    </script>
</html>