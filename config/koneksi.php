<?php
// config/koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "campusgear";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengatur timezone
date_default_timezone_set('Asia/Jakarta');
?>
