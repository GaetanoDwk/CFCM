/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : cfcm

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 08/04/2021 01:14:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for azienda
-- ----------------------------
DROP TABLE IF EXISTS `azienda`;
CREATE TABLE `azienda`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rsoc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ctu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `indi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cap` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `citta` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tele` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cell` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `piva` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rea` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `def` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for caso
-- ----------------------------
DROP TABLE IF EXISTS `caso`;
CREATE TABLE `caso`  (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_num` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ca_inc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ca_tipo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ca_dss` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ca_datains` date NOT NULL,
  `ca_datadel` date NOT NULL,
  `ca_ggres` smallint(6) NOT NULL,
  `ex_id_pm` int(11) NOT NULL,
  PRIMARY KEY (`ca_id`) USING BTREE,
  INDEX `vincolo_id_pm`(`ex_id_pm`) USING BTREE,
  INDEX `ca_id`(`ca_id`) USING BTREE,
  CONSTRAINT `caso_ibfk_1` FOREIGN KEY (`ex_id_pm`) REFERENCES `pm` (`pm_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 255 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cli_citta` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_ctp` tinyint(4) NULL DEFAULT 0,
  `is_procura` tinyint(4) NULL DEFAULT 0,
  `is_tribunale` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`cli_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for clone
-- ----------------------------
DROP TABLE IF EXISTS `clone`;
CREATE TABLE `clone`  (
  `clo_id` int(11) NOT NULL AUTO_INCREMENT,
  `clo_tipoacq` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_altro_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_stracq` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_md5` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_sha1` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_sha256` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clo_log` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ex_id_evi` int(11) NULL DEFAULT NULL,
  `ex_id_host_special` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`clo_id`) USING BTREE,
  INDEX `f_id_evi`(`ex_id_evi`) USING BTREE,
  CONSTRAINT `clone_ibfk_1` FOREIGN KEY (`ex_id_evi`) REFERENCES `evidence` (`evi_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2768 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for evidence
-- ----------------------------
DROP TABLE IF EXISTS `evidence`;
CREATE TABLE `evidence`  (
  `evi_id` int(11) NOT NULL AUTO_INCREMENT,
  `evi_etichetta` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_tipo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_modello` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_seriale` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_pwd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_pwd_used` tinyint(1) NULL DEFAULT 0,
  `evi_dimensione` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_kbmbgbtb` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `evi_pathfoto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_image1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_image2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_image3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `evi_image_docx` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ex_id_host` int(11) NOT NULL,
  PRIMARY KEY (`evi_id`) USING BTREE,
  INDEX `Vincolo Id Host`(`ex_id_host`) USING BTREE,
  CONSTRAINT `evidence_ibfk_1` FOREIGN KEY (`ex_id_host`) REFERENCES `host` (`ho_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1876 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ftktool_mail
-- ----------------------------
DROP TABLE IF EXISTS `ftktool_mail`;
CREATE TABLE `ftktool_mail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `receiver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `submit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `psize` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `lsize` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for host
-- ----------------------------
DROP TABLE IF EXISTS `host`;
CREATE TABLE `host`  (
  `ho_id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_etichetta` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_seriale` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_pwd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_pwd_used` tinyint(1) NULL DEFAULT 0,
  `ho_tipo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_modello` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_pathfoto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image4` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image_docx` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image_docx2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ex_id_caso` int(11) NULL DEFAULT NULL,
  `ex_id_indagato` int(11) NOT NULL,
  PRIMARY KEY (`ho_id`) USING BTREE,
  INDEX `f_id_caso`(`ex_id_caso`) USING BTREE,
  INDEX `vincolo_id_indag`(`ex_id_indagato`) USING BTREE,
  CONSTRAINT `host_ibfk_1` FOREIGN KEY (`ex_id_indagato`) REFERENCES `indagato` (`ind_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1277 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for host_special
-- ----------------------------
DROP TABLE IF EXISTS `host_special`;
CREATE TABLE `host_special`  (
  `ho_id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_etichetta` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_seriale` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_tipo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_modello` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_dimensione` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_kbmbgbtb` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_pathfoto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image4` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image_docx` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ho_image_docx2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ex_id_caso` int(11) NULL DEFAULT NULL,
  `ex_id_indagato` int(11) NOT NULL,
  PRIMARY KEY (`ho_id`) USING BTREE,
  INDEX `f_id_caso`(`ex_id_caso`) USING BTREE,
  INDEX `vincolo_id_indag`(`ex_id_indagato`) USING BTREE,
  CONSTRAINT `host_special_ibfk_1` FOREIGN KEY (`ex_id_indagato`) REFERENCES `indagato` (`ind_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 777 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for indagato
-- ----------------------------
DROP TABLE IF EXISTS `indagato`;
CREATE TABLE `indagato`  (
  `ind_id` int(11) NOT NULL AUTO_INCREMENT,
  `ind_titolo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ind_nome` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ind_cognome` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ex_id_caso` int(11) NOT NULL,
  PRIMARY KEY (`ind_id`) USING BTREE,
  INDEX `vincolo_id_caso`(`ex_id_caso`) USING BTREE,
  CONSTRAINT `indagato_ibfk_1` FOREIGN KEY (`ex_id_caso`) REFERENCES `caso` (`ca_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 547 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lavorazione
-- ----------------------------
DROP TABLE IF EXISTS `lavorazione`;
CREATE TABLE `lavorazione`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pm` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `procura` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dinizio` date NULL DEFAULT NULL,
  `gg` int(5) NULL DEFAULT NULL,
  `dfine` date NULL DEFAULT NULL,
  `ggrestanti` int(5) NULL DEFAULT NULL,
  `copia` tinyint(4) NULL DEFAULT 0,
  `ftk` tinyint(4) NULL DEFAULT 0,
  `ief` tinyint(4) NULL DEFAULT 0,
  `analisi` tinyint(4) NULL DEFAULT 0,
  `exprep` tinyint(4) NULL DEFAULT 0,
  `dim` tinyint(4) NULL DEFAULT 0,
  `allegati` tinyint(4) NULL DEFAULT 0,
  `liquidazione` tinyint(4) NULL DEFAULT 0,
  `difficolta` tinyint(4) NULL DEFAULT 0,
  `progresso` tinyint(4) NULL DEFAULT 0,
  `note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `operatore` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_upd_ggrestanti` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 221 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for magazzino
-- ----------------------------
DROP TABLE IF EXISTS `magazzino`;
CREATE TABLE `magazzino`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procura` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dossier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `plico` tinyint(4) NOT NULL,
  `dataC` date NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pm
-- ----------------------------
DROP TABLE IF EXISTS `pm`;
CREATE TABLE `pm`  (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `pm_titolo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pm_nome` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pm_cognome` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ex_id_cli` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`pm_id`) USING BTREE,
  INDEX `id_pro`(`ex_id_cli`) USING BTREE,
  CONSTRAINT `pm_ibfk_1` FOREIGN KEY (`ex_id_cli`) REFERENCES `cliente` (`cli_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 129 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tipo_acquisizione
-- ----------------------------
DROP TABLE IF EXISTS `tipo_acquisizione`;
CREATE TABLE `tipo_acquisizione`  (
  `acq_id` int(11) NOT NULL AUTO_INCREMENT,
  `acq_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `acq_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`acq_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tipo_evidence
-- ----------------------------
DROP TABLE IF EXISTS `tipo_evidence`;
CREATE TABLE `tipo_evidence`  (
  `evi_id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `evi_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `evi_default` tinyint(4) NOT NULL,
  `evi_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`evi_id_tipo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_evidence
-- ----------------------------
INSERT INTO `tipo_evidence` VALUES (1, 'HardDisk', 1, 'font/icon/HardDisk.png');
INSERT INTO `tipo_evidence` VALUES (2, 'MemoryCard', 1, 'font/icon/MemoryCard.png');
INSERT INTO `tipo_evidence` VALUES (3, 'SimCard', 1, 'font/icon/SimCard.png');
INSERT INTO `tipo_evidence` VALUES (4, 'Memoria', 1, 'font/icon/Memoria.png');
INSERT INTO `tipo_evidence` VALUES (5, 'PenDrive', 1, 'font/icon/PenDrive.png');
INSERT INTO `tipo_evidence` VALUES (6, 'Cd-Dvd', 1, 'font/icon/Cd-Dvd.png');
INSERT INTO `tipo_evidence` VALUES (7, 'File', 1, 'font/icon/File.png');
INSERT INTO `tipo_evidence` VALUES (8, 'Cartella', 1, 'font/icon/Cartella.png');
INSERT INTO `tipo_evidence` VALUES (9, 'SolidStateDrive', 0, 'font/icon/SolidStateDrive.png');
INSERT INTO `tipo_evidence` VALUES (10, 'RAID', 0, 'font/icon/RAID.png');
INSERT INTO `tipo_evidence` VALUES (11, 'Fusion Drive', 0, 'font/icon/FusionDrive.png');

-- ----------------------------
-- Table structure for tipo_host
-- ----------------------------
DROP TABLE IF EXISTS `tipo_host`;
CREATE TABLE `tipo_host`  (
  `ho_id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `ho_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ho_default` tinyint(4) NOT NULL,
  `ho_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ho_id_tipo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_host
-- ----------------------------
INSERT INTO `tipo_host` VALUES (1, 'Nas', 1, 'font/icon/nas.png');
INSERT INTO `tipo_host` VALUES (2, 'Server', 1, 'font/icon/server.png');
INSERT INTO `tipo_host` VALUES (3, 'Tablet', 1, 'font/icon/tablet.png');
INSERT INTO `tipo_host` VALUES (4, 'Notebook', 1, 'font/icon/notebook.png');
INSERT INTO `tipo_host` VALUES (5, 'Smartphone', 1, 'font/icon/smartphone.png');
INSERT INTO `tipo_host` VALUES (6, 'Cellulare', 1, 'font/icon/cellulare.png');
INSERT INTO `tipo_host` VALUES (7, 'Workstation', 1, 'font/icon/workstation.png');
INSERT INTO `tipo_host` VALUES (8, 'Hard Disk Esterno', 1, 'font/icon/HardDiskEsterno.png');
INSERT INTO `tipo_host` VALUES (9, 'DVR', 0, 'font/icon/dvr.png');
INSERT INTO `tipo_host` VALUES (10, 'Internet Key', 0, 'font/icon/InternetKey.png');
INSERT INTO `tipo_host` VALUES (11, 'POS', 0, 'font/icon/pos.png');
INSERT INTO `tipo_host` VALUES (12, 'Lettore MP3', 0, 'font/icon/lettoremp3.png');
INSERT INTO `tipo_host` VALUES (13, 'Action Camera', 0, 'font/icon/actioncamera.png');

-- ----------------------------
-- Table structure for tipo_host_special
-- ----------------------------
DROP TABLE IF EXISTS `tipo_host_special`;
CREATE TABLE `tipo_host_special`  (
  `hos_tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hos_default` tinyint(4) NOT NULL DEFAULT 0,
  `hos_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`hos_tipo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_host_special
-- ----------------------------
INSERT INTO `tipo_host_special` VALUES (3, 'Hard Disk', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (4, 'Hard Disk Esterno', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (5, 'MemoryCard', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (6, 'SimCard', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (7, 'PenDrive', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (8, 'Cd-Dvd', 1, NULL);
INSERT INTO `tipo_host_special` VALUES (10, 'Posta Elettronica', 0, NULL);
INSERT INTO `tipo_host_special` VALUES (11, 'Floppy Disk', 0, NULL);
INSERT INTO `tipo_host_special` VALUES (12, 'SolidStateDrive', 0, NULL);
INSERT INTO `tipo_host_special` VALUES (13, 'Altro', 0, NULL);
INSERT INTO `tipo_host_special` VALUES (14, 'LOG', 0, NULL);
INSERT INTO `tipo_host_special` VALUES (15, 'SSD Esterno', 0, 'font/icon/SSDEsterno.png');
INSERT INTO `tipo_host_special` VALUES (16, 'Cloud', 0, 'font/icon/Cloud.png');

-- ----------------------------
-- Table structure for tools
-- ----------------------------
DROP TABLE IF EXISTS `tools`;
CREATE TABLE `tools`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `md5` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for utenti
-- ----------------------------
DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti`  (
  `ute_id` int(11) NOT NULL AUTO_INCREMENT,
  `ute_username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ute_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ute_nome` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ute_cognome` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ute_isadmin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ute_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of utenti
-- ----------------------------
INSERT INTO `utenti` VALUES (5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Admin', 1);

-- ----------------------------
-- Triggers structure for table caso
-- ----------------------------
DROP TRIGGER IF EXISTS `CalcoloScadenza`;
delimiter ;;
CREATE TRIGGER `CalcoloScadenza` BEFORE INSERT ON `caso` FOR EACH ROW BEGIN 
SET NEW.ca_datadel = DATE_ADD(DATE(NOW()), INTERVAL 365 DAY);
SET NEW.ca_datains = DATE(NOW());
SET NEW.ca_ggres = DATEDIFF(NEW.ca_datadel, NEW.ca_datains)-1;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
