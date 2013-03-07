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
-- Table structure for table `logros_hora_varchar`
--

DROP TABLE IF EXISTS `logros_hora_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logros_hora_varchar` (
  `idlogro` int(11) NOT NULL AUTO_INCREMENT,
  `idadministrador` int(11) DEFAULT '1',
  `fecha` date DEFAULT NULL,
  `hora` varchar(15) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idlogro`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logros_hora_varchar`
--
-- ORDER BY:  `idlogro`

LOCK TABLES `logros_hora_varchar` WRITE;
/*!40000 ALTER TABLE `logros_hora_varchar` DISABLE KEYS */;
INSERT INTO `logros_hora_varchar` (`idlogro`, `idadministrador`, `fecha`, `hora`, `estatus`) VALUES (2,1,'2011-09-29','01:25 AM',1),(3,1,'2011-09-29','03:11 AM',1),(4,1,'2011-09-30','03:29 AM',1),(5,1,'2011-09-30','03:29 AM',1),(6,1,'2011-09-30','03:36 AM',1),(7,1,'2011-10-01','06:43 PM',1),(8,1,'2011-10-01','11:33 PM',1),(9,1,'2011-10-02','11:16 PM',1),(10,1,'2011-10-04','01:40 PM',1),(11,1,'2011-10-12','08:30 PM',1),(12,1,'2011-10-12','04:30 PM',1),(13,1,'2011-10-12','06:00 PM',1),(14,1,'2011-10-12','06:00 PM',1),(15,1,'2011-10-12','11:02 PM',1),(16,1,'2011-10-13','07:30 PM',1),(17,1,'2011-10-13','07:30 PM',1),(18,1,'2011-10-13','07:30 PM',1),(19,1,'2011-10-13','07:30 PM',1),(20,1,'2011-10-18','02:55 PM',1),(21,1,'2011-10-18','02:55 PM',1),(22,1,'2011-10-18','02:55 PM',1),(23,1,'2011-10-19','03:02 PM',1),(24,1,'2011-10-19','03:06 PM',1),(25,1,'2011-10-19','03:10 PM',1),(26,1,'2011-10-19','03:18 PM',1),(27,1,'2011-10-20','07:30 PM',1),(28,1,'2011-10-20','07:30 PM',1),(29,1,'2011-10-20','07:30 PM',1),(30,1,'2011-10-20','07:30 PM',1),(31,1,'2011-10-20','07:30 PM',1),(32,1,'2011-10-30','04:32 PM',1),(33,1,'2011-10-30','04:32 PM',1),(34,1,'2011-10-30','04:32 PM',1),(35,1,'2011-10-30','04:32 PM',1),(36,1,'2011-11-03','07:30 PM',1),(37,1,'2011-11-03','07:30 PM',1),(38,1,'2011-11-03','07:30 PM',1),(39,1,'2011-11-06','05:30 PM',1),(40,1,'2011-11-06','02:30 PM',1),(41,1,'2011-11-06','04:00 PM',1),(42,1,'2011-11-06','05:30 PM',1),(43,1,'2011-11-19','05:00 PM',1),(44,1,'2011-11-19','05:30 PM',1),(45,1,'2011-11-21','07:30 PM',1),(46,1,'2011-11-21','07:30 PM',1),(47,1,'2011-11-23','07:30 PM',1),(48,1,'2011-11-23','09:09 PM',1),(49,1,'2011-11-24','07:30 PM',1),(50,1,'2011-11-24','07:30 PM',1),(51,1,'2011-11-25','07:30 PM',1),(52,1,'2011-11-25','07:30 PM',1),(53,1,'2011-12-03','11:09 AM',1),(54,1,'2011-12-15','01:57 AM',1),(55,1,'2012-01-16','03:15 PM',1),(56,1,'2012-01-16','03:15 PM',1),(57,1,'2012-01-30','03:06 AM',1),(58,1,'2012-02-06','05:30 PM',1),(59,1,'2012-02-06','05:40 PM',1),(60,1,'2012-02-11','11:00 PM',1),(61,1,'2012-02-11','11:37 PM',1),(62,1,'2012-02-11','11:37 PM',1),(63,1,'2012-02-23','08:34 PM',1),(64,1,'2012-02-23','08:30 PM',1),(65,1,'2012-02-23','08:30 PM',1),(66,1,'2012-02-23','09:45 PM',1),(67,1,'2012-02-23','07:30 PM',1),(68,1,'2012-02-22','8:30 AM',1),(69,1,'2012-02-23','12:09 AM',1),(70,1,'2012-02-23','06:30 PM',1),(71,1,'2012-02-26','10:30 PM',1),(72,1,'2012-02-28','02:12 AM',1),(73,1,'2012-03-03','06:15 AM',1),(74,1,'2012-03-06','07:30 PM',1),(75,1,'2012-03-06','04:19 AM',1),(76,1,'2012-03-06','05:14 PM',1),(77,1,'2012-03-07','05:24 PM',1),(78,1,'2012-03-09','12:14 AM',1);
/*!40000 ALTER TABLE `logros_hora_varchar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:38
