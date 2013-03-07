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
-- Table structure for table `categorias_apuestas`
--

DROP TABLE IF EXISTS `categorias_apuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_apuestas` (
  `idcategoria_apuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `idapuesta` int(11) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idcategoria_apuesta`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idapuesta` (`idapuesta`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_apuestas`
--
-- ORDER BY:  `idcategoria_apuesta`

LOCK TABLES `categorias_apuestas` WRITE;
/*!40000 ALTER TABLE `categorias_apuestas` DISABLE KEYS */;
INSERT INTO `categorias_apuestas` (`idcategoria_apuesta`, `idcategoria`, `idapuesta`, `estatus`) VALUES (16,1,17,1),(17,1,18,1),(18,1,19,0),(19,1,1,1),(20,1,2,1),(21,1,3,1),(22,1,4,1),(23,2,1,1),(24,2,2,1),(25,2,3,1),(26,2,4,1),(27,2,17,1),(28,2,18,1),(29,2,19,1),(30,2,20,1),(31,2,9,1),(32,2,10,1),(33,2,11,1),(34,2,12,1),(35,2,7,1),(36,2,8,1),(37,2,13,1),(38,2,14,1),(39,2,15,1),(40,2,16,1),(41,1,9,1),(42,1,10,1),(43,1,11,1),(44,1,12,1),(45,6,1,1),(46,6,3,1),(47,2,21,1),(48,2,22,1),(49,1,23,1),(50,1,24,1),(51,1,20,0),(52,1,7,1),(53,1,8,1),(54,2,25,0),(55,2,26,0),(56,3,1,1),(57,3,2,1),(58,3,3,1),(59,3,4,1),(60,3,17,1),(61,3,18,1),(62,3,19,1),(63,3,20,1),(64,3,9,1),(65,3,10,1),(66,3,11,1),(67,3,12,1),(68,3,7,1),(69,3,8,1),(70,2,27,1),(71,2,28,1),(72,2,29,1),(73,2,30,1),(74,2,31,1),(75,2,32,0),(76,2,33,0),(77,2,34,1),(78,2,35,1),(79,2,36,1),(80,2,37,1),(81,2,38,1),(82,3,37,1),(83,3,38,1),(84,3,39,1),(85,3,40,1),(86,3,41,1),(87,3,42,1),(88,3,43,1),(89,3,44,1),(90,3,45,1),(91,3,46,1),(92,3,34,1),(93,3,35,1),(94,3,36,1),(95,6,17,1),(96,6,18,1),(97,6,19,0),(99,6,4,1),(100,6,1,1),(101,6,2,1),(102,6,9,1),(103,6,10,1),(104,6,11,1),(105,6,12,1),(106,6,23,1),(107,6,24,1),(108,6,20,0),(109,6,7,1),(110,6,8,1),(111,6,3,1);
/*!40000 ALTER TABLE `categorias_apuestas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:26
