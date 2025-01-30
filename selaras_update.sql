-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: selaras
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `custom`
--

DROP TABLE IF EXISTS `custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom` (
  `id_custom` int NOT NULL AUTO_INCREMENT,
  `id_kain` int NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `pjng_baju` varchar(10) NOT NULL,
  `pjng_lengan` varchar(10) NOT NULL,
  `bahu` varchar(10) NOT NULL,
  `pundak` varchar(10) NOT NULL,
  `pinggang` varchar(5) NOT NULL,
  `gambar_model` varchar(125) NOT NULL,
  `qty_custom` int NOT NULL,
  PRIMARY KEY (`id_custom`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom`
--

LOCK TABLES `custom` WRITE;
/*!40000 ALTER TABLE `custom` DISABLE KEYS */;
INSERT INTO `custom` VALUES (2,3,'20241017UGESTPAK','12','12','12','12','12','baju_belakang2.png',1),(3,3,'20241017QYYEMZUJ','15','15','15','15','15','baju_depan21.png',15),(4,3,'20250115R9JFWZEP','10','10','20','10','20','image_processing20210911-8482-t0pqlr.gif',20),(5,4,'20250115RWU5U8E0','10','10','20','10','20','image_processing20210911-8482-t0pqlr1.gif',10),(6,3,'20250115CCLY97NH','10','10','20','10','20','Slide_3.jpg',10),(7,3,'20250123ZAON6CQL','10','10','20','10','20','original-669873f58901abc05fed30e7e2285e5c.png',1),(8,4,'202501230FEMTZUR','10','10','20','10','20','image_processing20210911-8482-t0pqlr2.gif',10),(9,3,'20250123GWH7FF65','10','10','20','10','20','462575532_1875951256147999_4783417176782153285_n.jpg',10),(10,4,'20250123XZGEZS9C','10','10','20','10','20','image_processing20210911-8482-t0pqlr3.gif',19),(11,3,'202501230X4C72GV','10','10','20','10','20','image_processing20210911-8482-t0pqlr4.gif',10);
/*!40000 ALTER TABLE `custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(50) NOT NULL,
  `alamat_customer` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (11,'azzam','cigugur','082115649049','azzam','azzam','2024-10-07 12:04:54'),(12,'agung','kadugede','082115649047','agung','agung','2024-10-07 12:36:32'),(13,'angga','cijoho','082115649041','angga','angga','2024-10-07 12:56:12'),(14,'fauzi','cisantana','082115649042','fauzi','fauzi','2024-10-07 14:12:34'),(15,'dini','cigugur','082115649046','dini','dini','2024-10-08 00:29:46'),(18,'Lala','cigugur','082321319009','lala','lala','2024-10-14 12:27:28'),(19,'suci','cisantana','082115649040','suci','suci','2024-10-14 12:50:36'),(20,'alif','cigugur','082321319000','alif','alif','2024-10-17 02:48:18'),(21,'ripal','cigugur','082115649054','ripal','ripal','2024-10-17 03:45:00'),(22,'ares','cigugur','082115649052','ares','ares','2024-10-17 03:49:48'),(23,'rifki','kalapagunung','08982921','rifki','rifki','2024-10-17 03:49:48');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_transaksi`
--

DROP TABLE IF EXISTS `detail_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(20) NOT NULL,
  `id_size` int NOT NULL,
  `qty` varchar(15) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_transaksi`
--

LOCK TABLES `detail_transaksi` WRITE;
/*!40000 ALTER TABLE `detail_transaksi` DISABLE KEYS */;
INSERT INTO `detail_transaksi` VALUES (18,'20241007XMDGIJOC',74,'1'),(19,'20241007MUFFHUSR',62,'1'),(20,'20241007ITH0WFJZ',64,'1'),(21,'202410071VU4Y5G0',61,'1'),(22,'202410079HKHE3F2',68,'1'),(24,'20241008YZIRDN2T',69,'1'),(25,'202410145APHL8GW',68,'1'),(26,'20241014RUW3FDRJ',69,'1'),(27,'20241014PLNDHBQ1',69,'1'),(28,'20241014GYK6PLUV',68,'1'),(29,'20241017DOV6IWZX',67,'1'),(30,'20241017DOV6IWZX',62,'1'),(31,'20241017WLKSKCVI',67,'1'),(32,'20241017DK6YSMNO',62,'1'),(33,'20241017V4LEMC2U',62,'1'),(34,'20241211M1TLQVU2',60,'1'),(35,'20241211JTMZ78ZR',61,'1'),(36,'20241213GMC9M8NH',61,'1'),(37,'202412147WFPV160',61,'1'),(38,'20241214GYI8RKV0',60,'1'),(39,'202412141EPO38B7',62,'1'),(40,'20241214KDHRNX5A',61,'1'),(41,'20241214D6KFEXZT',61,'1'),(42,'20241214ZBTB4SQK',61,'1'),(43,'20241214GIX87O23',61,'1'),(44,'202412144WMG9IGM',61,'1'),(45,'20241214AL9XENTJ',61,'1'),(46,'20241214HSQTZNLV',64,'1'),(47,'20241214HSQTZNLV',60,'1'),(48,'20241214QLZAJBWQ',60,'1'),(49,'20241214JRM0EERD',61,'1'),(50,'20241214R0MAYNCL',64,'1'),(51,'20241215FJJZTQLL',61,'1'),(52,'20241215BRX3GWLP',60,'1'),(53,'20241215IHNTA3CA',62,'1'),(54,'20241220WSVXF5RG',60,'1'),(55,'20241220ZSVRSC14',64,'1'),(56,'20250115UBSTJUYY',60,'1'),(57,'20250115VDWN4YED',60,'1'),(58,'20250115ZO76YQMC',60,'1'),(59,'20250115LVXIY5AM',68,'1'),(60,'20250115NLRI1BOD',61,'1'),(61,'20250115IH7ODRBX',61,'1'),(62,'20250115OBCZW23R',61,'1');
/*!40000 ALTER TABLE `detail_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diskon`
--

DROP TABLE IF EXISTS `diskon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diskon` (
  `id_diskon` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `nama_diskon` varchar(50) NOT NULL,
  `besar_diskon` int NOT NULL,
  `tgl_selesai` varchar(50) NOT NULL,
  PRIMARY KEY (`id_diskon`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diskon`
--

LOCK TABLES `diskon` WRITE;
/*!40000 ALTER TABLE `diskon` DISABLE KEYS */;
INSERT INTO `diskon` VALUES (35,38,'0',0,'0'),(36,39,'0',0,'0'),(37,40,'0',0,'0'),(38,41,'0',0,'0'),(39,42,'jas',10,'2024-10-27'),(40,43,'0',0,'0'),(41,44,'gaun',10,'2024-10-17');
/*!40000 ALTER TABLE `diskon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kain`
--

DROP TABLE IF EXISTS `kain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kain` (
  `id_kain` int NOT NULL AUTO_INCREMENT,
  `nama_kain` varchar(125) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kain`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kain`
--

LOCK TABLES `kain` WRITE;
/*!40000 ALTER TABLE `kain` DISABLE KEYS */;
INSERT INTO `kain` VALUES (3,'Katun'),(4,'Linen'),(5,'Denim'),(6,'Organza'),(7,'Spandeks'),(8,'Sifon');
/*!40000 ALTER TABLE `kain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (2,'Celana'),(3,'Baju'),(4,'Jas'),(5,'Dress');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengembalian` (
  `id_return` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_return` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (1,'20220529EVYBRXJU','2022-06-17','salah warna');
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(125) NOT NULL,
  `berat` int NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES (38,4,'Jas Vest Motif Kotak Warna Abu-abu','<div>-Jas Formal bermotif kotak kotak tipis dengan warna abu-abu menimbulkan kesan yang formal dan sangat stylish untuk kerja kantoran, ke kondangan maupun untuk acara wedding.</div>\r\n<div>- Bahan : Semi Wool (berkualitas) dengan furing di bagian dalam, sehingga lebih tebal dan nyaman di gunakan</div>\r\n<div>- Sizing : SLIM FIT</div>\r\n<div>- Model 2 kancing bagian depan</div>\r\n<div>- 1 kantong di bagian bawah</div>\r\n<div>- 1 kantong di bagian dalam dada</div>\r\n<div>- Setiap pembelian mendapatkan&nbsp;</div>\r\n<div>Note :</div>\r\n<div>- Produk yang kami foto adalah asli produk kami, sehingga kami sudah usahakan agar warna, bentuk produk terlihat jelas. toleransi perbedaan warna disebabkan kamera, layar hape, cahaya 3 - 6%.</div>','Jas_Celana_Vest_Rompi_Motif_Kotak2.jpg',360),(39,4,'Jas Bellmore-T1 Warna Biru Gelap','<div>-Jas Formal bermotif kotak kotak tipis dengan warna abu-abu menimbulkan kesan yang formal dan sangat stylish untuk kerja kantoran, ke kondangan maupun untuk acara wedding.</div>\r\n<div>- Bahan : Semi Wool (premium) dengan furing di bagian dalam, sehingga lebih tebal dan nyaman di gunakan</div>\r\n<div>- Sizing : SLIM FIT</div>\r\n<div>- Model 1 kancing bagian depan</div>\r\n<div>- 2 kantong di bagian bawah</div>\r\n<div>- 1 kantong di bagian dalam dada</div>\r\n<div>- Setiap pembelian mendapatkan&nbsp;</div>\r\n<div>Note :</div>\r\n<div>- Produk yang kami foto adalah asli produk kami, sehingga kami sudah usahakan agar warna, bentuk produk terlihat jelas. toleransi perbedaan warna disebabkan kamera, layar hape, cahaya 3 - 6%.</div>','Jas_Bellmore-T1_Dark_Blue2.jpg',600),(40,4,'Jas Suit Blazer Hitam','<div>- Bahan : Semi Wool (berkualitas) dengan furing di bagian dalam, sehingga lebih tebal dan nyaman di gunakan</div>\r\n<div>- Sizing : SLIM FIT</div>\r\n<div>- Model 2 kancing bagian depan</div>\r\n<div>- 1 kantong bagian dada sebelah</div>\r\n<div>- 2 kantong di bagian bawah</div>\r\n<div>- 1 kantong di bagian dalam dada</div>\r\n<div>- Setiap pembelian mendapatkan cover jas berwarna hitam, agar anda dapat menyimpan jas dengan baik dan tidak kotor</div>\r\n<div>Note :</div>\r\n<div>- Produk yang kami foto adalah asli produk kami, sehingga kami sudah usahakan agar warna, bentuk produk terlihat jelas. toleransi perbedaan warna disebabkan kamera, layar hape, cahaya 3 - 6%.</div>','Jas_Suit_Blazer_Houseofcuf2.jpg',360),(41,5,'Gaun Wanita Warna Hijau Motif Bunga','<p>Gaun wanita motif bunga&nbsp;</p>\r\n<p>-Warna Hijau</p>\r\n<p>-Motif bunga warna Kuning Putih</p>\r\n<p>BAHAN : SIFON<br />ADEM DAN NYAMAN<br />*ADA FURING/LINING<br />*PINGGANG KARET<br /><br />UKURAN :<br />-BUST/LD : 108cm<br />-PANJANG : 128cm</p>','gaun_wanita_motif_bunga_hijau3.jpg',260),(42,5,'Gaun Wanita Model Korea Cream','<p>Gaun wanita kekinian gaya korea&nbsp;</p>\r\n<p>-Warna Cream</p>\r\n<p>-Size fit to L</p>\r\n<p>BAHAN : SIFON<br />ADEM DAN NYAMAN<br />*ADA FURING/LINING<br />*PINGGANG KARET</p>\r\n<p>Deskripsi DRESS UK L :<br />LD ( Lebar Dada ) &plusmn; 106cm<br />PJ Baju &plusmn; 140 cm</p>\r\n<p><br />Deskripsi DRESS UK XL<br />LD ( Lebar Dada ) &plusmn; 110 cm<br />PJ Baju &plusmn; 140</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','gaun_wanita_modern_gaya_korea3.jpg',260),(43,2,'Celana Pria Bahan Slim Fit Hitam','<p>DESKRIPSI PRODUK:</p>\r\n<p>Bahan nyaman dan adem saat digunakan</p>\r\n<p>cocok digunakan untuk bekerja, ataupun acara</p>\r\n<p>- Slim Fit<br />- Bahan semi wool<br />- Model Celana Panjang diatas mata kaki<br />- Ada kantong samping dan belakang kanan kiri</p>','celana_bahan_wol_pria2.jpg',260),(44,2,'Celana Pria Formal Lentur SlimFit Abu','<p>DESKRIPSI PRODUK :<br />- Slim Fit<br />- Bahan semi wool<br />- Model Celana Panjang diatas mata kaki<br />- Ada kantong samping dan belakang kanan kiri</p>\r\n<p>-Kemiripan warna 95% dengan foto disebabkan oleh lighting saat pengambilan foto produk dan kecerahan pada ponsel masing-masing<br />-Hati-hati dalam pemilihan size karena kita tidak dapat menerima retur akibat kesalahan dalam pemilihan size<br />-Tulis warna dan size cadangan pada catatan (mengantisipasi jika warna dan size sold out)</p>','celana_formal_lentur_slimfit1.jpg',260);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `size` (
  `id_size` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `size` varchar(50) NOT NULL,
  `stok` varchar(15) NOT NULL,
  `harga` varchar(20) NOT NULL,
  PRIMARY KEY (`id_size`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size`
--

LOCK TABLES `size` WRITE;
/*!40000 ALTER TABLE `size` DISABLE KEYS */;
INSERT INTO `size` VALUES (60,38,'M','11','230000'),(61,38,'L','5','260000'),(62,38,'XL','14','285000'),(63,39,'L','20','965000'),(64,39,'XL','15','1000000'),(65,40,'M','20','230000'),(66,40,'L','20','250000'),(67,40,'XL','17','265000'),(68,41,'L','25','169000'),(69,42,'L','27','199000'),(70,42,'XL','30','219000'),(71,43,'39','19','170000'),(72,43,'40','19','200000'),(73,44,'39','18','150000'),(74,44,'40','19','170000');
/*!40000 ALTER TABLE `size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_customer` int DEFAULT NULL,
  `tgl_transaksi` varchar(11) DEFAULT NULL,
  `alamat` text,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `ekspedisi` varchar(50) DEFAULT NULL,
  `estimasi` varchar(50) DEFAULT NULL,
  `ongkir` varchar(15) DEFAULT NULL,
  `status_order` int DEFAULT NULL,
  `status_pesan` int DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_bayar` varchar(50) DEFAULT NULL,
  `bukti_pembayaran` text,
  `type_transaksi` int NOT NULL DEFAULT '1',
  `metode_pembayaran` enum('cod','transfer') DEFAULT NULL,
  `harga_diskon` int DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES ('202410071VU4Y5G0',13,'2024-10-07','cijoho','Jawa Barat','Kuningan','tiki','SDS','14000',4,2,'2024-10-07 12:59:56','274000','bukti_bayar_brimo3.jpg',1,'transfer',NULL),('202410079HKHE3F2',14,'2024-10-07','cisantana','Jawa Barat','Kuningan','pos','SDS','14000',4,2,'2024-10-07 14:13:28','183000','bukti_bayar_brimo4.jpg',1,'transfer',NULL),('20241007ITH0WFJZ',13,'2024-10-07','cijoho','Jawa Barat','Kuningan','tiki','SDS','14000',4,2,'2024-10-07 12:57:21','1014000','bukti_bayar_brimo2.jpg',1,'transfer',NULL),('20241007MUFFHUSR',12,'2024-10-07','kadugede','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-07 12:37:12','301000','bukti_bayar_brimo1.jpg',1,'transfer',NULL),('20241007XMDGIJOC',11,'2024-10-07','cigugur','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-07 12:05:59','169000','bukti_bayar_brimo.jpg',1,'transfer',NULL),('20241008YZIRDN2T',15,'2024-10-08','cigugur','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-08 00:30:33','215000','bukti_bayar_brimo5.jpg',1,'transfer',NULL),('20241014GYK6PLUV',19,'2024-10-14','cisantana','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-14 12:51:29','185000','bukti_bayar_brimo9.jpg',1,'transfer',NULL),('20241014PLNDHBQ1',18,'2024-10-14','cigugur, cipager sebelah utara bank BRI','Jawa Barat','Kuningan','tiki','SDS','14000',4,2,'2024-10-14 12:28:29','183150','bukti_bayar_brimo8.jpg',1,'transfer',NULL),('20241017DK6YSMNO',21,'2024-10-17','cigugur','Jawa Barat','Kuningan','tiki','SDS','14000',4,2,'2024-10-17 03:45:50','299000','bukti_bayar_brimo14.jpg',1,'transfer',NULL),('20241017DOV6IWZX',13,'2024-10-17','cijoho','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-17 02:55:19','566000','bukti_bayar_brimo10.jpg',1,'transfer',NULL),('20241017V4LEMC2U',22,'2024-10-17','cigugur','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-17 03:50:33','301000','bukti_bayar_brimo15.jpg',1,'transfer',NULL),('20241017WLKSKCVI',20,'2024-10-17','cigugur','Jawa Barat','Kuningan','pos','Pos Sameday','16000',4,2,'2024-10-17 03:31:50','281000','bukti_bayar_brimo12.jpg',1,'transfer',NULL),('20241214JRM0EERD',11,'2024-12-14','cigugur','Jawa Barat','Kuningan','tiki','TRC','26500',4,2,'2024-12-14 00:00:46','286500','original-669873f58901abc05fed30e7e2285e5c.png',1,'transfer',NULL),('20241215IHNTA3CA',11,'2024-12-15','cigugur','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2024-12-15 11:12:54','292000',NULL,1,'cod',NULL),('20241220WSVXF5RG',11,'2024-12-20','cigugur','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2024-12-20 11:44:45','237000',NULL,1,'cod',NULL),('20241220ZSVRSC14',11,'2024-12-20','cigugur','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2024-12-20 12:28:24','1007000','Doctors-Sick-Note-for-Work-Word-Google-Docs-11.png',1,'transfer',NULL),('20250115IH7ODRBX',14,'2025-01-15','cisantana','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2025-01-15 21:55:57','267000',NULL,1,'cod',NULL),('20250115OBCZW23R',23,'2025-01-15','kalapagunung','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2025-01-15 22:06:42','267000',NULL,1,'cod',NULL),('20250115UBSTJUYY',11,'2025-01-15','cijoho','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2025-01-15 14:29:47','237000','Doctors-Sick-Note-for-Work-Word-Google-Docs-12.png',1,'transfer',NULL),('20250115VDWN4YED',11,'2025-01-15','cijoho','Jawa Barat','Kuningan','jne','CTC','7000',4,2,'2025-01-15 14:39:58','237000','Doctors-Sick-Note-for-Work-Word-Google-Docs-1.png',1,'transfer',NULL);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `alamat_user` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_user` int NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'Selaras','Cigugur','085698745236','pemilik','pemilik',2),(5,'Azzam','Cigugur','08563214569','admin','admin',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voucher_pelanggan`
--

DROP TABLE IF EXISTS `voucher_pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voucher_pelanggan` (
  `id_voucher` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `kode_voucher` varchar(50) NOT NULL,
  `nama_voucher` varchar(100) NOT NULL,
  `diskon_persen` decimal(5,2) NOT NULL,
  `minimum_pembelian` int DEFAULT '1',
  `tgl_mulai` datetime NOT NULL,
  `tgl_berakhir` datetime NOT NULL,
  `limit_penggunaan` int DEFAULT '1',
  PRIMARY KEY (`id_voucher`),
  UNIQUE KEY `kode_voucher` (`kode_voucher`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `voucher_pelanggan_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voucher_pelanggan`
--

LOCK TABLES `voucher_pelanggan` WRITE;
/*!40000 ALTER TABLE `voucher_pelanggan` DISABLE KEYS */;
INSERT INTO `voucher_pelanggan` VALUES (4,11,'ZXCV','Diskon tes',10.00,10,'2025-01-17 00:00:00','2025-01-24 00:00:00',1);
/*!40000 ALTER TABLE `voucher_pelanggan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-27 21:17:08
