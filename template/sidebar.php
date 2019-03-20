<?php
  $menu = [
    'Admin' => [
      ['judul' => 'Beranda' ,'url' => '/halaman/beranda', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Barang' ,'url' => '/halaman/barang/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Kategori Barang' ,'url' => '/halaman/kategori-barang/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Pengguna' ,'url' => '/halaman/pengguna/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Penjualan' ,'url' => '/halaman/penjualan/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Pembelian' ,'url' => '/halaman/pembelian/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Pelanggan' ,'url' => '/halaman/pelanggan/index.php', 'icon' => 'la-dashboard']
    ],
    'Karyawan Gudang' => [
      ['judul' => 'Beranda' ,'url' => '/halaman/beranda', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Barang' ,'url' => '/halaman/barang/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Supplier' ,'url' => '/halaman/supplier/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Pembelian' ,'url' => '/halaman/pembelian/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Pembelian' ,'url' => '/halaman/pembelian/laporan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'ROP & EOQ' ,'url' => '/halaman/eoq/index.php', 'icon' => 'la-dashboard']
    ],
    'Pimpinan' => [
      ['judul' => 'Beranda' ,'url' => '/halaman/beranda', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Barang' ,'url' => '/halaman/barang/laporan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Pembelian Harian' ,'url' => '/halaman/pembelian/laporan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Pembelian Bulanan' ,'url' => '/halaman/pembelian/laporan-bulanan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Pembelian Tahunan' ,'url' => '/halaman/pembelian/laporan-tahunan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Penjualan Harian' ,'url' => '/halaman/penjualan/laporan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Penjualan Bulanan' ,'url' => '/halaman/penjualan/laporan-bulanan.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Penjualan Tahunan' ,'url' => '/halaman/penjualan/laporan-tahunan.php', 'icon' => 'la-dashboard']
    ]
  ];
?>
<div class="sidebar">
  <div class="scroll-wrapper scrollbar-inner sidebar-wrapper" style="position: relative;">
    <div class="scrollbar-inner sidebar-wrapper scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 304px;">
      <ul class="nav">
        <?php
          $level = $_SESSION['jenis_pengguna'];
          foreach($menu[$level] as $d):
        ?>
          <li class="nav-item">
            <a href="<?=$alamat_web.$d['url']?>">
              <i class="la <?=$d['icon']?>"></i>
              <p><?=$d['judul']?></p>
            </a>
          </li>
        <?php
          endforeach;
        ?>
      </ul>
    </div>
  </div>
</div>
