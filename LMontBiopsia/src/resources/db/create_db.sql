DROP DATABASE  IF EXISTS `lmont_biopsia`;
CREATE DATABASE  IF NOT EXISTS `lmont_biopsia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lmont_biopsia`;
SET foreign_key_checks = 0;
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


--
-- Table structure for table `patologos`
--

DROP TABLE IF EXISTS `patologos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patologos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  genero varchar(10),
  `nombre` varchar(250) NOT NULL,
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
INSERT INTO `patologos` (`id`, genero, `nombre`, `activo`) VALUES (1,'Dr.','Jésus Enrique González Alfonzo','1'),(2,'Dr.','José David Mota Gamboa','1'),(3,'Dr.','Enrique López Loyo','1'),(4,'Dra.','Dilia Díaz Arreaza','1'),(5,'Dra.','Annie Planchart','1'),(6,'Dr.','Ruben Parra Montenegro','1');
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
  `foto` longblob NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  es_foto_per_operatoria char(1) default '0',
  PRIMARY KEY (`id`,`file_name`),
  KEY `FK_MACRO_FOTO_BIOPSIA` (`id`),
  CONSTRAINT `FK_MACRO_FOTO_BIOPSIA` FOREIGN KEY (`id`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='registro de fotos de la etapa macro';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_fotos`
--
-- ORDER BY:  `id`,`file_name`

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COMMENT='Tabla de grupos de examenes de biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_examenes`
--
-- ORDER BY:  `id`

LOCK TABLES `tipo_examenes` WRITE;
/*!40000 ALTER TABLE `tipo_examenes` DISABLE KEYS */;
INSERT INTO `tipo_examenes` (`id`, `nombre`, `codigo`, `descripcion`, `activo`) VALUES (-1,'Vacio','000','Vacio','0'),(1,'PIEL Y TEJIDOS','001','PIEL Y TEJIDOS','1'),(2,'GINECOLOGICAS','002','GINECOLOGICAS','1'),(3,'OVARIO','003','OVARIO','1'),(4,'HEMATOLOGICAS','004','HEMATOLOGICAS','1'),(5,'DIGESTIVAS','005','DIGESTIVAS','1'),(6,'GLANDULA MAMARIA','006','GLANDULA MAMARIA','1'),(7,'GENITOURINARIO','007','GENITOURINARIO','1'),(8,'PROSTATA','008','PROSTATA','1'),(9,'VEJIGA','009','VEJIGA','1'),(10,'TESTICULO','010','TESTICULO','1'),(11,'CABEZA Y CUELLO','011','CABEZA Y CUELLO','1'),(12,'NEUROLOGICAS','012','NEUROLOGICAS','1'),(13,'TRAUMATOLOGICAS/TEJIDOS BLANDOS','013','TRAUMATOLOGICAS/TEJIDOS BLANDOS','1'),(14,'CIRCULATORIO','014','CIRCULATORIO','1'),(15,'RESPIRATORIO','015','RESPIRATORIO','1'),(16,'BIOPSIAS POR PUNCION','016','BIOPSIAS POR PUNCION','1'),(17,'BIOPSIAS PREOPERATORIAS','017','BIOPSIAS PREOPERATORIAS','1'),(18,'CITOLOGIAS','018','CITOLOGIAS','1'),(19,'OTROS ESTUDIOS','019','OTROS ESTUDIOS','1'),(20,'INMUNOHISTOQUIMICA','020','INMUNOHISTOQUIMICA','1'),(21,'TROMPAS UTERINAS ','021','TROMPAS UTERINAS ','1'),(22,'OBSTETRICAS','022','OBSTETRICAS','1');
/*!40000 ALTER TABLE `tipo_examenes` ENABLE KEYS */;
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
INSERT INTO `biopsias_histologias` (`id`, `descripcion`) VALUES (1,'descripcion');
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
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1 COMMENT='tabla para registrar los distintos examenes de biopsias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examenes_biopsias`
--
-- ORDER BY:  `id`

LOCK TABLES `examenes_biopsias` WRITE;
/*!40000 ALTER TABLE `examenes_biopsias` DISABLE KEYS */;
INSERT INTO `examenes_biopsias` (`id`, `codigo`, `dias_resultado`, `nombre`, `activo`, `id_tipo_examen`) VALUES (-1,'0000',0,'vacio','0',-1),(1,'001',7,'002-001 FIMOSECTOMIA','1',1),(2,'002',7,'002-002 LIPOMA, TEJIDOS BLANDOS','1',1),(3,'003',7,'002-003 PIEL, EXTIRPACION DE NEVUS,DERMATOFIBROMA','1',1),(4,'004',7,'002-004 PIEL, RESECCIONES AMPLIAS','1',1),(5,'005',7,'002-005 QUISTE DE BARTHOLINO, QUISTE SEBACEO','1',1),(6,'006',7,'002-006 QUISTE DE SENO PILONIDAL','1',1),(7,'007',7,'002-007 QUISTE ODONTOGÉNICO, QUISTE TIROGLOSO','1',1),(8,'008',7,'002-008 CUELLO UTERINO, CONO','1',2),(9,'009',7,'002-009 CUELLO UTERINO','1',2),(10,'010',7,'002-010 ENDOMETRIO','1',2),(11,'011',7,'002-011 EXOCERVIX. ENDOCERVIX','1',2),(12,'012',7,'002-012 HISTERECTOMIA CON ANEXOS','1',2),(13,'013',7,'002-013 HISTERECTOMIA RADICAL','1',2),(14,'014',7,'002-014 HISTERECTOMÍA SIN ANEXOS','1',2),(15,'015',7,'002-015 LEGRADO,EXOCERVIX Y ENDOCERVIX','1',2),(16,'016',7,'002-016 LEIOMIOMIA','1',2),(17,'017',7,'002-017 MIOMECTOMÍA','1',2),(18,'018',7,'002-018 PÓLIPO DE CUELLO UTERINO, ENDOMETRIO','1',2),(19,'019',7,'002-019 CUÑA DE OVARIO','1',3),(20,'020',7,'002-020 OVARIO OOFORECTOMÍA','1',3),(21,'021',7,'002-021 OVARIO PROTOCOLO','1',3),(22,'022',7,'002-022 HIDATIDE DE MORGAGNI','1',21),(23,'023',7,'002-023 SALPINGECTOMÍA','1',21),(24,'024',7,'002-024 VAGINA, BIOPSIA','1',21),(25,'025',7,'002-025 VULVA, VULVECTOMIA','1',21),(26,'026',7,'002-026 AUTOPSIAS DE FETOS','1',22),(27,'027',7,'002-027 LEGRADO UTERINO','1',22),(28,'028',7,'042','1',22),(29,'029',7,'002-029 ESPLENECTOMIA','1',4),(30,'030',7,'002-030 GANGLIO LINFATICO, VACIAMIENTO','1',4),(31,'031',7,'002-031 GANGLIO LINFATICO','1',4),(32,'032',7,'002-032 MÉDULA ÓSEA','1',4),(33,'033',7,'002-033 APENDICECTOMIA','1',5),(34,'034',7,'002-034 BIOPSIA HEPÁTICA','1',5),(35,'035',7,'002-035 COLECISTECTOMÍA','1',5),(36,'036',7,'002-036 COLON POR DIVERTÍCULOS, NO TUMORAL','1',5),(37,'037',7,'002-037 EPIPLÓN','1',5),(38,'038',7,'002-038 ESÓFAGO Y ESTÓMAGO','1',5),(39,'039',7,'002-039 ESÓFAGO, ESTOMAGO, INTESTINO DELGADO Y','1',5),(40,'040',7,'002-040 ESÓFAGO, ESTÓMAGO, INTESTINO DELGADO, N...','1',5),(41,'041',7,'002-041 ESTÓMAGO Y COLON','1',5),(42,'042',7,'002-042 ESTÓMAGO Y DUODENO','1',5),(43,'043',7,'002-043 ESTÓMAGO, DUODENO,COLON RECTO(BIOPSIAS)','1',5),(44,'044',7,'002-045 FISURA O FISTULA ANAL','1',5),(45,'045',7,'HEMORROIDECTOMIA','1',5),(46,'046',7,'002-046 PANCREAS RESECCIÓN','1',5),(47,'047',7,'002-047 PANCREAS, PUNCION','1',5),(48,'048',7,'002-048 PANCREATECTOMÍA DE TUMOR MALIGNO','1',5),(49,'049',7,'002-049 SACO HERNIARIO','1',5),(131,'050',7,'002-050 MAMA, FOBROADENOMA,NODULECTOMÍA','1',6),(132,'051',7,'002-051 MAMOPLASTIA','1',6),(133,'052',7,'002-052 MASTECTOMIA POR NEOPLASIA','1',6),(134,'053',7,'002-053 MASTECTOMIA RADICAL CON PROTOCOLO POR TUMOR MALIGNO','1',6),(135,'054',7,'002-054 NEFRECTOMIA NO NEOPLÁSTICA','1',7),(136,'055',7,'002-055 NEFRECTOMÍA POR NEOPLÁSIA','1',7),(137,'056',7,'002-056 RIÑÓN, BIOPSIA','1',7),(138,'057',7,'002-057  SUPRARRENAL','1',7),(139,'058',7,'002-058 URÉTER, RESECCION','1',7),(140,'059',7,'002-059 PRÓSTATA, BIOPSIAS POR PUNCION (AMBOS LADOS)','1',8),(141,'060',7,'002-060 PROSTATECTOMÍA RADICAL','1',8),(142,'061',7,'002-061 PROSTACTECOMÍA SUPRAPÚBICA','1',8),(143,'062',7,'002-062 PROSTATECTOMÍA TRANSURETRAL','1',8),(144,'063',7,'002-063 CISTECTOMÍA POR NEOPLASIA','1',9),(145,'064',7,'002-064 VEJIGA, BIOPSIA TRANSURETRAL','1',9),(146,'065',7,'002-065 HIDROCELE','1',10),(147,'066',7,'002-066  PENE','1',10),(148,'067',7,'002-067 TESTÍCULO, BIOPSIA','1',10),(149,'068',7,'002-068 TESTÍCULO, ORQUIDECTOMÍA','1',10),(150,'069',7,'002-069 TESTÍCULO, ORQUIDECTOMÍA BILATERAL','1',10),(151,'070',7,'002-070 TESTÍCULO, ORQUIDECTOMÍA POR NEOPLASIA R','1',10),(152,'071',7,'002-071 AMIGDALAS Y ADENOIDES','1',11),(153,'072',7,'002-072 CUERDAS VOCALES','1',11),(154,'073',7,'002-073 GLÁNDULAS SALIVARES NEOPLÁSTICAS, PARÓTIDAS','1',11),(155,'074',7,'002-074 GLÁNDULAS SALIVARES NO NEOPLÁSTICAS, PARÓRIDAS','1',11),(156,'075',7,'002-075 GLOSECTOMÍA','1',11),(157,'076',7,'002-076 HEMIGLOSECTOMÍA','1',11),(158,'077',7,'002-077 LARINGE, BIOPSIA','1',11),(159,'078',7,'002-078 LARINGECTOMÍA','1',11),(160,'079',7,'002-079 LENGUA,BIOPSIA','1',11),(161,'080',7,'002-080 PARATIROIDES','1',11),(162,'081',7,'002-081 PERITONEO','1',11),(163,'082',7,'002-082 TIROIDECTOMÍA POR NEOPLASIA','1',11),(164,'083',7,'002-083 TOROIDES LESIÓN BENIGNA','1',11),(165,'084',7,'002-084 CEREBRO (BIOPSIA ESTEREOTÁXICA)','1',12),(166,'085',7,'002-085 HIPÓFISIS','1',12),(167,'086',7,'002-086 MENINGES, TUMOR','1',12),(168,'087',7,'002-087 NERVIO','1',12),(169,'088',7,'002-088 AMPUTACION DE DEDO','1',13),(170,'090',7,'002-090 CABEZA DE FÉMUR','1',13),(171,'091',7,'002-091 CARTÍGALO','1',13),(172,'092',7,'002-092 DISCO INTERVERTEBRAL','1',13),(173,'093',7,'002-093 EXOSTOSIS ÓSEA','1',13),(174,'094',7,'002-094 GANGLIÓN','1',13),(175,'095',7,'002-095 HUESO, BIOPSIA','1',13),(176,'096',7,'002-096 LAMINECTOMÍA','1',13),(177,'097',7,'002-097 SINOVIAL','1',13),(178,'098',7,'002-098 ANEURISMAS','1',14),(179,'099',7,'002-099 ARTERIA, PLACA ATEROMATOSA','1',14),(180,'100',7,'002-100 MICARDIO, BIOPSOA','1',14),(181,'101',7,'002-101 VALVULAS CARDÍACAS','1',14),(182,'102',7,'002-102 VÁRICES','1',14),(183,'103',7,'002-103 VARICOCELE','1',14),(184,'104',7,'002-104 BIOPSIA Y LAVADO BRONQUIAL','1',15),(185,'105',7,'002-105 BRONQUIO, BIOPSIA','1',15),(186,'106',7,'002-106 PLEURA','1',15),(187,'107',7,'002-107 PÓLIPOS INFLAMATORIOS NASALES, PARANASALES','1',15),(188,'108',7,'002-108 PULMON, BIOPSIA','1',15),(189,'109',7,'002-109 PULMON, NEUMONECTOMÍA NO TUMORAL','1',15),(190,'110',7,'002-110 PULMON, NEUMONECTOMÍA POR NEOPLASIA','1',15),(191,'111',7,'002-111 HÍGADO','1',16),(192,'112',7,'002-112 GLÁNDULA MAMARIA, PUNCIÓN','1',16),(193,'113',7,'002-113 PARTES BLANDAS','1',16),(194,'114',7,'002-114 PRÓSTATA (AMBOS LADOS)','1',16),(195,'115',7,'002-115 PULMÓN PUNCION','1',16),(196,'116',7,'002-116 TIROIDES, PUNCIÓN','1',16),(197,'117',7,'002-117 BIOPSIAS PER-OPERATORIA (CORTE CONGELADO) (ADICIONAL A LA PIEZA QUIRURGICA)','1',17),(198,'118',7,'002-118 BLOQUE CELULAR','1',18),(199,'119',7,'002-119 ENDOMETRIO','1',18),(200,'120',7,'002-120 EXO-ENDOCERVIX','1',18),(201,'121',7,'002-121 MAMA','1',18),(202,'122',7,'002-122 MAMA (BILATERAL)','1',18),(203,'123',7,'002-123 TIROIDES, LIQUIDO PERITONEAL, ESPUTO','1',18),(204,'124',7,'002-124 VULVA','1',18),(205,'125',7,'002-125 CAPTURA DE HÍBRIDOS','1',19),(206,'126',7,'002-126 RECUPERACION ANTÍGENOS (CISH)','1',19),(207,'127',7,'002-027 HIPÓFISIS','1',19),(208,'128',7,'002-128 GANGLIOS LINFÁTICOS','1',19),(209,'129',7,'002-129 MAMAS (4 REACCIONES)','1',19),(210,'130',7,'COSTO CADA REACCION DE INMUNOHISTOQUÍMICA','1',19);
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
  `year_biopsia` int(2) unsigned zerofill NOT NULL,
  `numero_biopsia` int(6) unsigned zerofill NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_examen_biopsia` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_fase_actual` int(11) NOT NULL,
  ultimo_informe_impreso mediumblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_CODIGO_BIOPSIA` (`year_biopsia`,`numero_biopsia`),
  KEY `FK_BIOPSIA_EXAMEN` (`id_examen_biopsia`),
  KEY `FK_BIOPSIA_CLIENTE` (`id_cliente`),
  KEY `FK_BIOPSIA_FASE` (`id_fase_actual`),
  CONSTRAINT `FK_BIOPSIA_CLIENTE` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_BIOPSIA_EXAMEN` FOREIGN KEY (`id_examen_biopsia`) REFERENCES `examenes_biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_BIOPSIA_FASE` FOREIGN KEY (`id_fase_actual`) REFERENCES `fases_biopsia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabla maestro de las biopsias realizadas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biopsias`
--
-- ORDER BY:  `id`

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

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `id_premium`, `cedula`, `nombres`, `apellidos`, `edad`, `telefono`, `correo`, `direccion`, `activo`) VALUES (-1,NULL,'0000','vacio','vacio',0,'vacio','vacio','vacio','0');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cliente`
--
-- ORDER BY:  `id`
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-27 11:26:57
SET foreign_key_checks = 1;
