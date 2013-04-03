CREATE DATABASE  IF NOT EXISTS `carrito` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `carrito`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: carrito
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `banco`
--

DROP TABLE IF EXISTS `banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banco`
--

LOCK TABLES `banco` WRITE;
/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito_tmp`
--

DROP TABLE IF EXISTS `carrito_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito_tmp` (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_producto`),
  KEY `FK_CARRITOTMP_USUARIO` (`id_usuario`),
  KEY `FK_CARRITOTMP_PRODUCTO` (`id_producto`),
  CONSTRAINT `FK_CARRITOTMP_PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CARRITOTMP_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito_tmp`
--

LOCK TABLES `carrito_tmp` WRITE;
/*!40000 ALTER TABLE `carrito_tmp` DISABLE KEYS */;
INSERT INTO `carrito_tmp` (`id_usuario`, `id_producto`) VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `carrito_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES (1,'Almuerzo','Almuerzo'),(2,'Bebidas','Bebidas'),(3,'Charcuteria','Charcuteria'),(4,'Desayuno','Desayuno'),(5,'Dulces','Dulces'),(6,'Galletas','Galletas'),(7,'Delicateses','Delicateses'),(8,'Otros','Otros');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `monto_sin_iva` double NOT NULL,
  `iva` double NOT NULL,
  `cod_factura` varchar(45) NOT NULL COMMENT 'Este codigo factura es el codigo propio de la factura fisica del proveedor al que se le reaizo dicha compra, esto para efectos contables',
  `id_proveedor` int(11) NOT NULL COMMENT 'proveedor al que se le realizo la compra',
  `id_banco` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_COMPRA_PROVEEDOR_idx` (`id_proveedor`),
  KEY `FK_COMPRA_BANCO_idx` (`id_banco`),
  KEY `FK_COMPRA_TIPO_PAGO_idx` (`id_tipo_pago`),
  CONSTRAINT `FK_COMPRA_BANCO` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_COMPRA_PROVEEDOR` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_COMPRA_TIPO_PAGO` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_de_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='En esta tabla se guardaran las distintas compras de productos, la idea es llevar en control de los ingresos y egresos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra_detalle`
--

DROP TABLE IF EXISTS `compra_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra_detalle` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_comprada` int(11) NOT NULL,
  `precio_unitario` double NOT NULL,
  `precio_total` double NOT NULL COMMENT 'Esto es calculado, pero como se registra una compra solo una vez, se esta agregando en la base de datos.',
  PRIMARY KEY (`id_compra`,`id_producto`),
  KEY `FK_COMPRA_DETALLE_PRODUCTO_idx` (`id_producto`),
  KEY `FK_COMPRA_DETALLE_COMPRA_idx` (`id_compra`),
  CONSTRAINT `FK_COMPRA_DETALLE_COMPRA` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_COMPRA_DETALLE_PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='En esta tabla tendremos el detalle de productos de determinada compra';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_detalle`
--

LOCK TABLES `compra_detalle` WRITE;
/*!40000 ALTER TABLE `compra_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`id`, `nombre`, `descripcion`) VALUES (1,'Administrador','Usuarios de tipo administrador con permisos superiores en el sistema'),(2,'Cliente','Usuarios de tipo Cliente');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precio_producto`
--

DROP TABLE IF EXISTS `precio_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precio_producto` (
  `id_producto` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL COMMENT 'fecha en la que se registro determinado precio, esto para mantener un historico al momento de revisar ventas del pasado',
  `fecha_fin` date DEFAULT NULL,
  `precio_neto` double NOT NULL,
  `precio_costo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='En esta tabla se mantendra un historico de los precios de determinado producto en el paso del tiempo. Asi podremos saber en determinado momento, que precio tenia determinado producto';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_producto`
--

LOCK TABLES `precio_producto` WRITE;
/*!40000 ALTER TABLE `precio_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `precio_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio_neto_actual` double NOT NULL,
  `precio_costo_actual` double NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad_comprada` int(11) NOT NULL COMMENT 'Este es el inventario total de las compras de este producto durante toda la vida',
  `cantidad_vendida` int(11) NOT NULL COMMENT 'Esta es la cantidad total acumulada de las ventas de este producto durante toda la vida. La cantidad disponible es el calculado de la resta entre la cantidad comprada acummulada y la cantidad vendida acumulada',
  PRIMARY KEY (`id`),
  KEY `FK_PRODUCTO_CATEGORIA_idx` (`id_categoria`),
  CONSTRAINT `FK_PRODUCTO_CATEGORIA` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio_neto_actual`, `precio_costo_actual`, `id_categoria`, `cantidad_comprada`, `cantidad_vendida`) VALUES (1,'Panetone de Chocolate','Panetone de Chocolate',120,100,5,500,0),(2,'Panetone de Fruta','Panetone de Fruta',120,100,5,500,0);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `nombre_contacto` varchar(30) NOT NULL COMMENT 'nombre de la persona de contacto en el proveedor (no necesariamente el vendedor)',
  `telefono_contacto` varchar(30) NOT NULL COMMENT 'Telefono de la persona de contacto',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_de_pago`
--

DROP TABLE IF EXISTS `tipo_de_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_de_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_de_pago`
--

LOCK TABLES `tipo_de_pago` WRITE;
/*!40000 ALTER TABLE `tipo_de_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_de_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(12) NOT NULL DEFAULT '',
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PERFIL_USUARIO_idx` (`id_perfil`),
  CONSTRAINT `FK_PERFIL_USUARIO` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `cedula`, `nombre`, `apellido`, `telefono`, `direccion`, `email`, `login`, `clave`, `id_perfil`) VALUES (1,'12345678','Administrador','del Sistema','0212-1234567','prueba','admin@carrito.com','admin','e10adc3949ba59abbe56e057f20f883e',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `monto_sin_iva` double NOT NULL,
  `iva` double NOT NULL,
  `cod_factura` varchar(45) DEFAULT NULL COMMENT 'Este codigo de factura es el nuestro y sera colocado cuando la venta ya este en estado procesado, mientras se procesa este valor sera null',
  `id_usuario` int(11) NOT NULL COMMENT 'Usuario del sistema que realizo la compra',
  `id_banco` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_VENTA_USUARIO_idx` (`id_usuario`),
  KEY `FK_VENTA_BANCO_idx` (`id_banco`),
  KEY `FK_VENTA_TIPO_PAGO_idx` (`id_tipo_pago`),
  CONSTRAINT `FK_VENTA_BANCO` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_VENTA_TIPO_PAGO` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_de_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_VENTA_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Sumarizado de las ventas del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_detalle`
--

DROP TABLE IF EXISTS `venta_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_detalle` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_vendida` int(11) NOT NULL,
  `precio_unitario` double NOT NULL,
  `precio_total` double NOT NULL COMMENT 'Este total es calculado, pero como esto solo se registra una vez, entonces de esta guardando en el primer momento',
  PRIMARY KEY (`id_venta`,`id_producto`),
  KEY `FK_VENTA_DETALLE_VENTA_idx` (`id_venta`),
  KEY `FK_VENTA_DETALLE_PRODUCTO_idx` (`id_producto`),
  CONSTRAINT `FK_VENTA_DETALLE_PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_VENTA_DETALLE_VENTA` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='detalle de determinada venta';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_detalle`
--

LOCK TABLES `venta_detalle` WRITE;
/*!40000 ALTER TABLE `venta_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-01 12:51:17
