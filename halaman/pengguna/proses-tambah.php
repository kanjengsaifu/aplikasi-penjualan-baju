<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO pengguna
      (
        nm_pengguna,
        username,
        password,
        jenis_pengguna,
        nohp,
        alamat
      ) 
    VALUES
      (
        :nm_pengguna,
        :username,
        MD5(:password),
        :jenis_pengguna,
        :nohp,
        :alamat
      )
  ", [
    'username' => $_POST['username'],
    'nm_pengguna' => $_POST['nm_pengguna'],
    'password' => $_POST['password'],
    'jenis_pengguna' => $_POST['jenis_pengguna'],
    'nohp' => $_POST['nohp'],
    'alamat' => $_POST['alamat']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
