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
  
  $ket_waktu_tmp = explode("-", $waktu);
  $ket_waktu = $ket_waktu_tmp[0];
  
  $daftar_pembelian = $db->query("SELECT MONTH(a.tgl_pembelian) AS bln, SUM(b.jml) AS jml, SUM(b.total_hrg) AS total_hrg FROM pembelian a JOIN detail_pembelian b ON a.kd_pembelian = b.kd_pembelian WHERE YEAR(a.tgl_pembelian) = YEAR(:waktu) GROUP BY MONTH(a.tgl_pembelian)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);  
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
      <?=$alamat_perusahaan?> <hr>
    </div>
    <div class="sub-judul">
      Laporan Pembelian Tahunan <br/> Tahun <?=$ket_waktu?> 
    </div>
    <br/>
    <table id="tabel" class="tabel_laporan">
      <thead>
        <tr>
          <th>No</th>
          <th>Bulan</th>
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
              <td><?=namaBulan($d['bln'])?></td>
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
  
  $dompdf->stream("laporan-pembelian-tahunan.pdf", array("Attachment" => false));
  exit(0);

?>
