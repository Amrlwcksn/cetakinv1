<?php
require "function.php";
require "auth_check.php";

// Update status jika form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // Kalau status selesai, tambahkan tanggal_selesai
    if ($status === 'selesai') {
        $pesanan_selesai = date('Y-m-d H:i:s');
        $query = "UPDATE customer SET status = '$status', pesanan_selesai = '$pesanan_selesai' WHERE nomor_pesanan = $id";
    } else {
        $query = "UPDATE customer SET status = '$status' WHERE nomor_pesanan = $id";
    }

    mysqli_query($conn, $query);
    header("Location: admin.php");
    exit;
}

// Ambil data pesanan
$result = mysqli_query($conn, "SELECT * FROM customer ORDER BY nomor_pesanan ASC");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  </head>

  <body class="bg-gray-100 min-h-screen pt-[96px] p-6" x-data="{ menuOpen: false }" x-cloak>

    <!-- Header -->
    <header class="bg-blue-700 text-white shadow fixed top-0 inset-x-0 z-20">
      <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold tracking-wide">Cetakin</h1>
          <p class="text-sm text-blue-200">Cetakin disini aja!</p>
        </div>

        <!-- Dropdown Menu Button -->
        <div class="relative">
          <button @click="menuOpen = !menuOpen" class="focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path x-show="!menuOpen" d="M4 6h16M4 12h16M4 18h16" />
              <path x-show="menuOpen" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <!-- Dropdown content -->
          <div x-show="menuOpen" @click.outside="menuOpen = false"
              class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-md overflow-hidden z-30 transition"
              x-transition>
            <a href="/profile" class="block px-4 py-2 hover:bg-blue-50">Profile</a>
            
            <form action="admin.php" method="POST" onsubmit="return confirm('Yakin mau hapus semua data?');">
              <button type="submit" name="delete_table" class="w-full text-left block px-4 py-2 text-red-600 hover:bg-red-50">
                Delete Table
              </button>
            </form>
            
            <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-red-50">Logout</a>
          </div>

        </div>
      </div>
    </header>

    <!-- Main content -->
    <main class="max-w-6xl mx-auto px-4 space-y-6">
      <h1 class="text-3xl font-bold text-blue-700">📋 Dashboard Admin</h1>

      <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="min-w-full table-auto divide-y divide-gray-200 text-sm">
          <thead class="bg-blue-50 text-blue-800 text-sm">
            <tr>
              <th class="px-5 py-4 text-left font-semibold">Nomor</th>
              <th class="px-5 py-4 text-left font-semibold">Masuk</th>
              <th class="px-5 py-4 text-left font-semibold">Nama</th>
              <th class="px-5 py-4 text-left font-semibold">Ukuran</th>
              <th class="px-5 py-4 text-left font-semibold">Jumlah</th>
              <th class="px-5 py-4 text-left font-semibold">Deskripsi</th>
              <th class="px-5 py-4 text-left font-semibold">File</th>
              <th class="px-5 py-4 text-center font-semibold">Status</th>
              <th class="px-5 py-4 text-center font-semibold">Harga</th>
              <th class="px-5 py-4 text-center font-semibold">Selesai</th>
              <th class="px-5 py-4 text-center font-semibold">Aksi</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr class="hover:bg-gray-50 transition-all">
                <td class="px-5 py-4 font-medium text-gray-800"><?= $row['nomor_pesanan'] ?></td>
                <td class="px-5 py-4 text-gray-700"><?= $row['waktu_pesanan_masuk'] ?></td>
                <td class="px-5 py-4 whitespace-normal break-words"><?= htmlspecialchars($row['nama']) ?></td>
                <td class="px-5 py-4"><?= htmlspecialchars($row['ukuran']) ?></td>
                <td class="px-5 py-4"><?= htmlspecialchars($row['jumlah']) ?></td>
                <td class="px-5 py-4 whitespace-normal break-words"><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td class="px-5 py-4 text-blue-600 underline">
                  <a href="uploads/<?= $row['file'] ?>" target="_blank">Lihat File</a>
                </td>
                <td class="px-5 py-4 text-center">
                  <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                    <?= match ($row['status']) {
                      'pending' => 'bg-yellow-500',
                      'diproses' => 'bg-blue-500',
                      'selesai' => 'bg-green-500',
                      default => 'bg-gray-400',
                    } ?>">
                    <?= ucfirst($row['status']) ?>
                  </span>
                </td>
                <td class="px-5 py-4 text-center text-gray-700"><?= $row['harga'] ?></td>
                <td class="px-5 py-4 text-center text-gray-700"><?= $row['pesanan_selesai'] ?></td>
                <td class="px-5 py-4">
                  <form action="admin.php" method="POST" class="flex flex-col items-center gap-2">
                    <input type="hidden" name="id" value="<?= $row['nomor_pesanan'] ?>">
                    <select name="status" class="text-sm rounded-md border-gray-300 px-2 py-1 focus:ring-blue-500 w-full">
                      <option value="pending" <?= $row['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                      <option value="diproses" <?= $row['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
                      <option value="selesai" <?= $row['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-xs w-full transition">
                      Update
                    </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

      </div>
    </main>
  </body>
</html>
