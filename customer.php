<?php
require "function.php";

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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>

<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex items-center justify-center px-4">

  <form action="customer.php" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-1">Cetakin</h2>
    <p class="text-sm text-center text-blue-500 mb-6">Isi data kamu dengan benar ya 👇</p>

    <!-- Nama -->
    <label class="block mb-4">
      <span class="text-gray-700 font-medium">Nama Lengkap</span>
      <input type="text" name="nama" required placeholder="Masukkan namamu"
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
    </label>

    <!-- Produk -->
    <label class="block mb-4">
      <span class="text-gray-700 font-medium">Produk</span>
      <select name="produk" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <option value="">Pilih produk</option>
        <?php foreach ($produk as $item): ?>
          <option value="<?= $item['id_produk'] ?>">
            <?= $item['nama_produk'] ?> - Rp<?= number_format($item['harga'], 0, ',', '.') ?> (<?= $item['deskripsi'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <!-- Jumlah -->
    <label class="block mb-4">
      <span class="text-gray-700 font-medium">Jumlah Cetak</span>
      <input type="number" name="jumlah" min="1" required placeholder="Contoh: 10"
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" />
    </label>

    <!-- Deskripsi -->
    <label class="block mb-4">
      <span class="text-gray-700 font-medium">Deskripsi Tambahan</span>
      <textarea name="deskripsi" rows="3" required placeholder="Contoh: cetak warna, kertas A4, 2 sisi"
        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200 resize-none"></textarea>
    </label>

    <!-- File Upload -->
    <label class="block mb-6">
      <span class="text-gray-700 font-medium">Upload File</span>
      <input type="file" name="file" required accept=".pdf,.doc,.jpg,.png"
        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0 file:text-sm file:font-semibold
               file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer" />
    </label>

    <button type="submit" name="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
      🚀 Kirim Pesanan
    </button>
  </form>

</body>
</html>
