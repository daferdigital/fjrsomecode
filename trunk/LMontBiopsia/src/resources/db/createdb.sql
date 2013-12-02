CREATE DATABASE  IF NOT EXISTS `lmont_biopsia` /*!40100 DEFAULT CHARACTER SET latin1 */;
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
-- Table structure for table `micro_laminas_files`
--

DROP TABLE IF EXISTS `micro_laminas_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `micro_laminas_files` (
  `id` int(11) NOT NULL,
  `cassete` int(11) NOT NULL,
  `bloque` int(11) NOT NULL,
  `lamina` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_content` mediumblob,
  `id_reactivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`cassete`,`lamina`,`bloque`,`file_name`),
  KEY `FK_LAMINAS_FILES_REACTIVO` (`id_reactivo`),
  CONSTRAINT `FK_LAMINAS_FILES_REACTIVO` FOREIGN KEY (`id_reactivo`) REFERENCES `reactivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `micro_laminas_files`
--
-- ORDER BY:  `id`,`cassete`,`lamina`,`bloque`,`file_name`

LOCK TABLES `micro_laminas_files` WRITE;
/*!40000 ALTER TABLE `micro_laminas_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `micro_laminas_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biopsias_macroscopicas`
--

DROP TABLE IF EXISTS `biopsias_macroscopicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biopsias_macroscopicas` (
  `id` int(11) NOT NULL,
  `desc_macro` text NOT NULL,
  `desc_per_operatoria` text,
  PRIMARY KEY (`id`),
  KEY `FK_MACRO_BIOPSIAS` (`id`),
  CONSTRAINT `FK_MACRO_BIOPSIAS` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='informacion de la fase macroscopica de las biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias_macroscopicas`
--
-- ORDER BY:  `id`

LOCK TABLES `biopsias_macroscopicas` WRITE;
/*!40000 ALTER TABLE `biopsias_macroscopicas` DISABLE KEYS */;
/*!40000 ALTER TABLE `biopsias_macroscopicas` ENABLE KEYS */;
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
  `genero` varchar(4) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='tabla de patologos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patologos`
--
-- ORDER BY:  `id`

LOCK TABLES `patologos` WRITE;
/*!40000 ALTER TABLE `patologos` DISABLE KEYS */;
INSERT INTO `patologos` (`id`, `nombre`, `genero`, `activo`) VALUES (1,'Jésus Enrique González Alfonzo','Dr.','1'),(2,'José David Mota Gamboa','Dr.','1'),(3,'Enrique López Loyo','Dr.','1'),(4,'Dilia Díaz Arreaza','Dra.','1'),(5,'Annie Planchart','Dra.','1'),(6,'Ruben Parra Montenegro','Dr.','1');
/*!40000 ALTER TABLE `patologos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macro_cassetes`
--

DROP TABLE IF EXISTS `macro_cassetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `macro_cassetes` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `bloques` int(11) NOT NULL DEFAULT '-1',
  `laminas` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`,`numero`),
  KEY `FK_CASSETE_BIOPSIA` (`id`),
  CONSTRAINT `FK_CASSETE_BIOPSIA` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla con la informacion de los cassetes de las biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_cassetes`
--
-- ORDER BY:  `id`,`numero`

LOCK TABLES `macro_cassetes` WRITE;
/*!40000 ALTER TABLE `macro_cassetes` DISABLE KEYS */;
/*!40000 ALTER TABLE `macro_cassetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biopsias_microscopicas`
--

DROP TABLE IF EXISTS `biopsias_microscopicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biopsias_microscopicas` (
  `id` int(11) NOT NULL,
  `idx` text,
  `diagnostico` text,
  `estudio_ihq` text,
  PRIMARY KEY (`id`),
  KEY `FK_MICRO_BIOPSIAS` (`id`),
  CONSTRAINT `FK_MICRO_BIOPSIAS` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='informacion de la fase microscopica de las biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias_microscopicas`
--
-- ORDER BY:  `id`

LOCK TABLES `biopsias_microscopicas` WRITE;
/*!40000 ALTER TABLE `biopsias_microscopicas` DISABLE KEYS */;
/*!40000 ALTER TABLE `biopsias_microscopicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macro_fotos`
--

DROP TABLE IF EXISTS `macro_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `macro_fotos` (
  `id` int(11) NOT NULL,
  `notacion` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `foto` longblob,
  `file_name` varchar(250) NOT NULL DEFAULT '',
  `fecha_registro` datetime NOT NULL,
  `es_foto_per_operatoria` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`file_name`),
  KEY `FK_MACRO_FOTO_BIOPSIA` (`id`),
  CONSTRAINT `FK_MACRO_FOTO_BIOPSIA` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='registro de fotos de la etapa macro';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_fotos`
--
-- ORDER BY:  `id`,`file_name`

LOCK TABLES `macro_fotos` WRITE;
/*!40000 ALTER TABLE `macro_fotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `macro_fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='Tabla de especialidades';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--
-- ORDER BY:  `id`

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` (`id`, `nombre`, `codigo`, `descripcion`, `activo`) VALUES (-1,'Vacio','000','Vacio','0'),(1,'Hematológica','001','Hematológica','1'),(2,'Neurológica','002','Neurológica','1'),(3,'Oftalmológica','003','Oftalmológica','1'),(4,'Enucleación','004','Enucleación','1'),(5,'Resección','005','Resección','1'),(6,'Excenteración','006','Excenteración','1'),(7,'Respiratorio','007','Respiratorio','1'),(8,'Nasales','008','Nasales','1'),(9,'Piel y Partes Blandas','009','Piel y Partes Blandas','1'),(10,'Cardiovascular','010','Cardiovascular','1'),(11,'Gatrointestinal','011','Gatrointestinal','1'),(12,'Ginecológica','012','Ginecológica','1'),(13,'Aparato Genital Masculino','013','Aparato Genital Masculino','1'),(14,'Sistema Endocrino','014','Sistema Endocrino','1');
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reactivos`
--

DROP TABLE IF EXISTS `reactivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reactivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `abreviatura` char(5) NOT NULL,
  `precio` double NOT NULL,
  `id_categoria_reactivo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_REACTIVO_CATEGORIA` (`id_categoria_reactivo`),
  CONSTRAINT `FK_REACTIVO_CATEGORIA` FOREIGN KEY (`id_categoria_reactivo`) REFERENCES `categorias_reactivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reactivos`
--
-- ORDER BY:  `id`

LOCK TABLES `reactivos` WRITE;
/*!40000 ALTER TABLE `reactivos` DISABLE KEYS */;
INSERT INTO `reactivos` (`id`, `nombre`, `abreviatura`, `precio`, `id_categoria_reactivo`) VALUES (-1,'oculto','OC',100,1),(97,'Recep. Estrógeno','RE',100,1),(98,'Recep. Progesterona','RP',100,1),(99,'Cerb-B2','CERB2',100,1),(100,'E-Cadherina','E-CAD',100,1),(101,'LC/DC Breast','LC/DC',100,1),(102,'Mamma globulina','MG',100,1),(103,'P 504 S','P504S',100,2),(104,'P 63','P63',100,2),(105,'Citoqueratina 34BE12','34B12',100,2),(106,'PSA','PSA',100,2),(107,'TSH','TSH',100,3),(108,'LH','LH',100,3),(109,'GH','GH',100,3),(110,'FSH','FSH',100,3),(111,'ACTH','ACTH',100,3),(112,'PL','PL',100,3),(113,'CD 1A','CD1A',100,4),(114,'CD 3','CD3',100,4),(115,'CD 4','CD4',100,4),(116,'CD 5','CD5',100,4),(117,'CD 7','CD7',100,4),(118,'CD 8','CD8',100,4),(119,'CD 10','CD10',100,4),(120,'CD 14','CD14',100,4),(121,'CD 15','CD15',100,4),(122,'CD 20','CD20',100,4),(123,'CD 21','CD21',100,4),(124,'CD 23','CD23',100,4),(125,'CD 30','CD30',100,4),(126,'CD 45ro','CD45',100,4),(127,'CD 56','CD56',100,4),(128,'CD 61','CD61',100,4),(129,'CD 68','CD68',100,4),(130,'CD 79a','CD79A',100,4),(131,'CD 138','CD138',100,4),(132,'CD 246 (ALK)','CD246',100,4),(133,'Mieloperox','MIELO',100,4),(134,'BCL 2','BCL2',100,4),(135,'LCA','LCA',100,4),(136,'P 53','P53',100,5),(137,'KI 67','KI67',100,5),(138,'PCNA','PCNA',100,5),(139,'EGFR','EGFR',100,5),(140,'CK AE1/AE3','CK',100,6),(141,'CK 7','CK7',100,6),(142,'CK 20','CK20',100,6),(143,'CK 5/6','CK5/6',100,6),(144,'Citoqueratina 34BE12','34B12',100,6),(145,'EMA','EMA',100,6),(146,'Act. Musculo Liso','AML',100,8),(147,'CD 31','CD31',100,8),(148,'CD 34','CD34',100,8),(149,'FV III','FVIII',100,8),(150,'Ulex Europeus','UE',100,8),(151,'VEGF','VEGF',100,8),(152,'D2-40 (podopianin)','D2-40',100,8),(153,'GFAP','GFAP',100,7),(154,'NSE','NSE',100,7),(155,'Sinaptofisina','SIN',100,7),(156,'Cromogranina','CROM',100,7),(157,'PGP 9.5','PGP95',100,7),(158,'Calponina','CALPO',100,9),(159,'Desmina','DES',100,9),(160,'Miogenina','MIOG',100,9),(161,'MYO D1','MYOD1',100,9),(165,'CEA','CEA',100,10),(166,'HEP-PAR','HEP',100,10),(167,'HGC','HGC',100,10),(168,'afetoproteina','afeto',100,10),(169,'Cairetinina','Caire',100,10),(170,'Tiroglobulina','Tiro',100,10),(171,'Ca 125','Ca125',100,10),(172,'a1 inhibina','ainhi',100,10),(173,'Calcitonina','Calci',100,10),(174,'P 21','P 21',100,10),(175,'Ca 19-9','Ca199',100,10),(176,'P 16','P 16',100,10),(177,'MD M2','MDM2',100,10),(178,'\"\"','\"\"',100,1);
/*!40000 ALTER TABLE `reactivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biopsias_ingresos`
--

DROP TABLE IF EXISTS `biopsias_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biopsias_ingresos` (
  `id` int(11) NOT NULL,
  `procedencia` varchar(250) NOT NULL,
  `pieza_recibida` varchar(250) NOT NULL,
  `referido_medico` varchar(250) DEFAULT NULL,
  `idx` text,
  `id_patologo_turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_INGRESO_BIOPSIA` (`id`),
  KEY `FK_INGRESO_PATOLOGO` (`id_patologo_turno`),
  CONSTRAINT `FK_INGRESO_BIOPSIA` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_INGRESO_PATOLOGO` FOREIGN KEY (`id_patologo_turno`) REFERENCES `patologos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='detalle de ingreso para una biopsia';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias_ingresos`
--
-- ORDER BY:  `id`

LOCK TABLES `biopsias_ingresos` WRITE;
/*!40000 ALTER TABLE `biopsias_ingresos` DISABLE KEYS */;
INSERT INTO `biopsias_ingresos` (`id`, `procedencia`, `pieza_recibida`, `referido_medico`, `idx`, `id_patologo_turno`) VALUES (4,'prueba','prueba','prueba','idx de prueba en ingreso',3),(5,'pri','ok','ok','ok',5),(7,'prueba','orueba','nonino','ok',6),(8,'pl','pl','pl','',3),(9,'ok','ok','prueba 777','',6);
/*!40000 ALTER TABLE `biopsias_ingresos` ENABLE KEYS */;
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
-- Table structure for table `fases_biopsia`
--

DROP TABLE IF EXISTS `fases_biopsia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fases_biopsia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='identificador para cada fase de un determinado examen de bio';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fases_biopsia`
--
-- ORDER BY:  `id`

LOCK TABLES `fases_biopsia` WRITE;
/*!40000 ALTER TABLE `fases_biopsia` DISABLE KEYS */;
INSERT INTO `fases_biopsia` (`id`, `nombre`) VALUES (1,'Ingreso'),(2,'Macroscopica'),(3,'Histologia'),(4,'Microscopica'),(5,'IHQ'),(6,'Entrega'),(7,'Confirmar IHQ'),(8,'Entregada A Paciente'),(9,'Rechazada Peticion IHQ'),(10,'Informe Impreso');
/*!40000 ALTER TABLE `fases_biopsia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biopsias_histologias`
--

DROP TABLE IF EXISTS `biopsias_histologias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biopsias_histologias` (
  `id` int(11) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `FK_HISTOLOGIA_BIOPSIA` (`id`),
  CONSTRAINT `FK_HISTOLOGIA_BIOPSIA` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias_histologias`
--
-- ORDER BY:  `id`

LOCK TABLES `biopsias_histologias` WRITE;
/*!40000 ALTER TABLE `biopsias_histologias` DISABLE KEYS */;
/*!40000 ALTER TABLE `biopsias_histologias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `micro_laminas_ihq_files`
--

DROP TABLE IF EXISTS `micro_laminas_ihq_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `micro_laminas_ihq_files` (
  `id` int(11) NOT NULL,
  `cassete` int(11) NOT NULL,
  `bloque` int(11) NOT NULL,
  `lamina` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_content` mediumblob,
  `id_reactivo` int(11) NOT NULL,
  PRIMARY KEY (`id`,`cassete`,`lamina`,`bloque`,`id_reactivo`,`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `micro_laminas_ihq_files`
--
-- ORDER BY:  `id`,`cassete`,`lamina`,`bloque`,`id_reactivo`,`file_name`

LOCK TABLES `micro_laminas_ihq_files` WRITE;
/*!40000 ALTER TABLE `micro_laminas_ihq_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `micro_laminas_ihq_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameters`
--

DROP TABLE IF EXISTS `parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameters` (
  `key` varchar(250) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  `editable` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameters`
--
-- ORDER BY:  `key`

LOCK TABLES `parameters` WRITE;
/*!40000 ALTER TABLE `parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_reactivos`
--

DROP TABLE IF EXISTS `categorias_reactivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_reactivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_reactivos`
--
-- ORDER BY:  `id`

LOCK TABLES `categorias_reactivos` WRITE;
/*!40000 ALTER TABLE `categorias_reactivos` DISABLE KEYS */;
INSERT INTO `categorias_reactivos` (`id`, `nombre`) VALUES (1,'Mama'),(2,'Prostata'),(3,'Hipofisis'),(4,'Linfoma'),(5,'Proliferación'),(6,'Epiteliales'),(7,'Neuroendocrinos'),(8,'Vasculares'),(9,'Musculares'),(10,'Otros');
/*!40000 ALTER TABLE `categorias_reactivos` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `micro_laminas`
--

DROP TABLE IF EXISTS `micro_laminas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `micro_laminas` (
  `id` int(11) NOT NULL,
  `cassete` int(11) NOT NULL,
  `bloque` int(11) NOT NULL,
  `lamina` int(11) NOT NULL,
  `descripcion` text,
  `id_reactivo` int(11) NOT NULL DEFAULT '-1',
  `procesado` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`cassete`,`lamina`,`bloque`,`id_reactivo`),
  KEY `FK_LAMINA_REACTIVO` (`id_reactivo`),
  CONSTRAINT `FK_LAMINA_REACTIVO` FOREIGN KEY (`id_reactivo`) REFERENCES `reactivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='laminas de trabajo, normales e IHQ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `micro_laminas`
--
-- ORDER BY:  `id`,`cassete`,`lamina`,`bloque`,`id_reactivo`

LOCK TABLES `micro_laminas` WRITE;
/*!40000 ALTER TABLE `micro_laminas` DISABLE KEYS */;
/*!40000 ALTER TABLE `micro_laminas` ENABLE KEYS */;
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
  `codigo_premium` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_EXAMEN_GRUPO` (`id_tipo_examen`),
  CONSTRAINT `FK_EXAMEN_GRUPO` FOREIGN KEY (`id_tipo_examen`) REFERENCES `especialidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COMMENT='tabla para registrar los distintos examenes de biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examenes_biopsias`
--
-- ORDER BY:  `id`

LOCK TABLES `examenes_biopsias` WRITE;
/*!40000 ALTER TABLE `examenes_biopsias` DISABLE KEYS */;
INSERT INTO `examenes_biopsias` (`id`, `codigo`, `dias_resultado`, `nombre`, `activo`, `id_tipo_examen`, `codigo_premium`) VALUES (-1,'0000',0,'vacio','0',-1,''),(34,'0001',7,'Ganglio linfático por punción','1',1,'0001'),(35,'0001',7,'Por reseccción','1',1,'0001');
/*!40000 ALTER TABLE `examenes_biopsias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biopsias`
--

DROP TABLE IF EXISTS `biopsias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biopsias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `side1_code_biopsia` varchar(10) NOT NULL,
  `side2_code_biopsia` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_examen_biopsia` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_fase_actual` int(11) NOT NULL,
  `ultimo_informe_impreso` mediumblob,
  `id_tipo_estudio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_CODIGO_BIOPSIA` (`side1_code_biopsia`,`side2_code_biopsia`),
  KEY `FK_BIOPSIA_EXAMEN` (`id_examen_biopsia`),
  KEY `FK_BIOPSIA_CLIENTE` (`id_cliente`),
  KEY `FK_BIOPSIA_FASE` (`id_fase_actual`),
  KEY `FK_BIOPSIA_TIPO_ESTUDIO` (`id_tipo_estudio`),
  CONSTRAINT `FK_BIOPSIA_CLIENTE` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_BIOPSIA_EXAMEN` FOREIGN KEY (`id_examen_biopsia`) REFERENCES `examenes_biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_BIOPSIA_FASE` FOREIGN KEY (`id_fase_actual`) REFERENCES `fases_biopsia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_BIOPSIA_TIPO_ESTUDIO` FOREIGN KEY (`id_tipo_estudio`) REFERENCES `tipo_estudio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Tabla maestro de las biopsias realizadas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias`
--
-- ORDER BY:  `id`

LOCK TABLES `biopsias` WRITE;
/*!40000 ALTER TABLE `biopsias` DISABLE KEYS */;
INSERT INTO `biopsias` (`id`, `side1_code_biopsia`, `side2_code_biopsia`, `fecha_registro`, `id_examen_biopsia`, `id_cliente`, `id_fase_actual`, `ultimo_informe_impreso`, `id_tipo_estudio`) VALUES (4,'13','00001','2013-11-02',34,3,1,NULL,2),(5,'8500','P','2013-11-03',34,3,1,NULL,1),(7,'13','00002','2013-11-04',34,3,1,NULL,2),(8,'13','00003','2013-11-04',34,3,1,NULL,1),(9,'13','00004','2013-11-09',34,3,1,NULL,4);
/*!40000 ALTER TABLE `biopsias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_estudio`
--

DROP TABLE IF EXISTS `tipo_estudio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_estudio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  `abreviatura` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='tipos de estudios posibles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_estudio`
--
-- ORDER BY:  `id`

LOCK TABLES `tipo_estudio` WRITE;
/*!40000 ALTER TABLE `tipo_estudio` DISABLE KEYS */;
INSERT INTO `tipo_estudio` (`id`, `nombre`, `activo`, `abreviatura`) VALUES (1,'Biopsia','1',''),(2,'Citologia','1','-C'),(3,'IHQ','1','-IHQ'),(4,'CISH','1','-CISH');
/*!40000 ALTER TABLE `tipo_estudio` ENABLE KEYS */;
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
  `direccion` text,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula_UNIQUE` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='pacientes a los que se les realice algun examen de biopsia';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--
-- ORDER BY:  `id`

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `id_premium`, `cedula`, `nombres`, `apellidos`, `edad`, `telefono`, `correo`, `direccion`, `activo`) VALUES (-1,NULL,'0000','vacio','vacio',0,'vacio','vacio','vacio','0'),(1,'11970267','V-11970267','ERNESTO','IBRAIM',30,'',NULL,'LA ALAMEDA BARUTA ','1'),(2,'9656280','V-9656280','GIZEH','PARRA MONTENEGRO',30,'',NULL,'Santa Monica','1'),(3,'','V-15507019','Felipe','Rojas',30,'04122354731','','','1');
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

-- Dump completed on 2013-12-02  8:37:21
