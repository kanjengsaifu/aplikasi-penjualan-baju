<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");  
  $db->query("INSERT INTO detail_penjualan_tmp (kd_penjualan, kd_barang, jml, total_hrg) VALUES (:kd_penjualan, :kd_barang, :jml, :total_hrg)", ['kd_penjualan' => $_SESSION['kd_penjualan'], 'kd_barang' => $_POST['kd_barang'], 'jml' => $_POST['jml'], 'total_hrg' => $_POST['total_hrg']]);  
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: tambah-detail.php?proses=tambah&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: tambah-detail.php?proses=tambah&hasil=1");
  }
?>
