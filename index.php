<?php 
require "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Input Cetakin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
     
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

  <form action="function.php" method="POST" enctype="multipart/form-data" 
        class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

    <h2 class="mb-10 text-2xl font-bold text-center text-blue-600">LOGIN</h2>

    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Username</span>
      <input type="text" name="username" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
    </label>
    <label class="block mb-3">
      <span  class="text-gray-700 font-semibold">Password</span>
      <input type="password" name="password" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
    </label>

    

    <button type="submit" name="login"
      class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
      Login
    </button>

  </form>

</body>
</html>
