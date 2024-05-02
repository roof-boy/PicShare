<?php

include 'config.php';

session_start();

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: " . BASE_URL . "main/main.php");
    exit();
}
?>
