<?php
session_start();
session_destroy(); // Menghancurkan semua sesi
header("Location: index.php"); // Mengarahkan kembali ke halaman login
exit();
?>
