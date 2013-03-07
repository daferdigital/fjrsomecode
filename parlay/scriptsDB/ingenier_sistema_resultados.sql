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
-- Table structure for table `resultados`
--

DROP TABLE IF EXISTS `resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultados` (
  `idresultado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `que_equipo` enum('B','A') DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idresultado`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultados`
--
-- ORDER BY:  `idresultado`

LOCK TABLES `resultados` WRITE;
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
INSERT INTO `resultados` (`idresultado`, `nombre`, `descripcion`, `que_equipo`, `estatus`) VALUES (1,'mediojuegoa','Medio Juego A','A',1),(2,'mediojuegob','Medio Juego B','B',1),(3,'suspendidomediojuego','Suspendido Medio Juego','A',1),(4,'marcadorfinala','Marcador Final A','A',1),(5,'marcadorfinalb','Marcador Final B','B',1),(6,'juegosuspendido','Juego Suspendido','A',1),(7,'primerinning','Anota primer inning','A',1),(8,'anotaprimero','Anota primero','A',1),(9,'2damitada','2da Mitad A','A',1),(10,'2damitadb','2da Mitad B','B',1),(11,'hita','Hit A','A',1),(12,'hitb','Hit B','B',1),(13,'errora','Error A','A',1),(14,'errorb','Error B','B',1),(15,'primertiempoa','Primer Tiempo A','A',1),(16,'primertiempob','Primer Tiempo B','B',1),(17,'segundotiempoa','Segundo Tiempo A','A',1),(18,'segundotiempob','Segundo Tiempo B','B',1),(19,'tercertiempoa','Tercer Tiempo A','A',1),(20,'tercertiempob','Tercer Tiempo B','B',1);
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:52
