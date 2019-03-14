<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Data Barang";  
  $daftar_barang = $db->query("SELECT a.*, b.nm_kategori FROM barang a JOIN kategori b ON a.kd_kategori = b.kd_kategori")->fetchAll(PDO::FETCH_ASSOC);
  
  $daftar_kategori = $db->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);
  
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
                
                <!-- Bagian form tambah data -->
                <form method="POST" id="tambahData" action="proses-tambah.php" style="display: none;">
                  <input type="hidden" value="" name="kd_barang" />
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title" id="judulForm">Data Barang Baru</div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nm_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nm_barang">
                      </div>
                      <div class="form-group">
                        <label for="hrg_jual">Harga Beli (Rp)</label>
                        <input type="number" class="form-control" name="hrg_beli">
                      </div>
                      <div class="form-group">
                        <label for="hrg_beli">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" name="hrg_jual">
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok">
                      </div>
                      <div class="form-group">
                        <label for="kd_kategori">Kategori</label>
                        <select name="kd_kategori" class="form-control">
                          <?php foreach($daftar_kategori as $d): ?>
                            <option value="<?=$d['kd_kategori']?>"><?=$d['nm_kategori']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="card-action">
                      <button type="submit" class="btn btn-success">Simpan</button>
                      <button type="reset" class="btn btn-danger">Reset</button>
                      <button type="button" class="btn btn-primary" onclick="showPage()">Kembali</button>
                    </div>
                  </div>
                </form>
                <!-- Akhir dari Bagian form tambah data -->
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Daftar Barang</div>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick="showPage()">+ Data Baru</button>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Harga Jual (Rp)</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_barang as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['nm_barang']?></td>
                              <td><?=rupiah($d['hrg_beli'], "")?></td>
                              <td><?=rupiah($d['hrg_jual'], "")?></td>
                              <td><?=$d['stok']?></td>
                              <td><?=$d['nm_kategori']?></td>
                              <td>
                                <div class="form-group">
                                  <button type="button" class="btn btn-primary" onclick="editPage(<?=$i?>)">Edit</button>
                                  <a href="proses-hapus.php?kd_barang=<?=$d['kd_barang']?>" class="btn btn-danger">Hapus</a>
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
      
      // detail setiap data ada disini
      var data_detail = <?=json_encode($daftar_barang)?>;
      
      // memmunculkan form tambah data dan daftar data dengan javascript.
      function showPage()
      {
        var tambahData = document.getElementById('tambahData');
        var daftarData = document.getElementById('daftarData');
        if(tambahData.style.display == 'block')
        {
          tambahData.style.display = 'none';
          daftarData.style.display = 'block';
          
          // Mereset form menjadi form tambah data
          document.getElementById("judulForm").innerHTML = "Data Barang Baru";
          document.getElementById('tambahData').action = "proses-tambah.php"; 
          document.getElementsByName('nm_barang')[0].value = ""; 
          document.getElementsByName('hrg_beli')[0].value = ""; 
          document.getElementsByName('hrg_jual')[0].value = ""; 
          document.getElementsByName('stok')[0].value = ""; 
          document.getElementsByName('kd_kategori')[0].value = ""; 
        }
        else
        {
          tambahData.style.display = 'block';
          daftarData.style.display = 'none';
        }
      }
      function editPage(id)
      {
        showPage();
        if(document.getElementById('tambahData').action = "proses-tambah.php")
        {
          
          // Mengubah form tambah jadi edit
          document.getElementById("judulForm").innerHTML = "Edit Data Barang";
          document.getElementById('tambahData').action = "proses-edit.php";
          
          // Memasukkan nilai yang ingin diedit kedalam form
          document.getElementsByName('nm_barang')[0].value = data_detail[id].nm_barang; 
          document.getElementsByName('hrg_beli')[0].value = data_detail[id].hrg_beli; 
          document.getElementsByName('hrg_jual')[0].value = data_detail[id].hrg_jual; 
          document.getElementsByName('stok')[0].value = data_detail[id].stok; 
          document.getElementsByName('kd_kategori')[0].value = data_detail[id].kd_kategori; 
          document.getElementsByName('kd_barang')[0].value = data_detail[id].kd_barang; 
        }
      }
      noRowsTable('tabel');
    </script>
  </body>
</html>
