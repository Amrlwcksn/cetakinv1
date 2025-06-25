<?php
require "function.php";

// Ambil nomor pesanan terakhir
$result = mysqli_query($conn, "SELECT MAX(nomor_pesanan) AS terakhir FROM customer");
$data = mysqli_fetch_assoc($result);
$nomorTerakhir = $data['terakhir'] ?? 0;

// Ambil data status dan harga_total
$status = "Tidak diketahui";
$harga_total = 0;

if ($nomorTerakhir) {
    $stmt = $conn->prepare("SELECT status, harga_total FROM customer WHERE nomor_pesanan = ?");
    $stmt->bind_param("s", $nomorTerakhir);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $status = $row['status'];
        $harga_total = $row['harga_total'];
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nomor Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

  <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full text-center">
    <h1 class="text-3xl font-bold text-blue-600 mb-4">🎉 Terima kasih!</h1>
    <p class="text-gray-700 text-lg mb-2">Pesanan kamu berhasil dicatat.</p>
    
    <div class="bg-blue-100 text-blue-800 font-semibold py-2 px-4 rounded text-xl mb-3">
      Nomor Pesanan: <span class="text-blue-600"><?= htmlspecialchars($nomorTerakhir) ?></span>
    </div>
    
    <div class="bg-yellow-100 text-yellow-800 font-semibold py-2 px-4 rounded text-lg mb-3">
      Status Pesanan: <span class="font-bold"><?= htmlspecialchars(ucfirst($status)) ?></span>
    </div>

    <div class="bg-green-100 text-green-800 font-semibold py-2 px-4 rounded text-lg mb-4">
      Total Bayar: <span class="font-bold">Rp<?= number_format($harga_total, 0, ',', '.') ?></span>
      <p class="text-gray-700 text-sm">Lakukan pembayaran ketika mengambil pesanan</p>
    </div>

    <p class="text-gray-700 text-lg mb-2">Ditunggu ya 🤗</p>
    <a href="customer.php" class="inline-block mt-6 text-blue-500 hover:underline">
      ← Kembali ke Form
    </a>
  </div>

</body>
</html>
