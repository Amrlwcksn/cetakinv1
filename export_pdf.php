<?php
require 'function.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Ambil data dari database
$result = mysqli_query($conn, "SELECT * FROM customer ORDER BY waktu_pesanan_masuk ASC");

// Mulai isi HTML
$html = '
  <h2 style="text-align:center;">Laporan Pesanan Cetakin</h2>
  <table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
      <tr style="background-color: #f0f0f0;">
        <th>No</th>
        <th>Masuk</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Jumlah</th>
        <th>Deskripsi</th>
        <th>Status</th>
        <th>Harga</th>
        <th>Selesai</th>
      </tr>
    </thead>
    <tbody>
';

$no = 1;
$totalHarga = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $harga = $row['harga_total'];
    $totalHarga += $harga;

    $html .= "<tr>
      <td>{$no}</td>
      <td>{$row['waktu_pesanan_masuk']}</td>
      <td>" . htmlspecialchars($row['nama']) . "</td>
      <td>" . htmlspecialchars($row['ukuran']) . "</td>
      <td>{$row['jumlah']}</td>
      <td>" . htmlspecialchars($row['deskripsi']) . "</td>
      <td>" . ucfirst($row['status']) . "</td>
      <td>Rp" . number_format($harga, 0, ',', '.') . "</td>
      <td>{$row['pesanan_selesai']}</td>
    </tr>";
    $no++;
}

$html .= '
    </tbody>
    <tfoot>
      <tr>
        <td colspan="7" style="text-align:right; font-weight:bold;">Total:</td>
        <td colspan="2"><strong>Rp' . number_format($totalHarga, 0, ',', '.') . '</strong></td>
      </tr>
    </tfoot>
  </table>
';

// Inisialisasi Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Langsung download PDF
$dompdf->stream("laporan_pesanan_cetakin.pdf"); // Auto-download
exit;
