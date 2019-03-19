-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `kd_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nm_barang` varchar(100) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `kd_kategori` int(11) NOT NULL,
  PRIMARY KEY (`kd_barang`),
  KEY `kd_kategori` (`kd_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `kategori` (`kd_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `hrg_beli`, `stok`, `hrg_jual`, `kd_kategori`) VALUES
(1,	'Baju 11',	10000,	31,	12000,	1),
(2,	'baju baru',	13000,	73,	15000,	1),
(3,	'Baju Miskin',	12345,	15,	32111,	2);

DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE `detail_pembelian` (
  `kd_detail_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pembelian` varchar(50) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_detail_pembelian`),
  KEY `kd_barang` (`kd_barang`),
  KEY `kd_pembelian` (`kd_pembelian`),
  CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE,
  CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`kd_pembelian`) REFERENCES `pembelian` (`kd_pembelian`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_pembelian` (`kd_detail_pembelian`, `kd_pembelian`, `kd_barang`, `jml`, `total_hrg`) VALUES
(1,	'12345',	1,	1,	1),
(2,	'123456',	1,	21,	200000);

DROP TABLE IF EXISTS `detail_pembelian_tmp`;
CREATE TABLE `detail_pembelian_tmp` (
  `kd_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pembelian` varchar(50) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_tmp`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `detail_pembelian_tmp_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan` (
  `kd_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(50) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_detail_penjualan`),
  KEY `kd_barang` (`kd_barang`),
  KEY `kd_penjualan` (`kd_penjualan`),
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE,
  CONSTRAINT `detail_penjualan_ibfk_3` FOREIGN KEY (`kd_penjualan`) REFERENCES `penjualan` (`kd_penjualan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_penjualan` (`kd_detail_penjualan`, `kd_penjualan`, `kd_barang`, `jml`, `total_hrg`) VALUES
(8,	'INV/4/2/2019/21124945',	1,	2,	0),
(9,	'INV/4/2/2019/21124945',	1,	1,	10000),
(10,	'INV/1/2/2019/102434173',	1,	1,	10000);

DROP TABLE IF EXISTS `detail_penjualan_tmp`;
CREATE TABLE `detail_penjualan_tmp` (
  `kd_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(50) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_tmp`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `detail_penjualan_tmp_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_penjualan_tmp` (`kd_tmp`, `kd_penjualan`, `kd_barang`, `jml`, `total_hrg`) VALUES
(1,	'INV/1/2/2019/102315873',	1,	2,	10000),
(2,	'INV/1/2/2019/102315873',	2,	1,	10000);

DROP TABLE IF EXISTS `eoq`;
CREATE TABLE `eoq` (
  `kd_eoq` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_hitung` date NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `tahun_penjualan` varchar(4) NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL,
  `biaya_pesan` int(11) NOT NULL,
  `biaya_simpan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `eoq` float NOT NULL,
  `rop` float NOT NULL,
  PRIMARY KEY (`kd_eoq`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `eoq_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `eoq` (`kd_eoq`, `tgl_hitung`, `kd_barang`, `tahun_penjualan`, `jumlah_penjualan`, `biaya_pesan`, `biaya_simpan`, `lead_time`, `eoq`, `rop`) VALUES
(1,	'2012-10-10',	2,	'2019',	6600,	50,	5,	6,	363,	108);

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kd_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
(1,	'Kain 2'),
(2,	'Kain');

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `kd_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pelanggan` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`) VALUES
(1,	'sdas'),
(2,	'Pelanggan 1'),
(3,	'Pelanggan 2'),
(4,	'Pelanggan 3'),
(5,	'Manual'),
(6,	'Manual 2');

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `kd_pembelian` varchar(50) NOT NULL,
  `kd_supplier` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_pembelian`),
  KEY `kd_supplier` (`kd_supplier`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pembelian` (`kd_pembelian`, `kd_supplier`, `tgl_pembelian`, `total_hrg`) VALUES
('12345',	3,	'2012-10-10',	1),
('123456',	3,	'2012-10-10',	200000);

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `kd_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pengguna` varchar(100) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` text NOT NULL,
  `jenis_pengguna` enum('Admin','Karyawan Gudang','Pimpinan') NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_pengguna`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengguna` (`kd_pengguna`, `nm_pengguna`, `username`, `password`, `jenis_pengguna`, `nohp`, `alamat`) VALUES
(1,	'Admin Admin',	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'Admin',	'081266838995',	'Padang'),
(2,	'Karyawan Gudang',	'gudang',	'27b60538393c4d5034814c7dc0dfd62b',	'Karyawan Gudang',	'081266838995',	'Alamat Karyawan Gudang'),
(3,	'Pimpinan Pimpinan',	'pimpinan',	'90973652b88fe07d05a4304f0a945de8',	'Pimpinan',	'081266838995',	'Alamat Pimpinan');

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `kd_penjualan` varchar(50) NOT NULL,
  `kd_pelanggan` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_penjualan`),
  KEY `kd_pelanggan` (`kd_pelanggan`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kd_pelanggan`) REFERENCES `pelanggan` (`kd_pelanggan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `penjualan` (`kd_penjualan`, `kd_pelanggan`, `tgl_penjualan`, `total_hrg`) VALUES
('INV/1/2/2019/102434173',	6,	'2018-10-10',	10000),
('INV/4/2/2019/21124945',	3,	'2012-10-10',	10000);

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `kd_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(30) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `supplier` (`kd_supplier`, `nm_supplier`, `nohp`, `alamat`) VALUES
(3,	'Supplier 1',	'081266838995',	'ALamat 1'),
(4,	'Supplier 2',	'3232121',	'fdsfseesf'),
(5,	'1232121',	'21332321',	'3123321'),
(6,	'sdaww',	'awadwdaw',	'dsaadwa');

-- 2019-03-18 16:06:10
