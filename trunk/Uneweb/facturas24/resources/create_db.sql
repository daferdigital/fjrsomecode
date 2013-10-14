CREATE DATABASE  IF NOT EXISTS `facturas24` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `facturas24`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: facturas24
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
-- Table structure for table `tipos_modelos`
--

DROP TABLE IF EXISTS `tipos_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='tipos de modelos de los documentos fiscales';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_modelos`
--
-- ORDER BY:  `id`

LOCK TABLES `tipos_modelos` WRITE;
/*!40000 ALTER TABLE `tipos_modelos` DISABLE KEYS */;
INSERT INTO `tipos_modelos` (`id`, `nombre`) VALUES (1,'Forma Libre'),(2,'Horizontal'),(3,'Vertical');
/*!40000 ALTER TABLE `tipos_modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelos`
--

DROP TABLE IF EXISTS `modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `numero` int(11) NOT NULL,
  `clasico` char(1) NOT NULL DEFAULT '0',
  `id_tipo_modelo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TIPO_MODELO` (`id_tipo_modelo`),
  CONSTRAINT `FK_TIPO_MODELO` FOREIGN KEY (`id_tipo_modelo`) REFERENCES `tipos_modelos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelos`
--
-- ORDER BY:  `id`

LOCK TABLES `modelos` WRITE;
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
INSERT INTO `modelos` (`id`, `nombre`, `numero`, `clasico`, `id_tipo_modelo`) VALUES (1,'Horizontal',1,'0',1),(2,'Vertical',1,'0',1),(3,'Clásico',1,'1',2),(4,'Clásico',2,'1',2),(5,'Clásico',3,'1',2),(6,'Horizontal',1,'0',2),(7,'Horizontal',2,'0',2),(8,'Horizontal',3,'0',2),(9,'Horizontal',4,'0',2),(10,'Clásico',1,'1',3),(11,'Clásico',2,'1',3),(12,'Clásico',3,'1',3),(13,'Geométrica',1,'0',3),(14,'Geométrica',2,'0',3),(15,'Geométrica',3,'0',3),(16,'Iniciales',1,'0',3),(17,'Iniciales',2,'0',3),(18,'Iniciales',3,'0',3),(19,'Iniciales',4,'0',3),(20,'Iniciales',5,'0',3),(21,'Iniciales',6,'0',3),(22,'Moderno',1,'0',3),(23,'Moderno',2,'0',3),(24,'Moderno',3,'0',3),(25,'Vanguardia',1,'0',3),(26,'Vanguardia',2,'0',3),(27,'Vanguardia',3,'0',3),(28,'Con Fuente',1,'0',2),(29,'Con Fuente',2,'0',2),(30,'Con Fuente',3,'0',2),(31,'Con Fuente',4,'0',2),(32,'Geométrica Con Fuente',1,'0',3),(33,'Geométrica Con Fuente',2,'0',3),(34,'Geométrica Con Fuente',3,'0',3),(35,'Iniciales Con Fuente',1,'0',3),(36,'Iniciales Con Fuente',2,'0',3),(37,'Iniciales Con Fuente',3,'0',3),(38,'Iniciales Con Fuente',4,'0',3),(39,'Iniciales Con Fuente',5,'0',3),(40,'Iniciales Con Fuente',6,'0',3),(41,'Moderno Con Fuente',1,'0',3),(42,'Moderno Con Fuente',2,'0',3),(43,'Moderno Con Fuente',3,'0',3),(44,'Vanguardia Con Fuente',1,'0',3),(45,'Vanguardia Con Fuente',2,'0',3),(46,'Vanguardia Con Fuente',3,'0',3);
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_contacto` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `cedula` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `rif_pedido` varchar(250) NOT NULL,
  `razon_social` varchar(250) NOT NULL,
  `estilo_razon_social` varchar(250) NOT NULL,
  `profesion` varchar(250) NOT NULL,
  `estilo_profesion` varchar(250) NOT NULL,
  `dir_fiscal_linea1` varchar(250) NOT NULL,
  `dir_fiscal_linea2` varchar(250) NOT NULL,
  `estilo_dir_fiscal` varchar(250) NOT NULL,
  `telefono_otro` varchar(250) NOT NULL,
  `estilo_telefono_otro` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `estilo_email` varchar(250) NOT NULL,
  `tamano` varchar(250) NOT NULL,
  `tipo_presentacion` varchar(250) NOT NULL,
  `documento_fiscal_previo` char(1) NOT NULL,
  `numeracion_documento_desde` varchar(250) DEFAULT NULL,
  `numeracion_documento_hasta` varchar(250) DEFAULT NULL,
  `numeracion_control_desde` varchar(250) DEFAULT NULL,
  `numeracion_control_hasta` varchar(250) DEFAULT NULL,
  `blocks_a_ordenar` int(11) NOT NULL,
  `numero_documento_inicial` varchar(250) NOT NULL,
  `numero_control_inicial` varchar(250) NOT NULL,
  `path_logo` varchar(250) DEFAULT NULL,
  `tamano_logo` varchar(250) DEFAULT NULL,
  `path_fondo` varchar(250) DEFAULT NULL,
  `tamano_fondo` varchar(250) DEFAULT NULL,
  `preferencia_impresion` varchar(250) NOT NULL,
  `preferencia_papel` varchar(250) NOT NULL,
  `opciones_color` varchar(250) NOT NULL,
  `path_rif` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--
-- ORDER BY:  `id`

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-14  7:21:24
