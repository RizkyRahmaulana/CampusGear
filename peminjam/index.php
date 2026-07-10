<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Ambil data peminjam
$query = mysqli_query($conn, "SELECT * FROM peminjam ORDER BY id_peminjam DESC");

if (!$query) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjam</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="bi bi-people"></i>
            Data Peminjam
        </h2>

        <div>

            <a href="../dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>

            <a href="tambah.php" class="btn btn-primary">
                Tambah Peminjam
            </a>

        </div>

    </div>

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">

        <tr>

            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        <?php

        $no = 1;

        while($row = mysqli_fetch_assoc($query)){

        ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= htmlspecialchars($row['nim']); ?></td>

            <td><?= htmlspecialchars($row['nama']); ?></td>

            <td><?= htmlspecialchars($row['prodi']); ?></td>

            <td><?= htmlspecialchars($row['no_hp']); ?></td>

            <td><?= htmlspecialchars($row['email']); ?></td>

            <td>

                <a href="edit.php?id=<?= $row['id_peminjam']; ?>"
                   class="btn btn-warning btn-sm">

                    <i class="bi bi-pencil-square"></i>

                </a>

                <a href="hapus.php?id=<?= $row['id_peminjam']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">

                    <i class="bi bi-trash"></i>

                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>