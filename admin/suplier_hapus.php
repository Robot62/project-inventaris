<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from suplier where suplier_id='$id'");
header("location:suplier.php");
