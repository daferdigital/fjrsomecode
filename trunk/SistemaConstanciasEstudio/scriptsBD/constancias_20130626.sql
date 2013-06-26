CREATE DATABASE  IF NOT EXISTS `constancias` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `constancias`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: constancias
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
-- Table structure for table `alumno_constancia`
--

DROP TABLE IF EXISTS `alumno_constancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_constancia` (
  `cedula` varchar(50) COLLATE latin1_bin NOT NULL,
  `nombre` varchar(250) COLLATE latin1_bin NOT NULL,
  `trimestre` varchar(10) COLLATE latin1_bin NOT NULL,
  `horario` varchar(250) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_constancia`
--
-- ORDER BY:  `cedula`

LOCK TABLES `alumno_constancia` WRITE;
/*!40000 ALTER TABLE `alumno_constancia` DISABLE KEYS */;
INSERT INTO `alumno_constancia` (`cedula`, `nombre`, `trimestre`, `horario`) VALUES ('10616519','MEJIAS BERMEJO ZULMA ZULEIMA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('10618219','SOLORZANO, WILMAN','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('10924864','TORRES ECHENIQUE, HENRY OMAR','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('11235938','ESAA ROJAS, GRISEL MIGUELINA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('11236252','MONTILLA, ELSA MARGARITA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('12581621','CABRERA CORONA, LUISA ELENA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('12903991','LEAL GARCIA, JOSE ANTONIO','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('13560146','DIAZ CASTILLO, ANA CAROLINA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('13639528','SEGOVIA CHACON, OMAR ALEXANDER','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('13732541','PERDOMO VELASQUEZ, DEIDYS CAROLINA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('14521103','LEAL, BENNY BIENNEY','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('15145739','PADILLA, JOSE MELECIO','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('16640114','SANOJA, MARIA ALEJANDRA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('17202342','PARRA DORANTE, MARIA DEL VALLE','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('18328732','GARRIDO INFANTE, YILENNY YOSMARBY','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('18580655','GONZALEZ GOLINDANO  DEIRA YLIANA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20092583','CASTILLO LAYA, YURAIMA NOHELIA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20611595','GALAN FLORES  JONATHAN JOSE','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20722970','ESPAÑA VENERO, DENNIS ALEJANDRINA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20724278','FUENTES GUTIERREZ, VICTOR GERARDO','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20724434','ROMERO MATUTE, MICHAEL STEEK','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20724536','ROMERO, CHARLY','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('20907932','LAYA CASTILLO  ROXANA JOSSELIN','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('21292079','PARRA DORANTE, MARIA DE LOS ANGELES','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('21293290','DEPABLOS GONZALEZ, YELIMER VANESSA','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('22684386','BRICEÑO SUAREZ, JOEL MISAEL','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('24103818','LINARES LINARES, ROBERT MACKENCY','I','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('24540584','NARVAEZ PEREZ MAR LUIS RUBI','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('24540671','NARANJO LUZ MARIANA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('25064449','PEÑALOZA MENDOZA DANIEL ALEXANDER','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('25260051','ESPINOZA GARCIA, PETRA MARIA','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('8169943','MUJICA ROJAS, FELIX FRANCISCO','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),('8190951','PADILLA, DARIO','II','Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM');
/*!40000 ALTER TABLE `alumno_constancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor_constancia`
--

DROP TABLE IF EXISTS `profesor_constancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor_constancia` (
  `cedula` varchar(50) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cargo` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor_constancia`
--
-- ORDER BY:  `cedula`

LOCK TABLES `profesor_constancia` WRITE;
/*!40000 ALTER TABLE `profesor_constancia` DISABLE KEYS */;
INSERT INTO `profesor_constancia` (`cedula`, `nombre`, `cargo`, `telefono`, `correo`) VALUES ('V - 11.239.777','José Luis Hernández Arvelo','Coordinador Aldea Tamanaco- Misión Sucre','0426-4306529','aldeatamanacoapure@hotmail.com/aldeatamanacoapure2@hotmail.com');
/*!40000 ALTER TABLE `profesor_constancia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-26  7:33:32
