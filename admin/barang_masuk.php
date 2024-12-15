<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang Masuk
      <small>Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Barang Masuk</h3>

            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal_suplier">
              <i class="fa fa-plus"></i> &nbsp Barang Masuk Baru
            </button>

            <!-- The Modal -->
            <div class="modal" id="modal_suplier">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Barang Masuk Baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form action="barang_masuk_act.php" method="post" enctype="multipart/form-data">

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
                        <label>Tanggal Masuk</label>
                        <input type="text" class="form-control datepicker2" autocomplete="off" name="tanggal" required="required" placeholder="Masukkan Tanggal Masuk ..">
                      </div>

                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah ..">
                      </div>

                      <div class="form-group">
                        <label>Suplier</label>
                        <select class="form-control" name="suplier" required="required">
                          <option value=""> - Pilih Suplier - </option>
                          <?php
                          $suplier = mysqli_query($koneksi, "SELECT * from suplier");
                          while ($s = mysqli_fetch_array($suplier)) {
                          ?>
                            <option value="<?php echo $s['suplier_id']; ?>"><?php echo $s['suplier_nama']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <!-- Input untuk Gambar -->
                      <div class="form-group">
                        <label>Bukti Barang Masuk</label>
                        <input type="file" class="form-control" name="bm_bukti" required="required" accept="image/*">
                      </div>

                      <div class="form-group">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>


          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA BARANG</th>
                    <th>GAMBAR</th>
                    <th>BUKTI</th>
                    <th>TANGGAL MASUK</th>
                    <th>JUMLAH</th>
                    <th>NAMA SUPPLIER</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;

                  // Query dengan join tabel barang_masuk dan barang
                  $data = mysqli_query($koneksi, "
      SELECT bm.*, b.barang_nama, b.gambar 
      FROM barang_masuk bm
      LEFT JOIN barang b ON bm.bm_id_barang = b.barang_id
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
                      <td>
                        <?php if (!empty($d['bm_bukti'])): ?>
                          <a href="../gambar/barang_masuk/<?php echo $d['bm_bukti']; ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                          No Bukti
                        <?php endif; ?>
                      </td>
                      <td><?php echo $d['bm_tgl_masuk']; ?></td>
                      <td><?php echo $d['bm_jumlah']; ?></td>
                      <td><?php echo $d['bm_nama_suplier']; ?></td>
                      <td>
                        <a class="btn btn-warning btn-sm" href="barang_masuk_edit.php?id=<?php echo $d['bm_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" href="barang_masuk_hapus.php?id=<?php echo $d['bm_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>


            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>