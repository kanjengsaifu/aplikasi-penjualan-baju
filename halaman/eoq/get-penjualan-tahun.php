<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/database.php");
  header('Content-Type:application/json');
  
  $hasil = $db->query("SELECT YEAR(a.tgl_penjualan) as tahun, b.kd_barang, SUM(b.jml) AS jml FROM penjualan a JOIN detail_penjualan b ON a.kd_penjualan = b.kd_penjualan 
                          WHERE YEAR(a.tgl_penjualan) = :tahun AND b.kd_barang = :kd_barang", ['tahun' => $_GET['tahun'], 'kd_barang' => $_GET['kd_barang']])->fetch(PDO::FETCH_ASSOC);
  echo json_encode($hasil);
  
?>
