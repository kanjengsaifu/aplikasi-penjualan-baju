<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  $db->query("DELETE FROM penjualan WHERE kd_penjualan = :kd_penjualan", [
    'kd_penjualan' => $_GET['kd_penjualan']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
