/*
Navicat MySQL Data Transfer

Source Server         : Enrony
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : siscola

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2011-12-07 08:07:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `control_logueo`
-- ----------------------------
DROP TABLE IF EXISTS `control_logueo`;
CREATE TABLE `control_logueo` (
  `idcontrol_logueo` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`idcontrol_logueo`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `control_logueo_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of control_logueo
-- ----------------------------

-- ----------------------------
-- Table structure for `departamentos`
-- ----------------------------
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`iddepartamento`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of departamentos
-- ----------------------------
INSERT INTO `departamentos` VALUES ('1', 'Licores', '1');
INSERT INTO `departamentos` VALUES ('2', 'Ventas', '1');
INSERT INTO `departamentos` VALUES ('3', 'Compras', '1');
INSERT INTO `departamentos` VALUES ('10', 'Mantenimientos', '1');

-- ----------------------------
-- Table structure for `operadores`
-- ----------------------------
DROP TABLE IF EXISTS `operadores`;
CREATE TABLE `operadores` (
  `idoperador` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` enum('femenino','masculino') DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `nivel` int(11) DEFAULT '2',
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idoperador`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operadores
-- ----------------------------
INSERT INTO `operadores` VALUES ('1', '16945700', 'Gabriel Suarez', '04268341450', '2011-10-04', 'masculino', 'enrony@gmail.com', 'Urb. La Mora, Av.28 #50', 'gabriel', '123', '2', '1');
INSERT INTO `operadores` VALUES ('5', '24923431', 'Carolina Moncada', '04164330677', '2011-10-06', 'masculino', 'maria@gmail.com', ' Urb. Las Mercedes', 'carolina', '456', '2', '1');
INSERT INTO `operadores` VALUES ('6', '12345678', 'Daniel', '04268341450', '2011-11-08', 'masculino', 'enrony@gmail.com', 'Las Carmelitas', 'enrony', '123', '2', '1');
INSERT INTO `operadores` VALUES ('7', '14512542', 'Adelaida Salcedo', '042154895544', '2009-08-04', 'masculino', 'salcedo@gmail.com', 'La soledad calle 6', 'salcedo', '123', '2', '1');
INSERT INTO `operadores` VALUES ('9', '16945699', 'Jenny Reyes', '041254521285', '2010-04-07', 'masculino', 'hencre@enlagoma.com', ' Calle casanova godoy...', 'jenny', '456', '2', '1');
INSERT INTO `operadores` VALUES ('10', '21456789', 'Maria Ruiz', '04125487554', '1991-05-26', 'femenino', 'maria@gmail.com', 'La Morita, edo. Aragua ', 'ruiz', '123', '2', '1');
INSERT INTO `operadores` VALUES ('11', '124587855', 'Carlos Ponce', '04245487855', '1980-06-14', 'masculino', 'carlosp@gmail.com', 'El consejo La Victoria ', 'carlosp', '456', '2', '1');
INSERT INTO `operadores` VALUES ('12', '125468799', 'Benancios', '04165487588', '1980-06-23', 'masculino', 'bena@hotmail.com', ' La Gogola ', 'bena', '789', '2', '1');
INSERT INTO `operadores` VALUES ('15', '168945698', 'Carmen Guerra', '04125452122', '1980-05-03', 'femenino', 'carmen@gmail.com', 'Maracay', 'carmen', '123456', '2', '1');

-- ----------------------------
-- Table structure for `operadores_taquillas`
-- ----------------------------
DROP TABLE IF EXISTS `operadores_taquillas`;
CREATE TABLE `operadores_taquillas` (
  `idoperador_taquilla` int(11) NOT NULL AUTO_INCREMENT,
  `idoperador` int(11) DEFAULT NULL,
  `idtaquilla` int(11) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idoperador_taquilla`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of operadores_taquillas
-- ----------------------------
INSERT INTO `operadores_taquillas` VALUES ('1', '1', '1', '1');
INSERT INTO `operadores_taquillas` VALUES ('2', '5', '2', '1');
INSERT INTO `operadores_taquillas` VALUES ('3', '6', '3', '1');
INSERT INTO `operadores_taquillas` VALUES ('4', '7', '4', '1');
INSERT INTO `operadores_taquillas` VALUES ('5', '9', '5', '1');
INSERT INTO `operadores_taquillas` VALUES ('26', '15', '28', '1');
INSERT INTO `operadores_taquillas` VALUES ('27', '0', '29', '1');
INSERT INTO `operadores_taquillas` VALUES ('28', '0', '30', '1');
INSERT INTO `operadores_taquillas` VALUES ('29', '0', '31', '1');
INSERT INTO `operadores_taquillas` VALUES ('30', '0', '32', '1');
INSERT INTO `operadores_taquillas` VALUES ('21', '11', '23', '1');
INSERT INTO `operadores_taquillas` VALUES ('22', '12', '24', '1');
INSERT INTO `operadores_taquillas` VALUES ('23', '0', '25', '1');
INSERT INTO `operadores_taquillas` VALUES ('24', '0', '26', '1');
INSERT INTO `operadores_taquillas` VALUES ('25', '0', '27', '1');

-- ----------------------------
-- Table structure for `taquillas`
-- ----------------------------
DROP TABLE IF EXISTS `taquillas`;
CREATE TABLE `taquillas` (
  `idtaquilla` int(11) NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idtaquilla`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taquillas
-- ----------------------------
INSERT INTO `taquillas` VALUES ('1', '1', 'NÃºmero 1', '1');
INSERT INTO `taquillas` VALUES ('2', '1', 'Numero 2', '1');
INSERT INTO `taquillas` VALUES ('3', '1', 'Numero 3', '1');
INSERT INTO `taquillas` VALUES ('4', '2', 'Numero 1', '1');
INSERT INTO `taquillas` VALUES ('5', '2', 'Numero 2', '1');
INSERT INTO `taquillas` VALUES ('6', '2', 'Numero 3', '1');
INSERT INTO `taquillas` VALUES ('7', '2', 'Numero 4', '1');
INSERT INTO `taquillas` VALUES ('28', '3', '1', '1');
INSERT INTO `taquillas` VALUES ('29', '3', '2', '1');
INSERT INTO `taquillas` VALUES ('30', '3', '3', '1');
INSERT INTO `taquillas` VALUES ('31', '3', '4', '1');
INSERT INTO `taquillas` VALUES ('32', '3', '5', '1');
INSERT INTO `taquillas` VALUES ('23', '10', 'NÃºmero 1', '1');
INSERT INTO `taquillas` VALUES ('24', '10', '2', '1');
INSERT INTO `taquillas` VALUES ('25', '10', '3', '1');
INSERT INTO `taquillas` VALUES ('26', '10', '4', '1');
INSERT INTO `taquillas` VALUES ('27', '10', '5', '1');

-- ----------------------------
-- Table structure for `terminales`
-- ----------------------------
DROP TABLE IF EXISTS `terminales`;
CREATE TABLE `terminales` (
  `idterminal` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `descripcion_impresora` varchar(255) DEFAULT NULL,
  `ubicacion_impresora` varchar(255) DEFAULT NULL COMMENT 'Ubicacion en la red',
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idterminal`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of terminales
-- ----------------------------
INSERT INTO `terminales` VALUES ('1', 'Medio utilizado para imprimir tickets', 'HP Deskjet D1600 series', 'HP Deskjet D1600 series (Copiar 1)', 'terminal1', '123456', '1');

-- ----------------------------
-- Table structure for `tickets_detalles`
-- ----------------------------
DROP TABLE IF EXISTS `tickets_detalles`;
CREATE TABLE `tickets_detalles` (
  `idticket_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `idticket_encabezado` int(11) DEFAULT NULL,
  `idoperador_taquilla` int(11) DEFAULT NULL,
  `correlativo` int(2) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hora_atendido` time DEFAULT NULL,
  `atendiendo` int(1) DEFAULT NULL,
  `atendido` int(1) DEFAULT NULL,
  `llamando` int(1) DEFAULT NULL,
  `anulado` int(1) DEFAULT NULL,
  `volver_llamar` int(1) DEFAULT '0',
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idticket_detalle`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tickets_detalles
-- ----------------------------
INSERT INTO `tickets_detalles` VALUES ('38', '11', '4', '1', '15:30:06', '15:35:12', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('39', '11', '4', '2', '15:30:26', '00:00:00', '1', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('40', '10', '1', '1', '15:30:32', '15:32:35', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('41', '10', '2', '2', '15:30:37', '16:03:35', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('42', '11', '5', '3', '15:30:53', '17:21:32', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('43', '11', '5', '4', '15:30:54', '00:00:00', '1', '0', '1', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('44', '11', '0', '5', '15:30:56', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('45', '10', '1', '3', '15:30:57', '00:00:00', '1', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('46', '10', '2', '4', '15:30:58', '16:17:34', '1', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('47', '10', '2', '5', '15:31:00', '16:19:17', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('48', '10', '0', '6', '15:31:01', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('49', '11', '0', '6', '16:13:19', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('50', '14', '0', '1', '03:18:28', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('51', '13', '0', '1', '03:18:33', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('52', '13', '0', '2', '03:18:36', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('53', '12', '1', '1', '03:18:39', '03:25:01', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('54', '15', '0', '1', '03:18:40', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('55', '15', '0', '2', '03:18:41', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('56', '12', '1', '2', '03:18:43', '22:04:57', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('57', '14', '0', '2', '03:18:44', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('58', '13', '0', '3', '03:18:46', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('59', '12', '1', '3', '12:03:38', '00:00:00', '1', '0', '1', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('60', '15', '0', '3', '12:04:01', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('61', '13', '0', '4', '22:01:28', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('62', '18', '0', '1', '21:11:24', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('63', '16', '1', '1', '21:11:55', '21:13:51', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('64', '16', '1', '2', '21:12:00', '00:00:00', '1', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('65', '19', '0', '1', '21:12:06', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('66', '19', '0', '2', '21:12:06', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('67', '19', '0', '3', '21:12:07', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('68', '17', '4', '1', '21:12:09', '22:27:06', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('69', '17', '4', '2', '21:12:09', '22:28:29', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('70', '17', '4', '3', '21:12:10', '00:00:00', '1', '0', '1', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('71', '17', '0', '4', '21:12:11', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('72', '16', '0', '3', '21:13:18', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('73', '16', '0', '4', '21:13:18', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('74', '16', '0', '5', '21:13:19', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('75', '18', '0', '2', '22:05:16', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('76', '16', '0', '6', '22:05:20', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('77', '17', '0', '5', '22:27:48', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('78', '17', '0', '6', '22:27:49', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('79', '22', '0', '1', '06:19:29', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('80', '22', '0', '2', '06:43:16', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('81', '21', '0', '1', '06:43:19', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('82', '20', '1', '1', '06:43:21', '07:08:15', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('83', '23', '0', '1', '06:43:22', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('84', '23', '0', '2', '06:43:23', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('85', '23', '0', '3', '06:43:25', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('86', '20', '1', '2', '06:43:26', '07:08:23', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('87', '21', '0', '2', '06:43:28', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('88', '22', '0', '3', '06:43:28', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('89', '23', '0', '4', '06:43:29', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('90', '20', '1', '3', '06:44:38', '07:09:38', '0', '1', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('91', '20', '1', '4', '06:44:39', '07:09:43', '0', '0', '0', '1', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('92', '20', '1', '5', '06:44:40', '00:00:00', '1', '0', '1', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('93', '20', '0', '6', '06:44:40', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('94', '20', '0', '7', '06:44:41', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('95', '20', '0', '8', '06:44:42', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('96', '20', '0', '9', '06:44:43', '00:00:00', '0', '0', '0', '0', '0', '1');
INSERT INTO `tickets_detalles` VALUES ('97', '20', '0', '10', '06:44:43', '00:00:00', '0', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `tickets_encabezados`
-- ----------------------------
DROP TABLE IF EXISTS `tickets_encabezados`;
CREATE TABLE `tickets_encabezados` (
  `idticket_encabezado` int(11) NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) DEFAULT NULL,
  `numero_tickets` int(2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idticket_encabezado`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tickets_encabezados
-- ----------------------------
INSERT INTO `tickets_encabezados` VALUES ('10', '1', '20', '2011-12-04', '1');
INSERT INTO `tickets_encabezados` VALUES ('11', '2', '25', '2011-12-04', '1');
INSERT INTO `tickets_encabezados` VALUES ('12', '1', '15', '2011-12-05', '1');
INSERT INTO `tickets_encabezados` VALUES ('13', '2', '15', '2011-12-05', '1');
INSERT INTO `tickets_encabezados` VALUES ('14', '3', '15', '2011-12-05', '1');
INSERT INTO `tickets_encabezados` VALUES ('15', '10', '15', '2011-12-05', '1');
INSERT INTO `tickets_encabezados` VALUES ('16', '1', '15', '2011-12-06', '1');
INSERT INTO `tickets_encabezados` VALUES ('17', '2', '15', '2011-12-06', '1');
INSERT INTO `tickets_encabezados` VALUES ('18', '3', '15', '2011-12-06', '1');
INSERT INTO `tickets_encabezados` VALUES ('19', '10', '15', '2011-12-06', '1');
INSERT INTO `tickets_encabezados` VALUES ('20', '1', '20', '2011-12-07', '1');
INSERT INTO `tickets_encabezados` VALUES ('21', '2', '15', '2011-12-07', '1');
INSERT INTO `tickets_encabezados` VALUES ('22', '3', '30', '2011-12-07', '1');
INSERT INTO `tickets_encabezados` VALUES ('23', '10', '15', '2011-12-07', '1');

-- ----------------------------
-- Table structure for `tips`
-- ----------------------------
DROP TABLE IF EXISTS `tips`;
CREATE TABLE `tips` (
  `idtip` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idtip`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tips
-- ----------------------------
INSERT INTO `tips` VALUES ('1', '2011-12-07', '05:42:27', 'A partir de maÃ±ana estaremos trabajando en horario navideÃ±o...', '8', '1');
INSERT INTO `tips` VALUES ('2', '2011-12-07', '05:43:03', 'Recuerden conciliar los documentos a la hora de solicitar audiencia.', '8', '1');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` enum('femenino','masculino') DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `nivel` int(11) DEFAULT '2',
  `estatus` int(1) DEFAULT '1',
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('8', '16945700', 'Administrador', '04268341450', '2011-10-04', 'masculino', 'enrony@gmail.com', 'Urb. La Mora, Av.28 #50', 'admin', '123', '1', '1');

-- ----------------------------
-- Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `idvideo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idvideo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES ('1', '2011-12-07', '08:01:01', 'tempads_tmtc.swf', '8', '1');

-- ----------------------------
-- View structure for `vista_operadores_taquillas`
-- ----------------------------
DROP VIEW IF EXISTS `vista_operadores_taquillas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_operadores_taquillas` AS select `operadores_taquillas`.`idoperador_taquilla` AS `idoperador_taquilla`,`operadores_taquillas`.`idoperador` AS `idoperador`,`operadores_taquillas`.`idtaquilla` AS `idtaquilla`,`operadores_taquillas`.`estatus` AS `estatus`,`operadores`.`cedula` AS `cedula`,`operadores`.`nombre` AS `nombre`,`operadores`.`telefono` AS `telefono`,`operadores`.`fecha_nacimiento` AS `fecha_nacimiento`,`operadores`.`sexo` AS `sexo`,`operadores`.`email` AS `email`,`operadores`.`direccion` AS `direccion`,`operadores`.`usuario` AS `usuario`,`operadores`.`clave` AS `clave`,`operadores`.`nivel` AS `nivel`,`taquillas`.`iddepartamento` AS `iddepartamento`,`taquillas`.`descripcion` AS `descripcion_taquilla`,`departamentos`.`descripcion` AS `descripcion_departamento` from (((`operadores_taquillas` join `operadores`) join `taquillas`) join `departamentos`) where ((`operadores_taquillas`.`idoperador` = `operadores`.`idoperador`) and (`operadores_taquillas`.`idtaquilla` = `taquillas`.`idtaquilla`) and (`taquillas`.`iddepartamento` = `departamentos`.`iddepartamento`)) ;

-- ----------------------------
-- View structure for `vista_taquillas_operadores`
-- ----------------------------
DROP VIEW IF EXISTS `vista_taquillas_operadores`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_taquillas_operadores` AS select `taquillas`.`idtaquilla` AS `idtaquilla`,`taquillas`.`iddepartamento` AS `iddepartamento`,`taquillas`.`descripcion` AS `descripcion_taquilla`,`taquillas`.`estatus` AS `estatus`,`departamentos`.`descripcion` AS `descripcion_departamento`,`operadores_taquillas`.`idoperador_taquilla` AS `idoperador_taquilla`,`operadores`.`cedula` AS `cedula`,`operadores`.`nombre` AS `nombre`,`operadores`.`telefono` AS `telefono`,`operadores`.`fecha_nacimiento` AS `fecha_nacimiento`,`operadores`.`sexo` AS `sexo`,`operadores`.`email` AS `email`,`operadores`.`direccion` AS `direccion`,`operadores`.`usuario` AS `usuario`,`operadores`.`clave` AS `clave`,`operadores`.`nivel` AS `nivel`,`operadores_taquillas`.`idoperador` AS `idoperador` from (((`taquillas` left join `departamentos` on((`taquillas`.`iddepartamento` = `departamentos`.`iddepartamento`))) left join `operadores_taquillas` on((`taquillas`.`idtaquilla` = `operadores_taquillas`.`idtaquilla`))) left join `operadores` on((`operadores_taquillas`.`idoperador` = `operadores`.`idoperador`))) ;

-- ----------------------------
-- View structure for `vista_tickets_departamentos`
-- ----------------------------
DROP VIEW IF EXISTS `vista_tickets_departamentos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_tickets_departamentos` AS select `tickets_encabezados`.`idticket_encabezado` AS `idticket_encabezado`,`tickets_encabezados`.`iddepartamento` AS `iddepartamento`,`tickets_encabezados`.`numero_tickets` AS `numero_tickets`,`tickets_encabezados`.`fecha` AS `fecha`,`tickets_encabezados`.`estatus` AS `estatus`,`departamentos`.`descripcion` AS `descripcion_departamento` from (`tickets_encabezados` join `departamentos`) where (`tickets_encabezados`.`iddepartamento` = `departamentos`.`iddepartamento`) ;

-- ----------------------------
-- View structure for `vista_tickets_detalles_departamentos`
-- ----------------------------
DROP VIEW IF EXISTS `vista_tickets_detalles_departamentos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_tickets_detalles_departamentos` AS select `tickets_detalles`.`idticket_detalle` AS `idticket_detalle`,`tickets_detalles`.`idticket_encabezado` AS `idticket_encabezado`,`tickets_detalles`.`idoperador_taquilla` AS `idoperador_taquilla`,`tickets_detalles`.`hora` AS `hora`,`tickets_detalles`.`atendiendo` AS `atendiendo`,`tickets_detalles`.`atendido` AS `atendido`,`tickets_detalles`.`llamando` AS `llamando`,`tickets_detalles`.`anulado` AS `anulado`,`tickets_detalles`.`volver_llamar` AS `volver_llamar`,`tickets_detalles`.`estatus` AS `estatus`,`tickets_encabezados`.`iddepartamento` AS `iddepartamento`,`tickets_encabezados`.`fecha` AS `fecha`,`departamentos`.`descripcion` AS `descripcion_departamento`,`operadores_taquillas`.`idoperador` AS `idoperador`,`operadores_taquillas`.`idtaquilla` AS `idtaquilla`,`operadores`.`cedula` AS `cedula`,`operadores`.`nombre` AS `nombre`,`operadores`.`telefono` AS `telefono`,`operadores`.`fecha_nacimiento` AS `fecha_nacimiento`,`operadores`.`sexo` AS `sexo`,`operadores`.`email` AS `email`,`operadores`.`direccion` AS `direccion`,`operadores`.`usuario` AS `usuario`,`operadores`.`clave` AS `clave`,`operadores`.`nivel` AS `nivel`,`taquillas`.`descripcion` AS `descripcion_taquilla`,`tickets_detalles`.`hora_atendido` AS `hora_atendido`,`tickets_detalles`.`correlativo` AS `correlativo` from (((((`tickets_detalles` left join `tickets_encabezados` on((`tickets_detalles`.`idticket_encabezado` = `tickets_encabezados`.`idticket_encabezado`))) left join `departamentos` on((`tickets_encabezados`.`iddepartamento` = `departamentos`.`iddepartamento`))) left join `operadores_taquillas` on((`tickets_detalles`.`idoperador_taquilla` = `operadores_taquillas`.`idoperador_taquilla`))) left join `operadores` on((`operadores_taquillas`.`idoperador` = `operadores`.`idoperador`))) left join `taquillas` on((`operadores_taquillas`.`idtaquilla` = `taquillas`.`idtaquilla`))) ;

-- ----------------------------
-- View structure for `vista_tips`
-- ----------------------------
DROP VIEW IF EXISTS `vista_tips`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_tips` AS select `tips`.`idtip` AS `idtip`,`tips`.`fecha` AS `fecha`,`tips`.`hora` AS `hora`,`tips`.`nota` AS `nota`,`tips`.`idusuario` AS `idusuario`,`tips`.`estatus` AS `estatus`,`usuarios`.`cedula` AS `cedula`,`usuarios`.`nombre` AS `nombre`,`usuarios`.`telefono` AS `telefono`,`usuarios`.`fecha_nacimiento` AS `fecha_nacimiento`,`usuarios`.`sexo` AS `sexo`,`usuarios`.`email` AS `email`,`usuarios`.`direccion` AS `direccion`,`usuarios`.`usuario` AS `usuario`,`usuarios`.`clave` AS `clave`,`usuarios`.`nivel` AS `nivel` from (`tips` left join `usuarios` on((`tips`.`idusuario` = `usuarios`.`idusuario`))) ;

-- ----------------------------
-- View structure for `vista_videos`
-- ----------------------------
DROP VIEW IF EXISTS `vista_videos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_videos` AS select `videos`.`idvideo` AS `idvideo`,`videos`.`fecha` AS `fecha`,`videos`.`hora` AS `hora`,`videos`.`descripcion` AS `descripcion`,`videos`.`idusuario` AS `idusuario`,`videos`.`estatus` AS `estatus`,`usuarios`.`cedula` AS `cedula`,`usuarios`.`nombre` AS `nombre`,`usuarios`.`telefono` AS `telefono`,`usuarios`.`fecha_nacimiento` AS `fecha_nacimiento`,`usuarios`.`sexo` AS `sexo`,`usuarios`.`email` AS `email`,`usuarios`.`direccion` AS `direccion`,`usuarios`.`usuario` AS `usuario`,`usuarios`.`nivel` AS `nivel`,`usuarios`.`clave` AS `clave` from (`videos` left join `usuarios` on((`usuarios`.`idusuario` = `usuarios`.`idusuario`))) ;
