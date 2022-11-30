<?php
    function br() {  //TODO: Da rimuovere
        echo '<br>';
    }
    
    if (!isset($_SERVER['HTTP_HOST'])) {
        die("_SERVER non dichiarato");
    }

    if ($_SERVER['HTTP_HOST'] != "127.0.0.1") { // Hosting
        $db_username = '';
        $db_password = '';
        $db_name = '';
        $db_host = '';
        
    } else { // Local
        $db_username = 'root';
        $db_password = '';
        $db_name = 'nethoc_main_db';
        $db_host = '127.0.0.1';
    }

    $nethocdb = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    /*if (!$nethocdb) { 
        redirectOnErrorPage_onlyError(mysqli_connect_error() . " Torna alla Home e riprova. [dbinfo]", 1);
    }*/
?>