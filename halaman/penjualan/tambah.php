<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $_SESSION['kd_penjualan'] = $_POST['kd_penjualan'];  
    $_SESSION['tgl_penjualan'] = $_POST['tgl_penjualan'];
    
    if(is_numeric($_POST['kd_pelanggan']))
    {
      $_SESSION['kd_pelanggan'] = $_POST['kd_pelanggan'];  
      $pelanggan_tmp = $db->query("SELECT nm_pelanggan FROM pelanggan WHERE kd_pelanggan = :kd_pelanggan", ['kd_pelanggan' => $_POST['kd_pelanggan']])->fetch();
      $_SESSION['nm_pelanggan'] = $pelanggan_tmp['nm_pelanggan'];
    }
    else
    {
      // tambahkan pelanggan baru
      $pelanggan_baru = $db->insert("pelanggan", ["nm_pelanggan" => $_POST['kd_pelanggan']]);
      $_SESSION['kd_pelanggan'] = $db->id();
      $_SESSION['nm_pelanggan'] = $_POST['kd_pelanggan'];
    }
  }
  
  if(isset($_SESSION['kd_penjualan']))
  {
    if($_SESSION['kd_penjualan'] != '')
    {
      {
        header("Location: tambah-detail.php");
      }   
    }
  }
  $judul = "Data Pembelian Baru";  
  
  $daftar_pelanggan = $db->query("SELECT * FROM pelanggan")->fetchAll(PDO::FETCH_ASSOC);
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
                    <div class="card-title">Data Pembelian Baru</div>
                  </div>
                  <div class="card-body">
                    <form method="POST" id="tambahData" action="">
                      <div class="form-group">
                        <label for="kd_penjualan">Kode Pembelian</label>
                        <input type="text" class="form-control" name="kd_penjualan" max="50" min="1" required />
                      </div>
                      <div class="form-group">
                        <label for="tgl_pelanggan">Tanggal Pembelian</label>
                        <input type="text" class="form-control" name="tgl_penjualan" required />
                      </div>
                      <div class="form-group">
                        <label for="kd_pelanggan">Pelanggan</label>
                        <select name="kd_pelanggan" id="kd_pelanggan" class="form-control">
                          <?php foreach($daftar_pelanggan as $d): ?>
                            <option value="<?=$d['kd_pelanggan']?>"><?=$d['nm_pelanggan']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-success">Selanjutnya</button>
                      </div>
                    </form>
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
      document.getElementsByName("kd_penjualan")[0].value = kodePenjualan();
      $('#kd_pelanggan').selectize({
        options: <?=json_encode($daftar_pelanggan)?>,
        valueField: "kd_pelanggan",
        labelField: "nm_pelanggan",
        create: true
      });
    </script>
  </body>
</html>
