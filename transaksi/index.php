<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";

// Query transaksi dengan JOIN
$sql = "SELECT
            t.id_transaksi,
            p.nama AS nama_peminjam,
            a.nama_alat,
            t.jumlah,
            t.tanggal_pinjam,
            t.tanggal_kembali,
            t.status
        FROM transaksi t
        LEFT JOIN alat a ON t.id_alat = a.id_alat
        LEFT JOIN peminjam p ON t.id_peminjam = p.id_peminjam
        ORDER BY t.id_transaksi DESC";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="bi bi-arrow-left-right"></i>
            Data Transaksi
        </h2>

        <div>

            <a href="../dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>

            <a href="tambah.php" class="btn btn-primary">
                Tambah Transaksi
            </a>

        </div>

    </div>

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">

        <tr>

            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Alat</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        <?php
        $no = 1;

        while ($row = mysqli_fetch_assoc($query)) {
        ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= htmlspecialchars($row['nama_peminjam'] ?? '-'); ?></td>

            <td><?= htmlspecialchars($row['nama_alat'] ?? '-'); ?></td>

            <td><?= htmlspecialchars($row['jumlah']); ?></td>

            <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>

            <td><?= htmlspecialchars($row['tanggal_kembali']); ?></td>

            <td>

                <?php

                if($row['status']=="Dipinjam"){

                    echo "<span class='badge bg-warning'>Dipinjam</span>";

                }elseif($row['status']=="Dikembalikan"){

                    echo "<span class='badge bg-success'>Dikembalikan</span>";

                }else{

                    echo "<span class='badge bg-danger'>Terlambat</span>";

                }

                ?>

            </td>

            <td>

                <a href="edit.php?id=<?= $row['id_transaksi']; ?>"
                   class="btn btn-warning btn-sm">

                    <i class="bi bi-pencil-square"></i>

                </a>

                <a href="hapus.php?id=<?= $row['id_transaksi']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">

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