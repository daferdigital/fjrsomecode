CREATE DATABASE  IF NOT EXISTS `difetours` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `difetours`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: difetours
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
-- Table structure for table `curso_pagos`
--

DROP TABLE IF EXISTS `curso_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo` varchar(45) NOT NULL,
  `key` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `pago_por_semana` char(1) NOT NULL COMMENT '''1'' para indicar que este concepto debe ser pagado de manera semanal, cualquier otro valor indica que dicho concepto es un pago unico.',
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_pagos`
--

LOCK TABLES `curso_pagos` WRITE;
/*!40000 ALTER TABLE `curso_pagos` DISABLE KEYS */;
INSERT INTO `curso_pagos` VALUES (1,'AirportPickupRequired','ninguno','Ninguno','0',0),(2,'AirportPickupRequired','ida','Solo Ida','0',100),(3,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170),(4,'registro','registro','Registro (Cuota Única no reembolsable)','0',110),(5,'materiales','3-12','Materiales de 3-12 semanas','1',70),(6,'materiales','13+','Materiales de 13 semanas o más','1',140),(7,'searchRoomstay','searchRoomstay','Búsqueda de alijamiento (no reembolsable)','0',130),(8,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125),(9,'sendDocuments','Vancouver','Envio de documentos por curier a Vancouver (no reembolsable)','0',50),(10,'sendDocuments','Toronto','Envio de documentos por curier a Toronto (no reembolsable)','0',75),(11,'sendDocuments','Montreal','Envio de documentos por curier a Canada (no reembolsable)','0',75),(12,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 años','1',0),(13,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 años','1',0);
/*!40000 ALTER TABLE `curso_pagos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-18  5:45:44
