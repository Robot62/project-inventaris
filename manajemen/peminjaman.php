<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Peminjaman
      <small>Data Peminjaman</small>
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
            <h3 class="box-title">Peminjaman</h3>

            <div class="btn-group pull-right">
              <a href="peminjaman_tambah.php" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp Peminjaman Baru</a>
              <a href="peminjaman_pdf.php" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <a href="peminjaman_print.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
            </div>

          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>BARANG</th>
                    <th>GAMBAR</th>
                    <th>BUKTI PINJAM</th>
                    <th>BUKTI PENGEMBALIAN</th>
                    <th>JUMLAH</th>
                    <th>KONDISI</th>
                    <th>TGL. PINJAM</th>
                    <th>TGL. KEMBALI</th>
                    <th>STATUS</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;

                  // Query dengan join tabel pinjam dan barang
                  $data = mysqli_query($koneksi, "
      SELECT p.*, b.barang_nama, b.gambar 
      FROM pinjam p
      LEFT JOIN barang b ON p.pinjam_barang = b.barang_id
    ");

                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['pinjam_peminjam']; ?></td>
                      <td><?php echo $d['barang_nama']; ?></td>
                      <td>
                        <?php if (!empty($d['gambar'])): ?>
                          <img src="../gambar/barang/<?php echo $d['gambar']; ?>" width="100" alt="Gambar Barang">
                        <?php else: ?>
                          No Image
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!empty($d['bukti'])): ?>
                          <a href="../gambar/pinjam/<?php echo $d['bukti']; ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                          No Bukti
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!empty($d['bukti_pengembalian'])): ?>
                          <a href="../gambar/pinjam/<?php echo $d['bukti_pengembalian']; ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                          No Bukti
                        <?php endif; ?>
                      </td>
                      <td><?php echo $d['pinjam_jumlah']; ?></td>
                      <td><?php echo $d['pinjam_kondisi']; ?></td>
                      <td><?php echo $d['pinjam_tgl_pinjam']; ?></td>
                      <td><?php echo $d['pinjam_tgl_kembali']; ?></td>
                      <td>
                        <?php
                        if ($d['pinjam_status'] == "Dikembalikan") {
                          echo "<span class='label label-success'>Di Kembalikan</span>";
                        } elseif ($d['pinjam_status'] == "Dipinjam") {
                          echo "<span class='label label-danger'>Di Pinjam</span>";
                        }
                        ?>
                      </td>
                      <td>
                        <a class="btn btn-warning btn-sm" href="peminjaman_edit.php?id=<?php echo $d['pinjam_id'] ?>"><i class="fa fa-cog"></i></a>
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