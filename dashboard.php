<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";

$totalAlat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM alat"));
$totalPeminjam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM peminjam"));
$totalTransaksi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi"));
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard CampusGear</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
    overflow-x:hidden;
}

.sidebar{

position:fixed;

top:0;

left:0;

width:240px;

height:100vh;

background:#0d6efd;

padding-top:20px;

}

.sidebar h3{

color:white;

text-align:center;

margin-bottom:35px;

}

.sidebar a{

display:block;

padding:12px 20px;

color:white;

text-decoration:none;

font-size:16px;

transition:.3s;

}

.sidebar a:hover{

background:white;

color:#0d6efd;

}

.content{

margin-left:250px;

padding:25px;

}

.card{

border:none;

border-radius:15px;

}

.card h2{

font-weight:bold;

}

</style>

</head>

<body>

<div class="sidebar">

<h3>CampusGear</h3>

<a href="dashboard.php">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

<a href="alat/index.php">

<i class="bi bi-tools"></i>

Data Alat

</a>

<a href="peminjam/index.php">

<i class="bi bi-people"></i>

Peminjam

</a>

<a href="transaksi/index.php">

<i class="bi bi-arrow-left-right"></i>

Transaksi

</a>

<a href="logout.php">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>

<div class="content">

<nav class="navbar navbar-light bg-white shadow rounded mb-4">

<div class="container-fluid">

<h4>

Dashboard Admin

</h4>

<span>

Selamat Datang,

<b><?= $_SESSION['nama']; ?></b>

</span>

</div>

</nav>

<div class="row">

<div class="col-md-4">

<div class="card shadow text-center">

<div class="card-body">

<i class="bi bi-tools text-primary" style="font-size:40px;"></i>

<h5 class="mt-3">Total Alat</h5>

<h2><?= $totalAlat; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center">

<div class="card-body">

<i class="bi bi-people text-success" style="font-size:40px;"></i>

<h5 class="mt-3">Total Peminjam</h5>

<h2><?= $totalPeminjam; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center">

<div class="card-body">

<i class="bi bi-arrow-left-right text-danger" style="font-size:40px;"></i>

<h5 class="mt-3">Total Transaksi</h5>

<h2><?= $totalTransaksi; ?></h2>

</div>

</div>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-body">

<h3>Selamat Datang di CampusGear</h3>

<hr>

<p>

CampusGear merupakan aplikasi Sistem Peminjaman Peralatan Kampus berbasis web.

Melalui aplikasi ini administrator dapat mengelola data alat, data peminjam,

serta transaksi peminjaman dan pengembalian alat.

</p>

</div>

</div>

</div>

</body>

</html>