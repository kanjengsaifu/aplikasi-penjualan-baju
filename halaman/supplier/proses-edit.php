<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE supplier SET
        nm_supplier = :nm_supplier,
        nohp = :nohp,
        alamat = :alamat 
    WHERE kd_supplier = :kd_supplier
  ", [
    'kd_supplier' => $_POST['kd_supplier'],
    'nm_supplier' => $_POST['nm_supplier'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
