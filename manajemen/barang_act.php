<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$spesifikasi = $_POST['spesifikasi'];
$lokasi = $_POST['lokasi'];
$kondisi = $_POST['kondisi'];
$jumlah = $_POST['jumlah'];
$sumber_dana = $_POST['sumber_dana'];
$keterangan = $_POST['keterangan'];
$jenis = $_POST['jenis'];
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $target_dir = "../gambar/barang/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = basename($_FILES["gambar"]["name"]);
            mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_spesifikasi, barang_lokasi, barang_kondisi, barang_jumlah, barang_sumber_dana, barang_keterangan, barang_jenis, gambar) 
            VALUES ('$nama', '$spesifikasi', '$lokasi', '$kondisi', '$jumlah', '$sumber_dana', '$keterangan', '$jenis', '$gambar')");
            header("location:barang.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
} else {
    mysqli_query($koneksi, "INSERT INTO barang (barang_nama, barang_spesifikasi, barang_lokasi, barang_kondisi, barang_jumlah, barang_sumber_dana, barang_keterangan, barang_jenis) 
    VALUES ('$nama', '$spesifikasi', '$lokasi', '$kondisi', '$jumlah', '$sumber_dana', '$keterangan', '$jenis')");
    header("location:barang.php");
}
?>
