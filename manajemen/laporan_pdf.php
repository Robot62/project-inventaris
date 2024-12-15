<?php
// memanggil library FPDF
require('../library/fpdf181/fpdf.php');

include '../koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'legal');

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(350, 10, 'LAPORAN', 0, 0, 'C');

$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$jenis = $_GET['jenis'];

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(35, 6, 'DARI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_dari)), 0, 0);
$pdf->Cell(10, 6, '', 0, 1);
$pdf->Cell(35, 6, 'SAMPAI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_sampai)), 0, 0);
$pdf->Cell(10, 6, '', 0, 1);
$pdf->Cell(35, 6, 'KATEGORI', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, $jenis, 0, 0);

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Arial', 'B', 9);

if ($jenis == "barang_masuk") {

  $pdf->Cell(14, 7, 'NO', 1, 0, 'C');
  $pdf->Cell(30, 7, 'NAMA BARANG', 1, 0, 'C');
  $pdf->Cell(30, 7, 'GAMBAR', 1, 0, 'C');
  $pdf->Cell(50, 7, 'TANGGAL MASUK', 1, 0, 'C');
  $pdf->Cell(35, 7, 'JUMLAH', 1, 0, 'C');
  $pdf->Cell(50, 7, 'BUKTI', 1, 0, 'C');
  $pdf->Cell(65, 7, 'NAMA SUPLIER', 1, 0, 'C');

  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', '', 10);

  $no = 1;
  $data = mysqli_query($koneksi, "
  SELECT bm.*, b.barang_nama, b.gambar 
  FROM barang_masuk bm
  LEFT JOIN barang b ON bm.bm_id_barang = b.barang_id
  WHERE DATE(bm.bm_tgl_masuk) >= '$tgl_dari' AND DATE(bm.bm_tgl_masuk) <= '$tgl_sampai'
");
  while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(14, 30, $no++, 1, 0, 'C');
    $pdf->Cell(30, 30, wordwrap($d['bm_nama_barang'], 15, "\n"), 1, 0, 'C');
    // Menambahkan gambar
    if (!empty($d['gambar'])) {
      $gambarPath = '../gambar/barang/' . $d['gambar'];
      if (file_exists($gambarPath)) {
        $pdf->Cell(30, 30, $pdf->Image($gambarPath, $pdf->GetX() + 2, $pdf->GetY() + 2, 26), 1, 0, 'C');
      } else {
        $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
      }
    } else {
      $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
    }

    $pdf->Cell(50, 30, $d['bm_tgl_masuk'], 1, 0, 'C');
    $pdf->Cell(35, 30, $d['bm_jumlah'], 1, 0, 'C');

    // Path ke gambar bukti barang keluar
    $gambarKeluar = '../gambar/barang_masuk/' . $d['bm_bukti'];
    if (file_exists($gambarKeluar) && in_array(pathinfo($gambarKeluar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
      // Mengambil dimensi asli gambar
      list($width, $height) = getimagesize($gambarKeluar);

      // Menentukan ukuran proporsional
      $maxWidth = 30;
      $maxHeight = 14;
      $ratio = min($maxWidth / $width, $maxHeight / $height);
      $newWidth = $width * $ratio;
      $newHeight = $height * $ratio;

      // Menampilkan gambar dengan ukuran proporsional
      $pdf->Cell(50, 30, $pdf->Image($gambarKeluar, $pdf->GetX() + (40 - $newWidth) / 2, $pdf->GetY() + (20 - $newHeight) / 2, $newWidth, $newHeight), 1, 0, 'C');
    } else {
      $pdf->Cell(50, 30, 'Tidak Ada', 1, 0, 'C'); // Teks jika file tidak ditemukan
    }

    $pdf->Cell(65, 30, $d['bm_nama_suplier'], 1, 1, 'C');
  }









} elseif ($jenis == "barang_keluar") {

  $pdf->Cell(14, 7, 'NO', 1, 0, 'C');
  $pdf->Cell(30, 7, 'NAMA BARANG', 1, 0, 'C');
  $pdf->Cell(30, 7, 'GAMBAR', 1, 0, 'C');
  $pdf->Cell(35, 7, 'TANGGAL KELUAR', 1, 0, 'C');
  $pdf->Cell(20, 7, 'JUMLAH', 1, 0, 'C');
  $pdf->Cell(50, 7, 'LOKASI', 1, 0, 'C');
  $pdf->Cell(50, 7, 'PENERIMA', 1, 0, 'C');
  $pdf->Cell(50, 7, 'BUKTI', 1, 0, 'C');
  $pdf->Cell(55, 7, 'KETERANGAN', 1, 0, 'C');

  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', '', 10);

  $no = 1;
  $data = mysqli_query($koneksi, "
  SELECT bk.*, b.barang_nama, b.gambar 
  FROM barang_keluar bk
  LEFT JOIN barang b ON bk.bk_id_barang = b.barang_id
  WHERE DATE(bk.bk_tgl_keluar) >= '$tgl_dari' AND DATE(bk.bk_tgl_keluar) <= '$tgl_sampai'
");
  while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(14, 30, $no++, 1, 0, 'C');
    $pdf->Cell(30, 30, wordwrap($d['bk_nama_barang'], 15, "\n"), 1, 0, 'C');

    // Menambahkan gambar
    if (!empty($d['gambar'])) {
      $gambarPath = '../gambar/barang/' . $d['gambar'];
      if (file_exists($gambarPath)) {
        $pdf->Cell(30, 30, $pdf->Image($gambarPath, $pdf->GetX() + 2, $pdf->GetY() + 2, 26), 1, 0, 'C');
      } else {
        $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
      }
    } else {
      $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
    }

    $pdf->Cell(35, 30, $d['bk_tgl_keluar'], 1, 0, 'C');
    $pdf->Cell(20, 30, $d['bk_jumlah_keluar'], 1, 0, 'C');
    $pdf->Cell(50, 30, $d['bk_lokasi'], 1, 0, 'C');
    $pdf->Cell(50, 30, $d['bk_penerima'], 1, 0, 'C');

    // Path ke gambar bukti barang keluar
    $gambarKeluar = '../gambar/barang_keluar/' . $d['bk_bukti'];
    if (file_exists($gambarKeluar) && in_array(pathinfo($gambarKeluar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
      // Mengambil dimensi asli gambar
      list($width, $height) = getimagesize($gambarKeluar);

      // Menentukan ukuran proporsional
      $maxWidth = 30;
      $maxHeight = 14;
      $ratio = min($maxWidth / $width, $maxHeight / $height);
      $newWidth = $width * $ratio;
      $newHeight = $height * $ratio;

      // Menampilkan gambar dengan ukuran proporsional
      $pdf->Cell(50, 30, $pdf->Image($gambarKeluar, $pdf->GetX() + (40 - $newWidth) / 2, $pdf->GetY() + (20 - $newHeight) / 2, $newWidth, $newHeight), 1, 0, 'C');
    } else {
      $pdf->Cell(50, 30, 'Tidak Ada', 1, 0, 'C'); // Teks jika file tidak ditemukan
    }

    $pdf->Cell(55, 30, $d['bk_keterangan'], 1, 1, 'C');
  }
}


$pdf->Output();
