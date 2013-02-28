CREATE DATABASE  IF NOT EXISTS `quierounacompu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `quierounacompu`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: quierounacompu
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
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(45) DEFAULT NULL,
  `key_module` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_module_UNIQUE` (`key_module`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'busqueda','notificados','Búsqueda de Registros con estado Notificado'),(2,'busqueda','pago_confirmado','Búsqueda de Registros con estado Pago Confirmado'),(3,'busqueda','pago_no_encontrado','Búsqueda de Registros con estado Pago No Encontrado'),(4,'busqueda','presupuestado','Búsqueda de Registros con estado Presupuestado'),(5,'busqueda','facturado','Búsqueda de Registros con estado Facturado'),(6,'busqueda','enviado','Búsqueda de Registros con estado Enviado'),(7,'busqueda_avanzada','busqueda_avanzada','Búsqueda Avanzada de Registros'),(8,'edicion','edicion_notificados','Edición de Registros en estado Notificado'),(9,'edicion','edicion_pago_confirmado','Edición de Registros en estado Pago Confirmado'),(10,'edicion','edicion_pago_noencontrado','Edición de Registros en estado Pago No Encontrado'),(11,'edicion','edicion_presupuestado','Edición de Registros en estado Presupuestado'),(12,'edicion','edicion_facturado','Edición de Registros en estado Facturado'),(13,'perfil','perfil','Acceso a la sección de Perfil (Datos básicos del usuario)'),(14,'administracion','crear_usuario','Creación de Usuarios'),(15,'administracion','modificar_usuario','Modificar Usuarios'),(16,'administracion','eliminar_usuario','Eliminar Usuarios'),(17,'administracion','permisos','Administración de permiso a los Modulos'),(18,'logs','transacciones','Acceso al log de actividades del Sistema'),(19,'logs','sistema','Acceso al log técnico del Sistema'),(20,'administracion','reactivar_usuario','Opción para activar nuevamente cuentas de usuario');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-28  0:22:14
