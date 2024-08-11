<?php
include 'koneksi.php';
session_start();

// Pastikan user login sebagai Kaprodi
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'prodi') {
    header("Location: index.php");
    exit();
}

// Periksa apakah ID pengajuan telah diterima melalui URL
if (isset($_GET['id'])) {
    $id_judul = $_GET['id'];

    // Ambil data pengajuan berdasarkan ID
    $query = "SELECT * FROM judul WHERE id_judul = $id_judul";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan.'); window.location.href='dashboard.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='dashboard.php';</script>";
    exit();
}

// Proses update data jika form disubmit
if (isset($_POST['submit'])) {
    $topik1 = mysqli_real_escape_string($koneksi, $_POST['topik1']);
    $topik2 = mysqli_real_escape_string($koneksi, $_POST['topik2']);
    $topik3 = mysqli_real_escape_string($koneksi, $_POST['topik3']);

    // Query untuk mengupdate data pengajuan berdasarkan ID
    $query_update = "UPDATE judul SET topik1 = '$topik1', topik2 = '$topik2', topik3 = '$topik3' WHERE id_judul = $id_judul";
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        echo "<script>alert('Pengajuan berhasil diupdate.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate pengajuan.'); window.location.href='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Edit Pengajuan</title>
</head>
<body>
<div class="wrapper">
        <div class="main-content">
            <div class="form-pengajuan">
                <p>Edit Pengajuan Topik Skripsi</p>
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" placeholder="Topik 1" name="topik1" value="<?php echo $row['topik1']; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Topik 2" name="topik2" value="<?php echo $row['topik2']; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Topik 3" name="topik3" value="<?php echo $row['topik3']; ?>" required>
                    </div>
                    <div class="input-group">
                        <button name="submit" class="btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
</div>
</body>
</html>
