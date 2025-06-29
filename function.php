<?php
session_start();
$conn = mysqli_connect("localhost", "root", "200201", "cetakin");


// TODO (Register with haashing)
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if(mysqli_num_rows($cek) > 1) {
        echo "username sudah digunakan.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
    if (mysqli_query($conn, $sql)){
        echo "Registrasi berhasil!";
        header("Location: index.php");
    }else{
        echo "Error" . mysqli_error($conn);
    }
}

// TODO (input pesanan)
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $id_produk = $_POST["produk"];
    $jumlah = intval($_POST["jumlah"]);
    $deskripsi = $_POST["deskripsi"];
    $file = $_FILES["file"];

    $waktu_pesanan_masuk = date('Y-m-d H:i:s');
    $status = 'pending';
    $pesanan_selesai = null;

    // Ambil data produk
    $query = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();

    if (!$produk) {
        echo "<script>alert('Produk tidak ditemukan!'); window.location.href = 'pesan.php';</script>";
        exit;
    }

    $ukuran = $produk["nama_produk"]; // Gunakan nama produk sebagai ukuran
    $harga_satuan = $produk["harga"];
    $harga_total = $harga_satuan * $jumlah;

    // Simpan ke DB
    $stmt = $conn->prepare("INSERT INTO customer 
        (waktu_pesanan_masuk, nama, ukuran, jumlah, deskripsi, status, harga_total, pesanan_selesai) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", 
        $waktu_pesanan_masuk, $nama, $ukuran, $jumlah, $deskripsi, $status, $harga_total, $pesanan_selesai);
    $stmt->execute();

    $nomor_pesanan = $stmt->insert_id;

    // Upload file
    if ($file["error"] === 0) {
        $fileName = basename($file["name"]);
        $fileTmp = $file["tmp_name"];
        $uploadDir = "uploads/$nomor_pesanan/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            $relativePath = "$nomor_pesanan/" . $fileName;

            $update = $conn->prepare("UPDATE customer SET file = ? WHERE nomor_pesanan = ?");
            $update->bind_param("si", $relativePath, $nomor_pesanan);
            $update->execute();

            echo "<script>alert('Pesanan berhasil disimpan!'); window.location.href = 'nomor_pesanan.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal upload file!'); window.location.href = 'customer.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('File belum dipilih atau terjadi error saat upload!'); window.location.href = 'customer.php';</script>";
        exit;
    }
}



// TODO (update pesanan)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
  $id = intval($_POST['id']);
  $status = $_POST['status'];

  if ($status === 'selesai') {
    $selesai = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("UPDATE customer SET status = ?, pesanan_selesai = ? WHERE nomor_pesanan = ?");
    $stmt->bind_param("ssi", $status, $selesai, $id);
  } else {
    $stmt = $conn->prepare("UPDATE customer SET status = ? WHERE nomor_pesanan = ?");
    $stmt->bind_param("si", $status, $id);
  }

  $stmt->execute();
  header("Location: admin.php");
  exit();
}

// TODO (Hapus semua data)
if (isset($_POST['delete_all'])) {
  mysqli_query($conn, "DELETE FROM customer");
  mysqli_query($conn, "ALTER TABLE customer AUTO_INCREMENT = 1");
  header("Location: admin.php");
  exit();
}

?>
