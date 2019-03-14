<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM pelanggan WHERE kd_pelanggan = :kd_pelanggan", [
    'kd_pelanggan' => $_POST['kd_pelanggan']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
