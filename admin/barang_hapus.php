<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Retrieve the image file name from the database
$result = mysqli_query($koneksi, "SELECT gambar FROM barang WHERE barang_id='$id'");
$data = mysqli_fetch_array($result);
$image_name = $data['gambar'];

// Check if an image exists and delete it from the server
if ($image_name != null) {
    $image_path = "../gambar/barang/" . $image_name;
    if (file_exists($image_path)) {
        unlink($image_path);  // Delete the image file
    }
}

// Delete the records from the database
mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id='$id'");
mysqli_query($koneksi, "DELETE FROM barang_masuk WHERE bm_id_barang='$id'");
mysqli_query($koneksi, "DELETE FROM barang_keluar WHERE bk_id_barang='$id'");

// Redirect back to the barang page
header("location:barang.php");
?>
