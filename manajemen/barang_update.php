<?php 
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$spesifikasi = $_POST['spesifikasi'];
$lokasi = $_POST['lokasi'];
$kondisi = $_POST['kondisi'];
$jumlah = $_POST['jumlah'];
$sumber_dana = $_POST['sumber_dana'];
$keterangan = $_POST['keterangan'];
$jenis = $_POST['jenis'];

// Check if a new image is uploaded
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "../gambar/barang/" . $gambar;

    // Fetch the current image name from the database
    $query = mysqli_query($koneksi, "SELECT gambar FROM barang WHERE barang_id='$id'");
    $row = mysqli_fetch_array($query);
    $old_image = $row['gambar'];

    // Move the new image file to the target directory
    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        // Delete the old image if it exists
        if ($old_image) {
            $old_image_path = "../gambar/barang/" . $old_image;
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        // Update the database with the new image
        mysqli_query($koneksi, "UPDATE barang SET gambar='$gambar' WHERE barang_id='$id'");
    } else {
        echo "Error uploading the new image.";
        exit;
    }
}

// Update other fields in the barang table
mysqli_query($koneksi, "UPDATE barang SET 
    barang_nama='$nama', 
    barang_spesifikasi='$spesifikasi', 
    barang_lokasi='$lokasi', 
    barang_kondisi='$kondisi', 
    barang_jumlah='$jumlah', 
    barang_sumber_dana='$sumber_dana', 
    barang_keterangan='$keterangan', 
    barang_jenis='$jenis' 
    WHERE barang_id='$id'");

header("location:barang.php");
?>
