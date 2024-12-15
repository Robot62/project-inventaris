<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Edit Barang Masuk
      <small>Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Barang Masuk</h3>
            <a href="barang_masuk.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
          </div>
          <div class="box-body">
            <form action="barang_masuk_update.php" method="post" enctype="multipart/form-data">
              <?php
              $id = $_GET['id'];
              $data = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE bm_id='$id'");
              while ($d = mysqli_fetch_array($data)) {
              ?>

                <div class="form-group">
                  <label>Barang</label>
                  <input type="hidden" name="id" value="<?php echo $d['bm_id'] ?>">
                  <select class="form-control" name="barang" required="required">
                    <option value=""> - Pilih Barang - </option>
                    <?php
                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                    while ($b = mysqli_fetch_array($barang)) {
                    ?>
                      <option <?php if ($d['bm_id_barang'] == $b['barang_id']) {
                                echo "selected='selected'";
                              } ?> value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <input type="text" class="form-control datepicker2" autocomplete="off" name="tanggal" required="required" placeholder="Masukkan Tanggal Masuk .." value="<?php echo $d['bm_tgl_masuk'] ?>">
                </div>

                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah .." value="<?php echo $d['bm_jumlah'] ?>">
                </div>

                <div class="form-group">
                  <label>Suplier</label>
                  <select class="form-control" name="suplier" required="required">
                    <option value=""> - Pilih Suplier - </option>
                    <?php
                    $suplier = mysqli_query($koneksi, "SELECT * FROM suplier");
                    while ($s = mysqli_fetch_array($suplier)) {
                    ?>
                      <option <?php if ($d['bm_id_suplier'] == $s['suplier_id']) {
                                echo "selected='selected'";
                              } ?> value="<?php echo $s['suplier_id']; ?>"><?php echo $s['suplier_nama']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Upload Bukti (Opsional)</label>
                  <?php if (!is_null($d['bm_bukti']) && $d['bm_bukti'] != '') { ?>
                    <div>
                      <img src="../gambar/barang_masuk/<?php echo $d['bm_bukti']; ?>" alt="Bukti Barang Masuk" style="max-width: 100px; max-height: 100px;">
                    </div>
                  <?php } ?>
                  <input type="file" class="form-control" name="bm_bukti">
                  <small class="text-muted">Jika tidak mengganti gambar, biarkan kosong.</small>
                </div>

                <div class="form-group">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
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