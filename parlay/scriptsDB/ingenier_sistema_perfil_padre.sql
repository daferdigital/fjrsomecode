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
-- Table structure for table `perfil_padre`
--

DROP TABLE IF EXISTS `perfil_padre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_padre` (
  `id_perfil_padre` int(10) NOT NULL AUTO_INCREMENT,
  `perfil_padre` varchar(50) NOT NULL,
  `orden` int(2) NOT NULL,
  `desplegable` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_perfil_padre`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_padre`
--
-- ORDER BY:  `id_perfil_padre`

LOCK TABLES `perfil_padre` WRITE;
/*!40000 ALTER TABLE `perfil_padre` DISABLE KEYS */;
INSERT INTO `perfil_padre` (`id_perfil_padre`, `perfil_padre`, `orden`, `desplegable`) VALUES (1,'Como apostar?',0,0),(2,'Ventas',2,1),(3,'Deportes',14,1),(4,'Banca',4,1),(5,'Logros',5,1),(6,'Resultados',6,1),(9,'Reportes',9,1),(10,'Mantenimiento',10,1),(11,'Salir',20,0),(12,'Admin',13,1),(13,'Ticket',3,1),(14,'Calculadora',1,0);
/*!40000 ALTER TABLE `perfil_padre` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:41
