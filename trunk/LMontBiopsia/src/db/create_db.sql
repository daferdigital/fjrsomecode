CREATE DATABASE  IF NOT EXISTS `lmont_biopsia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lmont_biopsia`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: lmont_biopsia
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
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `key` varchar(45) NOT NULL COMMENT 'clave asociada al modulo, para efectos de codigo del sistema',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_UNIQUE` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla para especificar los distintos modulos (opciones de me';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--
-- ORDER BY:  `id`

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='tabla de usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--
-- ORDER BY:  `id`

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `login`, `clave`, `nombre`) VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','Administrador del Sistema');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_examenes`
--

DROP TABLE IF EXISTS `tipo_examenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Tabla de grupos de examenes de biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_examenes`
--
-- ORDER BY:  `id`

LOCK TABLES `tipo_examenes` WRITE;
/*!40000 ALTER TABLE `tipo_examenes` DISABLE KEYS */;
INSERT INTO `tipo_examenes` (`id`, `nombre`, `codigo`, `descripcion`, `activo`) VALUES (1,'Tipo1','001','Tipo de examenes de prueba','1');
/*!40000 ALTER TABLE `tipo_examenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examenes_biopsias`
--

DROP TABLE IF EXISTS `examenes_biopsias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examenes_biopsias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `dias_resultado` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  `id_tipo_examen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EXAMEN_GRUPO` (`id_tipo_examen`),
  CONSTRAINT `FK_EXAMEN_GRUPO` FOREIGN KEY (`id_tipo_examen`) REFERENCES `tipo_examenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='tabla para registrar los distintos examenes de biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examenes_biopsias`
--
-- ORDER BY:  `id`

LOCK TABLES `examenes_biopsias` WRITE;
/*!40000 ALTER TABLE `examenes_biopsias` DISABLE KEYS */;
INSERT INTO `examenes_biopsias` (`id`, `codigo`, `dias_resultado`, `nombre`, `activo`, `id_tipo_examen`) VALUES (1,'001',15,'Examen de Prueba','1',1),(2,'002',7,'Examen2','1',1);
/*!40000 ALTER TABLE `examenes_biopsias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patologos`
--

DROP TABLE IF EXISTS `patologos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patologos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='tabla de patologos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patologos`
--
-- ORDER BY:  `id`

LOCK TABLES `patologos` WRITE;
/*!40000 ALTER TABLE `patologos` DISABLE KEYS */;
INSERT INTO `patologos` (`id`, `nombre`, `activo`) VALUES (1,'Jésus Enrique González Alfonzo','1'),(2,'José David Mota Gamboa','1'),(3,'Enrique López Loyo','1');
/*!40000 ALTER TABLE `patologos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_premium` varchar(15) DEFAULT NULL COMMENT 'campo para ser usado en las sincronizaciones con premium',
  `cedula` varchar(45) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='pacientes a los que se les realice algun examen de biopsia';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--
-- ORDER BY:  `id`

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `id_premium`, `cedula`, `nombres`, `apellidos`, `edad`, `telefono`, `correo`, `direccion`) VALUES (1,NULL,'V-15507019','Felipe Jose','Rojas Gonzalez',30,'0412-2354731','felipe.rojasg@gmail.com','Guarenas');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-30  7:10:44
