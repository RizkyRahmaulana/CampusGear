<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Ambil data dari form
$id_alat          = $_POST['id_alat'];
$id_peminjam      = $_POST['id_peminjam'];
$jumlah           = $_POST['jumlah'];
$tanggal_pinjam   = $_POST['tanggal_pinjam'];
$tanggal_kembali  = $_POST['tanggal_kembali'];
$status           = "Dipinjam";

// Cek data alat
$queryAlat = mysqli_query($conn, "SELECT * FROM alat WHERE id_alat='$id_alat'");

if (!$queryAlat) {
    die("SQL Error: " . mysqli_error($conn));
}

$alat = mysqli_fetch_assoc($queryAlat);

if (!$alat) {
    die("Data alat tidak ditemukan.");
}

// Validasi stok
if ($jumlah > $alat['jumlah']) {

    echo "<script>
            alert('Stok alat tidak mencukupi!');
            window.location='tambah.php';
          </script>";
    exit;
}

// Simpan transaksi
$simpan = mysqli_query($conn, "
INSERT INTO transaksi
(
    id_alat,
    id_peminjam,
    jumlah,
    tanggal_pinjam,
    tanggal_kembali,
    status
)
VALUES
(
    '$id_alat',
    '$id_peminjam',
    '$jumlah',
    '$tanggal_pinjam',
    '$tanggal_kembali',
    '$status'
)
");

if (!$simpan) {
    die("Gagal menyimpan transaksi: " . mysqli_error($conn));
}

// Kurangi stok alat
$stokBaru = $alat['jumlah'] - $jumlah;

// Update stok
mysqli_query($conn, "
UPDATE alat
SET jumlah='$stokBaru'
WHERE id_alat='$id_alat'
");

// Jika stok habis ubah status alat
if ($stokBaru <= 0) {

    mysqli_query($conn, "
    UPDATE alat
    SET status='Dipinjam'
    WHERE id_alat='$id_alat'
    ");
}

echo "<script>
        alert('Transaksi berhasil disimpan');
        window.location='index.php';
      </script>";
?>