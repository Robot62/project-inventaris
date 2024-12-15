<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang Keluar
      <small>Data Barang Keluar</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">

        <?php
        if (isset($_GET['alert'])) {
          if ($_GET['alert'] == "lebih") {
            echo "<div class='alert alert-danger'><b>GAGAL!</b> Jumlah barang keluar terlalu besar atau melebihi stok barang yang ada.</div>";
          }
        }
        ?>


        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Barang Keluar</h3>

            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal_suplier">
              <i class="fa fa-plus"></i> &nbsp Barang Keluar Baru
            </button>

            <!-- The Modal -->
            <div class="modal" id="modal_suplier">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Barang Keluar Baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form action="barang_keluar_act.php" method="post" enctype="multipart/form-data">

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
                        <label>Tanggal Keluar</label>
                        <input type="text" class="form-control datepicker2" autocomplete="off" name="tanggal" required="required" placeholder="Masukkan Tanggal keluar ..">
                      </div>

                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah ..">
                      </div>

                      <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi ..">
                      </div>

                      <div class="form-group">
                        <label>Penerima</label>
                        <input type="text" class="form-control" name="penerima" placeholder="Masukkan Penerima ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan ..">
                      </div>

                      <div class="form-group">
                        <label>Bukti Barang Keluar</label>
                        <input type="file" class="form-control" name="bk_bukti">
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
                    <th>TANGGAL KELUAR</th>
                    <th>JUMLAH</th>
                    <th>LOKASI</th>
                    <th>PENERIMA</th>
                    <th>KETERANGAN</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;

                  // Query dengan join tabel barang_keluar dan barang
                  $data = mysqli_query($koneksi, "
      SELECT bk.*, b.barang_nama, b.gambar 
      FROM barang_keluar bk
      LEFT JOIN barang b ON bk.bk_id_barang = b.barang_id
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
                        <?php if (!empty($d['bk_bukti'])): ?>
                          <a href="../gambar/barang_keluar/<?php echo $d['bk_bukti']; ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                          No Bukti
                        <?php endif; ?>
                      </td>
                      <td><?php echo $d['bk_tgl_keluar']; ?></td>
                      <td><?php echo $d['bk_jumlah_keluar']; ?></td>
                      <td><?php echo $d['bk_lokasi']; ?></td>
                      <td><?php echo $d['bk_penerima']; ?></td>
                      <td><?php echo $d['bk_keterangan']; ?></td>
                      <td>
                        <a class="btn btn-warning btn-sm" href="barang_keluar_edit.php?id=<?php echo $d['bk_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" href="barang_keluar_hapus.php?id=<?php echo $d['bk_id'] ?>">
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