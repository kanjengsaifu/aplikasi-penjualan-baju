<?
  session_start();
  require('../pengaturan/helper.php');
  require('../vendor/autoload.php');
  require('../pengaturan/medoo.php');
  
  
  $cek_login = $db->get("pengguna", "*", ["username" => $_POST['username'], "password" => md5($_POST['password'])]);

  if(empty($cek_login))
  {
    header("Location: ".$alamat_web."/login/index.php?login=0");
  }
  else
  {
    $_SESSION['username'] = $cek_login['username'];
    $_SESSION['nm_pengguna'] = $cek_login['nm_pengguna'];
    $_SESSION['jenis_pengguna'] = $cek_login['jenis_pengguna'];
    header("Location: ".$alamat_web."/halaman/beranda");
  }
?>
