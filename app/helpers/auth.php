<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// You can optionally define helper variables:
$user_email = $_SESSION['user'];
$user_name  = $_SESSION['name'] ?? 'User';
$user_role  = $_SESSION['role'] ?? 'admin';
?>
