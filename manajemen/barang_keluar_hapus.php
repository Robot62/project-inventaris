<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Ambil data barang keluar
$bk = mysqli_query($koneksi, "select * from barang_keluar where bk_id='$id'");
$barang_keluar = mysqli_fetch_assoc($bk);
$id_barang_keluar = $barang_keluar['bk_id_barang'];
$jumlah_barang_keluar = $barang_keluar['bk_jumlah_keluar'];
$bk_bukti = $barang_keluar['bk_bukti'];  // Ambil nama file gambar (jika ada)

// Ambil data barang yang bersangkutan
$b = mysqli_query($koneksi, "select * from barang where barang_id='$id_barang_keluar'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];

// Ubah jumlah stok barang
$ubah_jumlah = $jumlah_barang + $jumlah_barang_keluar;
mysqli_query($koneksi, "update barang set barang_jumlah='$ubah_jumlah' where barang_id='$id_barang_keluar'");

// Hapus gambar jika ada
if ($bk_bukti != NULL) {
    $path_to_image = '../gambar/barang_keluar/' . $bk_bukti;

    // Cek jika file gambar ada dan hapus
    if (file_exists($path_to_image)) {
        unlink($path_to_image);
    }
}

// Hapus data barang keluar
mysqli_query($koneksi, "delete from barang_keluar where bk_id='$id'");

// Redirect kembali ke halaman barang keluar
header("location:barang_keluar.php");
?>
