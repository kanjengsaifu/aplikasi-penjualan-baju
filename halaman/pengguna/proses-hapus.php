<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM pengguna WHERE kd_pengguna = :kd_pengguna", [
    'kd_pengguna' => $_POST['kd_pengguna']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
