<?php
  session_start();
  if(empty($_SESSION['kd_penjualan']))
  {
    header("Location: tambah.php");
  }
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Detail Pembelian";  
  $daftar_penjualan = $db->query("SELECT a.*, b.nm_barang FROM detail_penjualan_tmp a JOIN barang b ON a.kd_barang = b.kd_barang WHERE kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_SESSION['kd_penjualan']])->fetchAll(PDO::FETCH_ASSOC);
  $daftar_barang = $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
  $detail_penjualan = $db->query("SELECT SUM(total_hrg) as total_hrg FROM detail_penjualan_tmp WHERE kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_SESSION['kd_penjualan']])->fetch();
  
  $_SESSION['total_hrg'] = $detail_penjualan['total_hrg'];
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
              <div class="col-md-8">
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Tambah Pembelian Barang
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="proses-tambah-barang.php">
                      <div class="form-group">
                        <label>Pilih Barang</label>
                        <select name="kd_barang" class="form-control">
                          <!-- Daftar barang dibuat menggunakan javascript -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jml" class="form-control" min=1 />
                      </div>
                      <div class="form-group">
                        <label>Total Harga</label>
                        <input type="number" name="total_hrg" class="form-control" />
                      </div>
                      <div class="form-group">
                        <div style="float: left;">
                          <button type="submit" class="btn btn-primary">Tambahkan Barang</button>
                        </div>
                        <div style="float: right;">
                          <a href="proses-simpan-pembelian.php" class="btn btn-success">Simpan Pembelian</a>
                        </div>
                        <div style="clear: both;"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Detail Pembelian
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Kode Pembelian
                      </label>
                      <p>
                        <?=$_SESSION['kd_penjualan']?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Pembelian
                      </label>
                      <p>
                        <?=tanggal_indo($_SESSION['tgl_penjualan'])?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Pelanggan
                      </label>
                      <p>
                        <?=$_SESSION['nm_pelanggan']?>
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
                      <a href="reset-pembelian.php" class="btn btn-danger">Reset Pembelian
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
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
                            <th>Aksi
                            </th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$no = 1;
foreach($daftar_penjualan as $i=>$d):
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
                            <td>
                              <div class="form-group">
                                <a href="proses-hapus-pembelian.php?kd_tmp=<?=$d['kd_tmp']?>" class="btn btn-danger">Hapus
                                </a>
                              </div>
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
    <script>
      var daftar_barang = <?=json_encode($daftar_barang)?>;
      var list_barang = "<option value='0' selected disabled>-- Pilih Barang --</option>";
      // Proses pembuatan daftar barang
      for(var x = 0; x < daftar_barang.length; x++){
        list_barang += "<option value='" + daftar_barang[x].kd_barang + "'>" + daftar_barang[x].nm_barang + "</option>";
      }
      document.getElementsByName("kd_barang")[0].innerHTML = list_barang;
      
      function hitungHargaBarang(){
        var jml = document.getElementsByName("jml")[0].value;
        if(jml <= 0){
          document.getElementsByName("jml")[0].value = "1";
        }
        if(jml != "" && document.getElementsByName("kd_barang")[0].selectedIndex > 0){
          document.getElementsByName("total_hrg")[0].value = daftar_barang[document.getElementsByName("kd_barang")[0].selectedIndex - 1].hrg_jual * jml;
        }
      }
      
      // Event untuk harga barang berganti saat pilih barang
      document.getElementsByName("kd_barang")[0].addEventListener("change", hitungHargaBarang);
      document.getElementsByName("jml")[0].addEventListener("keyup", hitungHargaBarang);
      
      noRowsTable('tabel');
    </script>
  </body>
</html>

