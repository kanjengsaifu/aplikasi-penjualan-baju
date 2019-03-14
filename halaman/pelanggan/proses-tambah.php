<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO pelanggan
      (
        nm_pelanggan
      ) 
    VALUES
      (
        :nm_pelanggan
      )
  ", [
    'nm_pelanggan' => $_POST['nm_pelanggan']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
