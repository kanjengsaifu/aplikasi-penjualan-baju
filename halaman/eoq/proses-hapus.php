<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM eoq WHERE kd_eoq = :kd_eoq", [
    'kd_eoq' => $_GET['kd_eoq']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
