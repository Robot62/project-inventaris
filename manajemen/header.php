<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator - Sistem Informasi Inventaris Perangkat Teknologi Informasi DJKI</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php 
  include '../koneksi.php';
  session_start();
  if($_SESSION['level'] != "manajemen"){
    header("location:../index.php?alert=belum_login");
  }
  ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b>DJKI</b> </span>
        <span class="logo-lg"><b>Inventaris</b>DJKI</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php 
                $id_user = $_SESSION['id'];
                $profil = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
                $profil = mysqli_fetch_assoc($profil);
                if($profil['user_foto'] == ""){ 
                  ?>
                  <img src="../gambar/sistem/user.png" class="user-image">
                <?php }else{ ?>
                  <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
              </a>
            </li>
            <li>
              <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php 
            $id_user = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
            $profil = mysqli_fetch_assoc($profil);
            if($profil['user_foto'] == ""){ 
              ?>
              <img src="../gambar/sistem/user.png" class="img-circle">
            <?php }else{ ?>
              <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li>
            <a href="barang.php">
              <i class="fa fa-folder"></i> <span>DATA BARANG</span>
            </a>
          </li>

          <li>
            <a href="suplier.php">
              <i class="fa fa-truck"></i> <span>DATA SUPLIER</span>
            </a>
          </li>

          <li>
            <a href="peminjaman.php">
              <i class="fa fa-hand-paper-o"></i> <span>PEMINJAMAN</span>
            </a>
          </li>

          <li>
            <a href="barang_masuk.php">
              <i class="fa fa-mail-reply"></i> <span>BARANG MASUK</span>
            </a>
          </li>

          <li>
            <a href="barang_keluar.php">
              <i class="fa fa-mail-forward"></i> <span>BARANG KELUAR</span>
            </a>
          </li>

          <li>
            <a href="laporan.php">
              <i class="fa fa-file"></i> <span>LAPORAN</span>
            </a>
          </li>

          <li>
            <a href="gantipassword.php">
              <i class="fa fa-lock"></i> <span>GANTI PASSWORD</span>
            </a>
          </li>

          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
            </a>
          </li>
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
