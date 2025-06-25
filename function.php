<?php
session_start();
date_default_timezone_set('Asia/Jakarta');


$conn = mysqli_connect("localhost", "root", "200201", "cetakin");

// TODO login
if (isset($_POST ['login'])){
    $username = $_POST ['username'];
    $password = $_POST ['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    }else{
        echo "<script>
        alert('Username atau Password salah');
        window.location.href = 'index.php';
        </script>";


    }
}
// TODO Customer
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    
    $nama = $_POST["nama"] ?? '';
    $ukuran = $_POST["ukuran"] ?? '';
    $jumlah = $_POST["jumlah"] ?? '';
    $deskripsi = $_POST["deskripsi"] ?? '';
    $harga = $_POST["harga"] ?? '';


    if ($nama && $ukuran && $jumlah && $deskripsi) {
        $insert = mysqli_query($conn, "INSERT INTO customer (nama, ukuran, jumlah, deskripsi,) VALUES ('$nama', '$ukuran', $jumlah, '$deskripsi')");

        if ($insert) {
            $nomor_pesanan = mysqli_insert_id($conn);

            if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
                $fileName = $_FILES['file']['name'];
                $fileTmp = $_FILES['file']['tmp_name'];

                $uploadDir = 'uploads/' . $nomor_pesanan . '/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $uploadPath = $uploadDir . basename($fileName);
                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    $filePath = $nomor_pesanan . '/' . $fileName;
                    $update = mysqli_query($conn, "UPDATE customer SET file='$filePath' WHERE nomor_pesanan = $nomor_pesanan");

                    if ($update) {
                        echo "<script>alert('File berhasil dikirim dan disimpan!'); window.location.href = 'nomor_pesanan.php';</script>";
                    } else {
                        echo "<script>alert('Gagal update data file di database!'); window.location.href = 'index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Gagal upload file!'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "<script>alert('File belum dipilih atau error saat upload!'); window.location.href = 'index.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal simpan data!'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!'); window.location.href = 'index.php';</script>";
    }
}

// TODO admin
$result = mysqli_query($conn, "SELECT * FROM customer ORDER BY nomor_pesanan ASC");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $query = "UPDATE customer SET status = '$status' WHERE nomor_pesanan = $id";
    mysqli_query($conn, $query);

    header("Location: admin.php");
}


// Delete
if (isset($_POST['delete_table'])) {
    $query = "DELETE FROM customer";
    mysqli_query($conn, $query);
    mysqli_query($conn, "ALTER TABLE customer AUTO_INCREMENT = 1");
    header("Location: admin.php");
    exit;
  }


?>