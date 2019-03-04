<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM barang WHERE kd_barang = :kd_barang", [
    'kd_barang' => $_POST['kd_barang']
  ]);
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: index.php?proses=hapus&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: index.php?proses=hapus&hasil=1");
  }
?>
