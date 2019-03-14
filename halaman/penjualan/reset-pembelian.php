<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");  
  
  $_SESSION['kd_penjualan'] = "";  
  $_SESSION['tgl_penjualan'] = "";  
  $_SESSION['kd_pelanggan'] = "";  
  $_SESSION['nm_pelanggan'] = "";
  
  // Hapus keranjang
  $db->query("DELETE FROM detail_penjualan_tmp WHERE kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_SESSION['kd_penjualan']]);
  header("Location: tambah.php");
?>
