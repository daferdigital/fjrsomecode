CREATE DATABASE  IF NOT EXISTS `solicitud_empleo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `solicitud_empleo`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: solicitud_empleo
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
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CARGO_DPTO` (`id_departamento`),
  CONSTRAINT `FK_CARGO_DPTO` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--
-- ORDER BY:  `id`

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `nombre`, `id_departamento`) VALUES (1,'Administrador',1),(2,'Asistente',1),(3,'Secretaria',1),(4,'Gerente de Sistemas',2),(5,'Asistente',2),(6,'Jefe de Caja',3),(7,'Supervisor piso de venta',3),(8,'Cajero (a)',3),(9,'Gerente RRHH',4),(10,'Asistente',4),(11,'Analista',4),(12,'Charcutero',5),(13,'Ayudante',5),(14,'Carnicero',6),(15,'Ayudante',6),(16,'Deshuesador',6),(17,'Barra',7),(18,'Cajero (a)',7),(19,'Jefe de Perfumería',8),(20,'Ayudante',8),(21,'Cajero (a)',8),(22,'Jefe de Floristería',9),(23,'Cajero (a)',9),(24,'Jefe de Frutería',10),(25,'Frutero',10),(26,'Balanza',10),(27,'Jefe de Bodegón',11),(28,'Ayudante',11),(29,'Depositario',12),(30,'Pasillero',12),(31,'Jefe de Mantenimiento',13),(32,'Ayudante',13);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-21  1:32:54
