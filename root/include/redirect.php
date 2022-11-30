<?php
    /*Per la pagina Access*/
    define("SIGNIN_EMAIL_WRONG", 0); // Codice per 'ErrNo'
    define("LOGIN_EMAIL_WRONG", 1); // Codice per 'ErrNo'
    define("LOGIN_PASSWORD_WRONG", 2); // Codice per 'ErrNo'

    define("SIGNIN_EMAIL_ID", "label_signin_email"); // ID per puntare alla label email in Access page
    define("LOGIN_EMAIL_ID", "label_login_email");
    define("LOGIN_PASSWORD_ID", "label_login_password");


    /**
     * Reindirizza alla pagina Error, specificare i parametri NON CODIFICATI, redirect a tempo.
     * @param $from [String/URL] Url per il redirect IN CHIARO
     * @param $error [String] Testo dell'errore IN CHIARO
     */ 
    function redirectOnErrorPage_all($from, $error) {
        header("Location: error.php?from=" . base64_encode($from) . "&err=" . base64_encode($error));
        die();
    }

    /**
     * Reindirizza alla pagina Error, specificare i parametri NON CODIFICATI.
     * @param $error [String] Testo dell'errore IN CHIARO
     * @param $homeEnable [Int - 0/1] Decidi se attivare il tasto Home nella pagina 'Error'
     */ 
    function redirectOnErrorPage_onlyError($error, $homeEnable) {
        header("Location: error.php?err=" . base64_encode($error) . "&home=" . $homeEnable);
        die();
    }



    /**
     * Reindirizza alla pagina Access per credenziali errate, indicando qual'è quella errata
     * @param $errorNo Indica il numero del errore, campo errato
     * @param $id ID dell'elemento label/input
     */
    function redirectOnAccessPage($errorNo, $id) {
        header("Location: access.php?errNo=" . $errorNo . "#" . $id);
        die();
    }

    /**
     * Reindirizza alla pagina di Accesso senza specificare nessun errore
     */
    function redirectOnAccessPage_noError() {
        header("Location: access.php");
        die();
    }


    /**
     * Reindirizza alla pagina Index
     */
    function redirectOnIndexPage() {
        header("Location: index.php");
        die();
    }

    /**
     * Reindirizza alla pagina specificata
     * @param $page URL della pagina
     */
    function redirectOn($page) {
        header("Location: " . $page);
        die();
    }
?>