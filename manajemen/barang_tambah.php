<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang
      <small>Tambah Barang Baru</small>
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
            <h3 class="box-title">Tambah Barang Baru</h3>
            <a href="barang.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
          </div>
          <div class="box-body">
            <form action="barang_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group">
                <label>Spesifikasi</label>
                <input type="text" class="form-control" name="spesifikasi" required="required" placeholder="Masukkan spesifikasi ..">
              </div>
              <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required="required" placeholder="Masukkan lokasi ..">
              </div>

              <div class="form-group">
                <label>Kondisi</label>
                <input type="text" class="form-control" name="kondisi" required="required" placeholder="Masukkan kondisi ..">
              </div>

              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan jumlah ..">
              </div>

              <div class="form-group">
                <label>Sumber Dana</label>
                <input type="text" class="form-control" name="sumber_dana" required="required" placeholder="Masukkan sumber_dana ..">
              </div>

              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan keterangan ..">
              </div>

              <div class="form-group">
                <label>Jenis Barang</label>
                <select class="form-control" name="jenis" required="required">
                  <option value=""> - Pilih Jenis Barang - </option>
                  <option value="Sarana">Sarana</option>
                  <option value="Prasarana">Prasarana</option>
                </select>
              </div>

              <div class="form-group">
                <label>Gambar Barang</label>
                <input type="file" class="form-control" name="gambar" accept="image/*">
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