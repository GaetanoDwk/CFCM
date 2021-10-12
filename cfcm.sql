-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cfcm
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `azienda`
--

DROP TABLE IF EXISTS `azienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `azienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rsoc` varchar(255) DEFAULT NULL,
  `ctu` varchar(255) DEFAULT NULL,
  `indi` varchar(255) DEFAULT NULL,
  `cap` varchar(255) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `tele` varchar(255) DEFAULT NULL,
  `cell` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `piva` varchar(255) DEFAULT NULL,
  `rea` varchar(255) DEFAULT NULL,
  `def` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `azienda`
--

LOCK TABLES `azienda` WRITE;
/*!40000 ALTER TABLE `azienda` DISABLE KEYS */;
/*!40000 ALTER TABLE `azienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caso`
--

DROP TABLE IF EXISTS `caso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caso` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_num` varchar(50) NOT NULL,
  `ca_inc` varchar(255) DEFAULT NULL,
  `ca_tipo` varchar(50) NOT NULL,
  `ca_dss` varchar(255) NOT NULL,
  `ex_id_pm` int(11) NOT NULL,
  PRIMARY KEY (`ca_id`) USING BTREE,
  KEY `vincolo_id_pm` (`ex_id_pm`) USING BTREE,
  KEY `ca_id` (`ca_id`) USING BTREE,
  CONSTRAINT `caso_ibfk_1` FOREIGN KEY (`ex_id_pm`) REFERENCES `pm` (`pm_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caso`
--

LOCK TABLES `caso` WRITE;
/*!40000 ALTER TABLE `caso` DISABLE KEYS */;
/*!40000 ALTER TABLE `caso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) NOT NULL,
  `cli_citta` varchar(50) NOT NULL,
  `is_ctp` tinyint(4) DEFAULT 0,
  `is_procura` tinyint(4) DEFAULT 0,
  `is_tribunale` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`cli_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (50,'Procura della Repubblica Tribunale di TEST','TEST',0,1,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clone`
--

DROP TABLE IF EXISTS `clone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clone` (
  `clo_id` int(11) NOT NULL AUTO_INCREMENT,
  `clo_tipoacq` varchar(50) DEFAULT NULL,
  `clo_altro_tipo` varchar(255) DEFAULT NULL,
  `clo_stracq` varchar(50) DEFAULT NULL,
  `clo_md5` varchar(32) DEFAULT NULL,
  `clo_sha1` varchar(40) DEFAULT NULL,
  `clo_sha256` varchar(64) DEFAULT NULL,
  `clo_log` varchar(100) DEFAULT NULL,
  `ex_id_evi` int(11) DEFAULT NULL,
  `ex_id_host_special` int(11) DEFAULT NULL,
  PRIMARY KEY (`clo_id`) USING BTREE,
  KEY `f_id_evi` (`ex_id_evi`) USING BTREE,
  CONSTRAINT `clone_ibfk_1` FOREIGN KEY (`ex_id_evi`) REFERENCES `evidence` (`evi_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2773 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clone`
--

LOCK TABLES `clone` WRITE;
/*!40000 ALTER TABLE `clone` DISABLE KEYS */;
/*!40000 ALTER TABLE `clone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evidence`
--

DROP TABLE IF EXISTS `evidence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evidence` (
  `evi_id` int(11) NOT NULL AUTO_INCREMENT,
  `evi_etichetta` varchar(50) DEFAULT NULL,
  `evi_tipo` varchar(50) DEFAULT NULL,
  `evi_modello` varchar(50) DEFAULT NULL,
  `evi_seriale` varchar(50) DEFAULT NULL,
  `evi_pwd` varchar(255) DEFAULT NULL,
  `evi_pwd_used` tinyint(1) DEFAULT 0,
  `evi_dimensione` varchar(10) DEFAULT NULL,
  `evi_kbmbgbtb` varchar(4) NOT NULL,
  `evi_pathfoto` varchar(255) DEFAULT NULL,
  `evi_image1` varchar(50) DEFAULT NULL,
  `evi_image2` varchar(50) DEFAULT NULL,
  `evi_image3` varchar(50) DEFAULT NULL,
  `evi_image_docx` varchar(50) DEFAULT NULL,
  `ex_id_host` int(11) NOT NULL,
  PRIMARY KEY (`evi_id`) USING BTREE,
  KEY `Vincolo Id Host` (`ex_id_host`) USING BTREE,
  CONSTRAINT `evidence_ibfk_1` FOREIGN KEY (`ex_id_host`) REFERENCES `host` (`ho_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1880 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evidence`
--

LOCK TABLES `evidence` WRITE;
/*!40000 ALTER TABLE `evidence` DISABLE KEYS */;
/*!40000 ALTER TABLE `evidence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ftktool_mail`
--

DROP TABLE IF EXISTS `ftktool_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ftktool_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `submit` varchar(255) DEFAULT NULL,
  `delivery` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `psize` varchar(255) DEFAULT '',
  `lsize` varchar(255) DEFAULT NULL,
  `deleted` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ftktool_mail`
--

LOCK TABLES `ftktool_mail` WRITE;
/*!40000 ALTER TABLE `ftktool_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `ftktool_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host` (
  `ho_id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_etichetta` varchar(100) DEFAULT NULL,
  `ho_seriale` varchar(100) DEFAULT NULL,
  `ho_pwd` varchar(255) DEFAULT NULL,
  `ho_pwd_used` tinyint(1) DEFAULT 0,
  `ho_tipo` varchar(100) DEFAULT NULL,
  `ho_modello` varchar(255) DEFAULT NULL,
  `ho_pathfoto` varchar(255) DEFAULT NULL,
  `ho_image1` varchar(50) DEFAULT NULL,
  `ho_image2` varchar(50) DEFAULT NULL,
  `ho_image3` varchar(50) DEFAULT NULL,
  `ho_image4` varchar(50) DEFAULT NULL,
  `ho_image_docx` varchar(50) DEFAULT NULL,
  `ho_image_docx2` varchar(50) DEFAULT NULL,
  `ex_id_caso` int(11) DEFAULT NULL,
  `ex_id_indagato` int(11) NOT NULL,
  PRIMARY KEY (`ho_id`) USING BTREE,
  KEY `f_id_caso` (`ex_id_caso`) USING BTREE,
  KEY `vincolo_id_indag` (`ex_id_indagato`) USING BTREE,
  CONSTRAINT `host_ibfk_1` FOREIGN KEY (`ex_id_indagato`) REFERENCES `indagato` (`ind_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1282 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `host_special`
--

DROP TABLE IF EXISTS `host_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host_special` (
  `ho_id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_etichetta` varchar(100) DEFAULT NULL,
  `ho_seriale` varchar(100) DEFAULT NULL,
  `ho_tipo` varchar(100) DEFAULT NULL,
  `ho_modello` varchar(255) DEFAULT NULL,
  `ho_dimensione` varchar(50) DEFAULT NULL,
  `ho_kbmbgbtb` varchar(4) DEFAULT NULL,
  `ho_pathfoto` varchar(255) DEFAULT NULL,
  `ho_image1` varchar(50) DEFAULT NULL,
  `ho_image2` varchar(50) DEFAULT NULL,
  `ho_image3` varchar(50) DEFAULT NULL,
  `ho_image4` varchar(50) DEFAULT NULL,
  `ho_image_docx` varchar(50) DEFAULT NULL,
  `ho_image_docx2` varchar(50) DEFAULT NULL,
  `ex_id_caso` int(11) DEFAULT NULL,
  `ex_id_indagato` int(11) NOT NULL,
  PRIMARY KEY (`ho_id`) USING BTREE,
  KEY `f_id_caso` (`ex_id_caso`) USING BTREE,
  KEY `vincolo_id_indag` (`ex_id_indagato`) USING BTREE,
  CONSTRAINT `host_special_ibfk_1` FOREIGN KEY (`ex_id_indagato`) REFERENCES `indagato` (`ind_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=778 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host_special`
--

LOCK TABLES `host_special` WRITE;
/*!40000 ALTER TABLE `host_special` DISABLE KEYS */;
/*!40000 ALTER TABLE `host_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indagato`
--

DROP TABLE IF EXISTS `indagato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indagato` (
  `ind_id` int(11) NOT NULL AUTO_INCREMENT,
  `ind_titolo` varchar(255) DEFAULT NULL,
  `ind_nome` varchar(50) DEFAULT NULL,
  `ind_cognome` varchar(50) DEFAULT NULL,
  `ex_id_caso` int(11) NOT NULL,
  PRIMARY KEY (`ind_id`) USING BTREE,
  KEY `vincolo_id_caso` (`ex_id_caso`) USING BTREE,
  CONSTRAINT `indagato_ibfk_1` FOREIGN KEY (`ex_id_caso`) REFERENCES `caso` (`ca_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=552 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indagato`
--

LOCK TABLES `indagato` WRITE;
/*!40000 ALTER TABLE `indagato` DISABLE KEYS */;
/*!40000 ALTER TABLE `indagato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lavorazione`
--

DROP TABLE IF EXISTS `lavorazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lavorazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) DEFAULT NULL,
  `pm` varchar(255) DEFAULT NULL,
  `procura` varchar(255) DEFAULT NULL,
  `dinizio` date DEFAULT NULL,
  `gg` int(5) DEFAULT NULL,
  `dfine` date DEFAULT NULL,
  `ggrestanti` int(5) DEFAULT NULL,
  `copia` tinyint(4) DEFAULT 0,
  `ftk` tinyint(4) DEFAULT 0,
  `ief` tinyint(4) DEFAULT 0,
  `analisi` tinyint(4) DEFAULT 0,
  `exprep` tinyint(4) DEFAULT 0,
  `dim` tinyint(4) DEFAULT 0,
  `allegati` tinyint(4) DEFAULT 0,
  `liquidazione` tinyint(4) DEFAULT 0,
  `difficolta` tinyint(4) DEFAULT 0,
  `progresso` tinyint(4) DEFAULT 0,
  `note` varchar(255) DEFAULT NULL,
  `operatore` varchar(255) DEFAULT NULL,
  `last_upd_ggrestanti` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lavorazione`
--

LOCK TABLES `lavorazione` WRITE;
/*!40000 ALTER TABLE `lavorazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `lavorazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazzino`
--

DROP TABLE IF EXISTS `magazzino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazzino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procura` varchar(255) NOT NULL,
  `pm` varchar(255) NOT NULL,
  `dossier` varchar(255) NOT NULL,
  `plico` tinyint(4) NOT NULL,
  `dataC` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazzino`
--

LOCK TABLES `magazzino` WRITE;
/*!40000 ALTER TABLE `magazzino` DISABLE KEYS */;
/*!40000 ALTER TABLE `magazzino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pm`
--

DROP TABLE IF EXISTS `pm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `pm_titolo` varchar(10) NOT NULL,
  `pm_nome` varchar(50) NOT NULL,
  `pm_cognome` varchar(50) NOT NULL,
  `ex_id_cli` int(11) DEFAULT NULL,
  PRIMARY KEY (`pm_id`) USING BTREE,
  KEY `id_pro` (`ex_id_cli`) USING BTREE,
  CONSTRAINT `pm_ibfk_1` FOREIGN KEY (`ex_id_cli`) REFERENCES `cliente` (`cli_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pm`
--

LOCK TABLES `pm` WRITE;
/*!40000 ALTER TABLE `pm` DISABLE KEYS */;
/*!40000 ALTER TABLE `pm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_acquisizione`
--

DROP TABLE IF EXISTS `tipo_acquisizione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_acquisizione` (
  `acq_id` int(11) NOT NULL AUTO_INCREMENT,
  `acq_tipo` varchar(255) DEFAULT NULL,
  `acq_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acq_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_acquisizione`
--

LOCK TABLES `tipo_acquisizione` WRITE;
/*!40000 ALTER TABLE `tipo_acquisizione` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_acquisizione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_evidence`
--

DROP TABLE IF EXISTS `tipo_evidence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_evidence` (
  `evi_id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `evi_tipo` varchar(255) NOT NULL,
  `evi_default` tinyint(4) NOT NULL,
  `evi_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`evi_id_tipo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_evidence`
--

LOCK TABLES `tipo_evidence` WRITE;
/*!40000 ALTER TABLE `tipo_evidence` DISABLE KEYS */;
INSERT INTO `tipo_evidence` VALUES (1,'HardDisk',1,'font/icon/HardDisk.png'),(2,'MemoryCard',1,'font/icon/MemoryCard.png'),(3,'SimCard',1,'font/icon/SimCard.png'),(4,'Memoria',1,'font/icon/Memoria.png'),(5,'PenDrive',1,'font/icon/PenDrive.png'),(6,'Cd-Dvd',1,'font/icon/Cd-Dvd.png'),(7,'File',1,'font/icon/File.png'),(8,'Cartella',1,'font/icon/Cartella.png'),(9,'SolidStateDrive',0,'font/icon/SolidStateDrive.png'),(10,'RAID',0,'font/icon/RAID.png'),(11,'Fusion Drive',0,'font/icon/FusionDrive.png');
/*!40000 ALTER TABLE `tipo_evidence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_host`
--

DROP TABLE IF EXISTS `tipo_host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_host` (
  `ho_id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `ho_tipo` varchar(255) NOT NULL,
  `ho_default` tinyint(4) NOT NULL,
  `ho_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ho_id_tipo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_host`
--

LOCK TABLES `tipo_host` WRITE;
/*!40000 ALTER TABLE `tipo_host` DISABLE KEYS */;
INSERT INTO `tipo_host` VALUES (1,'Nas',1,'font/icon/nas.png'),(2,'Server',1,'font/icon/server.png'),(3,'Tablet',1,'font/icon/tablet.png'),(4,'Notebook',1,'font/icon/notebook.png'),(5,'Smartphone',1,'font/icon/smartphone.png'),(6,'Cellulare',1,'font/icon/cellulare.png'),(7,'Workstation',1,'font/icon/workstation.png'),(8,'Hard Disk Esterno',1,'font/icon/HardDiskEsterno.png'),(9,'DVR',0,'font/icon/dvr.png'),(10,'Internet Key',0,'font/icon/InternetKey.png'),(11,'POS',0,'font/icon/pos.png'),(12,'Lettore MP3',0,'font/icon/lettoremp3.png'),(13,'Action Camera',0,'font/icon/actioncamera.png');
/*!40000 ALTER TABLE `tipo_host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_host_special`
--

DROP TABLE IF EXISTS `tipo_host_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_host_special` (
  `hos_tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_tipo` varchar(255) NOT NULL,
  `hos_default` tinyint(4) NOT NULL DEFAULT 0,
  `hos_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hos_tipo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_host_special`
--

LOCK TABLES `tipo_host_special` WRITE;
/*!40000 ALTER TABLE `tipo_host_special` DISABLE KEYS */;
INSERT INTO `tipo_host_special` VALUES (3,'Hard Disk',1,NULL),(4,'Hard Disk Esterno',1,NULL),(5,'MemoryCard',1,NULL),(6,'SimCard',1,NULL),(7,'PenDrive',1,NULL),(8,'Cd-Dvd',1,NULL),(10,'Posta Elettronica',0,NULL),(11,'Floppy Disk',0,NULL),(12,'SolidStateDrive',0,NULL),(13,'Altro',0,NULL),(14,'LOG',0,NULL),(15,'SSD Esterno',0,'font/icon/SSDEsterno.png'),(16,'Cloud',0,'font/icon/Cloud.png');
/*!40000 ALTER TABLE `tipo_host_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `path` varchar(255) DEFAULT '',
  `md5` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools`
--

LOCK TABLES `tools` WRITE;
/*!40000 ALTER TABLE `tools` DISABLE KEYS */;
/*!40000 ALTER TABLE `tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `ute_id` int(11) NOT NULL AUTO_INCREMENT,
  `ute_username` varchar(255) NOT NULL DEFAULT '',
  `ute_password` varchar(255) NOT NULL DEFAULT '',
  `ute_nome` varchar(30) NOT NULL DEFAULT '',
  `ute_cognome` varchar(30) NOT NULL DEFAULT '',
  `ute_isadmin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ute_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (5,'admin','21232f297a57a5a743894a0e4a801fc3','Admin','Admin',1);
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-05  1:15:15
