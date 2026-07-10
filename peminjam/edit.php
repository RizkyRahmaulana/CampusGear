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
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

$query = mysqli_query($conn,"SELECT * FROM peminjam WHERE id_peminjam='$id'");

if(!$query){
    die(mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Peminjam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Peminjam</h3>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input type="hidden" name="id_peminjam" value="<?= $data['id_peminjam']; ?>">

<div class="mb-3">

<label>NIM</label>

<input
type="text"
name="nim"
class="form-control"
value="<?= htmlspecialchars($data['nim']); ?>"
required>

</div>

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= htmlspecialchars($data['nama']); ?>"
required>

</div>

<div class="mb-3">

<label>Program Studi</label>

<input
type="text"
name="prodi"
class="form-control"
value="<?= htmlspecialchars($data['prodi']); ?>"
required>

</div>

<div class="mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= htmlspecialchars($data['no_hp']); ?>">

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= htmlspecialchars($data['email']); ?>">

</div>

<button class="btn btn-success">

Update

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