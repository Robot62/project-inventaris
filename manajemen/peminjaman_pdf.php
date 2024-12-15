<?php
// Memanggil library FPDF
require('../library/fpdf181/fpdf.php');

include '../koneksi.php';

// Instance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A3');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(400, 10, 'DATA PEMINJAMAN', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Arial', 'B', 9);

// Header tabel
$pdf->Cell(14, 7, 'NO', 1, 0, 'C');
$pdf->Cell(40, 7, 'GAMBAR', 1, 0, 'C'); // Kolom gambar barang
$pdf->Cell(50, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(50, 7, 'BARANG', 1, 0, 'C');
$pdf->Cell(20, 7, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(30, 7, 'KONDISI', 1, 0, 'C');
$pdf->Cell(30, 7, 'TGL.PINJAM', 1, 0, 'C');
$pdf->Cell(40, 7, 'BUKTI PINJAM', 1, 0, 'C');
$pdf->Cell(30, 7, 'TGL.KEMBALI', 1, 0, 'C');
$pdf->Cell(40, 7, 'BUKTI PENGEMBALIAN', 1, 0, 'C');
$pdf->Cell(30, 7, 'STATUS', 1, 1, 'C');

// Data tabel
$pdf->SetFont('Arial', '', 10);

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM pinjam, barang WHERE pinjam_barang=barang_id");
while ($d = mysqli_fetch_array($data)) {
  $pdf->Cell(14, 20, $no++, 1, 0, 'C'); // Tinggi cell disesuaikan dengan gambar

  // Path ke gambar barang
  $gambar = '../gambar/barang/' . $d['gambar'];
  if (file_exists($gambar) && in_array(pathinfo($gambar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
    // Mengambil dimensi asli gambar
    list($width, $height) = getimagesize($gambar);

    // Menentukan ukuran proporsional
    $maxWidth = 30;
    $maxHeight = 14;
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = $width * $ratio;
    $newHeight = $height * $ratio;

    // Menampilkan gambar dengan ukuran proporsional
    $pdf->Cell(40, 20, $pdf->Image($gambar, $pdf->GetX() + (40 - $newWidth) / 2, $pdf->GetY() + (20 - $newHeight) / 2, $newWidth, $newHeight), 1, 0, 'C');
  } else {
    $pdf->Cell(40, 20, 'Tidak Ada', 1, 0, 'C'); // Teks jika file tidak ditemukan
  }

  // Menambahkan data lainnya
  $pdf->Cell(50, 20, $d['pinjam_peminjam'], 1, 0, 'C');
  $pdf->Cell(50, 20, $d['barang_nama'], 1, 0, 'C');
  $pdf->Cell(20, 20, $d['pinjam_jumlah'], 1, 0, 'C');
  $pdf->Cell(30, 20, $d['pinjam_kondisi'], 1, 0, 'C');
  $pdf->Cell(30, 20, $d['pinjam_tgl_pinjam'], 1, 0, 'C');

  // Path ke gambar bukti pinjam
  $gambarPinjam = '../gambar/pinjam/' . $d['bukti'];
  if (file_exists($gambarPinjam) && in_array(pathinfo($gambarPinjam, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
    // Mengambil dimensi asli gambar
    list($width, $height) = getimagesize($gambarPinjam);

    // Menentukan ukuran proporsional
    $maxWidth = 30;
    $maxHeight = 14;
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = $width * $ratio;
    $newHeight = $height * $ratio;

    // Menampilkan gambar dengan ukuran proporsional
    $pdf->Cell(40, 20, $pdf->Image($gambarPinjam, $pdf->GetX() + (40 - $newWidth) / 2, $pdf->GetY() + (20 - $newHeight) / 2, $newWidth, $newHeight), 1, 0, 'C');
  } else {
    $pdf->Cell(40, 20, 'Tidak Ada', 1, 0, 'C'); // Teks jika file tidak ditemukan
  }


  $pdf->Cell(30, 20, $d['pinjam_tgl_kembali'], 1, 0, 'C');

  // Path ke gambar bukti kembali
  $gambarKembali = '../gambar/pinjam/' . $d['bukti_pengembalian'];
  if (file_exists($gambarKembali) && in_array(pathinfo($gambarKembali, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
    // Mengambil dimensi asli gambar
    list($width, $height) = getimagesize($gambarKembali);

    // Menentukan ukuran proporsional
    $maxWidth = 30;
    $maxHeight = 14;
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = $width * $ratio;
    $newHeight = $height * $ratio;

    // Menampilkan gambar dengan ukuran proporsional
    $pdf->Cell(40, 20, $pdf->Image($gambarKembali, $pdf->GetX() + (40 - $newWidth) / 2, $pdf->GetY() + (20 - $newHeight) / 2, $newWidth, $newHeight), 1, 0, 'C');
  } else {
    $pdf->Cell(40, 20, 'Tidak Ada', 1, 0, 'C'); // Teks jika file tidak ditemukan
  }

  // Status peminjaman
  $s = $d['pinjam_status'] == "Dikembalikan" ? "Di Kembalikan" : "Di Pinjam";
  $pdf->Cell(30, 20, $s, 1, 1, 'C');
}

$pdf->Output();
