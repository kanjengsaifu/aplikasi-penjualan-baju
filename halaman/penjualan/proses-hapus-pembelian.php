<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM detail_penjualan_tmp WHERE kd_tmp = :kd_tmp", [
    'kd_tmp' => $_GET['kd_tmp']
  ]);
  header("Location: tambah-detail.php?proses=hapus&hasil=1");
?>
