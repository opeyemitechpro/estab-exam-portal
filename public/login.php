<?php session_start(); ?>

<?php
// session_start();
if (isset($_SESSION['register_success'])) {
    echo '<div style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">'
       . htmlspecialchars($_SESSION['register_success']) .
       '</div>';
    unset($_SESSION['register_success']); // Clear it so it shows only once
}

// Show login error message
if (isset($_SESSION['login_error'])) {
    echo '<div style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            ' . htmlspecialchars($_SESSION['login_error']) . '
          </div>';
    unset($_SESSION['login_error']);
}

// ✅ Logout success message
if (isset($_SESSION['logout_success'])) {
    echo '<div class="bg-blue-100 text-blue-800 p-3 rounded-lg mb-4 text-sm font-medium">'
       . htmlspecialchars($_SESSION['logout_success']) . '</div>';
    unset($_SESSION['logout_success']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Bureau Exam System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <form action="../app/controllers/authController.php" method="POST" class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-800">Bureau Exam System</h2>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 p-2 mb-4 rounded"><?= $error ?></div>
    <?php endif; ?>

    <input type="email" name="email" placeholder="Email" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <input type="password" name="password" placeholder="Password" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <button type="submit" name="login"
      class="bg-blue-700 text-white w-full py-2 rounded hover:bg-blue-600">Login</button>

    <div class="text-center text-sm mt-4">
      <a href="register.php" class="text-blue-600 hover:underline">Sign Up</a> |
      <a href="forgot_password.php" class="text-blue-600 hover:underline">Forgot Password?</a>
    </div>
  </form>
</body>
</html>
