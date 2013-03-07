CREATE DATABASE  IF NOT EXISTS `ingenier_sistema` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ingenier_sistema`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: ingenier_sistema
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
-- Table structure for table `banqueros`
--

DROP TABLE IF EXISTS `banqueros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banqueros` (
  `idbanquero` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ced_rif` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `direccion` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `telefonos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `web` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `usuario` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `clave` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ml` int(1) DEFAULT NULL COMMENT '1 si puede modificar logros',
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idbanquero`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='MyISAM free: 10240 kB';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banqueros`
--
-- ORDER BY:  `idbanquero`

LOCK TABLES `banqueros` WRITE;
/*!40000 ALTER TABLE `banqueros` DISABLE KEYS */;
INSERT INTO `banqueros` (`idbanquero`, `nombres`, `apellidos`, `ced_rif`, `direccion`, `telefonos`, `correo`, `web`, `usuario`, `clave`, `ml`, `estatus`) VALUES (1,'LARRY DACOSTA','PRINCIPAL','123456','CARACAS','04166147879','BANCADEPORTIVA@GMAIL.COM','WWW.GRANAPUESTA.COM','bancalarry','lunabar',0,1),(2,'CARLOS','LUCENA','12548547','Maracay','02435426548','carlos@hotmail.com','http://www.carloslucena.com','dos','123',1,1),(3,'BANCA JORGE','ROBERTO FARAH','123','123','123','123','123','BANCAJORGE','654321',0,1),(4,'BANCA ALQUILER ROBERTO','FARAH','12542588','Los proceres','02120548785','lucia@gmail.com','www.lucia.com.ve','BANCAALQUILER','123456',1,1),(5,'BANCA BRAYAN','MOREJON','123','Maracay','4243980018','zuli@gmail.com','www.zuli.com','BANCABRAYAN','123456',0,1),(6,'BANCA ROBERTO','FARAH','123456','CARACAS','(0416) 614-7879','BANCADEPORTIVA@GMAIL.COM','WWW.GRANAPUESTA.COM','ROBERTOFARAHTA','654321',0,1),(7,'Alejandro ','Jaramillo','123456','maracay','04144562296','alejaramillo@gmail.com','sistemasje.com.ve','ajaramillo','compaq',1,1),(8,'LARRY/ROBERTO ','FARAH','17667076','PUNTO FIJO','04146842688','VELIAUSCA@GMAIL.COM','NO','LARRYROBERTO','123456',0,1),(9,'NO FUNCIONA','BIEN','123','123','123','123','123','MALO2','123456',1,1),(10,'NO FUNCIONA ','BIEN','123','123','123','123','123','MALO','7566888',0,1);
/*!40000 ALTER TABLE `banqueros` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:36
