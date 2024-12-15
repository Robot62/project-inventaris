<?php
include '../koneksi.php';
$id  = $_POST['id'];
$barang_baru  = $_POST['barang'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$suplier = $_POST['suplier'];

// kembalikan data barang masuk
$bm = mysqli_query($koneksi,"SELECT * FROM barang_masuk WHERE bm_id='$id'");
$barang_masuk = mysqli_fetch_assoc($bm);
$id_barang_masuk = $barang_masuk['bm_id_barang'];
$jumlah_barang_masuk = $barang_masuk['bm_jumlah'];

$b = mysqli_query($koneksi,"SELECT * FROM barang WHERE barang_id='$id_barang_masuk'");
$barang = mysqli_fetch_assoc($b);
$jumlah_barang = $barang['barang_jumlah'];
$nama_barang = $barang['barang_nama'];

// ubah jumlah stok data barang
$ubah_jumlah = $jumlah_barang - $jumlah_barang_masuk;
mysqli_query($koneksi,"UPDATE barang SET barang_jumlah='$ubah_jumlah' WHERE barang_id='$id_barang_masuk'");
// akhir kembalikan data barang masuk

// Data suplier
$s = mysqli_query($koneksi,"SELECT * FROM suplier WHERE suplier_id='$suplier'");
$ss = mysqli_fetch_assoc($s);
$nama_suplier = $ss['suplier_nama'];

// update jumlah barang
$ubah_jumlah_baru = $ubah_jumlah + $jumlah;
mysqli_query($koneksi,"UPDATE barang SET barang_jumlah='$ubah_jumlah_baru' WHERE barang_id='$barang_baru'");

// Cek apakah ada file gambar yang diupload
$bm_bukti = $_FILES['bm_bukti']['name'];
if ($bm_bukti != '') {
    // Jika ada file gambar yang diupload, simpan gambar baru dan hapus gambar lama
    $file_tmp = $_FILES['bm_bukti']['tmp_name'];
    $file_ext = pathinfo($bm_bukti, PATHINFO_EXTENSION);
    $file_name = "bm_" . time() . "." . $file_ext; // generate unique file name
    $upload_path = "../gambar/barang_masuk/" . $file_name;

    // Simpan file gambar baru
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Hapus gambar lama jika ada
        if (!is_null($barang_masuk['bm_bukti']) && $barang_masuk['bm_bukti'] != '') {
            $old_image_path = "../gambar/barang_masuk/" . $barang_masuk['bm_bukti'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path); // hapus gambar lama
            }
        }
        // Update data barang masuk dengan nama file gambar baru
        mysqli_query($koneksi, "UPDATE barang_masuk SET bm_bukti='$file_name' WHERE bm_id='$id'");
    } else {
        echo "Gagal mengupload gambar.";
    }
}

// update data barang masuk tanpa mengubah gambar
mysqli_query($koneksi,"UPDATE barang_masuk SET bm_id_barang='$barang_baru', bm_nama_barang='$nama_barang', bm_tgl_masuk='$tanggal', bm_jumlah='$jumlah', bm_id_suplier='$suplier', bm_nama_suplier='$nama_suplier' WHERE bm_id='$id'");

header("Location: barang_masuk.php");
?>
