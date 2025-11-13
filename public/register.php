<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Bureau Exam System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <form action="../app/controllers/authController.php" method="POST" class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-800">Create an Account</h2>

    <input type="text" name="full_name" placeholder="Full Name" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <input type="email" name="email" placeholder="Email" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <input type="password" name="password" placeholder="Password" required
      class="border w-full p-2 mb-4 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none" />

    <button type="submit" name="register"
      class="bg-green-700 text-white w-full py-2 rounded hover:bg-green-600">Register</button>

    <div class="text-center text-sm mt-4">
      <a href="login.php" class="text-blue-600 hover:underline">Back to Login</a>
    </div>
  </form>
</body>
</html>
