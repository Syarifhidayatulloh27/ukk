<?php
include "koneksi.php";
session_start();

// Pastikan sesi dimulai dan nim sudah diset
if (isset($_SESSION['nim'])) {
    $nim = $_SESSION['nim'];
} else {
    // Jika nim belum diset, arahkan kembali ke halaman login atau berikan pesan error
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location.href='index.php';</script>";
    exit();
}

// Proses pengajuan topik
if (isset($_POST['submit'])) {
    $topik1 = mysqli_real_escape_string($koneksi, $_POST['topik1']);
    $topik2 = mysqli_real_escape_string($koneksi, $_POST['topik2']);
    $topik3 = mysqli_real_escape_string($koneksi, $_POST['topik3']);

    // Pastikan nim valid dan ada di tabel mahasiswa
    $query_check = "SELECT nim FROM mahasiswa WHERE nim='$nim'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        $query_insert = "INSERT INTO judul (nim, topik1, topik2, topik3) VALUES ('$nim', '$topik1', '$topik2', '$topik3')";
        if (mysqli_query($koneksi, $query_insert)) {
            echo "<script>alert('Pengajuan topik skripsi berhasil!');</script>";
        } else {
            echo "<script>alert('Pengajuan topik skripsi gagal! Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('NIM tidak valid atau tidak terdaftar.');</script>";
    }
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard Pengajuan Topik Skripsi</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>Dashboard Pengajuan Topik Skripsi</h1>
        <a href="logout.php" class="btn-logout">Logout</a>
    </header>
    <div class="main-content">
        <div class="form-pengajuan">
            <h2>Ajukan Topik Skripsi</h2>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" placeholder="Topik 1" name="topik1" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Topik 2" name="topik2" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Topik 3" name="topik3" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
