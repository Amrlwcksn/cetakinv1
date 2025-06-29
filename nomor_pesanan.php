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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex items-center justify-center px-4 py-10">

  <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full text-center border border-gray-200">
    <div class="mb-4">
      <div class="text-4xl mb-2">🎉</div>
      <h1 class="text-3xl font-bold text-blue-700">Terima kasih!</h1>
      <p class="text-gray-600 mt-2">Pesanan kamu berhasil dicatat.</p>
    </div>

    <div class="text-left space-y-3 mt-6">
      <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded">
        <p class="text-sm text-gray-500">Nomor Pesanan</p>
        <p class="text-xl font-bold text-blue-700"><?= htmlspecialchars($nomorTerakhir) ?></p>
      </div>

      <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
        <p class="text-sm text-gray-500">Status</p>
        <p class="text-lg font-semibold text-yellow-700"><?= htmlspecialchars(ucfirst($status)) ?></p>
      </div>

      <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded">
        <p class="text-sm text-gray-500">Total Bayar</p>
        <p class="text-lg font-semibold text-green-700">Rp<?= number_format($harga_total, 0, ',', '.') ?></p>
        <p class="text-xs text-gray-500 mt-1">* Bayar saat pengambilan</p>
      </div>
    </div>

    <div class="mt-6">
      <a href="cetak_struk.php?nomor_pesanan=<?= $nomorTerakhir ?>" target="_blank" class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
        🧾 <span>Cetak Bukti Transaksi</span>
      </a>
    </div>

    <div class="mt-6">
      <p class="text-gray-600 text-sm">Ditunggu ya 🤗</p>
      <a href="customer.php" class="mt-2 inline-block text-blue-500 hover:underline text-sm">
        ← Kembali ke Form
      </a>
    </div>
  </div>

</body>
</html>

