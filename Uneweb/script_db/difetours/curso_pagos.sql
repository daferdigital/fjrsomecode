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
  `grupo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `internal_key` varchar(45) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pago_por_semana` char(1) CHARACTER SET utf8 NOT NULL COMMENT '''1'' para indicar que este concepto debe ser pagado de manera semanal, cualquier otro valor indica que dicho concepto es un pago unico.',
  `precio` int(11) NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  `administrar` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_PAGOS_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_PAGOS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_pagos`
--
-- ORDER BY:  `id`

LOCK TABLES `curso_pagos` WRITE;
/*!40000 ALTER TABLE `curso_pagos` DISABLE KEYS */;
INSERT INTO `curso_pagos` (`id`, `grupo`, `internal_key`, `descripcion`, `pago_por_semana`, `precio`, `id_destino`, `administrar`) VALUES (96,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 años','1',0,1,'0'),(97,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 años','1',0,1,'0'),(122,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 años','1',0,2,'0'),(123,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 años','1',0,2,'0'),(136,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 años','1',0,3,'0'),(137,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 años','1',0,3,'0'),(150,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 años','1',0,4,'0'),(151,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 años','1',0,4,'0'),(206,'AirportPickupRequired','ninguno','Ninguno','0',0,2,'1'),(207,'AirportPickupRequired','ida','Solo Ida','0',100,2,'1'),(208,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,2,'1'),(209,'registro','registro','Registro (cuota única no reembolsable)','0',110,2,'1'),(210,'registro','registroHighSeason','Registro en temporada alta','0',200,2,'1'),(211,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,2,'1'),(212,'materiales','13+','Materiales 13 semanas o más','0',140,2,'1'),(213,'searchRoomstay','searchRoomstay','Búsqueda de alojamiento (no reembolsable)','0',130,2,'1'),(214,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,2,'1'),(215,'AirportPickupRequired','ninguno','Ninguno','0',0,3,'1'),(216,'AirportPickupRequired','ida','Solo Ida','0',100,3,'1'),(217,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,3,'1'),(218,' registro','registro','Registro (cuota única no reembolsable)','0',110,3,'1'),(219,'registro','registroHighSeason','Registro en temporada alta','0',200,3,'1'),(220,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,3,'1'),(221,'materiales','13+','Materiales 12 semanas o más','0',140,3,'1'),(222,'searchRoomstay','searchRoomstay','Búsqueda de alojamiento (no reembolsable)','0',130,3,'1'),(223,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,3,'1'),(224,'AirportPickupRequired','ninguno','Ninguno','0',0,4,'1'),(225,'AirportPickupRequired','ida','Solo Ida','0',100,4,'1'),(226,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,4,'1'),(227,' registro','registro','Registro (cuota única no reembolsable)','0',110,4,'1'),(228,'registro','registroHighSeason','Registro en temporada alta','0',200,4,'1'),(229,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,4,'1'),(230,'materiales','13+','Materiales 12 semanas o más','0',140,4,'1'),(231,'searchRoomstay','searchRoomstay','Búsqueda de alojamiento (no reembolsable)','0',130,4,'1'),(232,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,4,'1'),(233,'AirportPickupRequired','ninguno','Ninguno','0',0,1,'1'),(234,'AirportPickupRequired','ida','Solo Ida','0',100,1,'1'),(235,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,1,'1'),(236,'registro','registro','Registro (cuota única no reembolsable)','0',110,1,'1'),(237,'registro','registroHighSeason','Registro en temporada alta','0',200,1,'1'),(238,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,1,'1'),(239,'materiales','13+','Materiales 13 semanas o más','0',140,1,'1'),(240,'searchRoomstay','searchRoomstay','Búsqueda de alojamiento (no reembolsable)','0',130,1,'1'),(241,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,1,'1');
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

-- Dump completed on 2013-03-18  0:55:46
