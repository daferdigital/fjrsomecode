CREATE DATABASE  IF NOT EXISTS `sms_reader_web` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sms_reader_web`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: sms_reader_web
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BITACORA_USUARIO_idx` (`id_usuario`),
  CONSTRAINT `FK_BITACORA_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` (`id`, `operacion`, `fecha`, `id_usuario`) VALUES (1,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:00:27',1),(2,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:00:46',1),(3,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:01:48',1),(4,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:02:10',1),(5,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:02:51',1),(6,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:03:39',1),(7,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:04:13',1),(8,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:04:49',1),(9,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:16:44',1),(10,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:17:50',1),(11,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:18:12',1),(12,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:18:45',1),(13,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:25:44',1),(14,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:29:25',1),(15,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:30:00',1),(16,'Acceso a modulo de busqueda de Listado de SMS\'s: Admnistrador Del Sistema','2013-09-25 18:30:57',1);
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto_sms` text NOT NULL,
  `fecha_sms` date NOT NULL,
  `hora_sms` time NOT NULL,
  `number_from` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` (`id`, `texto_sms`, `fecha_sms`, `hora_sms`, `number_from`) VALUES (1,'Prueba','2013-09-25','18:00:00','584122354731');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `query` text NOT NULL,
  `result` text,
  `was_error` char(1) NOT NULL DEFAULT '0',
  `query_time` int(10) unsigned NOT NULL COMMENT 'tiempo en segundos que tardo en ejecutarse la consulta almacenada en este registro',
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SYSTEMLOG_USUARIO` (`id_usuario`),
  CONSTRAINT `FK_SYSTEMLOG_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2991 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_log`
--

LOCK TABLES `system_log` WRITE;
/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `max_records_paging` int(11) NOT NULL DEFAULT '50',
  `correo` varchar(250) DEFAULT NULL,
  `hora_minima_lectura` int(11) NOT NULL,
  `hora_maxima_lectura` int(11) NOT NULL,
  `timeout` int(11) NOT NULL DEFAULT '15',
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `login`, `clave`, `nombre`, `apellido`, `max_records_paging`, `correo`, `hora_minima_lectura`, `hora_maxima_lectura`, `timeout`, `activo`) VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','Admnistrador','Del Sistema',50,NULL,0,23,15,'1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-25 19:42:26
