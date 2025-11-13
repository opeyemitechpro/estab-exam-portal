<?php
session_start();

// Clear session variables and destroy the session
session_unset();
session_destroy();

// Set logout success message
session_start(); // Start a new session to store the message
$_SESSION['logout_success'] = "✅ You have been logged out successfully.";

// Redirect to login page
header("Location: login.php");
exit();
?>
