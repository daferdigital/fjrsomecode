CREATE DATABASE  IF NOT EXISTS `difetours` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `difetours`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: difetours
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
  `id_modalidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SEMANAS_MODALIDAD` (`id_modalidad`),
  CONSTRAINT `FK_SEMANAS_MODALIDAD` FOREIGN KEY (`id_modalidad`) REFERENCES `curso_modalidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_semanas`
--

LOCK TABLES `curso_semanas` WRITE;
/*!40000 ALTER TABLE `curso_semanas` DISABLE KEYS */;
INSERT INTO `curso_semanas` VALUES (1,1,3,288,1),(2,4,11,280,1),(3,12,15,264,1),(4,16,23,256,1),(5,24,31,248,1),(6,32,53,244,1),(7,1,3,236,2),(8,4,11,236,2),(9,12,15,228,2),(10,16,23,220,2),(11,24,31,216,2),(12,32,53,208,2),(13,1,3,172,3),(14,4,11,172,3),(15,12,15,164,3),(16,16,23,164,3),(17,24,31,152,3),(18,32,53,152,3),(19,1,3,136,4),(20,4,11,136,4),(21,12,15,128,4),(22,16,23,128,4),(23,24,31,120,4),(24,32,53,120,4);
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

-- Dump completed on 2013-02-18  5:45:42
