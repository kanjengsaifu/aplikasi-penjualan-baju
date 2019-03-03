<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO supplier
      (
        nm_supplier,
        nohp,
        alamat
      ) 
    VALUES
      (
        :nm_supplier,
        :nohp,
        :alamat
      )
  ", [
    'nm_supplier' => $_POST['nm_supplier'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
