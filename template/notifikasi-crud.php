<script>
<?php
  // Notifikasi
  $pesan = "";
  $tipe = "";
  $judul = "Pemberitahuan!";
  $jenis = "";
  $waktu = 1000;
  if(isset($_GET['proses']) && isset($_GET['hasil'])){
    switch($_GET['proses']){
      case "tambah":
        $jenis = 'dibuat';  
      break;
      case "edit":
        $jenis = 'diubah';  
      break;
      case "hapus":
        $jenis = 'dihapus';  
      break;
    }
    if($_GET['hasil'] == '0')
    {
      $tipe = "danger";
      $pesan = "Data gagal ".$jenis.". <br/> Error: ".htmlspecialchars(json_encode($_GET['error']), ENT_QUOTES, 'UTF-8');
      $waktu = 5000;
    }
    else
    {
      $tipe = "primary";
      $pesan = "Data berhasil ".$jenis.".";
    }
    echo "notification('".$judul."', '".$pesan."', '".$tipe."', ".$waktu.");";
  }
?>
</script>
