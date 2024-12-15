<?php
// memanggil library FPDF
require('../library/fpdf181/fpdf.php');

include '../koneksi.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(280,10,'DATA SUPLIER',0,0,'C');

$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Arial','B',9);


$pdf->Cell(14,7,'NO',1,0,'C');
$pdf->Cell(100,7,'NAMA SUPLIER' ,1,0,'C');
$pdf->Cell(120,7,'ALAMAT',1,0,'C');
$pdf->Cell(40,7,'TELEPON',1,0,'C');

$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','',10);


$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM suplier");
while($d = mysqli_fetch_array($data)){
  $pdf->Cell(14,6, $no++,1,0,'C');
  $pdf->Cell(100,6, $d['suplier_nama'],1,0,'C');
  $pdf->Cell(120,6, $d['suplier_alamat'],1,0,'C');
  $pdf->Cell(40,6, $d['suplier_telepon'],1,1,'C');
}

$pdf->Output();

?>