<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Ambil nama file bukti sebelum menghapus data dari database
$query = mysqli_query($koneksi, "SELECT bukti FROM pinjam WHERE pinjam_id='$id'");
$data = mysqli_fetch_assoc($query);

// Hapus file jika ada
if ($data && !empty($data['bukti'])) {
    $file_path = '../gambar/pinjam/' . $data['bukti'];
    if (file_exists($file_path)) {
        unlink($file_path); // Hapus file dari folder
    }
}

// Hapus data dari database
mysqli_query($koneksi, "DELETE FROM pinjam WHERE pinjam_id='$id'");
header("location:peminjaman.php");
