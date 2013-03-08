CREATE DATABASE  IF NOT EXISTS `censo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `censo`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: censo
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
-- Table structure for table `encuestas`
--

DROP TABLE IF EXISTS `encuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuestas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_jefe` int(11) NOT NULL,
  `fecha_llenado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestas`
--
-- ORDER BY:  `id`

LOCK TABLES `encuestas` WRITE;
/*!40000 ALTER TABLE `encuestas` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parroquias`
--

DROP TABLE IF EXISTS `parroquias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parroquias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `parroquia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_estado` (`id_estado`,`id_municipio`,`parroquia`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parroquias`
--
-- ORDER BY:  `id`

LOCK TABLES `parroquias` WRITE;
/*!40000 ALTER TABLE `parroquias` DISABLE KEYS */;
INSERT INTO `parroquias` (`id`, `id_estado`, `id_municipio`, `parroquia`) VALUES (2,1,3,'San Pedro'),(3,1,3,'San Juan'),(4,1,3,'Sucre'),(5,3,5,'Los Teques'),(9,1,3,'El Recreo');
/*!40000 ALTER TABLE `parroquias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jefe` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `parentesco` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `salud` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`,`id_persona`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--
-- ORDER BY:  `id`

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestas_detalle`
--

DROP TABLE IF EXISTS `encuestas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuestas_detalle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value_check` char(2) DEFAULT NULL,
  `value_text` varchar(45) DEFAULT NULL COMMENT 'valores posibles, Sí o null',
  `id_encuesta` int(10) unsigned NOT NULL,
  `id_item_encuesta` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_DETALLE_ENCUESTA` (`id_encuesta`),
  KEY `FK_DETALLE_ITEM_ENCUESTA` (`id_item_encuesta`),
  CONSTRAINT `FK_DETALLE_ENCUESTA` FOREIGN KEY (`id_encuesta`) REFERENCES `encuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DETALLE_ITEM_ENCUESTA` FOREIGN KEY (`id_item_encuesta`) REFERENCES `items_encuesta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestas_detalle`
--
-- ORDER BY:  `id`

LOCK TABLES `encuestas_detalle` WRITE;
/*!40000 ALTER TABLE `encuestas_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuestas_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_item_encuesta`
--

DROP TABLE IF EXISTS `categoria_item_encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_item_encuesta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto` varchar(45) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '1',
  `orden` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_item_encuesta`
--
-- ORDER BY:  `id`

LOCK TABLES `categoria_item_encuesta` WRITE;
/*!40000 ALTER TABLE `categoria_item_encuesta` DISABLE KEYS */;
INSERT INTO `categoria_item_encuesta` (`id`, `texto`, `active`, `orden`) VALUES (1,'Problemas de la Comunidad','1',1),(2,'Beneficiario de alguna Misión','1',2),(3,'Servicios Activos','1',3),(4,'Prueba','0',4),(5,'Otros','1',4);
/*!40000 ALTER TABLE `categoria_item_encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestas_old`
--

DROP TABLE IF EXISTS `encuestas_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuestas_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jefe` int(11) NOT NULL,
  `cooperacion_vecinos` int(11) NOT NULL DEFAULT '0',
  `violencia_vecinal` int(11) NOT NULL DEFAULT '0',
  `abuso_autoridades` int(11) NOT NULL DEFAULT '0',
  `prostitucion` int(11) NOT NULL DEFAULT '0',
  `alcoholismo` int(11) NOT NULL DEFAULT '0',
  `enfermos_terminales` int(11) NOT NULL DEFAULT '0',
  `discapacitados` int(11) NOT NULL DEFAULT '0',
  `delincuencia` int(11) NOT NULL DEFAULT '0',
  `indigentes` int(11) NOT NULL DEFAULT '0',
  `ninos_abandono` int(11) NOT NULL DEFAULT '0',
  `extrema_densidad_poblacional` int(11) NOT NULL DEFAULT '0',
  `comercio_drogas` int(11) NOT NULL DEFAULT '0',
  `consumo_drogas` int(11) NOT NULL DEFAULT '0',
  `servicios_publicos` int(11) NOT NULL DEFAULT '0',
  `basura` int(11) NOT NULL DEFAULT '0',
  `seguridad_urbana` int(11) NOT NULL DEFAULT '0',
  `aguas_servidas_emposadas` int(11) NOT NULL DEFAULT '0',
  `residuos_toxicos` int(11) NOT NULL DEFAULT '0',
  `barros_pantanos` int(11) NOT NULL DEFAULT '0',
  `ruidos` int(11) NOT NULL DEFAULT '0',
  `fabricas_contaminantes` int(11) NOT NULL DEFAULT '0',
  `licorerias` int(11) NOT NULL DEFAULT '0',
  `transito_vehicular` int(11) NOT NULL DEFAULT '0',
  `terrenos_baldios` int(11) NOT NULL DEFAULT '0',
  `falta_espacios_recreacion` int(11) NOT NULL DEFAULT '0',
  `falta_espacios_deportivos` int(11) NOT NULL DEFAULT '0',
  `victima_delito` int(11) NOT NULL DEFAULT '0',
  `otros_problemas_comunidad` text COLLATE utf8_spanish_ci NOT NULL,
  `mision_robinson` int(11) NOT NULL DEFAULT '0',
  `mision_ribas` int(11) NOT NULL DEFAULT '0',
  `mision_mercal` int(11) NOT NULL DEFAULT '0',
  `mision_negra_hipolita` int(11) NOT NULL DEFAULT '0',
  `mision_habitat` int(11) NOT NULL DEFAULT '0',
  `mision_vivienda` int(11) NOT NULL DEFAULT '0',
  `mision_barrio_adentro` int(11) NOT NULL DEFAULT '0',
  `mision_ciencia` int(11) NOT NULL DEFAULT '0',
  `mision_cultura` int(11) NOT NULL DEFAULT '0',
  `simoncito` int(11) NOT NULL DEFAULT '0',
  `unidad_educativa` int(11) NOT NULL DEFAULT '0',
  `liceo` int(11) NOT NULL DEFAULT '0',
  `universidad` int(11) NOT NULL DEFAULT '0',
  `aguas_blancas` int(11) NOT NULL DEFAULT '0',
  `aguas_servidas` int(11) NOT NULL DEFAULT '0',
  `sistema_electrico` int(11) NOT NULL DEFAULT '0',
  `recoleccion_basura` int(11) NOT NULL DEFAULT '0',
  `telefonia` int(11) NOT NULL DEFAULT '0',
  `transporte` int(11) NOT NULL DEFAULT '0',
  `mecanismo_informacion` int(11) NOT NULL DEFAULT '0',
  `servicios_comunitarios` int(11) NOT NULL DEFAULT '0',
  `gas_domestico` int(11) NOT NULL DEFAULT '0',
  `alumbrado_publico` int(11) NOT NULL DEFAULT '0',
  `modulos_seguridad` int(11) NOT NULL DEFAULT '0',
  `familiar_enfermo` int(11) NOT NULL DEFAULT '0',
  `ayuda_familiar_enfermo` int(11) NOT NULL DEFAULT '0',
  `simon_rodriguez` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestas_old`
--
-- ORDER BY:  `id`

LOCK TABLES `encuestas_old` WRITE;
/*!40000 ALTER TABLE `encuestas_old` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuestas_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`user`),
  UNIQUE KEY `email` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--
-- ORDER BY:  `id`

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user`, `pass`, `mail`, `name`, `rol`) VALUES (1,'admin','188ab7a79a795cdf01bee0a4a290779c','info@domain.com','Administrador',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nacionalidad` varchar(1) CHARACTER SET ascii NOT NULL DEFAULT 'V',
  `cedula` int(11) NOT NULL,
  `nombres` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado_civil` smallint(6) NOT NULL,
  `instruccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `profesion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nacionalidad` (`nacionalidad`,`cedula`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--
-- ORDER BY:  `id`

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_encuesta`
--

DROP TABLE IF EXISTS `items_encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_encuesta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto` varchar(250) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '1',
  `is_check` char(1) NOT NULL,
  `require_number` char(1) NOT NULL DEFAULT '0',
  `is_text` char(1) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `id_item_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ITEM_CATEGORIA_ENCUESTA` (`id_item_categoria`),
  CONSTRAINT `FK_ITEM_CATEGORIA_ENCUESTA` FOREIGN KEY (`id_item_categoria`) REFERENCES `categoria_item_encuesta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_encuesta`
--
-- ORDER BY:  `id`

LOCK TABLES `items_encuesta` WRITE;
/*!40000 ALTER TABLE `items_encuesta` DISABLE KEYS */;
INSERT INTO `items_encuesta` (`id`, `texto`, `active`, `is_check`, `require_number`, `is_text`, `orden`, `id_item_categoria`) VALUES (1,'Falta de cooperación de los vecinos','1','1','0','0',1,1),(2,'Violencia vecinal','1','1','0','0',2,1),(3,'Abuso de las autoridades','1','1','0','0',3,1),(4,'Prostitución','1','1','0','0',4,1),(5,'Alcoholismo','1','1','0','0',5,1),(6,'Enfermos terminales en la comunidad','1','1','1','0',6,1),(7,'Discapacitados en la comunidad','1','1','1','0',7,1),(8,'Delincuencia','1','1','0','0',8,1),(9,'Indigentes','1','1','1','0',9,1),(10,'Niños en situación de abandono','1','1','1','0',10,1),(11,'Extrema densidad poblacional','1','1','0','0',11,1),(12,'Comercio de drogas','1','1','0','0',12,1),(13,'Consumo de drogas','1','1','0','0',13,1),(14,'Servicios públicos','1','1','0','0',14,1),(15,'Basura en las calles','1','1','0','0',15,1),(16,'Seguridad urbana','1','1','0','0',16,1),(17,'Aguas servidas emposadas','1','1','0','0',17,1),(18,'Residuos tóxicos','1','1','0','0',18,1),(19,'Barros y pantanos','1','1','0','0',19,1),(20,'Ruidos','1','1','0','0',20,1),(21,'Fabricas contaminantes','1','1','0','0',21,1),(22,'Licorerías','1','1','0','0',22,1),(23,'Transito vehicular','1','1','0','0',23,1),(24,'Terrenos baldíos','1','1','0','0',24,1),(25,'Falta de espacios de recreación','1','1','0','0',25,1),(26,'Falta de espacios deportivos','1','1','0','0',26,1),(27,'Victima de algún delito','1','1','0','0',27,1),(28,'Otros','1','0','0','1',28,1),(29,'Misión Robinsion','1','1','0','0',1,2),(30,'Misión Ribas','1','1','0','0',2,2),(31,'Mision Mercal','1','1','0','0',3,2),(32,'Mision Negra Hipolita','1','1','0','0',4,2),(33,'Mision Habitat','1','1','0','0',5,2),(34,'Mision Vivienda','1','1','0','0',6,2),(35,'Mision Barrio Adentro','1','1','0','0',7,2),(36,'Mision Ciencia','1','1','0','0',8,2),(37,'Mision Cultura','1','1','0','0',9,2),(38,'Simoncito','1','1','0','0',10,2),(39,'Unidad Educativa','1','1','0','0',11,2),(40,'Liceo','1','1','0','0',12,2),(41,'Universidad','1','1','0','0',13,2),(42,'Aguas blancas','1','1','0','0',1,3),(43,'Aguas servidas','1','1','0','0',2,3),(44,'Sistema eléctrico','1','1','0','0',3,3),(45,'Recoleccion de basura','1','1','0','0',4,3),(46,'Telefonia','1','1','0','0',5,3),(47,'Transporte','1','1','0','0',6,3),(48,'Mecanismo de información','1','1','0','0',7,3),(49,'Servicios comunitarios','1','1','0','0',8,3),(50,'Gas domestico','1','1','0','0',9,3),(51,'Alumbrado Publico','1','1','0','0',10,3),(52,'Modulos de seguridad','1','1','0','0',11,3),(53,'Existe en su núcleo familiar alguna persona que padezca de alguna enfermedad?','1','1','0','0',1,5),(54,'Necesita Usted de ayuda especial para sus familiares enfermos?','1','1','0','0',2,5),(55,'Le gustaría contar con una Universidad Simón Rodríguez en Sabana Grande?','1','1','0','0',3,5);
/*!40000 ALTER TABLE `items_encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estados` (`estado`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--
-- ORDER BY:  `id`

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` (`id`, `estado`) VALUES (1,'Distrito Capital'),(2,'Amazonas'),(3,'Miranda'),(4,'Caracas Prueba');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `municipio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_estado` (`id_estado`,`municipio`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--
-- ORDER BY:  `id`

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` (`id`, `id_estado`, `municipio`) VALUES (3,1,'Libertador'),(5,3,'Guaicaipuro');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jefe` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_parroquia` int(11) NOT NULL,
  `nombre_inmueble` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `piso` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apartamento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `trabaja` smallint(6) NOT NULL,
  `vivienda` smallint(6) NOT NULL,
  `tipo_vivienda` smallint(6) NOT NULL,
  `tiempo_vivienda` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`),
  KEY `id_estado` (`id_estado`,`id_municipio`,`id_parroquia`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--
-- ORDER BY:  `id`

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-08  9:22:59
