<?php
session_start();

include 'config.php';

session_destroy();

header("Location: " . BASE_URL . "login/login.php");
?>