<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE kategori SET
        nm_kategori = :nm_kategori
    WHERE kd_kategori = :kd_kategori
  ", [
    'kd_kategori' => $_POST['kd_kategori'],
    'nm_kategori' => $_POST['nm_kategori']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
