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
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `idventa` bigint(20) NOT NULL AUTO_INCREMENT,
  `idtaquilla` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_prorroga` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hora_taquilla` time DEFAULT NULL,
  `hora_intermediario` time DEFAULT NULL,
  `hora_banquero` time DEFAULT NULL,
  `apuesta` float(8,2) DEFAULT NULL,
  `total_ganar` float(8,2) DEFAULT NULL,
  `monto_real_pagar` float(8,2) DEFAULT NULL COMMENT 'Muestra en monto real a pagar luego de haber hecho el calculo de tickets ganadores',
  `ganador` int(1) DEFAULT NULL,
  `perdedor` int(1) DEFAULT NULL,
  `pagado` int(1) DEFAULT NULL,
  `anulado` int(1) DEFAULT NULL,
  `vencido` int(1) DEFAULT NULL,
  `recalculado` int(1) DEFAULT NULL COMMENT 'Indica si el monto fue recalculado',
  `reembolsar` int(1) DEFAULT '0',
  `reembolsado` int(1) DEFAULT '0',
  `codigo_cliente` int(8) DEFAULT NULL,
  `codigo_ticket` int(8) DEFAULT NULL,
  `monto_pagado` float(8,2) DEFAULT NULL,
  `cantidad_apuesta` int(2) DEFAULT NULL,
  `tm` varchar(200) DEFAULT NULL COMMENT 'Nombre de la tabla modificador',
  `idtm` varchar(100) DEFAULT NULL COMMENT 'Nombre del id de la tabla modificador',
  `idmodificador` int(11) DEFAULT NULL COMMENT 'id del usuario que modifica la venta',
  `estatus` int(1) DEFAULT '1' COMMENT 'Uno: Ticket generado\r\nDos: Ticket anulado\r\nTres: Ticket pagado',
  PRIMARY KEY (`idventa`),
  KEY `idtaquilla` (`idtaquilla`)
) ENGINE=MyISAM AUTO_INCREMENT=210255 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--
-- ORDER BY:  `idventa`

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` (`idventa`, `idtaquilla`, `fecha`, `fecha_prorroga`, `hora`, `hora_taquilla`, `hora_intermediario`, `hora_banquero`, `apuesta`, `total_ganar`, `monto_real_pagar`, `ganador`, `perdedor`, `pagado`, `anulado`, `vencido`, `recalculado`, `reembolsar`, `reembolsado`, `codigo_cliente`, `codigo_ticket`, `monto_pagado`, `cantidad_apuesta`, `tm`, `idtm`, `idmodificador`, `estatus`) VALUES (210252,35,'2012-10-05','2012-10-08','19:39:23','19:44:23','19:49:23','05:39:23',100.00,495.43,0.00,0,0,0,0,0,0,0,0,29365101,210252,0.00,2,'','',0,1),(210253,42,'2012-10-05','2012-10-08','19:51:47','19:56:47','20:01:47','05:51:47',600.00,1477.83,0.00,0,0,0,0,0,0,0,0,93995856,210253,0.00,2,'','',0,1),(210254,41,'2012-10-05','2012-10-08','20:01:09','20:06:09','20:11:09','06:01:09',100.00,373.91,0.00,0,0,0,0,0,0,0,0,22873685,210254,0.00,2,'','',0,1);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:55
