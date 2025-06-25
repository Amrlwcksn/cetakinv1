<?php
require "function.php";

// Ambil produk dari database
$produk = [];
$result = mysqli_query($conn, "SELECT * FROM produk");
while ($row = mysqli_fetch_assoc($result)) {
  $produk[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

  <form action="customer.php" method="POST" enctype="multipart/form-data" 
        class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

    <h2 class="text-3xl font-bold text-center text-blue-600">Cetakin</h2>
    <p class="text-sm text-center text-blue-500 mb-6">Isi datamu dengan benar ya!</p>

    <!-- Nama -->
    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Nama</span>
      <input type="text" name="nama" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
    </label>

    <!-- Produk -->
    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Produk</span>
      <select name="produk" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <option value="">Pilih produk</option>
        <?php foreach ($produk as $item): ?>
          <option value="<?= $item['id_produk'] ?>">
            <?= $item['nama_produk'] ?> - Rp<?= number_format($item['harga'], 0, ',', '.') ?> (<?= $item['deskripsi'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <!-- Jumlah -->
    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Jumlah</span>
      <input type="number" name="jumlah" min="1" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
    </label>

    <!-- Deskripsi -->
    <label class="block mb-3">
      <span class="text-gray-700 font-semibold">Deskripsi</span>
      <textarea name="deskripsi" rows="3" required
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200 resize-none"></textarea>
    </label>

    <!-- File Upload -->
    <label class="block mb-6">
      <span class="text-gray-700 font-semibold">Upload File</span>
      <input type="file" name="file" required
        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0 file:text-sm file:font-semibold
               file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
    </label>

    <button type="submit" name="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
      Kirim Pesanan
    </button>

  </form>

</body>
</html>
