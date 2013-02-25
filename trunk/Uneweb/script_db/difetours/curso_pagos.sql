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
  `internal_key` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `pago_por_semana` char(1) NOT NULL COMMENT '''1'' para indicar que este concepto debe ser pagado de manera semanal, cualquier otro valor indica que dicho concepto es un pago unico.',
  `precio` int(11) NOT NULL,
  `id_destino` int(10) unsigned NOT NULL,
  `administrar` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_PAGOS_DESTINO_idx` (`id_destino`),
  CONSTRAINT `FK_PAGOS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `curso_destino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_pagos`
--

LOCK TABLES `curso_pagos` WRITE;
/*!40000 ALTER TABLE `curso_pagos` DISABLE KEYS */;
INSERT INTO `curso_pagos` VALUES (96,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 aÃ±os','1',0,1,'0'),(97,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 aÃ±os','1',0,1,'0'),(98,' registro','registro','Registro (cuota Ãºnica no reembolsable)','0',110,1,'1'),(99,'AirportPickupRequired','ninguno','Ninguno','0',0,1,'1'),(100,'AirportPickupRequired','ida','Solo Ida','0',100,1,'1'),(101,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,1,'1'),(102,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,1,'1'),(103,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,1,'1'),(104,'materiales','13+','Materiales 12 semanas o mÃ¡s','0',140,1,'1'),(105,'registro','registroHighSeason','Registro en temporada alta','0',200,1,'1'),(106,'searchRoomstay','searchRoomstay','BÃºsqueda de alojamiento (no reembolsable)','0',130,1,'1'),(107,'sendDocuments','Vancouver','Envio de documentos por curier a Vancouver (no reembolsable)','0',50,1,'1'),(108,'sendDocuments','Toronto','Envio de documentos por curier a Toronto (no reembolsable)','0',75,1,'1'),(109,'sendDocuments','Montreal','Envio de documentos por curier a Montreal (no reembolsable)','0',75,1,'1'),(110,'AirportPickupRequired','ninguno','Ninguno','0',0,2,'1'),(111,'AirportPickupRequired','ida','Solo Ida','0',100,2,'1'),(112,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,2,'1'),(113,' registro','registro','Registro (cuota ÃƒÂºnica no reembolsable)','0',110,2,'1'),(114,'registro','registroHighSeason','Registro en temporada alta','0',200,2,'1'),(115,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,2,'1'),(116,'materiales','13+','Materiales 12 semanas o mÃƒÂ¡s','0',140,2,'1'),(117,'searchRoomstay','searchRoomstay','BÃƒÂºsqueda de alojamiento (no reembolsable)','0',130,2,'1'),(118,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,2,'1'),(119,'sendDocuments','Vancouver','Envio de documentos por curier a Vancouver (no reembolsable)','0',50,2,'1'),(120,'sendDocuments','Toronto','Envio de documentos por curier a Toronto (no reembolsable)','0',75,2,'1'),(121,'sendDocuments','Montreal','Envio de documentos por curier a Montreal (no reembolsable)','0',75,2,'1'),(122,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 aÃƒÂ±os','1',0,2,'0'),(123,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 aÃƒÂ±os','1',0,2,'0'),(124,'AirportPickupRequired','ninguno','Ninguno','0',0,3,'1'),(125,'AirportPickupRequired','ida','Solo Ida','0',100,3,'1'),(126,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,3,'1'),(127,' registro','registro','Registro (cuota ÃƒÂºnica no reembolsable)','0',110,3,'1'),(128,'registro','registroHighSeason','Registro en temporada alta','0',200,3,'1'),(129,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,3,'1'),(130,'materiales','13+','Materiales 12 semanas o mÃƒÂ¡s','0',140,3,'1'),(131,'searchRoomstay','searchRoomstay','BÃƒÂºsqueda de alojamiento (no reembolsable)','0',130,3,'1'),(132,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,3,'1'),(133,'sendDocuments','Vancouver','Envio de documentos por curier a Vancouver (no reembolsable)','0',50,3,'1'),(134,'sendDocuments','Toronto','Envio de documentos por curier a Toronto (no reembolsable)','0',75,3,'1'),(135,'sendDocuments','Montreal','Envio de documentos por curier a Montreal (no reembolsable)','0',75,3,'1'),(136,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 aÃƒÂ±os','1',0,3,'0'),(137,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 aÃƒÂ±os','1',0,3,'0'),(138,'AirportPickupRequired','ninguno','Ninguno','0',0,4,'1'),(139,'AirportPickupRequired','ida','Solo Ida','0',100,4,'1'),(140,'AirportPickupRequired','ida-vuelta','Ida y Vuelta','0',170,4,'1'),(141,' registro','registro','Registro (cuota ÃƒÂºnica no reembolsable)','0',110,4,'1'),(142,'registro','registroHighSeason','Registro en temporada alta','0',200,4,'1'),(143,'materiales','3-12','Materiales de 3 a 12 semanas','0',70,4,'1'),(144,'materiales','13+','Materiales 12 semanas o mÃƒÂ¡s','0',140,4,'1'),(145,'searchRoomstay','searchRoomstay','BÃƒÂºsqueda de alojamiento (no reembolsable)','0',130,4,'1'),(146,'custodyLetter','custodyLetter','Carta Custodia (no reembolsable)','0',125,4,'1'),(147,'sendDocuments','Vancouver','Envio de documentos por curier a Vancouver (no reembolsable)','0',50,4,'1'),(148,'sendDocuments','Toronto','Envio de documentos por curier a Toronto (no reembolsable)','0',75,4,'1'),(149,'sendDocuments','Montreal','Envio de documentos por curier a Montreal (no reembolsable)','0',75,4,'1'),(150,'roomstayAge','precio_under18','Alojamiento en casa de familia - Alumnos menores de 18 aÃƒÂ±os','1',0,4,'0'),(151,'roomstayAge','precio_over18','Alojamiento en casa de familia - Alumnos mayores de 18 aÃƒÂ±os','1',0,4,'0');
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

-- Dump completed on 2013-02-24 23:59:19
