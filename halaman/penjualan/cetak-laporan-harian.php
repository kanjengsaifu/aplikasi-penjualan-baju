<?php
  session_start();
  require("../../vendor/autoload.php");
  require "../../pengaturan/pengaturan.php";
  require("../../pengaturan/helper.php");
  require("../../pengaturan/database.php");
  use Dompdf\Dompdf;
  
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    $waktu = $_GET['waktu'];
  }
  
  $daftar_penjualan = $db->query("SELECT a.*, b.nm_pelanggan FROM penjualan a JOIN pelanggan b ON a.kd_pelanggan = b.kd_pelanggan WHERE a.tgl_penjualan = DATE(:waktu)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);
  ob_start();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="<?=$alamat_web?>/assets/css/css-tabel-laporan.css">
  </head>
  <body>
    <div class="judul">
      <?=$nama_perusahaaan?>
    </div>
    <div class="sub-judul">
      <?=$alamat_perusahaaan?> <hr>
    </div>
    <div class="sub-judul">
      Laporan Penjualan Harian <br/> Tanggal <?=tanggal_indo($waktu)?> 
    </div>
    <br/>
      <table id="tabel" class="tabel_laporan">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Penjualan</th>
            <th>Tanggal Penjualan</th>
            <th>Nama Pelanggan</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($daftar_penjualan as $i=>$d):
          ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$d['kd_penjualan']?></td>
              <td><?=tanggal_indo($d['tgl_penjualan'])?></td>
              <td><?=$d['nm_pelanggan']?></td>
              <td><?=$d['total_hrg']?></td>
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
