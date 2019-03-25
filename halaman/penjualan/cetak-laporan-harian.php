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
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
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
      <?=$nama_perusahaan?>
    </div>
    <div class="sub-judul">
      <?=$alamat_perusahaan?> 
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
            $total = 0;
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
          <tr>
            <td class="kanan" colspan="4"><b>Total</b></td>
            <td><?=$total?></td>
          </tr>
        </tbody>
      </table>
      <div style="width: 300px;margin-top: 50px;margin-right: -50px; float: right;text-align: center;">
        <?=$kota_perusahaan?>, <?=date("d/m/Y")?> <br/> <br/> <br/> <br/> <?=$nama_pimpinan?> 
      </div>
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
