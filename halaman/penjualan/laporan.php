<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  $judul = "Laporan Penjualan Barang";  
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
  }
  
  $daftar_penjualan = $db->query("SELECT a.*, b.nm_pelanggan FROM penjualan a JOIN pelanggan b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.tgl_penjualan = DATE(:waktu)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);  
?>

<html>
  
  <!-- Bagian head -->
  <?php include("../../template/head.php") ?>
  
  <body>
    <script src="<?=$alamat_web?>/assets/js/moment.js"></script>
    <script src="<?=$alamat_web?>/assets/js/moment-id.js"></script>
    <script src="<?=$alamat_web?>/assets/js/pikaday.js"></script>
    <div class="wrapper">
      
      <!-- Bagian sidebar -->
      <?php include("../../template/header.php") ?>
      
      <!-- Bagian sidebar -->
      <?php include("../../template/sidebar.php") ?>
      
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            
            <!-- AWAL DARI BAGIAN KONTEN --> 
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12" style="padding-top: 15px;">
                          <span style="font-weight: bold; font-size: 15pt;">Laporan Penjualan Barang <br/> <?=tanggal_indo($waktu)?></span>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input class="form-control" type="text" id="waktu" name="waktu" placeholder="Pilih Hari" readonly />
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info" onclick="tampilkanLaporan()">Tampilkan</button>
                                <button type="button" class="btn btn-sm btn-success" onclick="cetakLaporan()">Cetak</button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Penjualan</th>
                            <th>Tanggal Penjualan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Harga (Rp)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            $total = 0;
                            foreach($daftar_penjualan as $i=>$d):
                              $total += $d['total_hrg'];
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['kd_penjualan']?></td>
                              <td><?=tanggal_indo($d['tgl_penjualan'])?></td>
                              <td><?=$d['nm_pelanggan']?></td>
                              <td><?=rupiah($d['total_hrg'], "")?></td>
                            </tr>
                          <?php
                            $no++;
                            endforeach;
                          ?>
                          <tr>
                            <td class="text-right" colspan="4"><b>Total</b></td>
                            <td><?=rupiah($total, "")?></td>
                          </tr>
                        </tbody>
											</table>
                      <!-- Akhir dari Bagian tabel -->
                      
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
      <?php
        if(isset($_GET['waktu']))
        {
          echo "document.getElementsByName('waktu')[0].value = '".$_GET['waktu']."';";
        }
      ?>
      
      
      var waktu = new Pikaday({
        field: document.getElementsByName('waktu')[0],
        format: 'YYYY-MM-DD',
      });
      
      function tampilkanLaporan()
      {
        window.location.href = "laporan.php?waktu=" + document.getElementsByName("waktu")[0].value;
      }
      function cetakLaporan()
      {
        window.open("cetak-laporan-harian.php?waktu=" + document.getElementsByName("waktu")[0].value);
      }
      
      noRowsTable('tabel');
    </script>
  </body>
</html>
