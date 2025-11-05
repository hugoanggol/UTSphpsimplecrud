/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 8.0.30 : Database - db_simplecrud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_simplecrud`;

/*Table structure for table `tb_agama` */

DROP TABLE IF EXISTS `tb_agama`;

CREATE TABLE `tb_agama` (
  `kode_agama` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_agama` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_agama` */

insert  into `tb_agama`(`kode_agama`,`nama_agama`) values 
('BUDDHA','Buddha'),
('HINDU','Hindu'),
('ISLAM','Islam'),
('KHATOLIK','Khatolik'),
('KONGHUCU','Konghucu'),
('KRISTEN','Kristen');

/*Table structure for table `tb_penduduk` */

DROP TABLE IF EXISTS `tb_penduduk`;

CREATE TABLE `tb_penduduk` (
  `id_pnddk` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lhr` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lhr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lhr` year NOT NULL,
  `provinsi` mediumint DEFAULT NULL,
  `agama` enum('Islam','Kristen','Khatolik','Hindu','Buddha','Konghucu') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('laki-laki','perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pnddk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_penduduk` */

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `id_provinsi` smallint NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nama_provinsi`) values 
(7,'Bali'),
(8,'Nusa Tenggara Timur'),
(9,'Nusa Tenggara Barat'),
(10,'Jawa Timur'),
(11,'Jawa Tengah'),
(12,'Jawa Barat'),
(13,'DKI Jakarta'),
(14,'DI Yogyakarta');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
