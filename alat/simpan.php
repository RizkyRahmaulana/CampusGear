<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Akses ditolak.");
}

// Ambil data
$nama_alat = trim($_POST['nama_alat']);
$kategori  = trim($_POST['kategori']);
$jumlah    = intval($_POST['jumlah']);
$kondisi   = trim($_POST['kondisi']);
$status    = trim($_POST['status']);

// Validasi
if ($nama_alat == "" || $kategori == "" || $jumlah <= 0) {
    die("Data belum lengkap.");
}

// Upload Foto
$foto = "";

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $folder = "../assets/upload/";

    // Buat folder jika belum ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $namaFile = $_FILES['foto']['name'];
    $tmp      = $_FILES['foto']['tmp_name'];
    $ext      = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    $izin = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $izin)) {
        die("Format gambar harus JPG, JPEG, atau PNG.");
    }

    $foto = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', $namaFile);

    if (!move_uploaded_file($tmp, $folder . $foto)) {
        die("Upload foto gagal.");
    }
}

// Simpan ke database
$sql = "INSERT INTO alat
(nama_alat, kategori, jumlah, kondisi, status, foto)
VALUES
(?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare gagal: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssisss",
    $nama_alat,
    $kategori,
    $jumlah,
    $kondisi,
    $status,
    $foto
);

if (mysqli_stmt_execute($stmt)) {

    echo "<script>
        alert('Data alat berhasil disimpan');
        window.location='index.php';
    </script>";

} else {

    die("Gagal menyimpan data: " . mysqli_stmt_error($stmt));

}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>