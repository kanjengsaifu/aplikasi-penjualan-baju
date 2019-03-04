<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM supplier WHERE kd_supplier = :kd_supplier", [
    'kd_supplier' => $_POST['kd_supplier']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
