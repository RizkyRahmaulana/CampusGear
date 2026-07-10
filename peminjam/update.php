<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

include "../config/koneksi.php";

$id     = intval($_POST['id_peminjam']);
$nim    = $_POST['nim'];
$nama   = $_POST['nama'];
$prodi  = $_POST['prodi'];
$hp     = $_POST['no_hp'];
$email  = $_POST['email'];

$update = mysqli_query($conn,"
UPDATE peminjam SET

nim='$nim',

nama='$nama',

prodi='$prodi',

no_hp='$hp',

email='$email'

WHERE id_peminjam='$id'
");

if(!$update){

die(mysqli_error($conn));

}

header("Location:index.php");

exit;

?>