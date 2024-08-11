<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ujikom_ukk_rpl_2024';
$port= 3307;

$koneksi = mysqli_connect($host, $user, $password, $database, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// echo "koneksi jaya";
?>