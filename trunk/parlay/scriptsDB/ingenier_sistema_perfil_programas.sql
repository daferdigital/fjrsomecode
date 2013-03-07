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
-- Table structure for table `perfil_programas`
--

DROP TABLE IF EXISTS `perfil_programas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_programas` (
  `id_perfil_programa` int(10) NOT NULL AUTO_INCREMENT,
  `id_perfil_padre` int(10) NOT NULL,
  `nombre_programa` varchar(50) NOT NULL,
  `programa_archivo` varchar(50) NOT NULL,
  `orden` int(2) NOT NULL,
  `apertura` varchar(1) DEFAULT '0' COMMENT 'cuando es 0 trabaja con el jquery y si es 1 hace un target',
  PRIMARY KEY (`id_perfil_programa`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_programas`
--
-- ORDER BY:  `id_perfil_programa`

LOCK TABLES `perfil_programas` WRITE;
/*!40000 ALTER TABLE `perfil_programas` DISABLE KEYS */;
INSERT INTO `perfil_programas` (`id_perfil_programa`, `id_perfil_padre`, `nombre_programa`, `programa_archivo`, `orden`, `apertura`) VALUES (1,1,'Como Apostar?','como_apostar.php',0,NULL),(2,2,'Apostar','ventas.php\r\n',0,NULL),(3,3,'Categorias','ingreso_categorias.php',1,NULL),(4,3,'Ligas','ingreso_ligas.php',2,NULL),(5,3,'Equipos','ingreso_equipos.php',3,NULL),(6,3,'Lanzadores','ingreso_lanzadores.php',4,NULL),(7,4,'Banqueros','ingreso_banqueros.php',1,NULL),(8,4,'Intermediarios','ingreso_intermediarios.php',2,NULL),(9,4,'Taquillas','ingreso_taquillas.php',3,NULL),(10,5,'Carga de Logros','logros.php',1,NULL),(11,5,'Logros del d&iacute;a','imprimir_todos_logros.php',0,'1'),(12,6,'Resultados','resultados.php',0,NULL),(13,9,'Tickets Ganadores','tickets_ganadores.php?fil=G',1,NULL),(14,9,'Ganancias y Perdidas','reportes.php',2,NULL),(15,9,'Mas Apostados','reporte_apostado.php',3,NULL),(16,10,'Cambio de Clave','cambio_clave.php',0,NULL),(18,12,'Apuestas','ingreso_apuestas.php',1,NULL),(19,12,'Combinaciones','ingreso_combinaciones.php',2,NULL),(20,12,'Tipos de apuestas','ingreso_tipo_apuestas.php',3,NULL),(21,12,'Ingreso Usuarios','ingreso_usuarios.php',4,NULL),(23,12,'Perfil Accesos','frame_perfil_accesos.php',3,NULL),(24,12,'Perfil Programas','frame_perfil_programas.php',2,NULL),(25,5,'Logros para Banquero','logros_banqueros.php',2,'0'),(26,13,'Anular Ticket','anular_ticket.php',1,'0'),(27,13,'Pagar Ticket','pagar_ticket.php',2,'0'),(28,13,'Tickets Vendidos','tickets_ganadores.php',3,'0'),(29,12,'Generar Cookies','activar_cookie.php',6,'0'),(30,14,'Calculadora Parlay','calculadorav2.php',0,'0');
/*!40000 ALTER TABLE `perfil_programas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-07  1:09:45
