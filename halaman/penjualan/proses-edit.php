<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE pelanggan SET
        nm_pelanggan = :nm_pelanggan,
        nohp = :nohp,
        alamat = :alamat 
    WHERE kd_pelanggan = :kd_pelanggan
  ", [
    'kd_pelanggan' => $_POST['kd_pelanggan'],
    'nm_pelanggan' => $_POST['nm_pelanggan'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
