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
-- Table structure for table `apuestas`
--

DROP TABLE IF EXISTS `apuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apuestas` (
  `idapuesta` int(11) NOT NULL AUTO_INCREMENT,
  `idtipo_apuesta` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `que_equipo` enum('A','B') DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idapuesta`),
  KEY `idtipo_apuesta` (`idtipo_apuesta`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apuestas`
--
-- ORDER BY:  `idapuesta`

LOCK TABLES `apuestas` WRITE;
/*!40000 ALTER TABLE `apuestas` DISABLE KEYS */;
INSERT INTO `apuestas` (`idapuesta`, `idtipo_apuesta`, `nombre`, `descripcion`, `que_equipo`, `estatus`) VALUES (1,1,'jcv','A ganar JC','A',1),(2,1,'mjv','A ganar MJ','A',1),(3,1,'jch','A ganar JC','B',1),(4,1,'mjh','A ganar MJ','B',1),(7,4,'AoBJC','Valores que se aplican para altas y bajas de juego completo','A',1),(8,4,'AoBMJ','Valores que se aplican para altas y bajas de medio  juego','A',1),(9,3,'logroaljc','Alta JC','A',1),(10,3,'logrobajc','Baja JC','A',1),(11,3,'logroalmj','Alta MJ','A',1),(12,3,'logrobamj','Baja MJ','A',1),(13,5,'anotav','1ero','A',1),(14,5,'anotah','1ero','B',1),(15,6,'siprimer','Si','A',1),(16,6,'noprimer','No','A',1),(17,2,'unomedioa','RLJC','A',1),(18,2,'unomediob','RLJC','B',1),(19,2,'ceromedioa','RLMJ','A',1),(20,2,'ceromediob','RLMJ','B',1),(21,7,'dosmedioa','SRL','A',1),(22,7,'dosmediob','SRL','B',1),(23,8,'ejc','Empate JC','A',1),(24,8,'emj','Empate MJ','A',1),(25,7,'unomedioa','1 1/2 A','A',1),(26,7,'unomediob','1 1/2 B','B',1),(27,9,'vche','Valor del CHE','A',1),(28,9,'logroache','ACHE','A',1),(29,9,'logrobche','BCHE','A',1),(30,10,'rlajca','RLAJC','A',1),(31,10,'rlajcb','RLAJC','B',1),(32,10,'rlamja','Run Line alternativo MJA','A',1),(33,10,'rlamjb','Run Line alternativo MJB','B',1),(34,3,'logroal6to','Alta 6to','A',1),(35,3,'logroba6to','Baja 6to','A',1),(36,4,'AoB6to','Valores que se aplican para altas y bajas de 6to','A',1),(37,1,'2damitadv','A ganar 2M','A',1),(38,1,'2damitadh','A ganar 2M','B',1),(39,2,'segundamitad','RL2M','A',1),(40,2,'segundamitad','RL2M','B',1),(41,1,'primertiempoa','1er Tiempo','A',1),(42,1,'primertiempob','1er Tiempo','B',1),(43,1,'segundotiempoa','2do Tiempo','A',1),(44,1,'segundotiempob','2do Tiempo','B',1),(45,1,'tercertiempoa','3er Tiempo','A',1),(46,1,'tercertiempob','3er Tiempo','B',1);
/*!40000 ALTER TABLE `apuestas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:21
