CREATE DATABASE  IF NOT EXISTS `coladist_satrim` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `coladist_satrim`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: coladist_satrim
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
-- Table structure for table `atencion_ticket`
--

DROP TABLE IF EXISTS `atencion_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atencion_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_atencion` datetime NOT NULL,
  `id_operador` int(10) unsigned NOT NULL,
  `id_taquilla` int(10) unsigned NOT NULL,
  `id_ticket` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ATENCION_OPERADOR` (`id_operador`),
  KEY `FK_ATENCION_TAQUILLA` (`id_taquilla`),
  KEY `FK_ATENCION_TICKET` (`id_ticket`),
  CONSTRAINT `FK_ATENCION_OPERADOR` FOREIGN KEY (`id_operador`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ATENCION_TAQUILLA` FOREIGN KEY (`id_taquilla`) REFERENCES `taquilla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ATENCION_TICKET` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla para almacenar el registro de atencion de un determina';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atencion_ticket`
--
-- ORDER BY:  `id`

LOCK TABLES `atencion_ticket` WRITE;
/*!40000 ALTER TABLE `atencion_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `atencion_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taquilla`
--

DROP TABLE IF EXISTS `taquilla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taquilla` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `orden` varchar(45) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  `id_operador` int(10) unsigned NOT NULL,
  `id_sub_departamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TAQUILLA_OPERADOR` (`id_operador`),
  KEY `FK_TAQUILLA_SUB_DPTO` (`id_sub_departamento`),
  CONSTRAINT `FK_TAQUILLA_OPERADOR` FOREIGN KEY (`id_operador`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TAQUILLA_SUB_DPTO` FOREIGN KEY (`id_sub_departamento`) REFERENCES `sub_departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla para indicar los operadores que reciben tickets de los';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taquilla`
--
-- ORDER BY:  `id`

LOCK TABLES `taquilla` WRITE;
/*!40000 ALTER TABLE `taquilla` DISABLE KEYS */;
/*!40000 ALTER TABLE `taquilla` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_log`
--
-- ORDER BY:  `id`

LOCK TABLES `system_log` WRITE;
/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_departamento`
--

DROP TABLE IF EXISTS `sub_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_departamento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `cupo_maximo` int(11) NOT NULL COMMENT 'cupo maximo de atencion de tickets por horario de trabajo',
  `horario_inicial` time NOT NULL,
  `horario_final` time NOT NULL,
  `tiempo_promedio_atencion` int(11) NOT NULL COMMENT 'tiempo promedio de atencion en minutos, para este sub departamento',
  `atencion_previa_cita` char(1) NOT NULL DEFAULT '0',
  `activo` char(1) NOT NULL DEFAULT '1',
  `id_departamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SUB_DPTO_DEPARTAMENTO` (`id_departamento`),
  CONSTRAINT `FK_SUB_DPTO_DEPARTAMENTO` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_departamento`
--
-- ORDER BY:  `id`

LOCK TABLES `sub_departamento` WRITE;
/*!40000 ALTER TABLE `sub_departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='informacion de los departamentos o unidades';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--
-- ORDER BY:  `id`

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='tabla para indicar los tipos de usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--
-- ORDER BY:  `id`

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`id`, `nombre`, `descripcion`) VALUES (1,'Administrador','Rol de usuarios de tipo administrador'),(2,'Terminales','Rol de usuario tipo terminal'),(3,'Operadores','Rol de usuario del tipo Operador');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_ticket`
--

DROP TABLE IF EXISTS `estado_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_ticket`
--
-- ORDER BY:  `id`

LOCK TABLES `estado_ticket` WRITE;
/*!40000 ALTER TABLE `estado_ticket` DISABLE KEYS */;
INSERT INTO `estado_ticket` (`id`, `nombre`, `descripcion`) VALUES (1,'Creado','Ticket Creado'),(2,'Confirmado','Ticket Confirmado'),(3,'Atendido','Ticket Atendido'),(4,'En espera','Ticket en Espera'),(5,'Anulado','Ticket Anulado'),(6,'Transferido','Ticket Transferido a otra Taquilla');
/*!40000 ALTER TABLE `estado_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previas_citas`
--

DROP TABLE IF EXISTS `previas_citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previas_citas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(45) NOT NULL,
  `nombre_paciente` varchar(255) NOT NULL,
  `fecha_real_reserva` datetime NOT NULL COMMENT 'fecha de la solicitud de cita',
  `fecha_requerida_atencion` datetime NOT NULL COMMENT 'fecha en la que se desea ser atendido',
  `id_sub_departamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PREVIA_CITA_SUB_DPTO` (`id_sub_departamento`),
  CONSTRAINT `FK_PREVIA_CITA_SUB_DPTO` FOREIGN KEY (`id_sub_departamento`) REFERENCES `sub_departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previas_citas`
--
-- ORDER BY:  `id`

LOCK TABLES `previas_citas` WRITE;
/*!40000 ALTER TABLE `previas_citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `previas_citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_estimada_atencion` datetime NOT NULL,
  `prioridad` int(11) NOT NULL DEFAULT '10' COMMENT 'valor de prioridad (10=normal) (100=emergencia)',
  `estado` int(11) unsigned NOT NULL,
  `id_sub_departamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TICKET_SUB_DPTO` (`id_sub_departamento`),
  KEY `FK_TICKET_ESTADO_TICKET` (`estado`),
  CONSTRAINT `FK_TICKET_ESTADO_TICKET` FOREIGN KEY (`estado`) REFERENCES `estado_ticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TICKET_SUB_DPTO` FOREIGN KEY (`id_sub_departamento`) REFERENCES `sub_departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tickets generados';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--
-- ORDER BY:  `id`

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_tipo_usuario` int(10) unsigned NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula_UNIQUE` (`cedula`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `FK_USUARIO_TIPO_USUARIO` (`id_tipo_usuario`),
  CONSTRAINT `FK_USUARIO_TIPO_USUARIO` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--
-- ORDER BY:  `id`

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
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

-- Dump completed on 2014-06-09  7:06:56
