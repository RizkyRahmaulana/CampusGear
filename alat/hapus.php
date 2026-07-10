<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Cek ID
if (!isset($_GET['id'])) {
    die("ID alat tidak ditemukan.");
}

$id = intval($_GET['id']);

// Ambil data alat
$query = mysqli_query($conn, "SELECT * FROM alat WHERE id_alat='$id'");

if (!$query) {
    die("Error Query: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data alat tidak ditemukan.");
}

// Cek apakah alat masih digunakan di transaksi
$cek = mysqli_query($conn, "
SELECT COUNT(*) AS total
FROM transaksi
WHERE id_alat='$id'
AND status='Dipinjam'
");

if (!$cek) {
    die("Error Cek Transaksi: " . mysqli_error($conn));
}

$hasil = mysqli_fetch_assoc($cek);

if ($hasil['total'] > 0) {

    echo "<script>
    alert('Alat masih dipinjam dan tidak dapat dihapus!');
    window.location='index.php';
    </script>";

    exit;
}

// Hapus foto jika ada
if (!empty($data['foto'])) {

    $file = "../assets/upload/" . $data['foto'];

    if (file_exists($file)) {
        unlink($file);
    }
}

// Hapus data
$hapus = mysqli_query($conn, "
DELETE FROM alat
WHERE id_alat='$id'
");

if (!$hapus) {
    die("Gagal menghapus data: " . mysqli_error($conn));
}

echo "<script>
alert('Data alat berhasil dihapus.');
window.location='index.php';
</script>";

exit;
?>