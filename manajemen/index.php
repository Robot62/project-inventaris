<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">

    <div class="row">

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <?php 
            $barang = mysqli_query($koneksi,"SELECT * FROM barang");
            ?>
            <h3><?php echo mysqli_num_rows($barang); ?></h3>
            <p>Model Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="barang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <?php 
            $suplier = mysqli_query($koneksi,"SELECT * FROM suplier");
            ?>
            <h3><?php echo mysqli_num_rows($suplier); ?></h3>
            <p>Suplier</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="suplier.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <?php 
            $pinjam = mysqli_query($koneksi,"SELECT * FROM pinjam");
            ?>
            <h3><?php echo mysqli_num_rows($pinjam); ?></h3>
            <p>Total Peminjaman</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="peminjaman.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php 
            $barang_masuk = mysqli_query($koneksi,"SELECT sum(bm_jumlah) as total_barang_masuk FROM barang_masuk");
            $bm = mysqli_fetch_assoc($barang_masuk);
            ?>
            <h3><?php echo $bm['total_barang_masuk']; ?></h3>
            <p>Total Barang Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="barang_masuk.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple">
          <div class="inner">
            <?php 
            $barang_keluar = mysqli_query($koneksi,"SELECT sum(bk_jumlah_keluar) as total_barang_keluar FROM barang_keluar");
            $bk = mysqli_fetch_assoc($barang_keluar);
            ?>
            <h3><?php echo $bk['total_barang_keluar']; ?></h3>
            <p>Total Barang Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="barang_keluar.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php 
            $barang_masuk = mysqli_query($koneksi,"SELECT * FROM barang_masuk");
            ?>
            <h3><?php echo mysqli_num_rows($barang_masuk); ?></h3>
            <p>Total Transaksi Barang Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="barang_masuk.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <?php 
            $barang_keluar = mysqli_query($koneksi,"SELECT * FROM barang_keluar");
            ?>
            <h3><?php echo mysqli_num_rows($barang_keluar); ?></h3>
            <p>Total Transaksi Barang Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="barang_keluar.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

       <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <?php 
            $peminjaman = mysqli_query($koneksi,"SELECT * FROM pinjam WHERE pinjam_status='dikembalikan'");
            ?>
            <h3><?php echo mysqli_num_rows($peminjaman); ?></h3>
            <p>Peminjaman Dikembalikan</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="peminjaman.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <?php 
            $peminjaman = mysqli_query($koneksi,"SELECT * FROM pinjam WHERE pinjam_status='dipinjam'");
            ?>
            <h3><?php echo mysqli_num_rows($peminjaman); ?></h3>
            <p>Peminjaman Belum Dikembalikan</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-list"></i>
          </div>
          <a href="peminjaman.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <div class="row">    
      <section class="col-lg-7">

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Detail Login</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Nama</th>
                <td><?php echo $_SESSION['nama']; ?></td>
              </tr>
              <tr>
                <th>Username</th>
                <td><?php echo $_SESSION['username']; ?></td>
              </tr>
              <tr>
                <th>Level Hak Akses</th>
                <td>
                  <span class="label label-success text-uppercase"><?php echo $_SESSION['level']; ?></span>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </section>
    </div>

  </section>

</div>
<?php include 'footer.php'; ?>