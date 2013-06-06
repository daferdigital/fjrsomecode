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
  `cargo_solicitado` varchar(250) NOT NULL,
  `ex_empleado` char(2) NOT NULL,
  `ex_dpto` varchar(250) DEFAULT NULL,
  `motivo_retiro` text,
  `horario_deseado` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes`
--
-- ORDER BY:  `id`

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
INSERT INTO `solicitudes` (`id`, `nombre`, `apellido`, `ci`, `lugar_nacimiento`, `fecha_nacimiento`, `sexo`, `edo_civil`, `tiene_hijos`, `direccion`, `tlf_habitacion`, `tlf_celular`, `email`, `grado_instruccion`, `profesional_en`, `especialista_en`, `experiencia_laboral`, `ultimos_trabajos`, `antiguedad_ultimo_trabajo`, `cargo_solicitado`, `ex_empleado`, `ex_dpto`, `motivo_retiro`, `horario_deseado`, `fecha_registro`) VALUES (1,'Felipe','Rojas','V11111111','Caracas','2013-06-01','M','Soltero(a)','Si','guarenas','02123652155','04122354731','felipe.rojasg@gmail.com','Primaria','Informatica','Java','Si','3','1 año','Administrador','No','','','Nocturno','2013-06-06 01:03:15');
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-06  1:07:45
