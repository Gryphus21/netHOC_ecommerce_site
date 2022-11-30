<?php
    function sessionTurnOn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function sessionTurnOff() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            return true;
        }
        return false;
    }

    function sessionReset() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            return true;
        }
        return false;
    }

    function sessionSet($index, $value) {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $_SESSION[$index] = $value;
            return true;
        }
        return false;
    }

    function sessionGet($index) {
        if (session_status() == PHP_SESSION_ACTIVE and isset($_SESSION[$index])) {
            return $_SESSION[$index];
        }
    }

    function sessionIsSet($index) {
        return isset($_SESSION[$index]);
    }

    sessionTurnOn();
?>