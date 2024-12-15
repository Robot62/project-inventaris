<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Peminjaman
      <small>Edit Peminjaman</small>
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
            <h3 class="box-title">Edit Peminjaman</h3>
            <a href="peminjaman.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
          </div>
          <div class="box-body">
            <form action="peminjaman_update.php" method="post" enctype="multipart/form-data">
              <?php
              $id = $_GET['id'];
              $data = mysqli_query($koneksi, "SELECT * FROM pinjam WHERE pinjam_id='$id'");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <div class="form-group">
                  <label>Nama Peminjam</label>
                  <input type="hidden" name="id" value="<?php echo $d['pinjam_id']; ?>">
                  <input autocomplete="off" type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama .." value="<?php echo $d['pinjam_peminjam']; ?>">
                </div>
                <div class="form-group">
                  <label>Barang</label>
                  <select class="form-control" name="barang" required="required">
                    <option value=""> - Pilih Barang - </option>
                    <?php
                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                    while ($b = mysqli_fetch_array($barang)) {
                    ?>
                      <option <?php if ($b['barang_id'] == $d['pinjam_barang']) {
                                echo "selected='selected'";
                              } ?> value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input autocomplete="off" type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan jumlah .." value="<?php echo $d['pinjam_jumlah']; ?>">
                </div>

                <div class="form-group">
                  <label>Tgl. Pinjam</label>
                  <input autocomplete="off" type="text" class="form-control datepicker2" name="tgl_pinjam" required="required" placeholder="Masukkan tgl pinjam .." value="<?php echo $d['pinjam_tgl_pinjam']; ?>">
                </div>

                <div class="form-group">
                  <label>Tgl. Kembali</label>
                  <input autocomplete="off" type="text" class="form-control datepicker2" name="tgl_kembali" required="required" placeholder="Masukkan tgl kembali .." value="<?php echo $d['pinjam_tgl_kembali']; ?>">
                </div>

                <div class="form-group">
                  <label>Kondisi</label>
                  <input autocomplete="off" type="text" class="form-control" name="kondisi" placeholder="Masukkan Kondisi .." value="<?php echo $d['pinjam_kondisi']; ?>">
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" required="required">
                    <option <?php if ($d['pinjam_status'] == "Dipinjam") {
                              echo "selected='selected'";
                            } ?> value="Dipinjam">Dipinjam</option>
                    <option <?php if ($d['pinjam_status'] == "Dikembalikan") {
                              echo "selected='selected'";
                            } ?> value="Dikembalikan">Dikembalikan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Bukti (Attachment)</label>
                  <?php if ($d['bukti'] != null): ?>
                    <p>
                      <a href="../gambar/pinjam/<?php echo $d['bukti']; ?>" target="_blank">Lihat Bukti</a>
                    </p>
                  <?php endif; ?>
                  <input type="file" name="bukti" class="form-control">
                  <small class="text-muted">Kosongkan jika tidak ingin mengganti file. Hanya file dengan format .jpg, .jpeg, .png, atau .pdf yang diperbolehkan untuk diunggah.</small>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>

              <?php
              }
              ?>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>