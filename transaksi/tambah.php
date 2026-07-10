<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Ambil data alat
$alat = mysqli_query($conn, "SELECT id_alat, nama_alat, jumlah FROM alat ORDER BY nama_alat");

if (!$alat) {
    die("Error tabel alat : " . mysqli_error($conn));
}

// Ambil data peminjam
$peminjam = mysqli_query($conn, "SELECT id_peminjam, nama FROM peminjam ORDER BY nama");

if (!$peminjam) {
    die("Error tabel peminjam : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Tambah Peminjaman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Tambah Peminjaman</h3>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label>Alat</label>

<select name="id_alat" class="form-select" required>

<option value="">-- Pilih Alat --</option>

<?php while($a=mysqli_fetch_assoc($alat)){ ?>

<option value="<?= $a['id_alat']; ?>">

<?= $a['nama_alat']; ?> (Stok : <?= $a['jumlah']; ?>)

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Peminjam</label>

<select name="id_peminjam" class="form-select" required>

<option value="">-- Pilih Peminjam --</option>

<?php while($p=mysqli_fetch_assoc($peminjam)){ ?>

<option value="<?= $p['id_peminjam']; ?>">

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Jumlah Pinjam</label>

<input
type="number"
name="jumlah"
class="form-control"
min="1"
required>

</div>

<div class="mb-3">

<label>Tanggal Pinjam</label>

<input
type="date"
name="tanggal_pinjam"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

</div>

<div class="mb-3">

<label>Tanggal Kembali</label>

<input
type="date"
name="tanggal_kembali"
class="form-control"
required>

</div>

<button type="submit" class="btn btn-success">

Simpan

</button>

<a href="index.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>