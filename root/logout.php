<?php
    require_once("include/session.php");
    require_once("include/redirect.php");
    require_once("include/checklogin.php");

    sessionReset();
    redirectOnIndexPage();
?>