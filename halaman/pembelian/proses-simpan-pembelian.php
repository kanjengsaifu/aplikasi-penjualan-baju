<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");  
  
  // Simpan data pembelian terlebih dahulu
  $db->query("
      INSERT INTO pembelian 
      (
        kd_pembelian,
        tgl_pembelian,
        kd_supplier,
        total_hrg
      )
      VALUES 
      (
        :kd_pembelian,
        :tgl_pembelian,
        :kd_supplier,
        :total_hrg
      )",
      [
        'kd_pembelian' => $_SESSION['kd_pembelian'],
        'tgl_pembelian' => $_SESSION['tgl_pembelian'],
        'kd_supplier' => $_SESSION['kd_supplier'],
        'total_hrg' => $_SESSION['total_hrg']
      ]); 
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: tambah.php?proses=tambah&hasil=0&error=".$error[2]);
  }
  
  
  // Simpan data barangnya kemudian
  $db->query("INSERT INTO detail_pembelian (kd_pembelian, kd_barang, jml, total_hrg) SELECT kd_pembelian, kd_barang, jml, total_hrg FROM detail_pembelian_tmp WHERE kd_pembelian = :kd_pembelian", ['kd_pembelian' => $_SESSION['kd_pembelian']]);

  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: tambah.php?proses=tambah&hasil=0&error=".$error[2]);
  }

  // Hapus keranjang
  $db->query("DELETE FROM detail_pembelian_tmp WHERE kd_pembelian = :kd_pembelian", ['kd_pembelian' => $_SESSION['kd_pembelian']]);
  
  // Data pembelian dikosongkan kembali
  $_SESSION['kd_pembelian'] = "";  
  $_SESSION['tgl_pembelian'] = "";  
  $_SESSION['kd_supplier'] = "";  
  $_SESSION['nm_supplier'] = "";
  
  header("Location: tambah.php?proses=tambah&hasil=1");
?>
