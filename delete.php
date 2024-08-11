<?php
include 'koneksi.php';
session_start();

// Pastikan user login sebagai Kaprodi
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'prodi') {
    header("Location: dashboard-prodi.php");
    exit();
}

// Periksa apakah ID pengajuan telah diterima melalui URL
if (isset($_GET['id'])) {
    $id_judul = $_GET['id'];

    // Query untuk menghapus data pengajuan berdasarkan ID
    $query = "DELETE FROM judul WHERE id_judul = $id_judul";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pengajuan berhasil dihapus.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengajuan.'); window.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='dashboard.php';</script>";
}
?>
