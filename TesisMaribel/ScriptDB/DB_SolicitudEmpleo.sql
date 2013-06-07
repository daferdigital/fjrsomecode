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

--
-- Table structure for table `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `ci` varchar(45) NOT NULL,
  `lugar_nacimiento` varchar(250) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `edo_civil` varchar(250) NOT NULL,
  `tiene_hijos` char(2) NOT NULL,
  `direccion` text NOT NULL,
  `tlf_habitacion` varchar(45) NOT NULL,
  `tlf_celular` varchar(45) NOT NULL,
  `email` varchar(250) NOT NULL,
  `grado_instruccion` varchar(45) NOT NULL,
  `profesional_en` varchar(250) NOT NULL,
  `especialista_en` varchar(250) NOT NULL,
  `experiencia_laboral` char(2) NOT NULL,
  `ultimos_trabajos` varchar(45) DEFAULT NULL,
  `antiguedad_ultimo_trabajo` varchar(45) DEFAULT NULL,
  `id_cargo` int(11) NOT NULL,
  `ex_empleado` char(2) NOT NULL,
  `id_exdpto` int(11) DEFAULT NULL,
  `motivo_retiro` text,
  `horario_deseado` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CARGO_SOLICITUD` (`id_cargo`),
  KEY `FK_EXDPTO_SOLICITUD` (`id_exdpto`),
  CONSTRAINT `FK_CARGO_SOLICITUD` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_EXDPTO_SOLICITUD` FOREIGN KEY (`id_exdpto`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes`
--
-- ORDER BY:  `id`

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `decripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--
-- ORDER BY:  `id`

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`id`, `nombre`, `decripcion`) VALUES (1,'Administración','Área Administrativa'),(2,'Sistemas','Área de Sistemas'),(3,'Cajas','Área de Cajas'),(4,'RRHH','Área de Recursos Humanos'),(5,'Charcutería','Área de Charcutería'),(6,'Carnicería','Área de Carnicería'),(7,'Cafetería','Área de Cafetería'),(8,'Perfumería','Área de Perfumería'),(9,'Floristería','Área de Floristería'),(10,'Frutería','Área de Frutería'),(11,'Bodegón','Área de Bodegón'),(12,'Pasillos y Depósitos','Área de Pasillos y Depósitos'),(13,'Mantenimiento','Área de Mantenimiento');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-07  7:42:35
