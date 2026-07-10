<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: ../login.php");
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Tambah Peminjam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

Tambah Data Peminjam

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<label>NIM</label>

<input type="text" name="nim" class="form-control" required>

<br>

<label>Nama</label>

<input type="text" name="nama" class="form-control" required>

<br>

<label>Prodi</label>

<input type="text" name="prodi" class="form-control">

<br>

<label>No HP</label>

<input type="text" name="no_hp" class="form-control">

<br>

<label>Email</label>

<input type="email" name="email" class="form-control">

<br>

<button class="btn btn-success" name="simpan">

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