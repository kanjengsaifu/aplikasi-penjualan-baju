<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO pelanggan
      (
        nm_pelanggan,
        nohp,
        alamat
      ) 
    VALUES
      (
        :nm_pelanggan,
        :nohp,
        :alamat
      )
  ", [
    'nm_pelanggan' => $_POST['nm_pelanggan'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: index.php?proses=tambah&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: index.php?proses=tambah&hasil=1");
  }
?>
