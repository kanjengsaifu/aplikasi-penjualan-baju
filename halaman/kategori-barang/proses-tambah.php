<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO kategori
      (
        nm_kategori
      )
    VALUES
      (
        :nm_kategori
      )
  ", [
    'nm_kategori' => $_POST['nm_kategori']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
