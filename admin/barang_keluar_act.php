<?php 
include '../koneksi.php';

$barang  = $_POST['barang'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$lokasi = $_POST['lokasi'];
$penerima = $_POST['penerima'];
$keterangan = $_POST['keterangan'];

// Ambil data barang
$b = mysqli_query($koneksi, "select * from barang where barang_id='$barang'");
$bb = mysqli_fetch_assoc($b);
$nama_barang = $bb['barang_nama'];
$jumlah_barang = $bb['barang_jumlah'];

// Cek jika jumlah yang diinput lebih besar dari jumlah barang yang ada
if ($jumlah > $jumlah_barang) {
    header("location:barang_keluar.php?alert=lebih");
} else {
    // Kurangi jumlah barang yang ada
    $jumlah_baru = $jumlah_barang - $jumlah;
    mysqli_query($koneksi, "update barang set barang_jumlah='$jumlah_baru' where barang_id='$barang'");

    // Proses upload gambar
    $bk_bukti = $_FILES['bk_bukti']['name'];
    $bk_tmp = $_FILES['bk_bukti']['tmp_name'];
    $upload_dir = '../gambar/barang_keluar/';

    // Buat folder jika belum ada
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($bk_bukti != '') {
        $file_ext = pathinfo($bk_bukti, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext; // Buat nama unik untuk file
        $upload_path = $upload_dir . $new_file_name;

        // Simpan file ke direktori
        if (move_uploaded_file($bk_tmp, $upload_path)) {
            // Insert data ke tabel barang_keluar
            mysqli_query($koneksi, "INSERT INTO barang_keluar (bk_id_barang, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_lokasi, bk_penerima, bk_keterangan, bk_bukti) 
                                    VALUES ('$barang', '$nama_barang', '$tanggal', '$jumlah', '$lokasi', '$penerima', '$keterangan', '$new_file_name')");
        } else {
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        // Insert data tanpa file gambar
        mysqli_query($koneksi, "INSERT INTO barang_keluar (bk_id_barang, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_lokasi, bk_penerima, bk_keterangan, bk_bukti) 
                                VALUES ('$barang', '$nama_barang', '$tanggal', '$jumlah', '$lokasi', '$penerima', '$keterangan', NULL)");
    }

    header("location:barang_keluar.php");
}
?>
