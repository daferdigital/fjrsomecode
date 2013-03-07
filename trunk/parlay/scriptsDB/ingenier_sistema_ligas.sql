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
-- Table structure for table `ligas`
--

DROP TABLE IF EXISTS `ligas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ligas` (
  `idliga` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  `liga_padre` int(1) DEFAULT NULL,
  `otras_ligas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idliga`),
  KEY `idcategoria` (`idcategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ligas`
--
-- ORDER BY:  `idliga`

LOCK TABLES `ligas` WRITE;
/*!40000 ALTER TABLE `ligas` DISABLE KEYS */;
INSERT INTO `ligas` (`idliga`, `nombre`, `idcategoria`, `estatus`, `liga_padre`, `otras_ligas`) VALUES (1,'LVBP',2,1,0,NULL),(2,'LPB',3,1,0,NULL),(3,'Liga Beisbol Menor Aragua',2,1,0,NULL),(4,'DISPONIBLE',1,1,0,'|7|,|15|'),(5,'Futbol Espa?ol',1,1,0,''),(6,'Carabobo Basket',3,1,0,NULL),(7,'Futbol Venezolano 1era Division',1,1,0,''),(9,'Liga Mayor de Rugby Nacional',5,1,0,NULL),(10,'NFL',6,1,0,NULL),(11,'MLB Grandes Ligas de Beisbol',2,1,0,NULL),(12,'Futbol InglÃ¯Â¿Â½s',1,1,1,''),(13,'Futbol Italiano',1,1,1,''),(14,'Futbol AlemÃ¯Â¿Â½n',1,1,1,''),(15,'UEFA Champions League',1,1,0,''),(16,'NBA',3,1,0,NULL),(17,'Paises',1,1,1,'|34|,|27|'),(18,'Basket Venezolano',3,1,1,NULL),(20,'Futbol Mexicano 1era Division',1,1,0,''),(21,'Copa Libertadores',1,1,0,''),(22,'Futbol Argentino 1era Division',1,1,0,''),(23,'Futbol Profesional Colombiano',1,1,0,''),(24,'Major League Soccer de EE.UU',1,1,0,''),(25,'Futbol de Portugal',1,1,0,''),(26,'Copa del Rey',1,1,0,''),(27,'EUROCOPA 2012',1,1,0,''),(28,'BOXEO INTERNACIONAL',1,1,0,''),(29,'WNBA',3,1,0,''),(30,'Futbol Brasileirao',1,1,0,''),(31,'Primera Division De Ecuador',1,1,0,''),(32,'Primera Division De Peru',1,1,0,''),(33,'Primera Division De Chile',1,1,0,''),(34,'Copa Sudamericana',1,1,0,''),(35,'CONCACAF liga de campeones',1,1,1,''),(36,'World Football Challenge ',1,1,1,''),(37,'Centro America',1,1,1,''),(38,'FUTBOL HOLANDES ',1,1,1,''),(39,'FUTBOL FRANCES ',1,1,1,''),(40,'SUPER COPA UEFA 2012',1,1,1,''),(41,'FUTBOL URUGUAY',1,1,1,''),(42,'FUTBOL PARAGUAY',1,1,1,''),(43,'UEFA EUROPA LEAGUE',1,1,0,'');
/*!40000 ALTER TABLE `ligas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:29
