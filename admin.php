<?php
require "function.php";
require "auth_check.php";

// 🔄 Hapus semua jika tombol diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
  mysqli_query($conn, "DELETE FROM customer");
  header("Location: admin.php");
  exit;
}

// 🔄 Update status jika tombol update diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
  $id = intval($_POST['id']);
  $status = $_POST['status'];

  if ($status === 'selesai') {
    $waktu_selesai = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("UPDATE customer SET status = ?, pesanan_selesai = ? WHERE nomor_pesanan = ?");
    $stmt->bind_param("ssi", $status, $waktu_selesai, $id);
  } else {
    $stmt = $conn->prepare("UPDATE customer SET status = ? WHERE nomor_pesanan = ?");
    $stmt->bind_param("si", $status, $id);
  }

  $stmt->execute();
  header("Location: admin.php");
  exit;
}

// Ambil semua data customer
$result = mysqli_query($conn, "SELECT * FROM customer ORDER BY waktu_pesanan_masuk ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Cetakin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Navbar -->
  <header class="bg-blue-700 text-white shadow fixed top-0 inset-x-0 z-10">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold tracking-wide">Cetakin</h1>

      <!-- Hamburger Menu -->
      <div class="relative" x-data="{ menuOpen: false }" x-cloak>
        <button @click="menuOpen = !menuOpen" class="focus:outline-none">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            stroke-linecap="round" stroke-linejoin="round">
            <path x-show="!menuOpen" d="M4 6h16M4 12h16M4 18h16" />
            <path x-show="menuOpen" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="menuOpen" @click.outside="menuOpen = false"
          class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-md overflow-hidden z-30 transition"
          x-transition>
          <a href="export_pdf.php" class="block px-4 py-2 hover:bg-blue-50">🧾 Export to PDF</a>
          <form method="POST" action="admin.php" onsubmit="return confirm('Yakin ingin menghapus semua pesanan?');">
            <button type="submit" name="delete_all" class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">
              ❌ Hapus Semua
            </button>
          </form>
          <a href="logout.php" class="block px-4 py-2 hover:bg-blue-50">🚪 Logout</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="pt-[96px] px-6">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold text-blue-700 mb-6">📋 Dashboard Admin</h2>

      <div class="overflow-x-auto bg-white shadow rounded-lg border">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-blue-50 text-blue-800">
            <tr>
              <th class="px-5 py-3 text-left font-semibold">No</th>
              <th class="px-5 py-3">Masuk</th>
              <th class="px-5 py-3">Nama</th>
              <th class="px-5 py-3">Ukuran</th>
              <th class="px-5 py-3">Jumlah</th>
              <th class="px-5 py-3">Deskripsi</th>
              <th class="px-5 py-3">File</th>
              <th class="px-5 py-3">Harga</th>
              <th class="px-5 py-3">Status</th>
              <th class="px-5 py-3">Selesai</th>
              <th class="px-5 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <?php
                $status = $row['status'] ?? 'pending';
                $badgeColor = match($status) {
                  'pending' => 'bg-yellow-400 text-white',
                  'diproses' => 'bg-blue-500 text-white',
                  'selesai' => 'bg-green-500 text-white',
                  default => 'bg-gray-300 text-black'
                };
              ?>
              <tr class="hover:bg-gray-50">
                <td class="px-5 py-3"><?= $row['nomor_pesanan'] ?></td>
                <td class="px-5 py-3"><?= $row['waktu_pesanan_masuk'] ?></td>
                <td class="px-5 py-3"><?= htmlspecialchars($row['nama']) ?></td>
                <td class="px-5 py-3"><?= htmlspecialchars($row['ukuran']) ?></td>
                <td class="px-5 py-3"><?= $row['jumlah'] ?></td>
                <td class="px-5 py-3"><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td class="px-5 py-3">
                  <?php if (!empty($row['file'])): ?>
                    <a href="uploads/<?= $row['file'] ?>" target="_blank" class="text-blue-600 underline">Lihat File</a>
                  <?php else: ?>
                    <span class="text-gray-400 italic">Belum ada</span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3">Rp<?= number_format($row['harga_total'], 0, ',', '.') ?></td>
                <td class="px-5 py-3">
                  <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $badgeColor ?>">
                    <?= htmlspecialchars(ucfirst($status)) ?>
                  </span>
                </td>
                <td class="px-5 py-3"><?= $row['pesanan_selesai'] ?? '-' ?></td>
                <td class="px-5 py-3">
                  <form method="POST" action="admin.php" class="flex flex-col gap-1">
                    <input type="hidden" name="id" value="<?= $row['nomor_pesanan'] ?>">
                    <button type="submit" name="update_status" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                      Update
                    </button>
                    <select name="status" class="mt-1 border rounded px-2 py-1 text-sm w-full transition duration-200 focus:ring-2 focus:ring-blue-500">
                      <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                      <option value="diproses" <?= $status === 'diproses' ? 'selected' : '' ?>>Diproses</option>
                      <option value="selesai" <?= $status === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    </select>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>
</html>
