<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");  
  
  // Simpan data pembelian terlebih dahulu
  $db->query("
      INSERT INTO penjualan
      (
        kd_penjualan,
        tgl_penjualan,
        kd_pelanggan,
        total_hrg
      )
      VALUES 
      (
        :kd_penjualan,
        :tgl_penjualan,
        :kd_pelanggan,
        :total_hrg
      )",
      [
        'kd_penjualan' => $_SESSION['kd_penjualan'],
        'tgl_penjualan' => $_SESSION['tgl_penjualan'],
        'kd_pelanggan' => $_SESSION['kd_pelanggan'],
        'total_hrg' => $_SESSION['total_hrg']
      ]); 
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: tambah.php?proses=tambah&hasil=0&error=".$error[2]);
  }
  
  
  // Simpan data barangnya kemudian
  $db->query("INSERT INTO detail_penjualan (kd_penjualan, kd_barang, jml, total_hrg) SELECT kd_penjualan, kd_barang, jml, total_hrg FROM detail_penjualan_tmp WHERE kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_SESSION['kd_penjualan']]);

  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: tambah.php?proses=tambah&hasil=0&error=".$error[2]);
  }

  // Hapus keranjang
  $db->query("DELETE FROM detail_penjualan_tmp WHERE kd_penjualan = :kd_penjualan", ['kd_penjualan' => $_SESSION['kd_penjualan']]);
  
  // Data pembelian dikosongkan kembali
  $_SESSION['kd_penjualan'] = "";  
  $_SESSION['tgl_penjualan'] = "";  
  $_SESSION['kd_pelanggan'] = "";  
  $_SESSION['nm_pelanggan'] = "";
  
  header("Location: tambah.php?proses=tambah&hasil=1");
?>
