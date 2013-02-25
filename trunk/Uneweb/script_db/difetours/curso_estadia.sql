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
  `internal_key` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_under18` int(11) NOT NULL,
  `precio_over18` int(11) NOT NULL,
  `long_desc` text NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ESTADIA_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_ESTADIA_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_estadia`
--

LOCK TABLES `curso_estadia` WRITE;
/*!40000 ALTER TABLE `curso_estadia` DISABLE KEYS */;
INSERT INTO `curso_estadia` VALUES (93,'homestay','PensiÃ³n Completa',224,210,'PensiÃ³n Completa (todas las comidas)',1),(94,'homestay-half-board','Media PensiÃ³n',210,196,'Media PensiÃ³n (sin almuerzo)',1),(95,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',1),(96,'none','Ninguna',0,0,'Ninguna',1),(97,'homestay','Pensión Completa',224,210,'Pensión Completa (todas las comidas)',4),(98,'homestay-half-board','Media PensiÃƒÂ³n',210,196,'Media PensiÃƒÂ³n (sin almuerzo)',4),(99,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',4),(100,'none','Ninguna',0,0,'Ninguna',4),(101,'homestay','PensiÃƒÂ³n Completa',224,210,'PensiÃƒÂ³n Completa (todas las comidas)',3),(102,'homestay-half-board','Media PensiÃƒÂ³n',210,196,'Media PensiÃƒÂ³n (sin almuerzo)',3),(103,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',3),(104,'none','Ninguna',0,0,'Ninguna',3),(105,'homestay','PensiÃƒÂ³n Completa',224,210,'PensiÃƒÂ³n Completa (todas las comidas)',2),(106,'homestay-half-board','Media PensiÃƒÂ³n',210,196,'Media PensiÃƒÂ³n (sin almuerzo)',2),(107,'roomstay','Solo Estadia',0,147,'Solo Estadia (sin comidas)',2),(108,'none','Ninguna',0,0,'Ninguna',2);
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

-- Dump completed on 2013-02-24 23:59:17
