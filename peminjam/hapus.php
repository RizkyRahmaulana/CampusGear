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
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);

// Cek apakah masih dipakai di transaksi
$cek = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM transaksi
WHERE id_peminjam='$id'
");

$hasil = mysqli_fetch_assoc($cek);

if($hasil['total'] > 0){

echo "<script>

alert('Data peminjam tidak dapat dihapus karena masih digunakan pada transaksi.');

window.location='index.php';

</script>";

exit;

}

$hapus = mysqli_query($conn,"
DELETE FROM peminjam
WHERE id_peminjam='$id'
");

if(!$hapus){

die(mysqli_error($conn));

}

echo "<script>

alert('Data berhasil dihapus.');

window.location='index.php';

</script>";

?>