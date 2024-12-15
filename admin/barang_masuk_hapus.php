<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Ambil data barang masuk berdasarkan ID
$bm = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);

// Cek apakah data barang masuk ditemukan
if ($barang_masuk) {
    $id_barang_masuk = $barang_masuk['bm_id_barang'];
    $jumlah_barang_masuk = $barang_masuk['bm_jumlah'];
    $bm_bukti = $barang_masuk['bm_bukti']; // Ambil nama file gambar

    // Ambil data barang berdasarkan ID
    $b = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$id_barang_masuk'");
    $barang = mysqli_fetch_assoc($b);

    // Hitung stok baru
    $jumlah_barang = $barang['barang_jumlah'];
    $ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;

    // Update jumlah stok barang
    mysqli_query($koneksi, "UPDATE barang SET barang_jumlah='$ubah_jumlah' WHERE barang_id='$id_barang_masuk'");

    // Hapus gambar jika field bm_bukti tidak null
    if (!is_null($bm_bukti) && $bm_bukti != '') {
        $file_path = '../gambar/barang_masuk/' . $bm_bukti;
        if (file_exists($file_path)) {
            unlink($file_path); // Hapus file gambar
        }
    }

    // Hapus data barang masuk dari database
    mysqli_query($koneksi, "DELETE FROM barang_masuk WHERE bm_id='$id'");
    header("location:barang_masuk.php");
} else {
    echo "Data tidak ditemukan!";
}
?>
