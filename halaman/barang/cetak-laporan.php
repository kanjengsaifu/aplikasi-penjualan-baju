<?php
  session_start();
  require("../../vendor/autoload.php");
  require "../../pengaturan/pengaturan.php";
  require("../../pengaturan/helper.php");
  require("../../pengaturan/database.php");
  use Dompdf\Dompdf;
  
  $judul = "Laporan Barang";  
  $daftar_barang = $db->query("SELECT a.*, b.nm_kategori FROM barang a JOIN kategori b ON a.kd_kategori = b.kd_kategori")->fetchAll(PDO::FETCH_ASSOC);
  ob_start();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="<?=$alamat_web?>/assets/css/css-tabel-laporan.css">
  </head>
  <body>
    <div class="judul">
      <?=$nama_perusahaan?>
    </div>
    <div class="sub-judul">
      <?=$alamat_perusahaan?>
    </div>
    <table class="tabel_laporan">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Harga Beli (Rp)</th>
          <th>Harga Jual (Rp)</th>
          <th>Stok (Pcs)</th>
          <th>Kategori</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          foreach($daftar_barang as $i=>$d):
        ?>
          <tr>
            <td class="tengah"><?=$no?></td>
            <td class="kiri"><?=$d['nm_barang']?></td>
            <td class="kanan"><?=rupiah($d['hrg_beli'], "")?></td>
            <td class="kanan"><?=rupiah($d['hrg_jual'], "")?></td>
            <td class="kanan"><?=$d['stok']?></td>
            <td class="kiri"><?=$d['nm_kategori']?></td>
          </tr>
        <?php
          $no++;
          endforeach;
        ?>
      </tbody>
    </table>
  </body>
</html>
<?php
$content = ob_get_clean();
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($content);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$dompdf->stream("laporan-barang.pdf", array("Attachment" => false));
exit(0);

?>
