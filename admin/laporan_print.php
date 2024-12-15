 <!DOCTYPE html>
 <html>

 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Administrator - Sistem Informasi Inventaris Perangkat Teknologi Informasi DJKI</title>
   <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

 </head>

 <body>

   <center>
     <h4>LAPORAN</h4>
     <h4>Sistem Informasi Inventaris Perangkat Teknologi Informasi DJKI</h4>
   </center>

   <?php include '../koneksi.php'; ?>
   <?php
    if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])) {
      $tgl_dari = $_GET['tanggal_dari'];
      $tgl_sampai = $_GET['tanggal_sampai'];
      $jenis = $_GET['jenis'];
    ?>

     <table class="">
       <tr>
         <th width="40%">DARI TANGGAL</th>
         <th width="10%" class="text-center">:</th>
         <td><?php echo $tgl_dari; ?></td>
       </tr>
       <tr>
         <th>SAMPAI TANGGAL</th>
         <th class="text-center">:</th>
         <td><?php echo $tgl_sampai; ?></td>
       </tr>
       <tr>
         <th>JENIS</th>
         <th class="text-center">:</th>
         <td><?php echo $jenis; ?></td>
       </tr>
     </table>
     <br />

     <?php
      if ($jenis == "barang_masuk") {
      ?>
       <div class="table-responsive">
         <table class="table table-bordered">
           <thead>
             <tr>
               <th width="1%">NO</th>
               <th>NAMA BARANG</th>
               <th>GAMBAR</th>
               <th>TANGGAL MASUK</th>
               <th>JUMLAH</th>
               <th>BUKTI</th>
               <th>NAMA SUPLIER</th>
             </tr>
           </thead>
           <tbody>
             <?php
              include '../koneksi.php';
              $no = 1;

              // Query untuk mengambil data dari barang_masuk dengan join tabel barang
              $data = mysqli_query($koneksi, "
      SELECT bm.*, b.barang_nama, b.gambar 
      FROM barang_masuk bm
      LEFT JOIN barang b ON bm.bm_id_barang = b.barang_id
      WHERE DATE(bm.bm_tgl_masuk) >= '$tgl_dari' AND DATE(bm.bm_tgl_masuk) <= '$tgl_sampai'
    ");

              while ($d = mysqli_fetch_array($data)) {
              ?>
               <tr>
                 <td><?php echo $no++; ?></td>
                 <td><?php echo $d['barang_nama']; ?></td>
                 <td>
                   <?php if (!empty($d['gambar'])): ?>
                     <img src="../gambar/barang/<?php echo $d['gambar']; ?>" width="100" alt="Gambar Barang">
                   <?php else: ?>
                     No Image
                   <?php endif; ?>
                 </td>
                 <td><?php echo $d['bm_tgl_masuk']; ?></td>
                 <td><?php echo $d['bm_jumlah']; ?></td>
                 <td>
                   <?php if (!empty($d['bm_bukti'])): ?>
                     <img src="../gambar/barang_masuk/<?php echo $d['bm_bukti']; ?>" width="100" alt="Gambar Barang">
                   <?php else: ?>
                     No Image
                   <?php endif; ?>
                 </td>
                 <td><?php echo $d['bm_nama_suplier']; ?></td>
               </tr>
             <?php
              }
              ?>
           </tbody>
         </table>
       </div>

     <?php
      } elseif ($jenis == "barang_keluar") {
      ?>
       <div class="table-responsive">
         <table class="table table-bordered">
           <thead>
             <tr>
               <th width="1%">NO</th>
               <th>NAMA BARANG</th>
               <th>GAMBAR</th>
               <th>TANGGAL KELUAR</th>
               <th>JUMLAH</th>
               <th>LOKASI</th>
               <th>PENERIMA</th>
               <th>BUKTI</th>
               <th>KETERANGAN</th>
             </tr>
           </thead>
           <tbody>
             <?php
              include '../koneksi.php';
              $no = 1;

              // Query dengan relasi ke tabel barang
              $data = mysqli_query($koneksi, "
      SELECT bk.*, b.barang_nama, b.gambar 
      FROM barang_keluar bk
      LEFT JOIN barang b ON bk.bk_id_barang = b.barang_id
      WHERE DATE(bk.bk_tgl_keluar) >= '$tgl_dari' AND DATE(bk.bk_tgl_keluar) <= '$tgl_sampai'
    ");

              while ($d = mysqli_fetch_array($data)) {
              ?>
               <tr>
                 <td><?php echo $no++; ?></td>
                 <td><?php echo $d['barang_nama']; ?></td>
                 <td>
                   <?php if (!empty($d['gambar'])): ?>
                     <img src="../gambar/barang/<?php echo $d['gambar']; ?>" width="100" alt="Gambar Barang">
                   <?php else: ?>
                     No Image
                   <?php endif; ?>
                 </td>
                 <td><?php echo $d['bk_tgl_keluar']; ?></td>
                 <td><?php echo $d['bk_jumlah_keluar']; ?></td>
                 <td><?php echo $d['bk_lokasi']; ?></td>
                 <td><?php echo $d['bk_penerima']; ?></td>
                 <td>
                   <?php if (!empty($d['bk_bukti'])): ?>
                     <img src="../gambar/barang_keluar/<?php echo $d['bk_bukti']; ?>" width="100" alt="Gambar Barang">
                   <?php else: ?>
                     No Image
                   <?php endif; ?>
                 </td>
                 <td><?php echo $d['bk_keterangan']; ?></td>
               </tr>
             <?php
              }
              ?>
           </tbody>
         </table>
       </div>

     <?php
      }
      ?>

   <?php
    } else {
    ?>

     <div class="alert alert-info text-center">
       Silahkan Filter Laporan Terlebih Dulu.
     </div>

   <?php
    }
    ?>

   <script>
     window.print();
     $(document).ready(function() {

     });
   </script>

 </body>

 </html>