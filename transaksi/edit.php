<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

if(!isset($_GET['id'])){
    die("ID Transaksi tidak ditemukan.");
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn,"
SELECT *
FROM transaksi
WHERE id_transaksi='$id'
");

if(!$query){
    die(mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data transaksi tidak ditemukan.");
}

// Data alat
$alat = mysqli_query($conn,"
SELECT *
FROM alat
ORDER BY nama_alat ASC
");

// Data peminjam
$peminjam = mysqli_query($conn,"
SELECT *
FROM peminjam
ORDER BY nama ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Edit Transaksi</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Transaksi</h3>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_transaksi"
value="<?= $data['id_transaksi']; ?>">

<div class="mb-3">

<label>Nama Alat</label>

<select
name="id_alat"
class="form-select"
required>

<?php

while($a=mysqli_fetch_assoc($alat)){

?>

<option
value="<?= $a['id_alat']; ?>"
<?= ($a['id_alat']==$data['id_alat']) ? 'selected' : ''; ?>>

<?= $a['nama_alat']; ?>

( Stok :
<?= $a['jumlah']; ?> )

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Nama Peminjam</label>

<select
name="id_peminjam"
class="form-select"
required>

<?php

while($p=mysqli_fetch_assoc($peminjam)){

?>

<option
value="<?= $p['id_peminjam']; ?>"
<?= ($p['id_peminjam']==$data['id_peminjam']) ? 'selected' : ''; ?>>

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
value="<?= $data['jumlah']; ?>"
required>

</div>

<div class="mb-3">

<label>Tanggal Pinjam</label>

<input
type="date"
name="tanggal_pinjam"
class="form-control"
value="<?= $data['tanggal_pinjam']; ?>"
required>

</div>

<div class="mb-3">

<label>Tanggal Kembali</label>

<input
type="date"
name="tanggal_kembali"
class="form-control"
value="<?= $data['tanggal_kembali']; ?>"
required>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option
value="Dipinjam"
<?= ($data['status']=="Dipinjam") ? "selected" : ""; ?>>

Dipinjam

</option>

<option
value="Dikembalikan"
<?= ($data['status']=="Dikembalikan") ? "selected" : ""; ?>>

Dikembalikan

</option>

</select>

</div>

<button
class="btn btn-success">

Update

</button>

<a
href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>