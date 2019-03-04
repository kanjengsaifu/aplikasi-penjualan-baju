<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM kategori WHERE kd_kategori = :kd_kategori", [
    'kd_kategori' => $_POST['kd_kategori']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
