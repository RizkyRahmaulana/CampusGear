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
$query = mysqli_query($conn, "SELECT * FROM alat");

if (!$query) {
    die("Error SQL: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Alat - CampusGear</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>
            <i class="bi bi-tools"></i>
            Data Alat
        </h2>

        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Alat
        </a>

    </div>

    <table class="table table-bordered table-hover table-striped">

        <thead class="table-dark">

        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Alat</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Status</th>
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

            <td>

                <?php
                if(empty($row['foto'])){
                    echo "-";
                }else{
                ?>

                <img src="../assets/upload/<?= htmlspecialchars($row['foto']); ?>"
                     width="70"
                     class="rounded">

                <?php } ?>

            </td>

            <td><?= htmlspecialchars($row['nama_alat']); ?></td>

            <td><?= htmlspecialchars($row['kategori']); ?></td>

            <td><?= htmlspecialchars($row['jumlah']); ?></td>

            <td><?= htmlspecialchars($row['kondisi']); ?></td>

            <td><?= htmlspecialchars($row['status']); ?></td>

            <td>

                <a href="edit.php?id=<?= $row['id_alat']; ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $row['id_alat']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus data?')">
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

    <a href="../dashboard.php" class="btn btn-secondary">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>