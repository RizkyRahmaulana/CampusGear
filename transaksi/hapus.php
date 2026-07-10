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
    die("ID transaksi tidak ditemukan.");
}

$id = (int)$_GET['id'];

/*
=========================
AMBIL TRANSAKSI
=========================
*/

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

$id_alat = $data['id_alat'];

$jumlah = $data['jumlah'];

/*
=========================
KEMBALIKAN STOK
HANYA JIKA MASIH DIPINJAM
=========================
*/

if($data['status']=="Dipinjam"){

mysqli_query($conn,"
UPDATE alat
SET jumlah = jumlah + $jumlah
WHERE id_alat='$id_alat'
");

mysqli_query($conn,"
UPDATE alat
SET status='Tersedia'
WHERE id_alat='$id_alat'
");

}

/*
=========================
HAPUS TRANSAKSI
=========================
*/

mysqli_query($conn,"
DELETE FROM transaksi
WHERE id_transaksi='$id'
");

echo "<script>

alert('Transaksi berhasil dihapus.');

window.location='index.php';

</script>";

?>