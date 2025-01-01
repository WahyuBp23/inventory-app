/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_inven
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_inven` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_inven`;

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `idpenjualan` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` varchar(255) CHARACTER SET latin1 NOT NULL,
  `total` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tanggal_input` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idpenjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan` */

/*Table structure for table `tb_barangkeluar` */

DROP TABLE IF EXISTS `tb_barangkeluar`;

CREATE TABLE `tb_barangkeluar` (
  `idkeluar` varchar(20) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `alamattujuan` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggalkeluar` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idkeluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barangkeluar` */

insert  into `tb_barangkeluar`(`idkeluar`,`idbarang`,`alamattujuan`,`qty`,`tanggalkeluar`) values 
('BK-001','BRG-002','Gudang Samarinda',200,'2024-06-15 15:14:37'),
('BK-002','BRG-003','Gudang Garam',50,'2024-06-15 16:18:56'),
('BK-003','BRG-011','Gudang Xxxxxx',25,'2024-06-15 16:19:35');

/*Table structure for table `tb_barangmasuk` */

DROP TABLE IF EXISTS `tb_barangmasuk`;

CREATE TABLE `tb_barangmasuk` (
  `idmasuk` varchar(20) NOT NULL,
  `idbarang` varchar(20) NOT NULL,
  `idsupplier` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggalmasuk` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idmasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barangmasuk` */

insert  into `tb_barangmasuk`(`idmasuk`,`idbarang`,`idsupplier`,`qty`,`tanggalmasuk`) values 
('BM-001','BRG-002','SP-005',500,'2024-06-15 15:04:36'),
('BM-002','BRG-003','SP-004',100,'2024-06-15 16:04:54'),
('BM-003','BRG-004','SP-001',150,'2024-06-15 16:05:11'),
('BM-004','BRG-005','SP-007',400,'2024-06-15 16:05:42'),
('BM-005','BRG-006','SP-011',200,'2024-06-15 16:07:14'),
('BM-006','BRG-007','SP-003',90,'2024-06-15 16:07:42'),
('BM-007','BRG-008','SP-003',250,'2024-06-15 16:08:17'),
('BM-008','BRG-009','SP-011',120,'2024-06-15 16:08:46'),
('BM-009','BRG-010','SP-010',240,'2024-06-15 16:09:22'),
('BM-010','BRG-011','SP-009',50,'2024-06-15 16:09:55'),
('BM-011','BRG-012','SP-006',190,'2024-06-15 16:10:49');

/*Table structure for table `tb_databarang` */

DROP TABLE IF EXISTS `tb_databarang`;

CREATE TABLE `tb_databarang` (
  `idbarang` varchar(20) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_databarang` */

insert  into `tb_databarang`(`idbarang`,`namabarang`,`kategori`,`merk`,`satuan`,`stock`,`harga`,`image`) values 
('BRG-002','Lancer Skincare The Method: Polish & Glow','Skincare','Lancer','Set',300,0,'86cf969558e39094bad90d92cd5552a7.jpg'),
('BRG-003','Skintific 5X Ceramide Soothing Toner 80ml','Skincare','Skintific','Box',50,0,'8c2ba5f391ac988234aa4413a64e79ae.jpg'),
('BRG-004','Maybelline Superstay Matte Ink Liquid Lipstick Founder','Make Up','Maybelline','Box',150,0,'737b7ee415fb59dbad2430136fa27541.jpg'),
('BRG-005','Scarlett Whitening Body Lotion 300ml Original - JOLLY','Bodycare','Scarlett','Box',400,0,'3e977ee34379a53cfcc7d25f52386adb.jpg'),
('BRG-006','COPY PASTE BREATHABLE MESH CUSHION SPF 33 PA++','Make Up','Somethinc','Box',200,0,'29ca78dd94976bb5454b273d6a7eb4fa.png'),
('BRG-007','HAIRFALL TREATMENT SHAMPOO','Haircare','Wardah','Box',90,0,'891ea31c42fab6ff5b69d90bde492a54.jpg'),
('BRG-008','NUTRI SHINE CONDITIONER','Haircare','Wardah','Box',250,0,'ada2def32de284b674c452a4fdca60cc.jpg'),
('BRG-009','Skin Goals Brightening Body Creme','Bodycare','Somethinc','Box',120,0,'57ac77c2eb6131e5c2224290369998b8.png'),
('BRG-010','MADAME GIE MADAME PROTECT ME SPF 30 PA+++','Skincare','Madame Gie','Box',240,0,'e5604b560864fe8bb55607ae963e470c.jpg'),
('BRG-011','FOCALLURE Waterproof Eyebrow Cream Pomade FA23','Make Up','Focallure','Box',25,0,'f51d8fc1d9d64df3a5cf6b0daa211fa5.jpg'),
('BRG-012','Viva Glow Up Perfumed Body Serum Glam Star','Bodycare','Viva','Box',190,0,'6e62b851c1f3db15e10bb29892776fd9.jpg');

/*Table structure for table `tb_penjualan` */

DROP TABLE IF EXISTS `tb_penjualan`;

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` varchar(20) NOT NULL,
  `jumlah` varchar(255) CHARACTER SET latin1 NOT NULL,
  `total` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tanggal_input` varchar(255) CHARACTER SET latin1 NOT NULL,
  `periode` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penjualan` */

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `idsupplier` varchar(20) NOT NULL,
  `namasupplier` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kontak` varchar(12) NOT NULL,
  PRIMARY KEY (`idsupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`idsupplier`,`namasupplier`,`alamat`,`kontak`) values 
('SP-001','Resha Yuana','Kediri','081515384096'),
('SP-002','Adi Alzava','Blitar','081675849091'),
('SP-003','Tolib Khoiri',' Blitar','081515384092'),
('SP-004','Ananda Rizki',' Tulungagung','081515384093'),
('SP-005','Ega Juni','Blitar','081515384095'),
('SP-006','Ryan Akta','Blitar','081515384097'),
('SP-007','Saiful Irvanda',' Blitar','081515384099'),
('SP-008','Ramadhani Mustofa','Tulungagung','081675849091'),
('SP-009','Faiz Kurniawan','Kediri','081515384045'),
('SP-010','Hari Idul Fitri',' Kediri','08151538423'),
('SP-011','Nadea Sukma','Blitar','081515384123');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level_user` enum('pemilik','admin','kasir') NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`nama_lengkap`,`username`,`password`,`level_user`,`image`) values 
(1,'Wahyu Bagus Pambudi','pemilik','pemilik','pemilik',''),
(2,'Malmedira','admin123','admin123','admin','fe31d0320fc1a6286207f2de5e140431.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
