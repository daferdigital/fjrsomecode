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
-- Table structure for table `curso_modalidad`
--

DROP TABLE IF EXISTS `curso_modalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_modalidad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `internal_key` varchar(45) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_MODALIDAD_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_MODALIDAD_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_modalidad`
--

LOCK TABLES `curso_modalidad` WRITE;
/*!40000 ALTER TABLE `curso_modalidad` DISABLE KEYS */;
INSERT INTO `curso_modalidad` (`id`, `internal_key`, `descripcion`, `id_destino`) VALUES (5,'intensive','Tiempo Completo Intensivo(30 clases/semana)',2),(6,'standard','Tiempo Completo (24 clases/semana)',2),(7,'part-timeAM','Medio tiempo AM (17 clases/semana)',2),(8,'part-timePM','Medio tiempo PM (13 clases/semana)',2),(9,'intensive','Tiempo Completo Intensivo(30 clases/semana)',3),(10,'standard','Tiempo Completo (24 clases/semana)',3),(11,'part-timeAM','Medio tiempo AM (17 clases/semana)',3),(12,'part-timePM','Medio tiempo PM (13 clases/semana)',3),(13,'intensive','Tiempo Completo Intensivo(30 clases/semana)',4),(14,'standard','Tiempo Completo (24 clases/semana)',4),(15,'part-timeAM','Medio tiempo AM (17 clases/semana)',4),(16,'part-timePM','Medio tiempo PM (13 clases/semana)',4),(35,'intensive','Tiempo Completo Intensivo(30 clases/semana)',1),(36,'standard','Tiempo Completo (24 clases/semana)',1),(37,'part-timeAM','Medio tiempo AM (17 clases/semana)',1),(38,'part-timePM','Medio tiempo PM (13 clases/semana)',1);
/*!40000 ALTER TABLE `curso_modalidad` ENABLE KEYS */;
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
