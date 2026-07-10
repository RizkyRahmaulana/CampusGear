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
    die("ID tidak ditemukan.");
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM alat WHERE id_alat='$id'");

if (!$query) {
    die("SQL Error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data alat tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Data Alat</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Data Alat</h3>

</div>

<div class="card-body">

<form action="update.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id_alat" value="<?= $data['id_alat']; ?>">

<input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

<div class="mb-3">

<label>Nama Alat</label>

<input
type="text"
name="nama_alat"
class="form-control"
value="<?= htmlspecialchars($data['nama_alat']); ?>"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<input
type="text"
name="kategori"
class="form-control"
value="<?= htmlspecialchars($data['kategori']); ?>"
required>

</div>

<div class="mb-3">

<label>Jumlah</label>

<input
type="number"
name="jumlah"
class="form-control"
value="<?= $data['jumlah']; ?>"
required>

</div>

<div class="mb-3">

<label>Kondisi</label>

<select
name="kondisi"
class="form-select">

<option value="Baik"
<?= ($data['kondisi']=="Baik") ? "selected" : ""; ?>>
Baik
</option>

<option value="Rusak Ringan"
<?= ($data['kondisi']=="Rusak Ringan") ? "selected" : ""; ?>>
Rusak Ringan
</option>

<option value="Rusak Berat"
<?= ($data['kondisi']=="Rusak Berat") ? "selected" : ""; ?>>
Rusak Berat
</option>

</select>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Tersedia"
<?= ($data['status']=="Tersedia") ? "selected" : ""; ?>>
Tersedia
</option>

<option value="Dipinjam"
<?= ($data['status']=="Dipinjam") ? "selected" : ""; ?>>
Dipinjam
</option>

</select>

</div>

<div class="mb-3">

<label>Foto Saat Ini</label><br>

<?php if(!empty($data['foto'])){ ?>

<img
src="../assets/upload/<?= htmlspecialchars($data['foto']); ?>"
width="120"
class="img-thumbnail">

<?php }else{ ?>

<p class="text-muted">Belum ada foto</p>

<?php } ?>

</div>

<div class="mb-3">

<label>Ganti Foto</label>

<input
type="file"
name="foto"
class="form-control">

</div>

<button
type="submit"
class="btn btn-success">

Update

</button>

<a href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>

</html>