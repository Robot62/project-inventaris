<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];

mysqli_query($koneksi, "update suplier set suplier_nama='$nama', suplier_alamat='$alamat', suplier_telepon='$telepon' where suplier_id='$id'");
header("location:suplier.php");