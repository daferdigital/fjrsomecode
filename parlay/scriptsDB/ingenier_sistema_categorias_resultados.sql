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
-- Table structure for table `categorias_resultados`
--

DROP TABLE IF EXISTS `categorias_resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_resultados` (
  `idcategoria_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `idresultado` int(11) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idcategoria_resultado`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idresultado` (`idresultado`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_resultados`
--
-- ORDER BY:  `idcategoria_resultado`

LOCK TABLES `categorias_resultados` WRITE;
/*!40000 ALTER TABLE `categorias_resultados` DISABLE KEYS */;
INSERT INTO `categorias_resultados` (`idcategoria_resultado`, `idcategoria`, `idresultado`, `estatus`) VALUES (1,2,1,1),(2,2,2,1),(3,2,3,1),(4,2,4,1),(5,2,5,1),(6,2,6,1),(7,2,7,1),(8,2,8,1),(9,2,9,1),(10,2,10,1),(11,1,1,1),(12,1,2,1),(13,1,3,1),(14,1,6,1),(15,1,4,1),(16,1,5,1),(17,3,1,1),(18,3,2,1),(19,3,4,1),(20,3,5,1),(21,3,9,1),(22,3,10,1),(23,3,15,1),(24,3,16,1),(25,3,17,1),(26,3,18,1),(27,3,19,1),(28,3,20,1),(29,6,1,1),(30,6,2,1),(31,6,3,1),(32,6,6,1),(33,6,4,1),(34,6,5,1);
/*!40000 ALTER TABLE `categorias_resultados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:53
