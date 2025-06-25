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

    <h2 class="text-2xl font-bold text-center text-blue-600">Cetakin</h2>
    <p class="text-sm text-center text-blue-500 mb-6">Cetakin disini aja!</p>


    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Nama</span>
      <input type="text" name="nama" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
    </label>

    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Ukuran</span>
      <select name="ukuran" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <option value="">Pilih ukuran</option>
        <option value="hvs">hvs 21x29.7cm</option>
        <option value="2x3">2x3 8lembar</option>
        <option value="3x4">3x4 6lembar</option>
        <option value="4x6">4x6 4lembar</option>
        <option value="10r">10r</option>
      </select>
    </label>

    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Jumlah</span>
      <input type="number" name="jumlah" min="1" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
    </label>

    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Deskripsi</span>
      <textarea name="deskripsi" rows="3" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 
               focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 resize-none"></textarea>
    </label>

    <label class="block mb-6">
      <span class="text-gray-700 font-semibold">Upload File (Multiple)</span>
      <input type="file" name="file" multiple
        class="mt-1 block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-100 file:text-blue-700
               hover:file:bg-blue-200
               cursor-pointer" />
    </label>

    <button type="submit" name="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
      Submit
    </button>

  </form>

</body>
</html>
