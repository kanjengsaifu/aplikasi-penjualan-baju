-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `kd_brg` int(11) NOT NULL AUTO_INCREMENT,
  `nm_brg` varchar(100) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `kd_kategori` int(11) NOT NULL,
  PRIMARY KEY (`kd_brg`),
  KEY `kd_kategori` (`kd_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `kategori` (`kd_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan` (
  `kd_detail_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pembelian` varchar(50) NOT NULL,
  `kd_brg` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_detail_pembelian`),
  KEY `kd_pembelian` (`kd_pembelian`),
  KEY `kd_brg` (`kd_brg`),
  CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`kd_pembelian`) REFERENCES `pembelian` (`kd_pembelian`) ON DELETE CASCADE,
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `detail_penjualan_tmp`;
CREATE TABLE `detail_penjualan_tmp` (
  `kd_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(50) NOT NULL,
  `kd_brg` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total_hrg` int(11) NOT NULL,
  PRIMARY KEY (`kd_tmp`),
  KEY `kd_brg` (`kd_brg`),
  CONSTRAINT `detail_penjualan_tmp_ibfk_1` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kd_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `kd_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `kd_pembelian` varchar(50) NOT NULL,
  `kd_supplier` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_pembelian`),
  KEY `kd_supplier` (`kd_supplier`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `kd_penjualan` varchar(50) NOT NULL,
  `kd_pelanggan` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `total_hrg` int(11) NOT NULL,
  KEY `kd_pelanggan` (`kd_pelanggan`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kd_pelanggan`) REFERENCES `pelanggan` (`kd_pelanggan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `kd_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(30) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-03-03 17:02:05
