<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang
      <small>Edit Barang</small>
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
            <h3 class="box-title">Edit Barang</h3>
            <a href="barang.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a> 
          </div>

          <div class="box-body">
            <form action="barang_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$id'");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="hidden" name="id" value="<?php echo $d['barang_id']; ?>">
                  <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama .." value="<?php echo $d['barang_nama']; ?>">
                </div>

                <div class="form-group">
                  <label>Spesifikasi</label>
                  <input type="text" class="form-control" name="spesifikasi" required placeholder="Masukkan spesifikasi .." value="<?php echo $d['barang_spesifikasi']; ?>">
                </div>

                <div class="form-group">
                  <label>Lokasi</label>
                  <input type="text" class="form-control" name="lokasi" required placeholder="Masukkan lokasi .." value="<?php echo $d['barang_lokasi']; ?>">
                </div>

                <div class="form-group">
                  <label>Kondisi</label>
                  <input type="text" class="form-control" name="kondisi" required placeholder="Masukkan kondisi .." value="<?php echo $d['barang_kondisi']; ?>">
                </div>

                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" required placeholder="Masukkan jumlah .." value="<?php echo $d['barang_jumlah']; ?>">
                </div>

                <div class="form-group">
                  <label>Sumber Dana</label>
                  <input type="text" class="form-control" name="sumber_dana" required placeholder="Masukkan sumber dana .." value="<?php echo $d['barang_sumber_dana']; ?>">
                </div>

                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" required placeholder="Masukkan keterangan .." value="<?php echo $d['barang_keterangan']; ?>">
                </div>

                <div class="form-group">
                  <label>Jenis Barang</label>
                  <select class="form-control" name="jenis" required>
                    <option value=""> - Pilih Jenis Barang - </option>
                    <option <?php if ($d['barang_jenis'] == "Sarana") echo "selected"; ?> value="Sarana">Sarana</option>
                    <option <?php if ($d['barang_jenis'] == "Prasarana") echo "selected"; ?> value="Prasarana">Prasarana</option>
                  </select>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                  <label>Gambar</label><br>
                  <?php if (!empty($d['gambar'])): ?>
                    <p>Gambar saat ini:</p>
                    <img src="../gambar/barang/<?php echo $d['gambar']; ?>" width="100" alt="Current Image"><br><br>
                  <?php endif; ?>
                  <input type="file" class="form-control" name="gambar">
                  <small>Biarkan kosong jika tidak ingin mengganti gambar.</small>
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
