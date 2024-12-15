<?php
include '../koneksi.php';

$id  = $_POST['id'];
$nama  = $_POST['nama'];
$barang = $_POST['barang'];
$jumlah = $_POST['jumlah'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$kondisi = $_POST['kondisi'];
$status = $_POST['status'];

// Query untuk mendapatkan data pinjaman sebelumnya
$query = mysqli_query($koneksi, "SELECT bukti FROM pinjam WHERE pinjam_id='$id'");
$data = mysqli_fetch_assoc($query);
$bukti_lama = $data['bukti_pengembalian'];

// Proses upload file bukti
if (isset($_FILES['bukti']['name']) && $_FILES['bukti']['name'] != "") {
    $target_dir = "../gambar/pinjam/";
    $file_name = $_FILES['bukti']['name'];
    $file_tmp = $_FILES['bukti']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];

    // Validasi ekstensi file
    if (in_array($file_ext, $allowed_ext)) {
        // Hapus file lama jika ada
        if ($bukti_lama && file_exists($target_dir . $bukti_lama)) {
            unlink($target_dir . $bukti_lama);
        }

        // Upload file baru
        $new_file_name = 'kembali_' . uniqid() . '.' . $file_ext;
        move_uploaded_file($file_tmp, $target_dir . $new_file_name);

        // Update data dengan file bukti baru
        $update_query = "UPDATE pinjam SET 
            pinjam_peminjam ='$nama', 
            pinjam_barang='$barang', 
            pinjam_jumlah='$jumlah', 
            pinjam_tgl_pinjam='$tgl_pinjam', 
            pinjam_tgl_kembali='$tgl_kembali', 
            pinjam_kondisi='$kondisi', 
            pinjam_status='$status', 
            bukti_pengembalian='$new_file_name' 
            WHERE pinjam_id='$id'";
    } else {
        echo "Format file tidak valid. Hanya .jpg, .jpeg, .png, atau .pdf yang diperbolehkan.";
        exit;
    }
} else {
    // Jika tidak ada file baru, update data tanpa mengganti bukti
    $update_query = "UPDATE pinjam SET 
        pinjam_peminjam ='$nama', 
        pinjam_barang='$barang', 
        pinjam_jumlah='$jumlah', 
        pinjam_tgl_pinjam='$tgl_pinjam', 
        pinjam_tgl_kembali='$tgl_kembali', 
        pinjam_kondisi='$kondisi', 
        pinjam_status='$status' 
        WHERE pinjam_id='$id'";
}

// Eksekusi query
mysqli_query($koneksi, $update_query);


// kembalikan stok awal
mysqli_query($koneksi, "UPDATE barang SET barang_jumlah = barang_jumlah + $jumlah WHERE barang_id = $barang");

// Redirect kembali ke halaman peminjaman
header("location:peminjaman.php");
