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
-- Table structure for table `intermediarios`
--

DROP TABLE IF EXISTS `intermediarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intermediarios` (
  `idintermediario` int(11) NOT NULL AUTO_INCREMENT,
  `idbanquero` int(11) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `pp` int(2) DEFAULT NULL COMMENT 'Porcentaje de parley',
  `pd` int(2) DEFAULT NULL COMMENT 'Porcentaje derecho',
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `mt` int(1) DEFAULT '1' COMMENT '1 si puede modificar taquillas',
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idintermediario`),
  KEY `idbanquero` (`idbanquero`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intermediarios`
--
-- ORDER BY:  `idintermediario`

LOCK TABLES `intermediarios` WRITE;
/*!40000 ALTER TABLE `intermediarios` DISABLE KEYS */;
INSERT INTO `intermediarios` (`idintermediario`, `idbanquero`, `cedula`, `nombre`, `direccion`, `telefono`, `pp`, `pd`, `usuario`, `clave`, `mt`, `estatus`) VALUES (1,2,'164580785','MIRIAM GONCALVES','La Morita - La Victoria','04144562296',10,8,'iuno','123',1,1),(2,2,'24512544','FRANKLIN JIMENEZ','La Mora','04125487544',10,9,'FJIMENEZ','123',1,1),(3,5,'20122322','ZUNIGEN','Cagua','04143423455',10,5,'ZUNIGEN','123',1,1),(4,1,'123456','LARRY DACOSTA','CARACAS','04166147879',0,0,'larrydacosta','lunabar',0,1),(5,1,'123','CENTRO HIPICOS','CARACAS','123',0,0,'CHIPICOS','matador',0,1),(6,1,'123','ROQUES','CARACAS','123',0,0,'ROQUES','123456',0,1),(7,1,'123','CUA','CARACAS','123',0,0,'CUA','123456',0,1),(8,1,'123','HIGUEROTE','CARACAS','123',0,0,'HIGUEROTE','2909',0,1),(9,1,'123','DANGER','CARACAS','123',0,0,'DANGER','123456',0,1),(10,1,'123','ADRIAN','CARACAS','123',0,0,'ADRIAN','123456',0,1),(11,1,'123','LUZ','CARACAS','123',0,0,'LUZ','123456',0,1),(12,1,'123','MAURICIO','CARACAS','123',0,0,'MAURICIO','123456',0,1),(13,1,'123','MERWING GUARENAS','CARACAS','123',0,0,'MERWING','123456',0,1),(14,1,'123','CENTRO HIPICOS BANDIDOSS','CARACAS','123',0,0,'CHBANDIDOS','123456',0,1),(15,5,'123','IMANES','CARACAS','123',0,0,'IMANES','123456',0,1),(16,5,'123','TEXTILES','CARACAS','123',0,0,'TEXTILES','123456',0,1),(17,8,'123','KARINA','CARACAS','123',0,0,'KARINA','123456',0,1),(18,8,'123','DAVID ROMAN','123','04146951074',0,0,'DAVIDROMAN','123456',0,1),(19,1,'123','TORRELLAS','123','123',0,0,'TORRELLAS','654321',0,1),(20,1,'123','JORGE ESCOBAR','123','123',0,0,'JORGEESCOBAR','123456',0,1),(21,1,'123','ADRIAN ALQUILER','123','123',0,0,'ADRIANALQ','123456',0,1),(22,1,'123','ALQUILER 500','123','123',0,0,'alquiler500','123456',0,1),(23,9,'123','INTERMEDIARIO PRUEBA','123','123',10,3,'INTPRUEBA','123456',1,1),(24,7,'213213','jaramillo1','maracay','04144562296',30,30,'ajaramillo1','compaq',1,1),(25,6,'123213213','roberto','21212132','21213213213',20,20,'roberto1','123456',1,1),(26,6,'123','ROBERTO FARAH','PUNTO FIJO','04146842688',10,3,'ROBERTOF','ASSIA1949',1,1),(27,6,'123','EL DE LA VELA','123','123',10,3,'VELA01','123456',0,1),(28,4,'1porciento','RIGOBERTO RIJOS','123','123',10,3,'RIGO01','123456',0,1),(29,6,'123','GRUPO JOSE MEDINA','123','123',10,3,'GRUPOJOSE','123456',0,1),(30,3,'123','JORGE MOROCHO','123','123',10,3,'JORGE02','7566888',0,1),(31,9,'123','TUBALIN','123','123',10,3,'TUBALIN','123456',0,1),(32,9,'123','PREPAGO','123','123',10,3,'PREPAGO','123456',0,1),(33,6,'123','ROGERCO','123','123',10,3,'ROGERCO','123456',0,1),(34,3,'123','PEDRO CHIRINOS','123','123',10,0,'FORMULAS','123456',0,1),(35,3,'123','JORGE NATERA','123','123',10,3,'JORGE01','123456',0,1),(36,6,'123','HEBERTO LEON','123','123',10,3,'HEBERTO','123456',0,1),(37,4,'400 BSF','CROCHE','la villa','1',0,0,'croche','luis',0,1),(38,1,'123','giovanni','123','123',0,0,'giovanni','123456',0,1),(39,6,'123','LA MINA DE ORO','123','123',10,3,'MINA','123',0,1),(40,1,'123','SILICON','123','123',0,0,'SILICON','123456',0,1),(41,4,'123','ROBERTO ALQUILER 500','123','123',0,0,'ROBERTOALQUILER','123456',0,1),(42,4,'123','ROBERTO ALQUILER 400','123','123',0,0,'ROBERTOALQUILER2','123456',0,1),(43,4,'123','SAVANHA','123','04246873332',0,0,'SAVANHA','13112596',0,1),(44,8,'123','CUADRES DIARIOS','1233','123',0,0,'CUADRESDIARIOS','123456',0,1),(45,8,'123','GRUPO CHAROON','123','04127195406',0,0,'JONATHAN01','232113',0,1),(46,1,'14909932','FAMILIA FORTUNA','PUERTO ORDAZ','04166148311',0,0,'FORTUNA','asdfghjk',0,1),(47,4,'123','PARTICIPACION 10% ','123','123',0,0,'PARTICIPACION10','123456',0,1),(48,4,'123','PARTICIPACION 20%','1232','123',0,0,'PARTICIPACION20','123456',0,1),(49,4,' 1% VENTA','BOCA ','123','02815119912',0,0,'BOCA','123456',0,1),(50,4,'123','YORMAN 400','123','04160499151',0,0,'YORMAN01','123456',0,1),(51,4,'123','MISURI 90/10','123','123',0,0,'MISURI','123456',0,1),(52,1,'123','GRUPO ROQUES SEMANAL','123','123',0,0,'ROQUESEMANAL','123456',0,1),(53,4,'123','ALQUILER 1%','123','123',0,0,'ALQUILER1','123456',0,1),(54,1,'16299366','Leonardo Garcia','puerto ordaz','04166147879',0,0,'leonardo01','leonardo',1,1);
/*!40000 ALTER TABLE `intermediarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:20
