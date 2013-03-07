CREATE DATABASE  IF NOT EXISTS `ingenier_sistema` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ingenier_sistema`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: ingenier_sistema
-- ------------------------------------------------------
-- Server version	5.5.24

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
-- Table structure for table `perfil_accesos`
--

DROP TABLE IF EXISTS `perfil_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_accesos` (
  `id_perfil_accesos` int(10) NOT NULL AUTO_INCREMENT,
  `id_perfil_programa` int(10) NOT NULL,
  `idusuario` int(10) NOT NULL,
  `id_perfil` int(10) NOT NULL,
  PRIMARY KEY (`id_perfil_accesos`)
) ENGINE=MyISAM AUTO_INCREMENT=1067 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_accesos`
--
-- ORDER BY:  `id_perfil_accesos`

LOCK TABLES `perfil_accesos` WRITE;
/*!40000 ALTER TABLE `perfil_accesos` DISABLE KEYS */;
INSERT INTO `perfil_accesos` (`id_perfil_accesos`, `id_perfil_programa`, `idusuario`, `id_perfil`) VALUES (59,18,1,0),(60,19,1,0),(61,20,1,0),(62,21,1,0),(85,1,6,2),(86,2,6,2),(87,3,6,2),(117,1,5,6),(118,2,5,6),(119,3,5,6),(120,4,5,6),(121,5,5,6),(122,6,5,6),(123,7,5,6),(124,8,5,6),(125,9,5,6),(126,11,5,6),(127,10,5,6),(128,12,5,6),(129,13,5,6),(130,14,5,6),(131,15,5,6),(132,16,5,6),(133,18,5,6),(134,19,5,6),(135,20,5,6),(136,21,5,6),(631,1,1,1),(632,3,1,1),(633,4,1,1),(634,5,1,1),(635,6,1,1),(636,7,1,1),(637,8,1,1),(638,9,1,1),(639,11,1,1),(640,10,1,1),(641,12,1,1),(642,13,1,1),(643,14,1,1),(644,15,1,1),(645,16,1,1),(646,26,1,1),(647,27,1,1),(648,28,1,1),(649,18,1,1),(650,19,1,1),(651,24,1,1),(652,20,1,1),(653,23,1,1),(654,21,1,1),(732,10,12,6),(733,16,12,6),(763,1,7,6),(764,10,7,6),(765,16,7,6),(766,6,7,6),(838,1,10,6),(839,28,10,6),(840,11,10,6),(841,10,10,6),(842,12,10,6),(843,16,10,6),(844,6,10,6),(874,1,3,3),(875,30,3,3),(876,28,3,3),(877,11,3,3),(878,13,3,3),(879,14,3,3),(880,15,3,3),(881,16,3,3),(882,1,2,2),(883,30,2,2),(884,28,2,2),(885,8,2,2),(886,9,2,2),(887,11,2,2),(888,25,2,2),(889,13,2,2),(890,14,2,2),(891,15,2,2),(892,16,2,2),(893,1,6,1),(894,30,6,1),(895,26,6,1),(896,27,6,1),(897,28,6,1),(898,7,6,1),(899,8,6,1),(900,9,6,1),(901,11,6,1),(902,10,6,1),(903,12,6,1),(904,13,6,1),(905,14,6,1),(906,15,6,1),(907,16,6,1),(908,18,6,1),(909,19,6,1),(910,24,6,1),(911,20,6,1),(912,23,6,1),(913,21,6,1),(914,29,6,1),(915,3,6,1),(916,4,6,1),(917,5,6,1),(918,6,6,1),(919,1,8,1),(920,30,8,1),(921,11,8,1),(922,10,8,1),(923,12,8,1),(924,16,8,1),(925,1,4,4),(926,30,4,4),(927,2,4,4),(928,26,4,4),(929,27,4,4),(930,28,4,4),(931,11,4,4),(932,13,4,4),(933,14,4,4),(934,15,4,4),(935,16,4,4),(938,1,2,6),(939,10,2,6),(940,12,2,6),(941,16,2,6),(946,1,11,6),(947,11,11,6),(948,10,11,6),(949,12,11,6),(950,16,11,6),(951,6,11,6),(952,1,9,6),(953,11,9,6),(954,10,9,6),(955,12,9,6),(956,16,9,6),(957,6,9,6),(991,12,13,6),(992,13,13,6),(993,16,13,6),(1006,28,13,1),(1007,11,13,1),(1008,12,13,1),(1009,16,13,1),(1010,1,11,1),(1011,30,11,1),(1012,28,11,1),(1013,11,11,1),(1014,10,11,1),(1015,12,11,1),(1016,13,11,1),(1017,16,11,1),(1018,6,11,1),(1027,10,5,1),(1028,16,5,1),(1029,5,5,1),(1042,1,14,1),(1043,30,14,1),(1044,11,14,1),(1045,10,14,1),(1046,16,14,1),(1047,5,14,1),(1048,6,14,1),(1049,1,9,1),(1050,11,9,1),(1051,10,9,1),(1052,12,9,1),(1053,16,9,1),(1054,6,9,1),(1061,30,10,1),(1062,11,10,1),(1063,10,10,1),(1064,12,10,1),(1065,16,10,1),(1066,6,10,1);
/*!40000 ALTER TABLE `perfil_accesos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:25
