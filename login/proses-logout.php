<?
  session_start();
  require('../pengaturan/pengaturan.php');
  require('../pengaturan/helper.php');
  if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    unset($_SESSION['nm_pengguna']);
    unset($_SESSION['jenis_pengguna']);
  }
  header("Location: $alamat_web/login");
?>
