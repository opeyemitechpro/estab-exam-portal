<?php
// Simple mock signup for testing (no database yet)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($fullname) && !empty($email) && !empty($password)) {
        echo "<h2>Signup successful!</h2>";
        echo "<p>Welcome, $fullname ($email).</p>";
    } else {
        echo "<h2>Error: All fields are required.</h2>";
    }
}
?>
