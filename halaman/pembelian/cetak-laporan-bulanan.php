<?php
  session_start();
  require("../../vendor/autoload.php");
  require "../../pengaturan/pengaturan.php";
  require("../../pengaturan/helper.php");
  require("../../pengaturan/database.php");
  use Dompdf\Dompdf;
  
  $judul = "Laporan Pembelian Barang";  
  $ket_waktu = "";
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
  }
  
  $ket_waktu_tmp = explode(" ", tanggal_indo($waktu));
  $ket_waktu = $ket_waktu_tmp[1]." ".$ket_waktu_tmp[2];
  
  $daftar_pembelian = $db->query("SELECT DAY(a.tgl_pembelian) AS tgl, SUM(b.jml) AS jml, SUM(b.total_hrg) AS total_hrg FROM pembelian a JOIN detail_pembelian b ON a.kd_pembelian = b.kd_pembelian WHERE MONTH(a.tgl_pembelian) = MONTH(:waktu) AND YEAR(a.tgl_pembelian) = YEAR(:waktu) GROUP BY DAY(a.tgl_pembelian)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);  
  ob_start();
?>

<html>
  
  <!-- Bagian head -->
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
      Laporan Pembelian Bulanan <br/> <?=$ket_waktu?> 
    </div>
    <br/>
    <table id="tabel" class="tabel_laporan">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
          <th>Total Harga (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $jml = 0;
          $total_hrg = 0;
          foreach($daftar_pembelian as $i=>$d):
            $jml += $d['jml'];
            $total_hrg += $d['total_hrg'];
        ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$d['tgl']?></td>
              <td><?=$d['jml']?></td>
              <td><?=rupiah($d['total_hrg'], "")?></td>
            </tr>
        <?php
          $no++;
          endforeach;
        ?>
        <tr>
          <td class="text-right" colspan="2"><b>Total</b></td>
          <td><?=$jml?></td>
          <td><?=rupiah($total_hrg, "")?></td>
        </tr>
      </tbody>
    </table>
    <!-- Akhir dari Bagian tabel -->
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
  
  $dompdf->stream("laporan-bulanan.pdf", array("Attachment" => false));
  exit(0);

?>
