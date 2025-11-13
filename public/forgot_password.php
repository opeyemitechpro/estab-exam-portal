<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password - Bureau Exam System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <form action="../app/controllers/authController.php" method="POST" class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-800">Forgot Password</h2>
    <p class="text-gray-600 text-sm mb-4 text-center">Enter your registered email. You’ll receive password reset instructions.</p>

    <input type="email" name="email" placeholder="Email Address" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <button type="submit" name="reset"
      class="bg-blue-700 text-white w-full py-2 rounded hover:bg-blue-600">Send Reset Link</button>

    <div class="text-center text-sm mt-4">
      <a href="login.php" class="text-blue-600 hover:underline">Back to Login</a>
    </div>
  </form>
</body>
</html>
