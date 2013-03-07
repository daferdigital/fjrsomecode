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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  `condicion_esp` int(1) NOT NULL COMMENT 'condiciï¿½n para reconocer la condiciï¿½n del asistente',
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--
-- ORDER BY:  `idusuario`

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`, `nombre`, `telefono`, `email`, `direccion`, `usuario`, `clave`, `tipo`, `idperfil`, `estatus`, `condicion_esp`) VALUES (1,'ROBERTO FARAH','04146842688','veliausca@gmail.com','Punto Fijo','robertofarah','hgdtfdghfy',1,1,0,0),(2,'PEDRO PEREZ','0412','asistente.administrador@gmail.com','Maracay','asistente','2dcvgbnncdf',2,1,0,1),(4,'CARLA','02123443234','carla@yahoo.com','Las Mercedes','carla','gfxzsfdbfc',2,1,0,0),(5,'ASISTENTE PRINCIPAL','04146842688','veliausca@gmail.com','punto fijo','asistente1','123456',1,1,1,0),(6,'GRAN APUESTA','04146842688','granapuesta.com@gmail.com','guatire','admin','caracas2013',1,1,1,0),(7,'JORGE NATERA','04148731962','jorgenatera2012@gmail.com','punto fijo','jorgenatera','jbhvffdsxvbnd',2,1,0,2),(8,'ADRIAN MAZA','04241271613','adrian14064@hotmail.com','GUATIRE','adrian01','jhvfgfsxgvfghd',1,1,0,0),(9,'EFRAIN VASQUEZ','04242131926','vasqueze@granapuesta.com','GUATIRE','vasqueze','efra12',1,1,1,0),(10,'JOSE LUIS AGUILERA','04141234567','JOSEA@granapuesta.com','GUATIRE','josea','22542714.0717',1,1,1,0),(11,'DANIEL MORENO','04124307806','morenod@granapuesta.com','GUATIRE','morenod','angie',1,1,1,0),(12,'ERIANYELIS JIMENEZ','04146686853','ERIANYELISJIMENEZ@HOTMAIL.COM','AMUAY','EJIMENEZ','hvgdgfdhg',2,1,0,2),(13,'MARINA ','04246373401','BANCADEPORTIVA@GMAIL.COM','CARACAS','marina','resultados2012',1,1,1,0),(14,'erik','123','123','123','erick01','santi',1,1,1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:50
