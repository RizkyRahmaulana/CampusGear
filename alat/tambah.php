<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Data Alat</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>

<i class="bi bi-plus-circle"></i>

Tambah Data Alat

</h3>

</div>

<div class="card-body">

<form action="simpan.php" method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">

Nama Alat

</label>

<input
type="text"
name="nama_alat"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Kategori

</label>

<input
type="text"
name="kategori"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Jumlah

</label>

<input
type="number"
name="jumlah"
class="form-control"
min="1"
required>

</div>

<div class="mb-3">

<label class="form-label">

Kondisi

</label>

<select
name="kondisi"
class="form-select">

<option value="Baik">Baik</option>

<option value="Rusak Ringan">Rusak Ringan</option>

<option value="Rusak Berat">Rusak Berat</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="Tersedia">Tersedia</option>

<option value="Dipinjam">Dipinjam</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Foto Alat

</label>

<input
type="file"
name="foto"
class="form-control"
accept=".jpg,.jpeg,.png">

</div>

<button
type="submit"
class="btn btn-success">

<i class="bi bi-save"></i>

Simpan

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>