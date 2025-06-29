<?php 
require "function.php";


?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex items-center justify-center px-4 py-10">

  <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full border border-gray-200">
    <div class="text-center mb-6">
      <div class="text-3xl mb-2">📝</div>
      <h2 class="text-2xl font-bold text-blue-700">Register Admin</h2>
      <p class="text-sm text-gray-500 mt-1">Daftarkan akun baru untuk login ke sistem</p>
    </div>

    <form action="function.php" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <button type="submit" name="register" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold transition">
        Daftar
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-gray-500 text-sm">Sudah punya akun? <a href="index.php" class="text-blue-600 hover:underline">Login di sini</a></p>
    </div>
  </div>

</body>
</html>

