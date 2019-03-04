<?php
  $menu = [
    'admin' => [
      ['judul' => 'Beranda' ,'url' => 'index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Barang' ,'url' => 'halaman/barang/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Admin' ,'url' => 'halaman/admin/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Penjualan' ,'url' => 'halaman/penjualan/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Pelanggan' ,'url' => 'halaman/pelanggan/index.php', 'icon' => 'la-dashboard']
    ],
    'karyawan gudang' => [
      ['judul' => 'Beranda' ,'url' => 'index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Barang' ,'url' => 'halaman/barang/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Data Supplier' ,'url' => 'halaman/supplier/index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Pembelian' ,'url' => 'halaman/laporan/pembelian/index.php', 'icon' => 'la-dashboard']
    ],
    'pemilik' => [
      ['judul' => 'Beranda' ,'url' => 'index.php', 'icon' => 'la-dashboard'],
      ['judul' => 'Laporan Penjualan' ,'url' => 'halaman/laporan/penjualan/index.php', 'icon' => 'la-dashboard']
    ]
  ];
?>
<div class="sidebar">
  <div class="scroll-wrapper scrollbar-inner sidebar-wrapper" style="position: relative;">
    <div class="scrollbar-inner sidebar-wrapper scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 304px;">
      <ul class="nav">
        <?php
          $level = 'admin';
          foreach($menu[$level] as $d):
        ?>
          <li class="nav-item">
            <a href="<?=$d['url']?>">
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
