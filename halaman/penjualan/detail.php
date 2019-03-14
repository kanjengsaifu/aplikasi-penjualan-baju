<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Detail Penjualan";  
  $detail_penjualan = $db->query("SELECT a.*, b.nm_pelanggan FROM penjualan a JOIN pelanggan b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_GET['kd_penjualan']])->fetch();
  $barang_dibeli = $db->query("SELECT a.*, b.nm_barang FROM detail_penjualan a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_GET['kd_penjualan']])->fetchAll(PDO::FETCH_ASSOC);
  
?>

<html>
  <!-- Bagian head -->
  <?php include("../../template/head.php") ?>
  <body>
    <div class="wrapper">
      <!-- Bagian sidebar -->
      <?php include("../../template/header.php") ?>
      <!-- Bagian sidebar -->
      <?php include("../../template/sidebar.php") ?>
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="card" id="daftarData">
                  <div class="card-header">
                    <div class="card-title">Detail Penjualan
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Kode Penjualan
                      </label>
                      <p>
                        <?=$detail_penjualan['kd_penjualan']?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Penjualan
                      </label>
                      <p>
                        <?=tanggal_indo($detail_penjualan['tgl_penjualan'])?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Pelanggan
                      </label>
                      <p>
                        <?=$detail_penjualan['nm_pelanggan']?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Total Harga
                      </label>
                      <p>
                        <?=rupiah($detail_penjualan['total_hrg'], "Rp  ")?>
                      </p>
                    </div>
                    <div class="form-group">
                      <p>
                        <a href="index.php" class="btn btn-primary"><< Kembali</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Daftar Barang Yang Dibeli
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
                        <thead>
                          <tr>
                            <th>No
                            </th>
                            <th>Nama Barang
                            </th>
                            <th>Jumlah
                            </th>
                            <th>Total Harga (Rp)
                            </th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$no = 1;
foreach($barang_dibeli as $i=>$d):
?>
                          <tr>
                            <td>
                              <?=$no?>
                            </td>
                            <td>
                              <?=$d['nm_barang']?>
                            </td>
                            <td>
                              <?=$d['jml']?>
                            </td>
                            <td>
                              <?=rupiah($d['total_hrg'], "")?>
                            </td>
                          </tr>
                          <?php
$no++;
endforeach;
?>
                        </tbody>
                      </table>
                      <!-- Akhir dari Bagian tabel -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- AKHIR DARI BAGIAN KONTEN -->  
          </div>
        </div>
      </div>
    </div>
    <!-- semua asset js dibawah ini -->
    <?php include("../../template/script.php") ?>
    <!-- notifikasi halaman crud ada disini -->
    <?php include("../../template/notifikasi-crud.php") ?>
  </body>
</html>

