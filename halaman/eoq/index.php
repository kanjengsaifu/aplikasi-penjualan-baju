<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  $judul = "Data ROP & EOQ";  
  $daftar_eoq = $db->query("SELECT a.*, b.nm_barang FROM eoq a JOIN barang b ON a.kd_barang = b.kd_barang")->fetchAll(PDO::FETCH_ASSOC);
  $data_barang = $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
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
                  <input type="hidden" value="" name="kd_eoq" />
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title" id="judulForm">Data ROP & EOQ baru</div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-xs-12">
                          <div class="form-group">
                            <label for="nm_supplier">Tanggal Hitung</label>
                            <input type="text" class="form-control" name="tgl_hitung">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Nama barang</label>
                            <select name="kd_barang" class="form-control">
                              <option selected disabled>-- Pilih Barang --</option>
                              <?php foreach($data_barang as $d): ?>
                                <option value="<?=$d['kd_barang']?>"><?=$d['nm_barang']?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Tahun Penjualan (Tahun)</label>
                            <input type="text" class="form-control" name="tahun_penjualan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Jumlah Penjualan (Pcs)</label>
                            <input type="text" class="form-control" name="jumlah_penjualan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Pesan (RP)</label>
                            <input type="text" class="form-control" name="biaya_pesan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Penyimpanan (Rp)</label>
                            <input type="text" class="form-control" name="biaya_simpan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Lead Time (Hari)</label>
                            <input type="text" class="form-control" name="lead_time">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Hasil Perhitungan EOQ</label>
                            <input type="text" class="form-control" name="eoq">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Hasil Perhitungan ROP</label>
                            <input type="text" class="form-control" name="rop">
                          </div>
                        </div>
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
                    <div class="card-title">Daftar ROP & EOQ</div>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick="showPage()">+ Data Baru</button>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Hitung</th>
                            <th>Nama Barang</th>
                            <th>Tahun Penjualan</th>
                            <th>Jumlah Penjualan</th>
                            <th>Biaya Pemesanan (Rp)</th>
                            <th>Biaya Penyimpanan (Rp)</th>
                            <th>Lead Time (Hari)</th>
                            <th>ROP</th>
                            <th>EOQ</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_eoq as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=tanggal_indo($d['tgl_hitung'])?></td>
                              <td><?=$d['nm_barang']?></td>
                              <td><?=$d['tahun_penjualan']?></td>
                              <td><?=$d['jumlah_penjualan']?></td>
                              <td><?=rupiah($d['biaya_pesan'], "")?></td>
                              <td><?=rupiah($d['biaya_simpan'], "")?></td>
                              <td><?=$d['lead_time']?></td>
                              <td><?=$d['rop']?></td>
                              <td><?=$d['eoq']?></td>
                              <td>
                                <div class="form-group">
                                  <button type="button" class="btn btn-primary" onclick="editPage(<?=$i?>)">Edit</button>
                                  <a href="proses-hapus.php?kd_eoq=<?=$d['kd_eoq']?>" class="btn btn-danger">Hapus</a>
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
      var data_detail = <?=json_encode($daftar_eoq)?>;
      
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
          document.getElementById("judulForm").innerHTML = "Data ROP & EOQ Baru";
          document.getElementById('tambahData').action = "proses-tambah.php"; 
          document.getElementsByName('tgl_hitung')[0].value = ""; 
          document.getElementsByName('kd_barang')[0].value = ""; 
          document.getElementsByName('tahun_penjualan')[0].value = ""; 
          document.getElementsByName('jumlah_penjualan')[0].value = ""; 
          document.getElementsByName('biaya_pesan')[0].value = ""; 
          document.getElementsByName('biaya_simpan')[0].value = ""; 
          document.getElementsByName('lead_time')[0].value = ""; 
          document.getElementsByName('eoq')[0].value = ""; 
          document.getElementsByName('rop')[0].value = ""; 
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
          document.getElementById("judulForm").innerHTML = "Edit Data ROP & EOQ";
          document.getElementById('tambahData').action = "proses-edit.php";
          
          // Memasukkan nilai yang ingin diedit kedalam form
          document.getElementsByName('tgl_hitung')[0].value = data_detail[id].tgl_hitung; 
          document.getElementsByName('kd_barang')[0].value = data_detail[id].kd_barang; 
          document.getElementsByName('tahun_penjualan')[0].value = data_detail[id].tahun_penjualan; 
          document.getElementsByName('jumlah_penjualan')[0].value = data_detail[id].jumlah_penjualan; 
          document.getElementsByName('biaya_pesan')[0].value = data_detail[id].biaya_pesan; 
          document.getElementsByName('biaya_simpan')[0].value = data_detail[id].biaya_simpan; 
          document.getElementsByName('lead_time')[0].value = data_detail[id].lead_time; 
          document.getElementsByName('eoq')[0].value = data_detail[id].eoq; 
          document.getElementsByName('rop')[0].value = data_detail[id].rop; 
          document.getElementsByName('kd_eoq')[0].value = data_detail[id].kd_eoq; 
        }
      }
      function hitungEoqDanRop()
      {
        console.log("jalan")
        var R = document.getElementsByName('jumlah_penjualan')[0].value;
        var S = document.getElementsByName('biaya_pesan')[0].value;
        var C = document.getElementsByName('biaya_simpan')[0].value;
        var LT = document.getElementsByName('lead_time')[0].value;
        var EOQ = 0; 
        var ROP = 0; 
        if(R != "" && S != "" && C != "" && LT != "")
        {
          EOQ = Math.sqrt((2 * R * S) / C);
          ROP = (R / 365) * LT;
          document.getElementsByName("eoq")[0].value = Math.round(EOQ);
          document.getElementsByName("rop")[0].value = Math.round(ROP);
        }
      }
      
      // Menghitung eoq dan rop saat terjadi perubahan nilai di jumlah penjualan, biaya pesan, biaya simpan dan lead time
      document.getElementsByName('jumlah_penjualan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('biaya_pesan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('biaya_simpan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('lead_time')[0].addEventListener("keyup", hitungEoqDanRop);
      
      noRowsTable('tabel');
    </script>
  </body>
</html>
