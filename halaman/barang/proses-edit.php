<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE barang SET
        nm_barang = :nm_barang,
        hrg_jual = :hrg_jual,
        hrg_beli = :hrg_beli,
        stok = :stok,
        kd_kategori = :kd_kategori WHERE kd_barang = :kd_barang
  ", [
    'nm_barang' => $_POST['nm_barang'],
    'hrg_beli' => $_POST['hrg_beli'],
    'hrg_jual' => $_POST['hrg_jual'],
    'stok' => $_POST['stok'],
    'kd_kategori' => $_POST['kd_kategori'],
    'kd_barang' => $_POST['kd_barang']
  ]);
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: index.php?proses=edit&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: index.php?proses=edit&hasil=1");
  }
?>
