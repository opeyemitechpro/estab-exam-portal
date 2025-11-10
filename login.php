<?php
// Simple mock authentication for testing (no DB yet)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === "admin@bureau.gov" && $password === "12345") {
        echo "<h2>Login successful. Welcome, $email!</h2>";
    } else {
        echo "<h2>Invalid credentials. Try again.</h2>";
    }
}
?>
