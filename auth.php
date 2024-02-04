<?php

include 'config.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: /instacopy" . $register_page);
}
?>