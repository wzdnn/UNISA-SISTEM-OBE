-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 49.128.176.212    Database: simptt
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.16.04.1

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
-- Table structure for table `pt_unitkerja`
--

DROP TABLE IF EXISTS `pt_unitkerja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pt_unitkerja` (
  `kdunitkerja` smallint(5) unsigned NOT NULL DEFAULT '0',
  `unitkerja` varchar(60) NOT NULL,
  `sebutan` varchar(20) DEFAULT '',
  `kdkategori` tinyint(3) unsigned DEFAULT NULL,
  `leveling` int(11) unsigned NOT NULL,
  `kdunitkerjapj` int(10) unsigned NOT NULL,
  `kdperson` int(10) unsigned NOT NULL,
  `notelpuk` varchar(12) NOT NULL COMMENT 'nomor telepon/ekstension telp Unit Kerja',
  `kdpersonpj` int(10) unsigned NOT NULL,
  `kodesuratSPP` varchar(20) NOT NULL,
  `kodesuratSPM` varchar(20) NOT NULL,
  `kodesuratSPJ` varchar(20) NOT NULL,
  `ishapus` tinyint(1) DEFAULT NULL,
  `kodesubsurat` varchar(45) DEFAULT NULL,
  `kdpersonadmin` int(10) DEFAULT NULL,
  PRIMARY KEY (`kdunitkerja`),
  KEY `idx11` (`kdkategori`),
  KEY `idx230` (`kdperson`),
  KEY `idx63` (`kdpersonpj`),
  KEY `idx830` (`kdunitkerjapj`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_unitkerja`
--

LOCK TABLES `pt_unitkerja` WRITE;
/*!40000 ALTER TABLE `pt_unitkerja` DISABLE KEYS */;
INSERT INTO `pt_unitkerja` VALUES (1,'Wakil Ketua I','',1,1,99,3394,'',3208,'SPP-23','SPM-23','SPJ-23',1,NULL,NULL),(2,'Wakil Ketua II','',1,1,99,3212,'',3208,'SPP-24','SPM-24','SPJ-24',1,NULL,NULL),(3,'Wakil Ketua III','',1,1,99,3203,'',3208,'SPP-25','SPM-25','SPJ-25',1,NULL,NULL),(4,'Program Studi Ilmu Keperawatan','Ketua',3,4,95,944,'',20110845,'SPP-03','SPM-03','SPJ-03',0,'FIKes-NAP',NULL),(5,'Program Studi Kebidanan','Ketua',3,4,95,2539,'',20110845,'SPP-01','SPM-01','SPJ-01',0,'FIKes-BDN',NULL),(6,'Program Studi Kebidanan','Ketua',3,4,95,3373,'',20110845,'SPP-02','SPM-02','SPJ-02',0,'FIKes-MED',NULL),(7,'Biro Akademik','Kepala',4,5,97,4206,'',20114894,'SPP-08','SPM-08','SPJ-08',0,NULL,NULL),(8,'UPT Laboratorium','Kepala',4,5,97,2581,'',3212,'SPP-19','SPM-19','SPJ-19',0,NULL,NULL),(9,'UPT Perpustakaan','Kepala',4,5,97,4175,'',20114894,'SPP-21','SPM-21','SPJ-21',0,NULL,NULL),(10,'Badan Pengembangan Teknologi dan Sistem Informasi','Kepala',4,5,37,3413,'',3208,'SPP-13','SPM-13','SPJ-13',0,NULL,NULL),(11,'Biro Kerjasama dan Urusan Internasional','Kepala',4,5,97,2530,'',20114894,'SPP-14','SPM-14','SPJ-14',0,NULL,NULL),(12,'Biro Pengembangan Sumber Daya Manusia','Kepala',4,5,37,20116377,'',3212,'SPP-22','SPM-22','SPJ-22',0,NULL,NULL),(13,'Rektorat','Rektor',1,0,98,3208,'',20116378,'SPP-17','SPM-17','SPJ-17',0,NULL,NULL),(14,'Biro Keuangan','Kepala',4,5,96,20111927,'',3212,'SPP-18','SPM-18','SPJ-18',0,NULL,NULL),(15,'Badan Penjaminan Mutu','Kepala',4,3,13,3147,'',3208,'SPP-11','SPM-11','SPJ-11',0,NULL,20111766),(16,'Biro Kemahasiswaan dan Alumni','Kepala',4,5,97,20113778,'',20114894,'SPP-15','SPM-15','SPJ-15',0,NULL,NULL),(17,'----- (Alumni dan Pengembangan Karir)','Koordinator',4,5,3,0,'',3203,'SPP-09','SPM-09','SPJ-09',1,NULL,NULL),(18,'----- (Asrama)','Koordinator',4,5,3,0,'',3203,'SPP-10','SPM-10','SPJ-10',1,NULL,NULL),(19,'Lembaga Pengkajian dan Pengamalan Islam','Ketua',4,5,13,20111907,'',3151,'SPP-20','SPM-20','SPJ-20',0,NULL,NULL),(20,'Program Profesi Ners','Ketua',3,4,95,944,'',20110845,'SPP-05','SPM-05','SPJ-05',0,'FIKes-NAP',NULL),(21,'BP RB PKU Muhammadiyah Sewu Galur','',4,5,1,0,'',20110845,'','','',1,NULL,NULL),(22,'BP RB PKU \'Aisyiyah Panjatan Kulon Progo','',4,5,1,0,'',20110845,'','','',1,NULL,NULL),(23,'Lembaga Penelitian dan Pengabdian pada Masyarakat','Ketua',4,5,13,20110257,'',3208,'SPP-12','SPM-12','SPJ-12',0,NULL,NULL),(24,'Program Studi Fisioterapi','Ketua',3,4,95,20111981,'',20110845,'SPP-04','SPM-04','SPJ-04',0,'FIKes-SFT',NULL),(25,'Program Studi Ilmu Kebidanan','Ketua',3,4,95,3371,'',20110845,'SPP-07','SPM-07','SPJ-07',0,'FIKes-MIK',NULL),(26,'Pusat Pengembangan Bahasa','Kepala',4,5,97,20110194,'',20114894,'SPP-','SPM-','SPJ-',0,NULL,NULL),(27,'Program Analis Kesehatan','Ketua',3,4,95,20113773,'',20110845,'','','',0,'FIKes-TLM',NULL),(28,'Program Studi Radiologi','Ketua',3,4,95,20114849,'',20110845,'','','',0,'FIKes-RAD',NULL),(29,'Program Profesi Fisioterapi','Ketua',3,4,95,20111981,'',20110845,'','','',0,'FIKes-SFT',NULL),(30,'Program Studi Akuntansi','Ketua',3,4,94,20114790,'',20113796,'','','',0,'FEISHUM-AKT',NULL),(31,'Program Studi Manajemen','Ketua',3,4,94,20116378,'',20113796,'','','',0,'FEISHUM-MAN',NULL),(32,'Program Studi Arsitektur','Ketua',3,4,93,20113793,'',20113783,'','','',0,'FST-ARS',NULL),(33,'Program Studi Komunikasi','Ketua',3,3,94,20114877,'',20113796,'00','-','-',0,'FEISHUM-KOM',NULL),(34,'Program Studi Administrasi Publik','Ketua',3,4,94,20114875,'',20113796,'','','',0,'FEISHUM-ADP',NULL),(35,'Program Studi Psikologi','Ketua',3,4,94,20116527,'',20113796,'','','',0,'FEISHUM-PSI',NULL),(36,'Program Studi Bioteknologi','Ketua',3,4,93,20116382,'',20113783,'','','',0,'FST-BIO',NULL),(37,'Badan Perencanaan dan Pengembangan','Kepala',4,3,13,3222,'',3208,'','','',1,NULL,NULL),(38,'Biro Admisi dan Humas','Kepala',4,5,96,0,'',3212,'','','',1,NULL,NULL),(39,'Biro Aset dan Umum','Kepala',4,5,96,20114776,'',3212,'','','',0,NULL,NULL),(93,'Fakultas Sains dan Teknologi','Dekan',2,3,13,20113783,'',3208,'','','',0,'FST',NULL),(94,'Fakultas Ekonomi, Ilmu Sosial, dan Humaniora','Dekan',2,3,13,20113796,'',3208,'','','',0,'FEISHUM',NULL),(95,'Fakultas Ilmu Kesehatan','Dekan',2,3,13,20110845,'',3208,'','','',0,'FIKes',NULL),(96,'Wakil Rektor II','Warek',1,2,98,3212,'',3208,'','','',0,NULL,NULL),(97,'Wakil Rektor I','Warek',1,2,98,20114894,'',3208,'','','',0,NULL,NULL),(98,'Rektor','',1,1,0,3208,'',0,'','','',0,NULL,NULL),(99,'Ketua ','',1,1,99,3208,'',3208,'SPP-16','SPM-16','SPJ-16',1,NULL,NULL),(100,'Universitas','',NULL,0,0,0,'',0,'','','',0,NULL,NULL),(40,'Program Studi Gizi','Ketua',3,4,95,20112814,'',20110845,'','','',0,'FIKes-GIZ',NULL),(41,'Program Studi Teknologi Informasi','Ketua',3,4,93,20114866,'',20113783,'','','',0,'FST-TI',NULL),(45,'Komisi Etik Penelitian','Ketua',3,2,97,3224,' ',20114894,' ',' ',' ',0,NULL,NULL),(42,'Biro Pengembangan dan Perencanaan','Kepala',4,3,13,3188,'',3208,'','','',0,NULL,NULL),(43,'Biro Admisi','Kepala',4,5,96,1472,'',3212,'','','',0,NULL,NULL),(44,'Biro Humas, Kerjasama dan Protokoler','Kepala',4,5,96,4174,'',3212,'','','',0,NULL,NULL),(46,'Program Studi Kebidanan','Ketua',3,4,95,4237,'',20110845,'','','',0,'FIKes-MID',NULL),(47,'Program Studi Keperawatan Anestesiologi','Ketua',3,4,95,4151,'',20110845,'','','',0,'FIKes-KAN',NULL),(48,'Program Pendidikan Profesi Bidan','Ketua',3,4,95,4237,'',20110845,'','','',0,NULL,NULL),(92,'Wakil Rektor III','Warek',1,2,98,3151,'',3208,'','','',0,'',NULL),(49,'Program Studi Keperawatan','Ketua',3,4,95,944,'',20110845,'SPP-03','SPM-03','SPJ-03',0,'FIKes-NAP',NULL),(50,'Program Pendidikan Profesi Ners','Ketua',3,4,95,944,'',20110845,'SPP-05','SPM-05','SPJ-05',0,'FIKes-NAP',NULL),(51,'Program Pendidikan Profesi Fisioterapi','Ketua',3,4,95,20111981,'',20110845,'','','',0,'FIKes-SFT',NULL),(52,'Program Studi Teknologi Laboratorium Medis','Ketua',3,4,95,20113773,'',20110845,'','','',0,'FIKes-TLM',NULL),(53,'Program Studi Merdeka Belajar','Ketua',3,4,0,0,'',0,'','','',0,'MBKM',NULL),(54,'-- Tidak Ada --','Kosong',0,0,0,0,'0',0,' ',' ',' ',0,' ',NULL),(55,'Program Studi Ilmu Komunikasi','Ketua',3,3,94,20114877,'',20113796,'00','-','-',0,'FEISHUM-KOM',NULL),(56,'Program Studi Kebidanan','Ketua',3,4,95,3371,'',20110845,'SPP-07','SPM-07','SPJ-07',0,'FIKes-MIK',NULL),(57,'Aisyiyah Center','Ketua',4,4,0,20118708,'0',0,' ',' ',' ',0,NULL,NULL),(58,'Pusat Studi Wanita','Ketua',4,4,0,3149,'0',0,'  ',' ',' ',0,NULL,NULL),(59,'Wakil Dekan 1 Fikes','Wakil',4,4,0,3394,'0',20110845,'-','-','-',0,'-',NULL),(60,'Wakil Dekan II Fikes','Wakil',4,4,0,3191,'0',20110845,'-','-','-',0,'-',NULL),(61,'Wakil Dekan 1 FST','Wakil',4,4,0,20113791,'0',20113783,'-','-','-',0,'-',NULL),(62,'Wakil Dekan II FST','Wakil',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(63,'Wakil Dekan 1 FEISHUM','Wakil',4,4,0,20113776,'0',20113796,'-','-','-',0,'-',NULL),(64,'Wakil Dekan II FEISHUM','Wakil',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(65,'Ses. Prodi Teknologi Laboratorium Medik-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(66,'Ses. Prodi Radiologi-D3','Sekprodi',4,4,0,20116528,'0',20114849,'-','-','-',0,'-',NULL),(67,'Ses. Prodi Akuntansi-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(68,'Ses. Prodi Manajemen-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(69,'Ses. Prodi Arsitektur-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(70,'Ses. Prodi Ilmu Komunikasi-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(71,'Ses. Prodi Administrasi Publik-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(72,'Ses. Prodi Psikologi-S1','Sekprodi',4,4,0,20114874,'0',20116527,'-','-','-',0,'-',NULL),(73,'Ses. Prodi Bioteknologi-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(74,'Ses. Prodi Gizi-S1','Sekprodi',4,4,0,20114858,'0',20112814,'-','-','-',0,'-',NULL),(75,'Ses. Prodi Teknologi Informasi-S1','Sekprodi',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(76,'Ses. Prodi Anestesiologi-D4','Sekprodi',4,4,0,20123140,'0',4151,'-','-','-',0,'-',NULL),(77,'Wakil Dekan III Fikes','Wakil',4,4,0,866,'0',20110845,'-','-','-',0,'-',NULL),(78,'Wakil Dekan III FST','Wakil',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(79,'Wakil Dekan III FEISHUM','Wakil',4,4,0,0,'0',0,'-','-','-',0,'-',NULL),(80,'LAZISMu','',0,0,0,0,'0',0,'-','-','-',0,'-',NULL);
/*!40000 ALTER TABLE `pt_unitkerja` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-21 11:39:35
