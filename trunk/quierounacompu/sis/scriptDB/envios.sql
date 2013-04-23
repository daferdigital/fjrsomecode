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
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seudonimo_ml` varchar(250) NOT NULL,
  `nombre_completo` varchar(250) NOT NULL,
  `ci_rif` varchar(45) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `tlf_cliente` varchar(45) DEFAULT NULL,
  `tlf_local_cliente` varchar(45) DEFAULT NULL,
  `detalle_compra` text NOT NULL,
  `num_voucher` varchar(250) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `monto_pago` double NOT NULL,
  `nombre_destinatario` varchar(250) NOT NULL,
  `cedula_destinatario` varchar(45) NOT NULL,
  `direccion_destino` text NOT NULL,
  `ciudad_destino` varchar(250) NOT NULL,
  `estado_destino` varchar(250) NOT NULL,
  `tlf_celular_destinatario` varchar(45) DEFAULT NULL,
  `tlf_local_destinatario` varchar(45) DEFAULT NULL,
  `observaciones_envio` text,
  `codigo_factura` varchar(45) DEFAULT NULL COMMENT 'codigo interno de factura de quierounacompu',
  `codigo_envio` varchar(45) DEFAULT NULL COMMENT 'codigo de envio indicado por la empresa que prestara el propio servicio de envio',
  `id_medio_pago` int(10) unsigned NOT NULL,
  `id_banco` int(10) unsigned NOT NULL,
  `id_empresa_envio` int(10) unsigned NOT NULL,
  `id_status_actual` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_TIPO_PAGO` (`id_medio_pago`),
  KEY `FK_ENVIO_BANCO` (`id_banco`),
  KEY `FK_CIA_ENVIO` (`id_empresa_envio`),
  KEY `FK_ENVIO_STATUS_ACTUAL` (`id_status_actual`),
  CONSTRAINT `FK_CIA_ENVIO` FOREIGN KEY (`id_empresa_envio`) REFERENCES `empresa_envio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ENVIO_BANCO` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ENVIO_STATUS_ACTUAL` FOREIGN KEY (`id_status_actual`) REFERENCES `envios_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TIPO_PAGO` FOREIGN KEY (`id_medio_pago`) REFERENCES `medios_de_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios`
--

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-23 16:46:15
