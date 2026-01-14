-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fullstack
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nrp_mahasiswa` char(9) DEFAULT NULL,
  `npk_dosen` char(6) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`username`),
  KEY `fk_akun_mahasiswa_idx` (`nrp_mahasiswa`),
  KEY `fk_akun_dosen1_idx` (`npk_dosen`),
  CONSTRAINT `fk_akun_dosen1` FOREIGN KEY (`npk_dosen`) REFERENCES `dosen` (`npk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_akun_mahasiswa` FOREIGN KEY (`nrp_mahasiswa`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` VALUES ('admin','$2y$10$KNNtr98sAaKaAm9VzmZskueBsvV/NdrqbnqdPinNgeyMOZsG4lLhC',NULL,NULL,1),('alvinkurniawan','$2y$10$aFL7oMhyRO/EIINGlzhZmeXeHcoznt8I6G18nrKLHUqDLcJBFJ7k.','160423055',NULL,0),('andre','$2y$10$9f4ncQFj19yl13wBy0TwDOFVA6o6053tGhmj6w6SmNHa5Bng02b0a',NULL,'208020',0),('enrichdaniel','$2y$10$JimW1GIh6sC738X3cfAjYuSKZehjS9CiNI/oCBfwOoX9TW.FPBx.u','160423091',NULL,0),('erickosutanto','$2y$10$CaPW3ZJ5rxC7k8AufGvLRev2jaLnYF8kNWsRxISOjzM2hLB.likcW','160423088',NULL,0),('harrenanwar','$2y$10$wC9jUR7/OiSzUKJfi.69relXLWYOUqZj8ym0RhZ6tcfS1gRSF0yrC','160423081',NULL,0),('hendradinata','$2y$10$9aRBbU6VWM73Rmu.vsqINuKbzjY4DFhgAwPbNSslRnypdqp/MQKxK',NULL,'210034',0),('heruarwokomt','$2y$10$QjOvArH6Xg9PA04q154jc.bNEgLPAIsPtfLfAtsiUpVesYjf6p366',NULL,'192014',0),('jonathan','$2y$10$E5NdfE8f/no13UvyUmE7MO01fgtxs0HoZhf0BMqo6A9v3ihGYhKAS','160423095',NULL,0),('liliana','$2y$10$XL7Oyn5Uo2yEaGncXLT/LuVvTN4a/..rfSOt89g0L/z9T5VEq1Xdy',NULL,'206020',0),('richieviriyananda','$2y$10$cvyVCy093B/HrMX95qFoweFWtSrY0Mk56VV/CamKMsM6Zmy58qxvW','160423078',NULL,0),('susanalimanto','$2y$10$m..zDC.sLzla7nMK4JLx0Ofg9kmM7UQrIplEFvdFPQ.ccJbZcNjcS',NULL,'197030',0);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL AUTO_INCREMENT,
  `idthread` int(11) NOT NULL,
  `username_pembuat` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL,
  PRIMARY KEY (`idchat`),
  KEY `fk_chat_thread1_idx` (`idthread`),
  KEY `fk_chat_akun1_idx` (`username_pembuat`),
  CONSTRAINT `fk_chat_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_chat_thread1` FOREIGN KEY (`idthread`) REFERENCES `thread` (`idthread`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,1,'susanalimanto','Halo semuanya','2026-01-10 22:20:59'),(2,1,'susanalimanto','Selamat Datang','2026-01-10 22:21:25'),(3,1,'alvinkurniawan','Halo Bu!','2026-01-10 22:22:00'),(4,2,'alvinkurniawan','Halo semuanya!','2026-01-14 17:21:02'),(5,3,'alvinkurniawan','Info Cheatsheet DB Rich!','2026-01-14 17:21:41'),(6,4,'alvinkurniawan','Chie, Rick, ntar kita sekelompok yak buat Project SE!','2026-01-14 17:22:26'),(7,5,'alvinkurniawan','Selamat Pagi / Siang / Malam Pak Andre!','2026-01-14 17:22:57'),(8,3,'liliana','Nanti Ibu buatin','2026-01-14 17:36:06'),(9,6,'liliana','Halo semuanya!','2026-01-14 17:38:32'),(10,7,'hendradinata','Selamat Sore semuanya!','2026-01-14 17:46:34'),(11,7,'hendradinata','Selamat datang di Grup FSP Gasal 2025/2026','2026-01-14 17:46:47'),(12,7,'erickosutanto','Selamat Sore Pak!','2026-01-14 17:47:18');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen` (
  `npk` char(6) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `foto_extension` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`npk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES ('192014','Heru Arwoko, M.T.','jpg'),('197030','Susana Limanto','jpg'),('206020','Dr. Liliana','jpg'),('208020','Dr. Andre','jpg'),('210034','Dr. Hendra Dinata','jpg');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `idevent` int(11) NOT NULL AUTO_INCREMENT,
  `idgrup` int(11) NOT NULL,
  `judul` varchar(45) DEFAULT NULL,
  `judul-slug` varchar(45) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `poster_extension` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idevent`),
  KEY `fk_event_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_event_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (2,4,'QTS DB','qts-db','2025-12-02 10:35:00','Event Quiz Tengah Semester nih.','Privat','png'),(4,5,'QTS SE','qts-se','2025-12-03 09:45:00','Materinya tentang BPMN ya.','Publik','png'),(5,3,'QTS Alin','qts-alin','2025-12-03 09:45:00','Materi sampai dengan Determinan ya. Bersifat open 1 lembar A4','Publik','jpg'),(6,6,'QTS NMP','qts-nmp','2025-12-03 09:45:00','Quiz Tengah','Publik','png'),(8,8,'QTS Applied DB','qts-applied-db','2026-01-14 20:50:00','Quiz Applied DB nih!','Publik','jpg'),(9,9,'QTS FSP','qts-fsp','2026-01-14 23:00:00','Quiz Tengah untuk matkul FSP','Publik','png');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grup`
--

DROP TABLE IF EXISTS `grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grup` (
  `idgrup` int(11) NOT NULL AUTO_INCREMENT,
  `username_pembuat` varchar(20) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `tanggal_pembentukan` datetime DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `kode_pendaftaran` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgrup`),
  KEY `fk_grup_akun1_idx` (`username_pembuat`),
  CONSTRAINT `fk_grup_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grup`
--

LOCK TABLES `grup` WRITE;
/*!40000 ALTER TABLE `grup` DISABLE KEYS */;
INSERT INTO `grup` VALUES (3,'susanalimanto','Alin KP A','Grup untuk Alin KP A','2025-11-26 09:01:20','Privat','UBAYA3'),(4,'liliana','Database B Gasal 24/25','Grup untuk mahasiswa DB KP B','2025-12-03 01:33:51','Publik','UBAYA4'),(5,'liliana','SE KP D Gasal 24/25','Grup untuk mahasiswa SE KP D','2025-12-03 01:40:43','Publik','UBAYA5'),(6,'andre','NMP KP A','Grup untuk NMP KP A','2025-12-03 02:24:40','Publik','UBAYA6'),(7,'andre','NMP KP B','Grup untuk NMP KP B','2025-12-03 02:24:52','Privat','UBAYA7'),(8,'liliana','Applied DB ','Grup untuk mahasiswa matkul Applied DB','2026-01-14 11:36:52','Publik','UBAYA8'),(9,'hendradinata','Fullstack Gasal 2025/2026','Grup untuk seluruh KP Matkul FSP','2026-01-14 11:45:12','Publik','UBAYA9');
/*!40000 ALTER TABLE `grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mahasiswa` (
  `nrp` char(9) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `foto_extention` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES ('160423055','Alvin Kurniawan','Pria','2005-10-20',2023,'jpg'),('160423078','Richie Viriyananda Hartono','Pria','2005-06-23',2023,'jpg'),('160423081','Harren Anwar Natawijaya','Pria','2005-10-20',2023,'jpg'),('160423088','Ericko Sutanto','Pria','2005-10-31',2023,'jpg'),('160423091','Enrich Daniel','Pria','2025-10-20',2023,'jpg'),('160423095','Jonathan Andrian Hadinata','Pria','2025-12-01',2025,'jpg');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_grup`
--

DROP TABLE IF EXISTS `member_grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_grup` (
  `idgrup` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`idgrup`,`username`),
  KEY `fk_grup_has_akun_akun1_idx` (`username`),
  KEY `fk_grup_has_akun_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_grup_has_akun_akun1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_grup_has_akun_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_grup`
--

LOCK TABLES `member_grup` WRITE;
/*!40000 ALTER TABLE `member_grup` DISABLE KEYS */;
INSERT INTO `member_grup` VALUES (3,'alvinkurniawan'),(3,'susanalimanto'),(4,'alvinkurniawan'),(4,'liliana'),(5,'alvinkurniawan'),(5,'erickosutanto'),(5,'liliana'),(5,'richieviriyananda'),(6,'alvinkurniawan'),(6,'andre'),(6,'richieviriyananda'),(7,'andre'),(8,'enrichdaniel'),(8,'harrenanwar'),(8,'hendradinata'),(8,'liliana'),(8,'richieviriyananda'),(9,'alvinkurniawan'),(9,'enrichdaniel'),(9,'erickosutanto'),(9,'harrenanwar'),(9,'hendradinata'),(9,'jonathan'),(9,'richieviriyananda');
/*!40000 ALTER TABLE `member_grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread` (
  `idthread` int(11) NOT NULL AUTO_INCREMENT,
  `username_pembuat` varchar(20) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL,
  `status` enum('Open','Close') DEFAULT 'Open',
  PRIMARY KEY (`idthread`),
  KEY `fk_thread_akun1_idx` (`username_pembuat`),
  KEY `fk_thread_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_thread_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_thread_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread`
--

LOCK TABLES `thread` WRITE;
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
INSERT INTO `thread` VALUES (1,'susanalimanto',3,'2026-01-10 22:20:49','Open'),(2,'alvinkurniawan',3,'2026-01-10 22:51:08','Open'),(3,'alvinkurniawan',4,'2026-01-14 17:21:18','Open'),(4,'alvinkurniawan',5,'2026-01-14 17:22:00','Open'),(5,'alvinkurniawan',6,'2026-01-14 17:22:44','Open'),(6,'liliana',8,'2026-01-14 17:38:24','Close'),(7,'hendradinata',9,'2026-01-14 17:46:05','Open');
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-14 17:53:12
