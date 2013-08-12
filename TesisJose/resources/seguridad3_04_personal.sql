CREATE DATABASE  IF NOT EXISTS `seguridad3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `seguridad3`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: seguridad3
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
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE latin1_bin NOT NULL,
  `apellido` varchar(250) COLLATE latin1_bin NOT NULL,
  `cedula` varchar(45) COLLATE latin1_bin NOT NULL,
  `direccion` text COLLATE latin1_bin NOT NULL,
  `turno` varchar(45) COLLATE latin1_bin NOT NULL,
  `ubicacion` varchar(250) COLLATE latin1_bin NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `telefono` text COLLATE latin1_bin NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_supervisor` int(11) DEFAULT NULL COMMENT 'id del supervisor si aplica (en los casos que no aplique dejar el valor en null)',
  `activo` char(1) COLLATE latin1_bin NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_CARGO_PERSONAL` (`id_cargo`),
  KEY `FK_SUPERVISOR_PERSONAL` (`id_supervisor`),
  CONSTRAINT `FK_CARGO_PERSONAL` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_SUPERVISOR_PERSONAL` FOREIGN KEY (`id_supervisor`) REFERENCES `personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--
-- ORDER BY:  `id`

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` (`id`, `nombre`, `apellido`, `cedula`, `direccion`, `turno`, `ubicacion`, `fecha_ingreso`, `telefono`, `id_cargo`, `id_supervisor`, `activo`) VALUES (2,'Felipe','Rojas','E-1234593847','kerbhfiueb','iubf3reiub','iub3iuebf','2013-07-02','23645872364',3,NULL,'1'),(3,'Jose','Falcon','V-8888888888','oficina','nocturno','Centro','2013-08-02','02123652155',3,NULL,'1'),(4,'hhhh','hhh','V-5555555555','tttttttttttttt','ttttttttttttttt','tttttttttttttttt','2013-08-01','86876765',1,2,'0');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-03  1:18:39
