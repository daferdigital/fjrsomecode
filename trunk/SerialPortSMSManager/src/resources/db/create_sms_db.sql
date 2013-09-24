CREATE DATABASE  IF NOT EXISTS `sms_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sms_db`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: sms_db
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
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recibido` datetime NOT NULL,
  `number_from` varchar(45) NOT NULL,
  `message_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--
-- ORDER BY:  `id`

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` (`id`, `fecha_recibido`, `number_from`, `message_value`) VALUES (43,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(44,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(45,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(46,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(47,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n\r\nOK\r\n'),(48,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(49,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(50,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(51,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(52,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(53,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n\r\nOK\r\n'),(54,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(55,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(56,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(57,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(58,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(59,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(60,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(61,'2013-09-02 23:34:28','\"04122354731\"','Prueba con listener\r\n'),(62,'2013-09-02 23:34:28','\"04122354731\"','Prueba con listener\r\n'),(63,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n\r\nOK\r\n'),(64,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(65,'2013-09-02 23:34:28','\"04122354731\"','Prueba con listener\r\n'),(66,'2013-09-02 23:34:28','\"04122354731\"','Prueba con listener\r\n'),(67,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n'),(68,'2013-05-17 01:31:04','\"04122354731\"','Mensaje de prueba 2\r\n\r\nCon un enter.\r\n');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-24  6:44:09
