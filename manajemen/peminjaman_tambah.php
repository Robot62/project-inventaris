<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Peminjaman
      <small>Tambah Peminjaman Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Tambah Peminjaman</h3>
            <a href="peminjaman.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
          </div>
          <div class="box-body">
            <?php
            // Tampilkan pesan alert jika ada query string 'error'
            if (isset($_GET['error']) && $_GET['error'] == 'stok') {
              echo "<script>alert('Jumlah barang yang dipinjam melebihi stok yang tersedia!');</script>";
            } else  if (isset($_GET['error']) && $_GET['error'] == 'no_kembali') {
              echo "<script>alert('Pengembalian dibatalkan, karena tidak ada proses peminjaman barang sebelumnya');</script>";
            } else  if (isset($_GET['error']) && $_GET['error'] == 'kembali_over') {
              echo "<script>alert('Jumlah yang dikembalikan melebihi dari total yang dipinjam');</script>";
            }
            ?>

            <form action="peminjaman_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama Peminjam</label>
                <input autocomplete="off" type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group">
                <label>Barang</label>
                <select class="form-control" name="barang" required="required">
                  <option value=""> - Pilih Barang - </option>
                  <?php
                  $barang = mysqli_query($koneksi, "SELECT * from barang");
                  while ($b = mysqli_fetch_array($barang)) {
                  ?>
                    <option value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input autocomplete="off" type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan jumlah ..">
              </div>

              <div class="form-group">
                <label>Tgl. Pinjam</label>
                <input autocomplete="off" type="text" class="form-control datepicker2" name="tgl_pinjam" required="required" placeholder="Masukkan tgl pinjam ..">
              </div>

              <div class="form-group">
                <label>Tgl. Kembali</label>
                <input autocomplete="off" type="text" class="form-control datepicker2" name="tgl_kembali" required="required" placeholder="Masukkan tgl kembali ..">
              </div>

              <div class="form-group">
                <label>Kondisi</label>
                <input autocomplete="off" type="text" class="form-control" name="kondisi" placeholder="Masukkan Kondisi ..">
              </div>

              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required="required">
                  <option value="Dipinjam">Dipinjam</option>
                  <option value="Dikembalikan">Dikembalikan</option>
                </select>
              </div>

              <div class="form-group">
                <label>Bukti (Attachment)</label>
                <input type="file" class="form-control" name="bukti" required="required" accept=".jpg,.jpeg,.png,.pdf">
                <small class="text-muted">Hanya file dengan format .jpg, .jpeg, .png, atau .pdf yang diperbolehkan.</small>
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>