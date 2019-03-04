<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");  
  
  $_SESSION['kd_pembelian'] = "";  
  $_SESSION['tgl_pembelian'] = "";  
  $_SESSION['kd_supplier'] = "";  
  $_SESSION['nm_supplier'] = "";
  
  // Hapus keranjang
  $db->query("DELETE FROM detail_pembelian_tmp WHERE kd_pembelian = :kd_pembelian", ['kd_pembelian' => $_SESSION['kd_pembelian']]);
  header("Location: tambah.php");
?>
