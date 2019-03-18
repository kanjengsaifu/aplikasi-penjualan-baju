<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO eoq
      (
        tgl_hitung,
        kd_barang,
        tahun_penjualan,
        jumlah_penjualan,
        biaya_pesan,
        biaya_simpan,
        lead_time,
        rop,
        eoq
      ) 
    VALUES
      (
        :tgl_hitung,
        :kd_barang,
        :tahun_penjualan,
        :jumlah_penjualan,
        :biaya_pesan,
        :biaya_simpan,
        :lead_time,
        :rop,
        :eoq
      )
  ", [
    'tgl_hitung' => $_POST['tgl_hitung'],
    'kd_barang' => $_POST['kd_barang'],
    'tahun_penjualan' => $_POST['tahun_penjualan'],
    'jumlah_penjualan' => $_POST['jumlah_penjualan'],
    'biaya_pesan' => $_POST['biaya_pesan'],
    'biaya_simpan' => $_POST['biaya_simpan'],
    'lead_time' => $_POST['lead_time'],
    'rop' => $_POST['rop'],
    'eoq' => $_POST['eoq']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
