<?php
  session_start();
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../vendor/autoload.php");
  
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  use Dompdf\Dompdf;
  $judul = "Data ROP & EOQ";  
  $daftar_eoq = $db->query("SELECT a.*, b.nm_barang FROM eoq a JOIN barang b ON a.kd_barang = b.kd_barang")->fetchAll(PDO::FETCH_ASSOC);
  $data_barang = $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
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
      Laporan Perhitungan ROP & EOQ
    </div>
    <br/>
    <table id="tabel" class="tabel_laporan">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Hitung</th>
          <th>Nama Barang</th>
          <th>Tahun Penjualan</th>
          <th>Jumlah Penjualan</th>
          <th>Biaya Pemesanan (Rp)</th>
          <th>Biaya Penyimpanan (Rp)</th>
          <th>Lead Time (Hari)</th>
          <th>ROP</th>
          <th>EOQ</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          foreach($daftar_eoq as $i=>$d):
        ?>
          <tr>
            <td><?=$no?></td>
            <td><?=tanggal_indo($d['tgl_hitung'])?></td>
            <td><?=$d['nm_barang']?></td>
            <td><?=$d['tahun_penjualan']?></td>
            <td><?=$d['jumlah_penjualan']?></td>
            <td><?=rupiah($d['biaya_pesan'], "")?></td>
            <td><?=rupiah($d['biaya_simpan'], "")?></td>
            <td><?=$d['lead_time']?></td>
            <td><?=$d['rop']?></td>
            <td><?=$d['eoq']?></td>
          </tr>
        <?php
          $no++;
          endforeach;
        ?>
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
  
  $dompdf->stream("laporan-barang.pdf", array("Attachment" => false));
  exit(0);
?>
