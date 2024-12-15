<?php 
include '../koneksi.php';

$barang  = $_POST['barang'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$suplier = $_POST['suplier'];

// Ambil data barang
$b = mysqli_query($koneksi, "select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];

// Ambil data suplier
$s = mysqli_query($koneksi, "select * from suplier where suplier_id='$suplier'");
$ss = mysqli_fetch_assoc($s);
$nama_suplier = $ss['suplier_nama'];

// Tambah jumlah data barang
$jumlah_lama = $bb['barang_jumlah'];
$jumlah_baru = $jumlah_lama + $jumlah;
mysqli_query($koneksi, "update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

// Proses upload gambar
$bm_bukti = $_FILES['bm_bukti']['name'];
$bm_tmp = $_FILES['bm_bukti']['tmp_name'];
$upload_dir = '../gambar/barang_masuk/';

// Buat folder jika belum ada
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($bm_bukti != '') {
    $file_ext = pathinfo($bm_bukti, PATHINFO_EXTENSION);
    $new_file_name = uniqid() . '.' . $file_ext; // Buat nama unik untuk file
    $upload_path = $upload_dir . $new_file_name;

    // Simpan file ke direktori
    if (move_uploaded_file($bm_tmp, $upload_path)) {
        // Insert data ke tabel barang_masuk
        mysqli_query($koneksi, "INSERT INTO barang_masuk (bm_id_barang, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_id_suplier, bm_nama_suplier, bm_bukti) 
                                VALUES ('$barang', '$nama_barang', '$tanggal', '$jumlah', '$suplier', '$nama_suplier', '$new_file_name')");
    } else {
        echo "Gagal mengunggah file.";
        exit;
    }
} else {
    // Insert data tanpa file gambar
    mysqli_query($koneksi, "INSERT INTO barang_masuk (bm_id_barang, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_id_suplier, bm_nama_suplier, bm_bukti) 
                            VALUES ('$barang', '$nama_barang', '$tanggal', '$jumlah', '$suplier', '$nama_suplier', NULL)");
}

header("location:barang_masuk.php");
