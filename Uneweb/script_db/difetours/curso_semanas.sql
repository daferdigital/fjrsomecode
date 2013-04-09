CREATE DATABASE  IF NOT EXISTS `difetours` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `difetours`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: difetours
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `curso_semanas`
--

DROP TABLE IF EXISTS `curso_semanas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_semanas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minimo_semanas` int(11) NOT NULL,
  `maximo_semanas` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_modalidad` int(10) unsigned NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SEMANAS_MODALIDAD` (`id_modalidad`),
  KEY `FK_SEMANA_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_SEMANA_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_SEMANA_MODALIDAD` FOREIGN KEY (`id_modalidad`) REFERENCES `curso_modalidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1385 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_semanas`
--

LOCK TABLES `curso_semanas` WRITE;
/*!40000 ALTER TABLE `curso_semanas` DISABLE KEYS */;
INSERT INTO `curso_semanas` (`id`, `minimo_semanas`, `maximo_semanas`, `precio`, `id_modalidad`, `id_destino`) VALUES (1245,1,3,288,5,2),(1246,1,3,236,6,2),(1247,1,3,172,7,2),(1248,1,3,136,8,2),(1249,4,11,280,5,2),(1250,4,11,236,6,2),(1251,4,11,172,7,2),(1252,4,11,136,8,2),(1253,12,15,264,5,2),(1254,12,15,228,6,2),(1255,12,15,164,7,2),(1256,12,15,128,8,2),(1257,16,23,256,5,2),(1258,16,23,220,6,2),(1259,16,23,164,7,2),(1260,16,23,128,8,2),(1261,24,31,248,5,2),(1262,24,31,216,6,2),(1263,24,31,152,7,2),(1264,24,31,120,8,2),(1265,32,54,244,5,2),(1266,32,54,208,6,2),(1267,32,54,152,7,2),(1268,32,54,120,8,2),(1269,1,3,288,9,3),(1270,1,3,236,10,3),(1271,1,3,172,11,3),(1272,1,3,136,12,3),(1273,4,11,280,9,3),(1274,4,11,236,10,3),(1275,4,11,172,11,3),(1276,4,11,136,12,3),(1277,12,15,264,9,3),(1278,12,15,228,10,3),(1279,12,15,164,11,3),(1280,12,15,128,12,3),(1281,16,23,256,9,3),(1282,16,23,220,10,3),(1283,16,23,164,11,3),(1284,16,23,128,12,3),(1285,24,31,248,9,3),(1286,24,31,216,10,3),(1287,24,31,152,11,3),(1288,24,31,120,12,3),(1289,32,54,244,9,3),(1290,32,54,208,10,3),(1291,32,54,152,11,3),(1292,32,54,120,12,3),(1293,1,3,288,13,4),(1294,1,3,236,14,4),(1295,1,3,172,15,4),(1296,1,3,136,16,4),(1297,4,11,280,13,4),(1298,4,11,236,14,4),(1299,4,11,172,15,4),(1300,4,11,136,16,4),(1301,12,15,264,13,4),(1302,12,15,228,14,4),(1303,12,15,164,15,4),(1304,12,15,128,16,4),(1305,16,23,256,13,4),(1306,16,23,220,14,4),(1307,16,23,164,15,4),(1308,16,23,128,16,4),(1309,24,31,248,13,4),(1310,24,31,216,14,4),(1311,24,31,152,15,4),(1312,24,31,120,16,4),(1313,32,54,244,13,4),(1314,32,54,208,14,4),(1315,32,54,152,15,4),(1316,32,54,120,16,4),(1361,1,3,288,35,1),(1362,1,3,236,36,1),(1363,1,3,172,37,1),(1364,1,3,136,38,1),(1365,4,11,280,35,1),(1366,4,11,236,36,1),(1367,4,11,172,37,1),(1368,4,11,136,38,1),(1369,12,15,264,35,1),(1370,12,15,228,36,1),(1371,12,15,164,37,1),(1372,12,15,128,38,1),(1373,16,23,256,35,1),(1374,16,23,220,36,1),(1375,16,23,164,37,1),(1376,16,23,128,38,1),(1377,24,31,248,35,1),(1378,24,31,216,36,1),(1379,24,31,152,37,1),(1380,24,31,120,38,1),(1381,32,54,244,35,1),(1382,32,54,208,36,1),(1383,32,54,152,37,1),(1384,32,54,120,38,1);
/*!40000 ALTER TABLE `curso_semanas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-22 12:28:15