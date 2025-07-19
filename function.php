<?php
session_start();
$conn = mysqli_connect("localhost", "root", "CetakIn200201!", "cetakin");

// ======== REGISTER USER ========
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Username sudah digunakan.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// ======== INPUT PESANAN ========
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $id_produk = $_POST["produk"];
    $jumlah = intval($_POST["jumlah"]);
    $deskripsi = $_POST["deskripsi"];
    $files = $_FILES["file"];

    $waktu_pesanan_masuk = date('Y-m-d H:i:s');
    $status = 'pending';
    $pesanan_selesai = null;

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

    $ukuran = $produk["nama_produk"];
    $harga_satuan = $produk["harga"];
    $harga_total = $harga_satuan * $jumlah;

    $stmt = $conn->prepare("INSERT INTO customer 
        (waktu_pesanan_masuk, nama, ukuran, jumlah, deskripsi, status, harga_total, pesanan_selesai) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", 
        $waktu_pesanan_masuk, $nama, $ukuran, $jumlah, $deskripsi, $status, $harga_total, $pesanan_selesai);
    $stmt->execute();

    $nomor_pesanan = $stmt->insert_id;

    $uploadDir = "uploads/$nomor_pesanan/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedFiles = [];

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === 0) {
            $fileName = basename($files['name'][$i]);
            $fileTmp = $files['tmp_name'][$i];
            $uploadPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmp, $uploadPath)) {
                $uploadedFiles[] = "$nomor_pesanan/$fileName";
            }
        }
    }

    if (!empty($uploadedFiles)) {
        $filePaths = implode(',', $uploadedFiles);

        $update = $conn->prepare("UPDATE customer SET file = ? WHERE nomor_pesanan = ?");
        $update->bind_param("si", $filePaths, $nomor_pesanan);
        $update->execute();

        echo "<script>alert('Pesanan berhasil disimpan!'); window.location.href = 'nomor_pesanan.php';</script>";
        exit;
    } else {
        echo "<script>alert('Tidak ada file yang berhasil diupload!'); window.location.href = 'customer.php';</script>";
        exit;
    }
}

// ======== UPDATE STATUS PESANAN ========
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

// ======== HAPUS SEMUA DATA ========
if (isset($_POST['delete_all'])) {
    mysqli_query($conn, "DELETE FROM customer");
    mysqli_query($conn, "ALTER TABLE customer AUTO_INCREMENT = 1");
    header("Location: admin.php");
    exit();
}
?>
