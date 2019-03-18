<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE eoq SET
        tgl_hitung = :tgl_hitung,
        kd_barang = :kd_barang,
        tahun_penjualan = :tahun_penjualan,
        jumlah_penjualan = :jumlah_penjualan,
        biaya_pesan = :biaya_pesan,
        biaya_simpan = :biaya_simpan,
        lead_time = :lead_time,
        rop = :rop,
        eoq = :eoq
    WHERE kd_eoq = :kd_eoq
  ", [
      'tgl_hitung' => $_POST['tgl_hitung'],
      'kd_barang' => $_POST['kd_barang'],
      'tahun_penjualan' => $_POST['tahun_penjualan'],
      'jumlah_penjualan' => $_POST['jumlah_penjualan'],
      'biaya_pesan' => $_POST['biaya_pesan'],
      'biaya_simpan' => $_POST['biaya_simpan'],
      'lead_time' => $_POST['lead_time'],
      'rop' => $_POST['rop'],
      'eoq' => $_POST['eoq'],
      'kd_eoq' => $_POST['kd_eoq']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
