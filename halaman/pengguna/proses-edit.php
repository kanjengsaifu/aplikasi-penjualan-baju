<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE pengguna SET
        nm_pengguna = :nm_pengguna,
        username = :username,
        password = MD5(:password),
        jenis_pengguna = :jenis_pengguna,
        nohp = :nohp,
        alamat = :alamat 
    WHERE kd_pengguna = :kd_pengguna
  ", [
    'kd_pengguna' => $_POST['kd_pengguna'],
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'nm_pengguna' => $_POST['nm_pengguna'],
    'jenis_pengguna' => $_POST['jenis_pengguna'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
