CREATE DATABASE  IF NOT EXISTS `uneweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `uneweb`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: uneweb
-- ------------------------------------------------------
-- Server version	5.5.22

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
-- Table structure for table `oficios`
--

DROP TABLE IF EXISTS `oficios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oficios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oficios`
--

LOCK TABLES `oficios` WRITE;
/*!40000 ALTER TABLE `oficios` DISABLE KEYS */;
INSERT INTO `oficios` (`id`, `nombre`) VALUES (1,'Aire Acondicionado'),(2,'Aire Acondicionado vehículos'),(3,'Adornos, recuerdos'),(4,'Alarmas hogar u oficina'),(5,'Alarmas Vehículos'),(6,'Albañilería'),(7,'Aluminio'),(8,'Amolador'),(9,'Artesano'),(10,'Ascensores'),(11,'Aseo y Limpieza'),(12,'Auto lavado a domicilio'),(13,'Ventanas y puertas de aluminio'),(14,'Cambio de aceite automotriz a domicilio'),(15,'Canal de agua'),(16,'Carpintero'),(17,'Ceramista'),(18,'Cerrajero'),(19,'Cerrajería'),(20,'Cielo raso de Escayola'),(21,'Cielo raso de Dry wall'),(22,'Técnico Cocina'),(23,'Costureros/as'),(24,'Decoradores'),(25,'Diseñador'),(26,'Diseñador de Interiores'),(27,'Diseñador de Moda'),(28,'Diseñador Gráfico'),(29,'Paredes Dry Wall'),(30,'Ductería (Ductos)'),(31,'Dulcería'),(32,'Técnico DVD, Blue Ray '),(33,'Ebanista'),(34,'Electricista'),(35,'Electricista automotriz'),(36,'Electrónico'),(37,'Técnico Equipo de sonido'),(38,'Crear nuevo oficio');
/*!40000 ALTER TABLE `oficios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitantes` (
  `correo` varchar(100) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  PRIMARY KEY (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitantes`
--

LOCK TABLES `visitantes` WRITE;
/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directorio`
--

DROP TABLE IF EXISTS `directorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `rif` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `familia` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` text NOT NULL,
  `correo` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `municipio` varchar(200) NOT NULL,
  `website` varchar(64) NOT NULL,
  `terminos` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=MyISAM AUTO_INCREMENT=1242 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directorio`
--

LOCK TABLES `directorio` WRITE;
/*!40000 ALTER TABLE `directorio` DISABLE KEYS */;
INSERT INTO `directorio` (`id`, `nombre`, `rif`, `tipo`, `familia`, `direccion`, `telefono`, `correo`, `estado`, `ciudad`, `municipio`, `website`, `terminos`, `estatus`) VALUES (1234,'Oswaldo Perez','13693310','Aire Acondicionado','Cajetines, bombillos, enchufes, cargadores','Av. BoleÃ­ta Centro Comercial','9538412','oswaldo@elmerr.com','Distrito Capital','Caracas','Baruta','www.gentedeoficio.com/oswaldo','Acepto',2),(1235,'Oscar MuÃ±os','13693310','Artesano','Duendes, esculturas, muÃ±equerÃ­a, vasijas','La California, av. los jabillos','2568790','info@duendes.com','Distrito Capital','Caracas','Sucre','www.duendes.com','Acepto',2),(1241,'FJR','12345','Adornos, recuerdos|Aire Acondicionado|Aire Acondicionado vehículos|Alarmas hogar u oficina','','prueba','286487236','a@q','Anzoátegui','Barcelona','','','Acepto',1);
/*!40000 ALTER TABLE `directorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabs`
--

DROP TABLE IF EXISTS `tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabs` (
  `id` int(11) NOT NULL,
  `link` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabs`
--

LOCK TABLES `tabs` WRITE;
/*!40000 ALTER TABLE `tabs` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo_ubicacion` int(11) NOT NULL,
  `id_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicaciones`
--

LOCK TABLES `ubicaciones` WRITE;
/*!40000 ALTER TABLE `ubicaciones` DISABLE KEYS */;
INSERT INTO `ubicaciones` (`id`, `nombre`, `tipo_ubicacion`, `id_padre`) VALUES (1,'Amazonas',1,NULL),(2,'Anzoátegui',1,NULL),(3,'Apure',1,NULL),(4,'Aragua',1,NULL),(5,'Barinas',1,NULL),(6,'Bolívar',1,NULL),(7,'Carabobo',1,NULL),(8,'Cojedes',1,NULL),(9,'Delta Amacuro',1,NULL),(10,'Falcón',1,NULL),(11,'Guárico',1,NULL),(12,'Lara',1,NULL),(13,'Mérida',1,NULL),(14,'Miranda',1,NULL),(15,'Monagas',1,NULL),(16,'Nueva Esparta',1,NULL),(17,'Portuguesa',1,NULL),(18,'Sucre',1,NULL),(19,'Táchira',1,NULL),(20,'Trujillo',1,NULL),(21,'Vargas',1,NULL),(22,'Zulia',1,NULL),(23,'Distrito Capital',1,NULL),(24,'Yaracuy',1,NULL),(25,'Puerto Ayacucho',2,1),(26,'Barcelona',2,2),(27,'San Fernando de Apure',2,3),(28,'Maracay',2,4),(29,'Barinas',2,5),(30,'Ciudad Bolívar',2,6),(31,'Valencia',2,7),(32,'San Carlos',2,8),(33,'Tucupita',2,9),(34,'Coro',2,10),(35,'San Juan de Los Morros',2,11),(36,'Barquisimeto',2,12),(37,'Mérida',2,13),(38,'Los Teques',2,14),(39,'Maturin',2,15),(40,'La Asunción',2,16),(41,'Guanare',2,17),(42,'Cumaná',2,18),(43,'San Cristóbal',2,19),(44,'Trujillo',2,20),(45,'La Guaira',2,21),(46,'Maracaibo',2,22),(47,'Caracas',2,23),(48,'San Felipe',2,24);
/*!40000 ALTER TABLE `ubicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slideshow`
--

DROP TABLE IF EXISTS `slideshow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `link` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slideshow`
--

LOCK TABLES `slideshow` WRITE;
/*!40000 ALTER TABLE `slideshow` DISABLE KEYS */;
/*!40000 ALTER TABLE `slideshow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'uneweb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-30 16:56:36
