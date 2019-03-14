<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE pelanggan SET
        nm_pelanggan = :nm_pelanggan
    WHERE kd_pelanggan = :kd_pelanggan
  ", [
    'kd_pelanggan' => $_POST['kd_pelanggan'],
    'nm_pelanggan' => $_POST['nm_pelanggan']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
