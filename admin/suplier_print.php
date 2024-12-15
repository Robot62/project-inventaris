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
    <h4>LAPORAN SUPLIER</h4>
    <h4>Sistem Informasi Inventaris Perangkat Teknologi Informasi DJKI</h4>
  </center>

  <?php include '../koneksi.php'; ?>
  
  <table class="table table-bordered table-striped" id="table-datatable">
    <thead>
      <tr>
        <th width="1%">NO</th>
        <th>NAMA SUPLIER</th>
        <th>ALAMAT</th>
        <th>TELEPON</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      include '../koneksi.php';
      $no=1;
      $data = mysqli_query($koneksi,"SELECT * FROM suplier");
      while($d = mysqli_fetch_array($data)){
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['suplier_nama']; ?></td>
        <td><?php echo $d['suplier_alamat']; ?></td>
        <td><?php echo $d['suplier_telepon']; ?></td>
      </tr>

      <?php 
    }
    ?>
  </tbody>
</table>

<script>

  window.print();
  $(document).ready(function(){

  });
</script>

</body>
</html>
