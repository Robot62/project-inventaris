<?php
include '../koneksi.php';

$nama  = $_POST['nama'];
$barang = $_POST['barang'];
$jumlah = $_POST['jumlah'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$kondisi = $_POST['kondisi'];
$status = $_POST['status'];

if ($status === 'Dipinjam') {
    // Pengecekan jumlah stok sesuai barang yang dipinjam
    $queryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id={$barang}");
    $get = mysqli_fetch_object($queryBarang);
    $jumlahStok = $get->barang_jumlah;

    if ((int) $jumlah > (int) $jumlahStok) {
        // Redirect dengan pesan error
        header("location:peminjaman_tambah.php?error=stok");
        exit; // Pastikan proses dihentikan setelah redirect
    }
} else {
    $total = 0;
    // Pengecekan histori sudah pernah dipinjam atau belum?
    $queryBarang = mysqli_query($koneksi, "SELECT * FROM pinjam WHERE pinjam_barang={$barang}");
    $get = mysqli_fetch_all($queryBarang);

    // echo '<pre>'; print_r($get); die();

    if (count($get) == 0) {
        header("location:peminjaman_tambah.php?error=no_kembali");
        exit; // Pastikan proses dihentikan setelah redirect

    } else if (count($get) > 0) {
        foreach ($get as $row) {
            $total += $row[3]; // Tambahkan nilai dari indeks [3] ke total
        }

        if ($jumlah > $total) {
            header("location:peminjaman_tambah.php?error=kembali_over");
            exit; // Pastikan proses dihentikan setelah redirect
        }
    }
}

// Handle file upload
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = '../gambar/pinjam/';
    $original_file_name = pathinfo($_FILES['bukti']['name'], PATHINFO_FILENAME);
    $file_extension = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);

    // Generate a unique hashed file name
    $file_name = hash('sha256', $original_file_name . time()) . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['bukti']['tmp_name'], $file_path)) {
        $bukti = $file_name;
    } else {
        $bukti = null; // Handle error if file move fails
    }
} else {
    $bukti = null; // Handle error if file upload fails
}



// Insert data into tabel pinjam
$insertPinjam = mysqli_query($koneksi, "INSERT INTO pinjam (pinjam_peminjam, pinjam_barang, pinjam_jumlah, pinjam_tgl_pinjam, pinjam_tgl_kembali, pinjam_kondisi, pinjam_status, bukti) 
    VALUES ('$nama', '$barang', '$jumlah', '$tgl_pinjam', '$tgl_kembali', '$kondisi', '$status', '$bukti')");

if ($insertPinjam) {
    // Update stok barang di tabel barang
    $sisaStok = $jumlahStok - $jumlah;
    mysqli_query($koneksi, "UPDATE barang SET barang_jumlah=$sisaStok WHERE barang_id={$barang}");
}


// Redirect ke halaman peminjaman setelah sukses
header("location:peminjaman.php");
