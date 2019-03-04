<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO barang
      (
        nm_barang,
        hrg_beli,
        hrg_jual,
        stok,
        kd_kategori
      ) 
    VALUES
      (
        :nm_barang,
        :hrg_beli,
        :hrg_jual,
        :stok,
        :kd_kategori
      )
  ", [
    'nm_barang' => $_POST['nm_barang'],
    'hrg_beli' => $_POST['hrg_beli'],
    'hrg_jual' => $_POST['hrg_jual'],
    'stok' => $_POST['stok'],
    'kd_kategori' => $_POST['kd_kategori']
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
