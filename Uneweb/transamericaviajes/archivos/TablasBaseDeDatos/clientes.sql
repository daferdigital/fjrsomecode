CREATE DATABASE  IF NOT EXISTS `transviajes` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `transviajes`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: transviajes
-- ------------------------------------------------------
-- Server version	5.5.22

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `tipo_cliente` char(1) NOT NULL,
  `razon_social` varchar(1000) DEFAULT NULL,
  `rif` varchar(45) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `nombre_contacto` varchar(300) DEFAULT NULL,
  `apellido_contacto` varchar(300) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `direccion` varchar(1000) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `codigo_postal` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono_trabajo1` varchar(100) DEFAULT NULL,
  `telefono_trabajo2` varchar(100) DEFAULT NULL,
  `telefono_habitacion` varchar(50) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `referido_por` varchar(300) DEFAULT NULL,
  `notas` varchar(50) DEFAULT NULL,
  `comision_paq_nacionales` varchar(50) DEFAULT NULL,
  `comision_paq_internacionales` varchar(50) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-03 16:03:55
