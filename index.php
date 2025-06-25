<?php 

require "function.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Cetakin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <form action="function.php" method="POST" class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-4 text-center text-blue-600">Login Admin</h2>

    <label class="block mb-3">
      <span class="text-gray-700">Username</span>
      <input type="text" name="username" required class="w-full p-2 border rounded mt-1" />
    </label>

    <label class="block mb-4">
      <span class="text-gray-700">Password</span>
      <input type="password" name="password" required class="w-full p-2 border rounded mt-1" />
    </label>

    <button type="submit" name="login" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
      Login
    </button>
  </form>
</body>
</html>
