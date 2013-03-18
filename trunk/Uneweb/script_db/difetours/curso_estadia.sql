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
-- Table structure for table `curso_estadia`
--

DROP TABLE IF EXISTS `curso_estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_estadia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `internal_key` varchar(45) CHARACTER SET utf8 NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL,
  `precio_under18` int(11) NOT NULL,
  `precio_over18` int(11) NOT NULL,
  `long_desc` text CHARACTER SET utf8 NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ESTADIA_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_ESTADIA_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_estadia`
--
-- ORDER BY:  `id`

LOCK TABLES `curso_estadia` WRITE;
/*!40000 ALTER TABLE `curso_estadia` DISABLE KEYS */;
INSERT INTO `curso_estadia` (`id`, `internal_key`, `descripcion`, `precio_under18`, `precio_over18`, `long_desc`, `id_destino`) VALUES (153,'homestay','Pensión Completa',224,210,'Pensión Completa (todas las comidas)',2),(154,'homestay-half-board','Media Pensión',210,196,'Media Pensin (sin almuerzo)',2),(155,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',2),(156,'none','Ninguna',0,0,'Ninguna',2),(157,'homestay','Pensión Completa',224,210,'Pensión Completa (todas las comidas)',3),(158,'homestay-half-board','Media Pensión',210,196,'Media Pensión (sin almuerzo)',3),(159,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',3),(160,'none','Ninguna',0,0,'Ninguna',3),(161,'homestay','Pensión Completa',224,210,'Pensión Completa (todas las comidas)',4),(162,'homestay-half-board','Media Pensión',210,196,'Media Pensión (sin almuerzo)',4),(163,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',4),(164,'none','Ninguna',0,0,'Ninguna',4),(165,'homestay','Pensión Completa',224,210,'Pensión Completa (incluye todas las comidas)',1),(166,'homestay-half-board','Media pensión',210,196,'Media Pensión (sin almuerzo)',1),(167,'roomstay','Solo estadia',0,147,'Solo estadia (sin comidas)',1),(168,'none','Ninguna',0,0,'Ninguna',1);
/*!40000 ALTER TABLE `curso_estadia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-18  0:55:45
