<?php
ob_start();
require 'function.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!isset($_GET['nomor_pesanan'])) {
    echo "Nomor pesanan tidak ditemukan!";
    exit;
}

$nomorPesanan = $_GET['nomor_pesanan'];

// Ambil data berdasarkan nomor pesanan
$stmt = $conn->prepare("SELECT * FROM customer WHERE nomor_pesanan = ?");
$stmt->bind_param("s", $nomorPesanan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

// Buat isi HTML PDF
$html = '
  <style>
    body { font-family: Arial, sans-serif; font-size: 12pt; }
    .header { text-align:center; font-size: 18pt; font-weight: bold; color: #2b6cb0; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
    .label { font-weight: bold; width: 30%; }
  </style>

  <div class="header">Bukti Transaksi - Cetak.in</div>
  <table>
    <tr><td class="label">Nomor Pesanan</td><td>' . $data['nomor_pesanan'] . '</td></tr>
    <tr><td class="label">Tanggal Masuk</td><td>' . $data['waktu_pesanan_masuk'] . '</td></tr>
    <tr><td class="label">Nama Pelanggan</td><td>' . htmlspecialchars($data['nama']) . '</td></tr>
    <tr><td class="label">Ukuran</td><td>' . htmlspecialchars($data['ukuran']) . '</td></tr>
    <tr><td class="label">Jumlah</td><td>' . $data['jumlah'] . '</td></tr>
    <tr><td class="label">Deskripsi</td><td>' . htmlspecialchars($data['deskripsi']) . '</td></tr>
    <tr><td class="label">Status</td><td>' . ucfirst($data['status']) . '</td></tr>
    <tr><td class="label">Total Harga</td><td>Rp' . number_format($data['harga_total'], 0, ',', '.') . '</td></tr>
    <tr><td class="label">Tanggal Selesai</td><td>' . ($data['pesanan_selesai'] ?? '-') . '</td></tr>
  </table>

  <p style="margin-top: 20px; text-align:center;">Terima kasih telah menggunakan layanan Cetak.in</p>
';

// Proses PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();

// Output ke browser
$dompdf->stream("bukti-transaksi-{$data['nomor_pesanan']}.pdf", ["Attachment" => false]);
exit;
