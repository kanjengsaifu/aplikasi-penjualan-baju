<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $_SESSION['kd_pembelian'] = $_POST['kd_pembelian'];  
    $_SESSION['tgl_pembelian'] = $_POST['tgl_pembelian'];  
    $_SESSION['kd_supplier'] = $_POST['kd_supplier'];  
    $supplier_tmp = $db->query("SELECT nm_supplier FROM supplier WHERE kd_supplier = :kd_supplier", ['kd_supplier' => $_POST['kd_supplier']])->fetch();
    $_SESSION['nm_supplier'] = $supplier_tmp['nm_supplier'];
  }
  
  if(isset($_SESSION['kd_pembelian']))
  {
    if($_SESSION['kd_pembelian'] != '')
    {
      {
        header("Location: tambah-detail.php");
      }   
    }
  }
  $judul = "Data Pembelian Baru";  
  
  $daftar_supplier = $db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);
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
                  <div class="card-header">
                    <div class="card-title">Data Pembelian Baru</div>
                  </div>
                  <div class="card-body">
                    <form method="POST" id="tambahData" action="">
                      <div class="form-group">
                        <label for="kd_pembelian">Kode Pembelian</label>
                        <input type="text" class="form-control" name="kd_pembelian" max="50" min="1" required />
                      </div>
                      <div class="form-group">
                        <label for="tgl_supplier">Tanggal Pembelian</label>
                        <input type="text" class="form-control" name="tgl_pembelian" required />
                      </div>
                      <div class="form-group">
                        <label for="kd_supplier">Supplier</label>
                        <select name="kd_supplier" id="kd_supplier" class="form-control">
                          <option value="">-- Pilih Supplier --</option>
                          <?php foreach($daftar_supplier as $d): ?>
                            <option value="<?=$d['kd_supplier']?>"><?=$d['nm_supplier']?></option>
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
      var tgl_pembelian = new Pikaday({
        field: document.getElementsByName('tgl_pembelian')[0],
        format: 'YYYY-MM-DD',
      });
      $('#kd_supplier').selectize({
        create: true
      });
    </script>
  </body>
</html>
