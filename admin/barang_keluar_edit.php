<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Edit Barang keluar
      <small>Data Barang keluar</small>
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
            <h3 class="box-title">Edit Barang keluar</h3>
            <a href="barang_keluar.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="barang_keluar_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "select * from barang_keluar where bk_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>
                
                <div class="form-group">
                  <label>Barang</label>
                  <input type="hidden" name="id" value="<?php echo $d['bk_id'] ?>">
                  <select class="form-control" name="barang" required="required">
                    <option value=""> - Pilih Barang - </option>
                    <?php 
                    $barang = mysqli_query($koneksi,"SELECT * from barang");
                    while($b=mysqli_fetch_array($barang)){
                      ?>
                      <option <?php if($d['bk_id_barang'] == $b['barang_id']){echo "selected='selected'";} ?> value="<?php echo $b['barang_id']; ?>"><?php echo $b['barang_nama']; ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal keluar</label>
                  <input type="text" class="form-control datepicker2" autocomplete="off" name="tanggal" required="required" placeholder="keluarkan Tanggal keluar .." value="<?php echo $d['bk_tgl_keluar'] ?>">
                </div>

                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" required="required" placeholder="keluarkan Jumlah .." value="<?php echo $d['bk_jumlah_keluar'] ?>">
                </div>

                <div class="form-group">
                  <label>Lokasi</label>
                  <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi .." value="<?php echo $d['bk_lokasi'] ?>">
                </div>

                <div class="form-group">
                  <label>Penerima</label>
                  <input type="text" class="form-control" name="penerima" placeholder="Masukkan Penerima .." value="<?php echo $d['bk_penerima'] ?>">
                </div>

                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan .." value="<?php echo $d['bk_keterangan'] ?>">
                </div>

                <div class="form-group">
                  <label>Upload Bukti (Opsional)</label>
                  <?php if (!is_null($d['bk_bukti']) && $d['bk_bukti'] != '') { ?>
                    <div>
                      <img src="../gambar/barang_keluar/<?php echo $d['bk_bukti']; ?>" alt="Bukti Barang Keluar" style="max-width: 100px; max-height: 100px;">
                    </div>
                  <?php } ?>
                  <input type="file" class="form-control" name="bk_bukti">
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