CREATE DATABASE  IF NOT EXISTS `quierounacompu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `quierounacompu`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: ubuntu-sun    Database: quierounacompu
-- ------------------------------------------------------
-- Server version	5.1.37

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
-- Table structure for table `envios_comentarios`
--

DROP TABLE IF EXISTS `envios_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envios_comentarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_comentario` datetime NOT NULL,
  `comentario` text NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL COMMENT 'nulo para el caso del comprador generando algun comentario para el envio',
  `id_status_envio` int(10) unsigned NOT NULL,
  `id_envio` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_COMENTARIO_USUARIO` (`id_usuario`),
  KEY `FK_COMENTARIO_STATUS_ENVIO` (`id_status_envio`),
  KEY `FK_COMENTARIO_ENVIO_idx` (`id_envio`),
  CONSTRAINT `FK_COMENTARIO_ENVIO` FOREIGN KEY (`id_envio`) REFERENCES `envios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_COMENTARIO_STATUS_ENVIO` FOREIGN KEY (`id_status_envio`) REFERENCES `envios_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_COMENTARIO_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios_comentarios`
--

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-23 16:46:41
