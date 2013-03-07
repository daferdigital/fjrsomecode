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
-- Table structure for table `tipo_apuestas`
--

DROP TABLE IF EXISTS `tipo_apuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_apuestas` (
  `idtipo_apuesta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` enum('juego','equipo') DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idtipo_apuesta`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_apuestas`
--
-- ORDER BY:  `idtipo_apuesta`

LOCK TABLES `tipo_apuestas` WRITE;
/*!40000 ALTER TABLE `tipo_apuestas` DISABLE KEYS */;
INSERT INTO `tipo_apuestas` (`idtipo_apuesta`, `nombre`, `tipo`, `estatus`) VALUES (1,'A Ganar','equipo',1),(2,'RunLine','equipo',1),(3,'Altas y Bajas','juego',1),(4,'Valores para Altas y Bajas','juego',1),(5,'Anota primero','equipo',1),(6,'Primer inning','juego',1),(7,'Super Run Line','equipo',1),(8,'Empate','juego',1),(9,'C-H-E','juego',1),(10,'RunLine Alternativo','equipo',1);
/*!40000 ALTER TABLE `tipo_apuestas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:19
