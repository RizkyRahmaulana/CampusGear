<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Pastikan request berasal dari form
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Akses ditolak.");
}

// Ambil data
$id         = intval($_POST['id_alat']);
$nama       = mysqli_real_escape_string($conn, $_POST['nama_alat']);
$kategori   = mysqli_real_escape_string($conn, $_POST['kategori']);
$jumlah     = intval($_POST['jumlah']);
$kondisi    = mysqli_real_escape_string($conn, $_POST['kondisi']);
$status     = mysqli_real_escape_string($conn, $_POST['status']);
$foto_lama  = $_POST['foto_lama'];

// Default gunakan foto lama
$foto = $foto_lama;

// Jika upload foto baru
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $folder = "../assets/upload/";

    // Buat folder jika belum ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $namaFile = time() . "_" . basename($_FILES['foto']['name']);
    $tujuan = $folder . $namaFile;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan)) {

        // Hapus foto lama jika ada
        if (!empty($foto_lama) && file_exists($folder . $foto_lama)) {
            unlink($folder . $foto_lama);
        }

        $foto = $namaFile;

    } else {
        die("Gagal upload foto.");
    }
}

// Update data
$sql = "UPDATE alat SET
            nama_alat = '$nama',
            kategori = '$kategori',
            jumlah = '$jumlah',
            kondisi = '$kondisi',
            status = '$status',
            foto = '$foto'
        WHERE id_alat = '$id'";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Gagal update data: " . mysqli_error($conn));
}

// Redirect
header("Location: index.php");
exit;
?>