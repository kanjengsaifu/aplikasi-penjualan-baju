<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  $judul = "Laporan Pembelian Barang";  
  $ket_waktu = "";
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
  }
  
  $ket_waktu_tmp = explode("-", $waktu);
  $ket_waktu = $ket_waktu_tmp[0];
  
  $daftar_pembelian = $db->query("SELECT MONTH(a.tgl_pembelian) AS bln, SUM(b.jml) AS jml, SUM(b.total_hrg) AS total_hrg FROM pembelian a JOIN detail_pembelian b ON a.kd_pembelian = b.kd_pembelian WHERE YEAR(a.tgl_pembelian) = YEAR(:waktu) GROUP BY MONTH(a.tgl_pembelian)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);  
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
                          <span style="font-weight: bold; font-size: 15pt;">Laporan Pembelian Barang <br/> Tahun <?=$ket_waktu?></span>
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
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Total Harga (Rp)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            $jml = 0;
                            $total_hrg = 0;
                            foreach($daftar_pembelian as $i=>$d):
                              $jml += $d['jml'];
                              $total_hrg += $d['total_hrg'];
                          ?>
                              <tr>
                                <td><?=$no?></td>
                                <td><?=namaBulan($d['bln'])?></td>
                                <td><?=$d['jml']?></td>
                                <td><?=rupiah($d['total_hrg'], "")?></td>
                              </tr>
                          <?php
                            $no++;
                            endforeach;
                          ?>
                          <tr>
                            <td class="text-right" colspan="2"><b>Total</b></td>
                            <td><?=$jml?></td>
                            <td><?=rupiah($total_hrg, "")?></td>
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
        window.location.href = "laporan-tahunan.php?waktu=" + document.getElementsByName("waktu")[0].value;
      }
      function cetakLaporan()
      {
        window.open("cetak-laporan-tahunan.php?waktu=" + document.getElementsByName("waktu")[0].value);
      }
      
      noRowsTable('tabel');
    </script>
  </body>
</html>
