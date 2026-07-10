<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Pastikan request POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses tidak diizinkan.");
}

// Ambil data
$nim   = trim($_POST['nim']);
$nama  = trim($_POST['nama']);
$prodi = trim($_POST['prodi']);
$no_hp = trim($_POST['no_hp']);
$email = trim($_POST['email']);

// Validasi sederhana
if (
    empty($nim) ||
    empty($nama) ||
    empty($prodi) ||
    empty($no_hp) ||
    empty($email)
) {
    die("Semua data wajib diisi.");
}

// Cek NIM sudah ada atau belum
$cek = mysqli_query($conn, "SELECT id_peminjam FROM peminjam WHERE nim='$nim'");

if (!$cek) {
    die("SQL Error : " . mysqli_error($conn));
}

if (mysqli_num_rows($cek) > 0) {

    echo "<script>
        alert('NIM sudah terdaftar!');
        window.history.back();
    </script>";

    exit;
}

// Simpan
$simpan = mysqli_query($conn, "
INSERT INTO peminjam
(
    nim,
    nama,
    prodi,
    no_hp,
    email
)
VALUES
(
    '$nim',
    '$nama',
    '$prodi',
    '$no_hp',
    '$email'
)
");

if (!$simpan) {
    die("Gagal menyimpan data : " . mysqli_error($conn));
}

echo "<script>
    alert('Data peminjam berhasil ditambahkan.');
    window.location='index.php';
</script>";
exit;
?>