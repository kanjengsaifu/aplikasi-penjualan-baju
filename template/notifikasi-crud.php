<script>
<?php
  // Notifikasi
  $pesan = "";
  $tipe = "";
  $judul = "Pemberitahuan!";
  $jenis = "";
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
      $pesan = "Data gagal ".$jenis.". Silahkan coba beberapa saat lagi.";
    }
    else
    {
      $tipe = "primary";
      $pesan = "Data berhasil ".$jenis.".";
    }
    echo "notification('".$judul."', '".$pesan."', '".$tipe."');";
  }
?>
</script>
