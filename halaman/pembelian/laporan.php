<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  $judul = "Laporan Pembelian Barang";  
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    $waktu = $_GET['waktu'];
  }
  
  $daftar_pembelian = $db->query("SELECT a.*, b.nm_supplier FROM pembelian a JOIN supplier b ON a.kd_supplier = b.kd_supplier WHERE a.tgl_pembelian = DATE(:waktu)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);
  
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
                    <div class="table-responsive">
                      <div class="row">
                        <div class="col-md-6 col-xs-12" style="padding-top: 15px;">
                          <span style="font-weight: bold; font-size: 15pt;">Laporan Pembelian Barang <br> <?=tanggal_indo($waktu)?></span>
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
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Pembelian</th>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Supplier</th>
                            <th>Total Harga (Rp)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            $total = 0;
                            foreach($daftar_pembelian as $i=>$d):
                              $total += $d['total_hrg'];
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['kd_pembelian']?></td>
                              <td><?=tanggal_indo($d['tgl_pembelian'])?></td>
                              <td><?=$d['nm_supplier']?></td>
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
