<?php
    require_once("include/dbinfo.php");
    require_once("include/redirect.php");

    if (!(sessionIsSet("userID") and sessionIsSet("firstname") and sessionIsSet("email"))) {
        redirectOnErrorPage_onlyError("Non hai il permesso", 1);
    }
?>