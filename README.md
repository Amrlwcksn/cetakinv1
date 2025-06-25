# 🖨️ Cetakin - Sistem Pemesanan Cetak

Cetakin adalah aplikasi berbasis web sederhana yang digunakan untuk mencatat dan mengelola pesanan cetak dari pelanggan secara efisien. Cocok untuk bisnis fotokopi, percetakan, atau usaha UMKM yang membutuhkan sistem input pesanan digital tanpa ribet.

---

## ✨ Fitur Utama

- 🔐 **Login Admin**  
  Autentikasi admin untuk mengakses dashboard.

- 📥 **Form Pemesanan**  
  Pelanggan dapat mengisi data pesanan seperti nama, produk, jumlah, deskripsi, dan mengunggah file.

- 📊 **Dashboard Admin**  
  Melihat daftar pesanan yang masuk lengkap dengan status dan waktu.

- 🔄 **Update Status Pesanan**  
  Admin dapat mengubah status pesanan menjadi Pending, Diproses, atau Selesai.

- 📎 **Unggah & Tampilkan File**  
  Pelanggan dapat mengunggah file yang dibutuhkan (misal file desain cetak).

- 🧾 **Export ke PDF**  
  Admin dapat mengekspor laporan seluruh pesanan ke PDF.

- 🧹 **Hapus Semua Pesanan**  
  Tombol darurat untuk menghapus semua pesanan (digunakan dengan hati-hati!).

---

## 🧰 Tech Stack

| Teknologi       | Keterangan                                          |
|-----------------|------------------------------------------------------|
| 🐘 PHP Native    | Bahasa pemrograman backend utama tanpa framework.   |
| 🌬️ Tailwind CSS | Untuk styling UI yang rapi, konsisten, dan responsif. |
| 📦 Composer      | Dependency manager PHP (digunakan untuk Dompdf).    |
| 🧾 Dompdf        | Library untuk membuat file PDF dari HTML.           |
| 🗃️ MySQL         | Database untuk menyimpan data user, produk, dan pesanan.|

---

## ⚙️ Cara Menjalankan Proyek

1. **Clone repo ini**:
   ```bash
   git clone https://github.com/username/cetakin.git
   cd cetakin
2. Jalankan server lokal (XAMPP, Laragon, dsb) dan arahkan root ke folder cetakin.

3. Install Dompdf melalui Composer:
    Pastikan Composer sudah terinstall. Jalankan: composer require dompdf/dompdf
4. Setup database MySQL:
    Buat database bernama cetakin
    Jalankan SQL berikut untuk membuat tabel:
   
     CREATE TABLE user (
      id_user INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50) NOT NULL,
      password VARCHAR(255) NOT NULL
    );
    
    CREATE TABLE produk (
      id_produk INT AUTO_INCREMENT PRIMARY KEY,
      nama_produk VARCHAR(100),
      harga INT,
      deskripsi TEXT
    );
    
    CREATE TABLE customer (
      nomor_pesanan INT AUTO_INCREMENT PRIMARY KEY,
      waktu_pesanan_masuk DATETIME,
      nama VARCHAR(100),
      ukuran VARCHAR(100),
      jumlah INT,
      deskripsi TEXT,
      file VARCHAR(255),
      status VARCHAR(50),
      harga_total INT,
      pesanan_selesai DATETIME
    );

5. Akses aplikasinya melalui browser: http://localhost/cetakin/


** 📂 Struktur Folder Singkat
cetakin/
├── admin.php
├── customer.php
├── export_pdf.php
├── function.php
├── index.php
├── logout.php
├── nomor_pesanan.php
├── pesan.php
├── uploads/
├── vendor/          ← setelah composer install
└── README.md

** 🧠 Penggunaan Singkat
  User mengisi form pemesanan di pesan.php

- Admin login via index.php

- Admin mengelola pesanan di admin.php

- Admin dapat mengubah status, export PDF, atau menghapus semua data

** 🙌 Kredit
  Dibuat oleh Wicaksono
  Untuk pembelajaran, pengembangan, dan kebutuhan proyek internal.

-- 📄 Lisensi
  Open Source untuk penggunaan bebas, edukasi, atau pengembangan pribadi 🚀
   
