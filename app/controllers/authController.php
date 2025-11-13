<?php
session_start();

// ✅ Correct path to DB connection
require_once __DIR__ . '/../config/database.php';

// REGISTER
if (isset($_POST['register'])) {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Prevent duplicate users
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $error = "Email already registered.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashed]);

        // Set a one-time success message in session
        $_SESSION['register_success'] = "Registration successful! You can now log in.";

        // Redirect to login page
        header("Location: ../../public/login.php");
        exit;
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user['email'];
        $_SESSION['name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'] ?? 'user';
        header("Location: ../../public/dashboard.php");
        exit;
    } else {
        // Store error message in session
        $_SESSION['login_error'] = "❌ Wrong email or password. Please try again.";
        header("Location: ../../public/login.php");
        exit;
    }
}


// FORGOT PASSWORD (placeholder)
if (isset($_POST['reset'])) {
    $email = trim($_POST['email']);
    $message = "If this email exists, a password reset link will be sent.";
}
?>
