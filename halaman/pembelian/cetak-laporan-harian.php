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
  
  $daftar_pembelian = $db->query("SELECT a.*, b.nm_supplier FROM pembelian a JOIN supplier b ON a.kd_supplier = b.kd_supplier WHERE a.tgl_pembelian = DATE(:waktu)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);
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
      Laporan Pembelian Harian <br/> Tanggal <?=tanggal_indo($waktu)?> 
    </div>
    <br/>
      <table id="tabel" class="tabel_laporan">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pembelian</th>
            <th>Tanggal Pembelian</th>
            <th>Nama Supplier</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $total = 0;
            foreach($daftar_pembelian as $i=>$d):
              $total += $d['total_hrg'];
          ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$d['kd_pembelian']?></td>
              <td><?=tanggal_indo($d['tgl_pembelian'])?></td>
              <td><?=$d['nm_supplier']?></td>
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
