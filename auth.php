<?php

include 'config.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: " . BASE_URL . "login/login.php?login=noCookie");
}
?>