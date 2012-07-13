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
-- Table structure for table `ventas_paquetes_credito`
--

DROP TABLE IF EXISTS `ventas_paquetes_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_paquetes_credito` (
  `nro_inscripcion` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `tipo_factura` varchar(200) DEFAULT NULL,
  `id_moneda_factura` int(11) DEFAULT NULL,
  `codigo_paquete` int(11) DEFAULT NULL,
  `cancelada` varchar(45) DEFAULT NULL,
  `anulada` varchar(45) DEFAULT NULL,
  `codigo_promotor` varchar(45) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  `total_pagar` double DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `nro_pasaporte_pas` varchar(45) DEFAULT NULL,
  `nro_visa_pas` varchar(45) DEFAULT NULL,
  `telefono_pas` varchar(45) DEFAULT NULL,
  `correo_pas` varchar(45) DEFAULT NULL,
  `direccion_pas` varchar(300) DEFAULT NULL,
  `ciudad` varchar(200) DEFAULT NULL,
  `colegio` varchar(100) DEFAULT NULL,
  `tipo_habitacion` varchar(200) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `talla_camisa` varchar(45) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  PRIMARY KEY (`nro_inscripcion`)
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
