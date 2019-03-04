<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Data Pembelian";  
  $daftar_pembelian = $db->query("SELECT a.*, b.nm_supplier FROM pembelian a JOIN supplier b ON a.kd_supplier = b.kd_supplier")->fetchAll(PDO::FETCH_ASSOC);
  
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
            
            <!-- AWAL DARI BAGIAN KONTEN --> 
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Daftar Pembelian</div>
                  </div>
                  <div class="card-body">
                    <a href="tambah.php" class="btn btn-primary">+ Data Baru</a>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Pembelian</th>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_pembelian as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['kd_pembelian']?></td>
                              <td><?=$d['tgl_pembelian']?></td>
                              <td><?=$d['nm_supplier']?></td>
                              <td><?=$d['total_hrg']?></td>
                              <td>
                                <div class="form-group">
                                  <a href="proses-hapus.php?kd_pembelian=<?=$d['kd_pembelian']?>" class="btn btn-danger">Hapus</a>
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
      noRowsTable('tabel');
    </script>
  </body>
</html>
