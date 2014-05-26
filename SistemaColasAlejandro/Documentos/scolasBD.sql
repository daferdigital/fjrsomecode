-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 07-05-2014 a las 21:58:10
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `felipeSa`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `control_logueo`
-- 

CREATE TABLE `control_logueo` (
  `idcontrol_logueo` int(11) NOT NULL auto_increment,
  `idusuario` int(11) default NULL,
  `evento` varchar(255) default NULL,
  `fecha` date default NULL,
  `hora` time default NULL,
  PRIMARY KEY  (`idcontrol_logueo`),
  KEY `idusuario` (`idusuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `control_logueo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `departamentos`
-- 

CREATE TABLE `departamentos` (
  `iddepartamento` int(11) NOT NULL auto_increment,
  `descripcion` varchar(100) default NULL,
  `tickets_disponibles` int(4) NOT NULL,
  `estatus` int(1) default '1',
  PRIMARY KEY  (`iddepartamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Volcar la base de datos para la tabla `departamentos`
-- 

INSERT INTO `departamentos` VALUES (1, 'Recaudacion Gerencia', 50, 1);
INSERT INTO `departamentos` VALUES (2, 'Consult. Juridica', 200, 1);
INSERT INTO `departamentos` VALUES (3, 'Superintendencia', 50, 1);
INSERT INTO `departamentos` VALUES (4, 'Auditoria Fiscal', 500, 1);
INSERT INTO `departamentos` VALUES (5, 'Licores', 500, 1);
INSERT INTO `departamentos` VALUES (6, 'Fiscalizacion', 500, 1);
INSERT INTO `departamentos` VALUES (7, 'Liquidacion (A)', 1000, 1);
INSERT INTO `departamentos` VALUES (8, 'Iaromm Caja', 1000, 1);
INSERT INTO `departamentos` VALUES (9, 'Recaudacion Caja (A)', 1000, 1);
INSERT INTO `departamentos` VALUES (10, 'Recaudacion Caja (B)', 1000, 1);
INSERT INTO `departamentos` VALUES (11, 'Iaromm Liquidadores', 1000, 1);
INSERT INTO `departamentos` VALUES (12, 'Iaromm Gerencia', 50, 1);
INSERT INTO `departamentos` VALUES (13, 'Liquidacion Solvencia', 1000, 1);
INSERT INTO `departamentos` VALUES (14, 'Recaudacion Tasas', 1000, 1);
INSERT INTO `departamentos` VALUES (15, 'Liquidacion Vehiculos', 1000, 1);
INSERT INTO `departamentos` VALUES (16, 'Liquidacion Gerencia', 200, 1);
INSERT INTO `departamentos` VALUES (17, 'Liquidacion Publicidad', 1000, 1);
INSERT INTO `departamentos` VALUES (18, 'Economia Social', 500, 1);
INSERT INTO `departamentos` VALUES (19, 'Espectaculos Publicos', 500, 1);
INSERT INTO `departamentos` VALUES (20, 'Industria y Comercio', 500, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `operadores`
-- 

CREATE TABLE `operadores` (
  `idoperador` int(11) NOT NULL auto_increment,
  `cedula` varchar(15) default NULL,
  `nombre` varchar(100) default NULL,
  `telefono` varchar(50) default NULL,
  `fecha_nacimiento` date default NULL,
  `sexo` enum('femenino','masculino') default NULL,
  `email` varchar(50) default NULL,
  `direccion` varchar(255) default NULL,
  `usuario` varchar(100) default NULL,
  `clave` varchar(50) default NULL,
  `nivel` int(11) default '2',
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idoperador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- 
-- Volcar la base de datos para la tabla `operadores`
-- 

INSERT INTO `operadores` VALUES (18, '11988833', 'Olymar Sangronis', '11988833', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'solymar', '11988833', 2, 1);
INSERT INTO `operadores` VALUES (19, '20989464', 'Milagros PiÃ±ate', '20989464', '1990-09-12', 'femenino', 'prueba@gmail.com', 'prueba', 'pmilagros', '20989464', 2, 1);
INSERT INTO `operadores` VALUES (20, '17800560', 'Wilmer Vasquez', '17800560', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'vwilmer', '17800560', 2, 1);
INSERT INTO `operadores` VALUES (21, '15807091', 'Liliana Quintero', '15807091', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'qliliana', '15807091', 2, 1);
INSERT INTO `operadores` VALUES (22, '12738607', 'Francisco Figuera', '12738607', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'ffrancisco', '12738607', 2, 1);
INSERT INTO `operadores` VALUES (23, '8743180', 'Rosbely Jaspe', '8743180', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'jrosbely', '8743180', 2, 1);
INSERT INTO `operadores` VALUES (24, '18640605', 'Veronica Segovia', '18640605', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'sveronica', '18640605', 2, 1);
INSERT INTO `operadores` VALUES (25, '15333299', 'Yesenia Lopez', '15333299', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'lyesenia', '15333299', 2, 1);
INSERT INTO `operadores` VALUES (26, '18853215', 'Francis Velasquez', '18853215', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'vfrancis', '18853215', 2, 1);
INSERT INTO `operadores` VALUES (27, '7243244', 'Beysa Narvaez', '7243244', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'nbeysa', '7243244', 2, 1);
INSERT INTO `operadores` VALUES (28, '7248517', 'Maribel Blanco', '7248517', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'bmaribel', '7248517', 2, 1);
INSERT INTO `operadores` VALUES (29, '17275756', 'Hector Rodriguez', '17275756', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'rhector', '17275756', 2, 1);
INSERT INTO `operadores` VALUES (30, '17471079', 'Daniellys Aguilera', '17471079', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'adaniellys', '17471079', 2, 1);
INSERT INTO `operadores` VALUES (31, '18554395', 'Jennifer Joyo', '18554395', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'jjennifer', '18554395', 2, 1);
INSERT INTO `operadores` VALUES (32, '18220862', 'Gleysi Padrino', '18220862', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'pgleysi', '18220862', 2, 1);
INSERT INTO `operadores` VALUES (33, '18853364', 'Robercy Marquez', '18853364', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'mrobercy', '18853364', 2, 1);
INSERT INTO `operadores` VALUES (34, '13721380', 'Nathaly Pinto', '13721380', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'pnathaly', '13721380', 2, 1);
INSERT INTO `operadores` VALUES (35, '16206965', 'Yusmarbi Zambrano', '16206965', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'zyusmarbi', '16206965', 2, 1);
INSERT INTO `operadores` VALUES (36, '17986887', 'Jhoan Ochoa', '17986887', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'ojhoan', '17986887', 2, 1);
INSERT INTO `operadores` VALUES (37, '18488363', 'Wicther Perez', '18488363', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'pwicther', '18488363', 2, 1);
INSERT INTO `operadores` VALUES (38, '19790723', 'Luis Guzman', '19790723', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'gluis', '19790723', 2, 1);
INSERT INTO `operadores` VALUES (39, '13518997', 'Jenny Salom', '13518997', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'sjenny', '123', 2, 1);
INSERT INTO `operadores` VALUES (40, '18109528', 'Lisbeth Abreu', '18109528', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'alisbeth', '18109528', 2, 1);
INSERT INTO `operadores` VALUES (41, '14676901', 'Mario Prieto', '14676901', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'pmario', '14676901', 2, 1);
INSERT INTO `operadores` VALUES (42, '19181980', 'Angelica Sequera', '19181980', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'sangelica', '19181980', 2, 1);
INSERT INTO `operadores` VALUES (43, '16340313', 'David Davila', '16340313', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'ddavila', '16340313', 2, 1);
INSERT INTO `operadores` VALUES (44, '18109528', 'Lisbeth Abreu', '18109528', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'alisbeth', '18109528', 2, 1);
INSERT INTO `operadores` VALUES (45, '16551641', 'Rocio Daza', '16551641', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'drocio', '16551641', 2, 1);
INSERT INTO `operadores` VALUES (46, '16405191', 'Mayerling Rico', '16405191', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'rmayerling', '16405191', 2, 1);
INSERT INTO `operadores` VALUES (47, '18639384', 'Andreina Marquez', '18639384', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'mandreina', '123', 2, 1);
INSERT INTO `operadores` VALUES (48, '17689157', 'Yeycri Morillo', '17689157', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'myeycri', '17689157', 2, 1);
INSERT INTO `operadores` VALUES (49, '19111768', 'Maybran Soteldo', '19111768', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'smaybran', '19111768', 2, 1);
INSERT INTO `operadores` VALUES (50, '15736214', 'Mailene Montero', '15736214', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'mmailene', '123', 2, 1);
INSERT INTO `operadores` VALUES (51, '16864317', 'Luis MuÃ±os', '16864317', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'mluis', '123', 2, 1);
INSERT INTO `operadores` VALUES (52, '19246418', 'Dinaluz Martinez', '19246418', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'mdinaluz', '19246418', 2, 1);
INSERT INTO `operadores` VALUES (53, '12141662', 'Eris Mijares', '12141662', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'meris', '12141662', 2, 1);
INSERT INTO `operadores` VALUES (54, '17701378', 'Orlando Castillo', '17701378', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'corlando', '17701378', 2, 1);
INSERT INTO `operadores` VALUES (55, '18364043', 'Miriana Vasquez', '18364043', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'vmiriana', '18364043', 2, 1);
INSERT INTO `operadores` VALUES (56, '13870245', 'joan Barreto', '13870245', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'bjoan', '13870245', 2, 1);
INSERT INTO `operadores` VALUES (57, '16128029', 'Legna Rondon', '16128029', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'rlegna', '16128029', 2, 1);
INSERT INTO `operadores` VALUES (58, '9692703', 'Perla Hernandez', '9692703', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'hperla', '9692703', 2, 1);
INSERT INTO `operadores` VALUES (59, '9684573', 'Lisbeth Guerra', '9684573', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'glisbeth', '9684573', 2, 1);
INSERT INTO `operadores` VALUES (60, '19245887', 'Raul Guerrero', '19245887', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'graul', '19245887', 2, 1);
INSERT INTO `operadores` VALUES (61, '11797578', 'Yarley Bravo', '11797578', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'byarley', '11797578', 2, 1);
INSERT INTO `operadores` VALUES (62, '17273523', 'Flor Lopez', '17273523', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'lflor', '17273523', 2, 1);
INSERT INTO `operadores` VALUES (63, '15275230', 'Yeinmy Ferreira', '15275230', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'fyeinmy', '15275230', 2, 1);
INSERT INTO `operadores` VALUES (64, '14958415', 'Yeinni Hernandez', '14958415', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'hyeinni', '14958415', 2, 1);
INSERT INTO `operadores` VALUES (65, '13039086', 'Nora Lozada', '13039086', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'lnora', '13039086', 2, 1);
INSERT INTO `operadores` VALUES (66, '16686313', 'Wilmer Gutierrez', '16686313', '1990-06-12', 'masculino', 'prueba@gmail.com', 'prueba', 'gwilmer', '16686313', 2, 1);
INSERT INTO `operadores` VALUES (67, '9671897', 'Jenny Jimenez', '9671897', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'jjenny', '9671897', 2, 1);
INSERT INTO `operadores` VALUES (68, '7219797', 'Celia Diaz', '7219797', '1990-06-12', 'femenino', 'prueba@gmail.com', 'prueba', 'dcelia', '7219797', 2, 1);
INSERT INTO `operadores` VALUES (69, '16863562', 'Marfer Hernandez', '16863562', '1990-06-12', 'masculino', 'p@gmail.com', 'p', 'hmarfer', '123', 2, 1);
INSERT INTO `operadores` VALUES (70, '18084007', 'Juan Martinez', '123456', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'mjuan', '18084007', 2, 1);
INSERT INTO `operadores` VALUES (71, '18640080', 'Felix Moreira', '123456', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'mfelix', '18640080', 2, 1);
INSERT INTO `operadores` VALUES (72, '19173621', 'Rosa Barreto', '123456', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'brosa', '19173621', 2, 1);
INSERT INTO `operadores` VALUES (73, '6685562', 'Liset Figuera', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'fliset', '6685562', 2, 1);
INSERT INTO `operadores` VALUES (74, '17569834', 'Rosmy Romero', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'rrosmy', '17569834', 2, 1);
INSERT INTO `operadores` VALUES (75, '18780773', 'Yenireth Prato', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'pyenireth', '18780773', 2, 1);
INSERT INTO `operadores` VALUES (76, '16864585', 'Hector Tabare', '123', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'thector', '123', 2, 1);
INSERT INTO `operadores` VALUES (77, '13736874', 'Juan Quintana', '123', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'qjuan', '13736874', 2, 1);
INSERT INTO `operadores` VALUES (78, '9682438', 'Maria Figueira', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'fmaria', '9682438', 2, 1);
INSERT INTO `operadores` VALUES (79, '13948425', 'Jonathan Rojas', '123', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'rjonathan', '13948425', 2, 1);
INSERT INTO `operadores` VALUES (80, '9685711', 'Martin Anare', '123', '1990-06-12', 'masculino', 'p@c.com', 'prueba', 'amartin', '9685711', 2, 1);
INSERT INTO `operadores` VALUES (81, '12336978', 'Maria Pinto', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'pp', 'pmaria', '123', 2, 1);
INSERT INTO `operadores` VALUES (82, '18778601', 'Yoselin Delgado', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'dyoselin', '18778601', 2, 1);
INSERT INTO `operadores` VALUES (83, '12572597', 'Elianna Faneite', '123', '1990-06-12', 'masculino', 'p@g.com', 'pp', 'felianna', '123', 2, 1);
INSERT INTO `operadores` VALUES (84, '16553702', 'Vanessa Borges', '123', '1990-06-12', 'femenino', 'p@g.com', 'pp', 'bvanessa', '16553702', 2, 1);
INSERT INTO `operadores` VALUES (85, '16764379', 'vanessa Berrios', '123', '1990-06-12', 'femenino', 'p@g.com', 'prueba', 'bvanessa', '16764379', 2, 1);
INSERT INTO `operadores` VALUES (86, '13869086', 'Erick Beni', '123', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'berick', '13869086', 2, 1);
INSERT INTO `operadores` VALUES (87, '14430873', 'Sugehin Riera', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'pp', 'rsugehin', '14430873', 2, 1);
INSERT INTO `operadores` VALUES (88, '14881861', 'Winda Ortega', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'owinda', '14881861', 2, 1);
INSERT INTO `operadores` VALUES (89, '9669031', 'Arelys Leal', '123', '1990-06-12', 'femenino', 'p@gmail.com', 'prueba', 'larelys', '9669031', 2, 1);
INSERT INTO `operadores` VALUES (90, '16762983', 'Lean Mabel', '123', '1990-06-12', 'masculino', 'p@gmail.com', 'prueba', 'mlean', '16762983', 2, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `operadores_taquillas`
-- 

CREATE TABLE `operadores_taquillas` (
  `idoperador_taquilla` int(11) NOT NULL auto_increment,
  `idoperador` int(11) default NULL,
  `idtaquilla` int(11) default NULL,
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idoperador_taquilla`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

-- 
-- Volcar la base de datos para la tabla `operadores_taquillas`
-- 

INSERT INTO `operadores_taquillas` VALUES (1, 27, 1, 1);
INSERT INTO `operadores_taquillas` VALUES (2, 28, 2, 1);
INSERT INTO `operadores_taquillas` VALUES (3, 0, 3, 1);
INSERT INTO `operadores_taquillas` VALUES (4, 0, 4, 1);
INSERT INTO `operadores_taquillas` VALUES (5, 0, 5, 1);
INSERT INTO `operadores_taquillas` VALUES (6, 76, 6, 1);
INSERT INTO `operadores_taquillas` VALUES (7, 74, 7, 1);
INSERT INTO `operadores_taquillas` VALUES (8, 75, 8, 1);
INSERT INTO `operadores_taquillas` VALUES (9, 77, 9, 1);
INSERT INTO `operadores_taquillas` VALUES (10, 0, 10, 1);
INSERT INTO `operadores_taquillas` VALUES (11, 86, 11, 1);
INSERT INTO `operadores_taquillas` VALUES (12, 87, 12, 1);
INSERT INTO `operadores_taquillas` VALUES (13, 88, 13, 1);
INSERT INTO `operadores_taquillas` VALUES (14, 89, 14, 1);
INSERT INTO `operadores_taquillas` VALUES (15, 90, 15, 1);
INSERT INTO `operadores_taquillas` VALUES (16, 83, 16, 1);
INSERT INTO `operadores_taquillas` VALUES (17, 84, 17, 1);
INSERT INTO `operadores_taquillas` VALUES (18, 85, 18, 1);
INSERT INTO `operadores_taquillas` VALUES (19, 0, 19, 1);
INSERT INTO `operadores_taquillas` VALUES (20, 0, 20, 1);
INSERT INTO `operadores_taquillas` VALUES (21, 79, 21, 1);
INSERT INTO `operadores_taquillas` VALUES (22, 78, 22, 1);
INSERT INTO `operadores_taquillas` VALUES (23, 0, 23, 1);
INSERT INTO `operadores_taquillas` VALUES (24, 0, 24, 1);
INSERT INTO `operadores_taquillas` VALUES (25, 0, 25, 1);
INSERT INTO `operadores_taquillas` VALUES (26, 80, 26, 1);
INSERT INTO `operadores_taquillas` VALUES (27, 81, 27, 1);
INSERT INTO `operadores_taquillas` VALUES (28, 82, 28, 1);
INSERT INTO `operadores_taquillas` VALUES (29, 0, 29, 1);
INSERT INTO `operadores_taquillas` VALUES (30, 0, 30, 1);
INSERT INTO `operadores_taquillas` VALUES (31, 40, 31, 1);
INSERT INTO `operadores_taquillas` VALUES (32, 41, 32, 1);
INSERT INTO `operadores_taquillas` VALUES (33, 42, 33, 1);
INSERT INTO `operadores_taquillas` VALUES (34, 46, 34, 1);
INSERT INTO `operadores_taquillas` VALUES (35, 51, 35, 1);
INSERT INTO `operadores_taquillas` VALUES (36, 29, 36, 1);
INSERT INTO `operadores_taquillas` VALUES (37, 30, 37, 1);
INSERT INTO `operadores_taquillas` VALUES (38, 31, 38, 1);
INSERT INTO `operadores_taquillas` VALUES (39, 32, 39, 1);
INSERT INTO `operadores_taquillas` VALUES (40, 33, 40, 1);
INSERT INTO `operadores_taquillas` VALUES (41, 18, 41, 1);
INSERT INTO `operadores_taquillas` VALUES (42, 19, 42, 1);
INSERT INTO `operadores_taquillas` VALUES (43, 22, 43, 1);
INSERT INTO `operadores_taquillas` VALUES (44, 0, 44, 1);
INSERT INTO `operadores_taquillas` VALUES (45, 25, 45, 1);
INSERT INTO `operadores_taquillas` VALUES (46, 53, 46, 1);
INSERT INTO `operadores_taquillas` VALUES (47, 23, 47, 1);
INSERT INTO `operadores_taquillas` VALUES (48, 20, 48, 1);
INSERT INTO `operadores_taquillas` VALUES (49, 24, 49, 1);
INSERT INTO `operadores_taquillas` VALUES (50, 0, 50, 1);
INSERT INTO `operadores_taquillas` VALUES (51, 34, 51, 1);
INSERT INTO `operadores_taquillas` VALUES (52, 35, 52, 1);
INSERT INTO `operadores_taquillas` VALUES (53, 36, 53, 1);
INSERT INTO `operadores_taquillas` VALUES (54, 37, 54, 1);
INSERT INTO `operadores_taquillas` VALUES (55, 38, 55, 1);
INSERT INTO `operadores_taquillas` VALUES (56, 39, 56, 1);
INSERT INTO `operadores_taquillas` VALUES (57, 0, 57, 1);
INSERT INTO `operadores_taquillas` VALUES (58, 0, 58, 1);
INSERT INTO `operadores_taquillas` VALUES (59, 0, 59, 1);
INSERT INTO `operadores_taquillas` VALUES (60, 0, 60, 1);
INSERT INTO `operadores_taquillas` VALUES (61, 43, 61, 1);
INSERT INTO `operadores_taquillas` VALUES (62, 47, 62, 1);
INSERT INTO `operadores_taquillas` VALUES (63, 52, 63, 1);
INSERT INTO `operadores_taquillas` VALUES (64, 49, 64, 1);
INSERT INTO `operadores_taquillas` VALUES (65, 45, 65, 1);
INSERT INTO `operadores_taquillas` VALUES (66, 26, 66, 1);
INSERT INTO `operadores_taquillas` VALUES (67, 0, 67, 1);
INSERT INTO `operadores_taquillas` VALUES (68, 0, 68, 1);
INSERT INTO `operadores_taquillas` VALUES (69, 0, 69, 1);
INSERT INTO `operadores_taquillas` VALUES (70, 0, 70, 1);
INSERT INTO `operadores_taquillas` VALUES (71, 54, 71, 1);
INSERT INTO `operadores_taquillas` VALUES (72, 55, 72, 1);
INSERT INTO `operadores_taquillas` VALUES (73, 0, 73, 1);
INSERT INTO `operadores_taquillas` VALUES (74, 0, 74, 1);
INSERT INTO `operadores_taquillas` VALUES (75, 0, 75, 1);
INSERT INTO `operadores_taquillas` VALUES (76, 56, 76, 1);
INSERT INTO `operadores_taquillas` VALUES (77, 57, 77, 1);
INSERT INTO `operadores_taquillas` VALUES (78, 58, 78, 1);
INSERT INTO `operadores_taquillas` VALUES (79, 59, 79, 1);
INSERT INTO `operadores_taquillas` VALUES (80, 0, 80, 1);
INSERT INTO `operadores_taquillas` VALUES (81, 60, 81, 1);
INSERT INTO `operadores_taquillas` VALUES (82, 61, 82, 1);
INSERT INTO `operadores_taquillas` VALUES (83, 62, 83, 1);
INSERT INTO `operadores_taquillas` VALUES (84, 0, 84, 1);
INSERT INTO `operadores_taquillas` VALUES (85, 0, 85, 1);
INSERT INTO `operadores_taquillas` VALUES (86, 69, 86, 1);
INSERT INTO `operadores_taquillas` VALUES (87, 70, 87, 1);
INSERT INTO `operadores_taquillas` VALUES (88, 71, 88, 1);
INSERT INTO `operadores_taquillas` VALUES (89, 73, 89, 1);
INSERT INTO `operadores_taquillas` VALUES (90, 72, 90, 1);
INSERT INTO `operadores_taquillas` VALUES (91, 67, 91, 1);
INSERT INTO `operadores_taquillas` VALUES (92, 68, 92, 1);
INSERT INTO `operadores_taquillas` VALUES (93, 0, 93, 1);
INSERT INTO `operadores_taquillas` VALUES (94, 0, 94, 1);
INSERT INTO `operadores_taquillas` VALUES (95, 0, 95, 1);
INSERT INTO `operadores_taquillas` VALUES (96, 63, 96, 1);
INSERT INTO `operadores_taquillas` VALUES (97, 64, 97, 1);
INSERT INTO `operadores_taquillas` VALUES (98, 65, 98, 1);
INSERT INTO `operadores_taquillas` VALUES (99, 66, 99, 1);
INSERT INTO `operadores_taquillas` VALUES (100, 0, 100, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `taquillas`
-- 

CREATE TABLE `taquillas` (
  `idtaquilla` int(11) NOT NULL auto_increment,
  `iddepartamento` int(11) default NULL,
  `descripcion` varchar(100) default NULL,
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idtaquilla`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

-- 
-- Volcar la base de datos para la tabla `taquillas`
-- 

INSERT INTO `taquillas` VALUES (1, 1, '1', 1);
INSERT INTO `taquillas` VALUES (2, 1, '2', 1);
INSERT INTO `taquillas` VALUES (3, 1, '3', 1);
INSERT INTO `taquillas` VALUES (4, 1, '4', 1);
INSERT INTO `taquillas` VALUES (5, 1, '5', 1);
INSERT INTO `taquillas` VALUES (6, 2, '1', 1);
INSERT INTO `taquillas` VALUES (7, 2, '2', 1);
INSERT INTO `taquillas` VALUES (8, 2, '3', 1);
INSERT INTO `taquillas` VALUES (9, 2, '4', 1);
INSERT INTO `taquillas` VALUES (10, 2, '5', 1);
INSERT INTO `taquillas` VALUES (11, 3, '1', 1);
INSERT INTO `taquillas` VALUES (12, 3, '2', 1);
INSERT INTO `taquillas` VALUES (13, 3, '3', 1);
INSERT INTO `taquillas` VALUES (14, 3, '4', 1);
INSERT INTO `taquillas` VALUES (15, 3, '5', 1);
INSERT INTO `taquillas` VALUES (16, 4, '1', 1);
INSERT INTO `taquillas` VALUES (17, 4, '2', 1);
INSERT INTO `taquillas` VALUES (18, 4, '3', 1);
INSERT INTO `taquillas` VALUES (19, 4, '4', 1);
INSERT INTO `taquillas` VALUES (20, 4, '5', 1);
INSERT INTO `taquillas` VALUES (21, 5, '1', 1);
INSERT INTO `taquillas` VALUES (22, 5, '2', 1);
INSERT INTO `taquillas` VALUES (23, 5, '3', 1);
INSERT INTO `taquillas` VALUES (24, 5, '4', 1);
INSERT INTO `taquillas` VALUES (25, 5, '5', 1);
INSERT INTO `taquillas` VALUES (26, 6, '1', 1);
INSERT INTO `taquillas` VALUES (27, 6, '2', 1);
INSERT INTO `taquillas` VALUES (28, 6, '3', 1);
INSERT INTO `taquillas` VALUES (29, 6, '4', 1);
INSERT INTO `taquillas` VALUES (30, 6, '5', 1);
INSERT INTO `taquillas` VALUES (31, 7, '1', 1);
INSERT INTO `taquillas` VALUES (32, 7, '2', 1);
INSERT INTO `taquillas` VALUES (33, 7, '3', 1);
INSERT INTO `taquillas` VALUES (34, 7, '4', 1);
INSERT INTO `taquillas` VALUES (35, 7, '5', 1);
INSERT INTO `taquillas` VALUES (36, 8, '1', 1);
INSERT INTO `taquillas` VALUES (37, 8, '2', 1);
INSERT INTO `taquillas` VALUES (38, 8, '3', 1);
INSERT INTO `taquillas` VALUES (39, 8, '4', 1);
INSERT INTO `taquillas` VALUES (40, 8, '5', 1);
INSERT INTO `taquillas` VALUES (41, 9, '1', 1);
INSERT INTO `taquillas` VALUES (42, 9, '2', 1);
INSERT INTO `taquillas` VALUES (43, 9, '3', 1);
INSERT INTO `taquillas` VALUES (44, 9, '4', 1);
INSERT INTO `taquillas` VALUES (45, 9, '5', 1);
INSERT INTO `taquillas` VALUES (46, 10, '1', 1);
INSERT INTO `taquillas` VALUES (47, 10, '2', 1);
INSERT INTO `taquillas` VALUES (48, 10, '3', 1);
INSERT INTO `taquillas` VALUES (49, 10, '4', 1);
INSERT INTO `taquillas` VALUES (50, 10, '5', 1);
INSERT INTO `taquillas` VALUES (51, 11, '1', 1);
INSERT INTO `taquillas` VALUES (52, 11, '2', 1);
INSERT INTO `taquillas` VALUES (53, 11, '3', 1);
INSERT INTO `taquillas` VALUES (54, 11, '4', 1);
INSERT INTO `taquillas` VALUES (55, 11, '5', 1);
INSERT INTO `taquillas` VALUES (56, 12, '1', 1);
INSERT INTO `taquillas` VALUES (57, 12, '2', 1);
INSERT INTO `taquillas` VALUES (58, 12, '3', 1);
INSERT INTO `taquillas` VALUES (59, 12, '4', 1);
INSERT INTO `taquillas` VALUES (60, 12, '5', 1);
INSERT INTO `taquillas` VALUES (61, 13, '1', 1);
INSERT INTO `taquillas` VALUES (62, 13, '2', 1);
INSERT INTO `taquillas` VALUES (63, 13, '3', 1);
INSERT INTO `taquillas` VALUES (64, 13, '4', 1);
INSERT INTO `taquillas` VALUES (65, 13, '5', 1);
INSERT INTO `taquillas` VALUES (66, 14, '1', 1);
INSERT INTO `taquillas` VALUES (67, 14, '2', 1);
INSERT INTO `taquillas` VALUES (68, 14, '3', 1);
INSERT INTO `taquillas` VALUES (69, 14, '4', 1);
INSERT INTO `taquillas` VALUES (70, 14, '5', 1);
INSERT INTO `taquillas` VALUES (71, 15, '1', 1);
INSERT INTO `taquillas` VALUES (72, 15, '2', 1);
INSERT INTO `taquillas` VALUES (73, 15, '3', 1);
INSERT INTO `taquillas` VALUES (74, 15, '4', 1);
INSERT INTO `taquillas` VALUES (75, 15, '5', 1);
INSERT INTO `taquillas` VALUES (76, 16, '1', 1);
INSERT INTO `taquillas` VALUES (77, 16, '2', 1);
INSERT INTO `taquillas` VALUES (78, 16, '3', 1);
INSERT INTO `taquillas` VALUES (79, 16, '4', 1);
INSERT INTO `taquillas` VALUES (80, 16, '5', 1);
INSERT INTO `taquillas` VALUES (81, 17, '1', 1);
INSERT INTO `taquillas` VALUES (82, 17, '2', 1);
INSERT INTO `taquillas` VALUES (83, 17, '3', 1);
INSERT INTO `taquillas` VALUES (84, 17, '4', 1);
INSERT INTO `taquillas` VALUES (85, 17, '5', 1);
INSERT INTO `taquillas` VALUES (86, 18, '1', 1);
INSERT INTO `taquillas` VALUES (87, 18, '2', 1);
INSERT INTO `taquillas` VALUES (88, 18, '3', 1);
INSERT INTO `taquillas` VALUES (89, 18, '4', 1);
INSERT INTO `taquillas` VALUES (90, 18, '5', 1);
INSERT INTO `taquillas` VALUES (91, 19, '1', 1);
INSERT INTO `taquillas` VALUES (92, 19, '2', 1);
INSERT INTO `taquillas` VALUES (93, 19, '3', 1);
INSERT INTO `taquillas` VALUES (94, 19, '4', 1);
INSERT INTO `taquillas` VALUES (95, 19, '5', 1);
INSERT INTO `taquillas` VALUES (96, 20, '1', 1);
INSERT INTO `taquillas` VALUES (97, 20, '2', 1);
INSERT INTO `taquillas` VALUES (98, 20, '3', 1);
INSERT INTO `taquillas` VALUES (99, 20, '4', 1);
INSERT INTO `taquillas` VALUES (100, 20, '5', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `terminales`
-- 

CREATE TABLE `terminales` (
  `idterminal` int(11) NOT NULL auto_increment,
  `descripcion` varchar(255) default NULL,
  `descripcion_impresora` varchar(255) default NULL,
  `ubicacion_impresora` varchar(255) default NULL COMMENT 'Ubicacion en la red',
  `usuario` varchar(50) default NULL,
  `clave` varchar(50) default NULL,
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idterminal`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `terminales`
-- 

INSERT INTO `terminales` VALUES (1, 'Medio utilizado para imprimir tickets', 'HP Deskjet D1600 series', 'HP Deskjet D1600 series (Copiar 1)', 'terminal1', '123456', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tickets_detalles`
-- 

CREATE TABLE `tickets_detalles` (
  `idticket_detalle` int(11) NOT NULL auto_increment,
  `idticket_encabezado` int(11) default NULL,
  `idoperador_taquilla` int(11) default NULL,
  `correlativo` int(2) default NULL,
  `hora` time default NULL,
  `hora_atendido` time default NULL,
  `atendiendo` int(1) default NULL,
  `atendido` int(1) default NULL,
  `llamando` int(1) default NULL,
  `anulado` int(1) default NULL,
  `volver_llamar` int(1) default '0',
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idticket_detalle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4911 ;

-- 
-- Volcar la base de datos para la tabla `tickets_detalles`
-- 

INSERT INTO `tickets_detalles` VALUES (4823, 285, 0, 2, '21:52:07', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4822, 296, 0, 2, '21:52:03', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4821, 288, 0, 2, '21:50:24', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4820, 288, 0, 1, '21:50:19', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4819, 296, 0, 1, '21:48:13', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4818, 279, 0, 2, '21:47:47', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4817, 282, 0, 1, '21:43:48', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4816, 279, 0, 1, '21:43:42', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4815, 285, 0, 1, '21:41:55', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4824, 285, 0, 3, '21:52:24', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4825, 285, 0, 4, '21:52:36', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4826, 279, 0, 3, '22:01:29', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4827, 296, 0, 3, '22:01:47', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4828, 290, 62, 4828, '23:30:53', '00:15:54', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4829, 290, 62, 1, '23:32:38', '00:11:28', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4830, 290, 62, 2, '23:32:42', '00:49:02', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4831, 290, 0, 3, '23:32:43', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4832, 290, 0, 4, '23:32:46', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4833, 290, 0, 5, '23:32:55', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4834, 286, 0, 1, '00:05:12', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4835, 284, 35, 2, '00:08:31', '00:24:58', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4836, 284, 35, 3, '00:08:35', '00:25:29', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4837, 284, 35, 4, '00:08:36', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4838, 284, 0, 5, '00:08:38', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4839, 284, 0, 6, '00:08:39', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4840, 284, 0, 7, '00:08:40', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4841, 284, 0, 8, '00:08:42', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4842, 303, 27, 1, '10:44:59', '10:51:46', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4843, 316, 0, 4843, '10:45:02', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4844, 303, 27, 3, '10:45:04', '01:44:25', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4845, 304, 35, 1, '10:46:41', '01:45:49', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4846, 304, 35, 2, '10:46:43', '01:46:11', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4847, 304, 35, 3, '10:46:45', '01:50:16', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4848, 304, 35, 4, '10:46:46', '01:50:49', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4849, 303, 27, 3, '01:38:47', '01:44:27', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4850, 310, 62, 4850, '01:44:45', '01:45:06', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4851, 304, 35, 4851, '01:44:47', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4852, 303, 27, 6, '01:44:49', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4853, 303, 0, 7, '01:44:51', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4854, 303, 0, 8, '01:44:53', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4855, 303, 0, 9, '01:44:57', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4856, 303, 0, 10, '01:44:58', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4857, 303, 0, 11, '01:44:59', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4858, 303, 0, 12, '01:45:01', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4859, 304, 0, 6, '01:48:51', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4860, 304, 0, 7, '01:48:54', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4861, 304, 0, 8, '01:48:56', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4862, 304, 0, 9, '01:48:58', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4863, 304, 0, 10, '01:48:59', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4864, 304, 0, 11, '01:49:02', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4865, 304, 0, 12, '01:49:03', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4866, 304, 0, 13, '01:49:05', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4867, 304, 0, 14, '01:49:08', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4868, 304, 0, 15, '01:49:09', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4869, 310, 62, 1, '01:52:14', '01:53:55', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4870, 310, 0, 2, '01:52:16', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4871, 310, 0, 3, '01:52:18', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4872, 310, 0, 4, '01:52:20', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4873, 310, 0, 5, '01:52:21', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4874, 310, 0, 6, '01:52:23', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4875, 323, 27, 1, '13:59:06', '14:00:04', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4876, 323, 27, 2, '13:59:08', '15:05:55', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4877, 323, 27, 3, '13:59:09', '15:06:01', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4878, 323, 27, 4, '13:59:10', '15:06:08', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4879, 323, 27, 5, '13:59:12', '00:00:00', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4880, 332, 0, 1, '15:52:03', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4881, 329, 0, 1, '16:01:41', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4882, 343, 27, 1, '18:19:32', '00:00:00', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4883, 343, 0, 2, '18:19:34', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4884, 363, 27, 1, '22:18:30', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4885, 359, 6, 1, '22:20:03', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4886, 363, 0, 2, '22:20:41', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4887, 359, 0, 2, '22:20:43', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4888, 359, 0, 3, '22:21:08', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4889, 361, 16, 1, '22:25:17', '00:00:00', 1, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4890, 361, 0, 2, '22:25:20', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4891, 361, 0, 3, '22:25:22', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4892, 375, 86, 1, '22:43:33', '22:52:47', 0, 1, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4893, 375, 86, 2, '22:43:36', '00:00:00', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4894, 375, 0, 3, '22:43:37', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4895, 375, 0, 4, '00:06:14', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4896, 425, 0, 1, '20:14:51', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4897, 430, 0, 1, '20:18:47', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4898, 431, 0, 1, '20:18:51', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4899, 431, 0, 2, '20:18:56', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4900, 448, 0, 1, '21:38:31', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4901, 454, 0, 1, '21:38:36', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4902, 447, 0, 1, '21:38:38', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4903, 446, 43, 1, '21:38:40', '00:00:00', 1, 0, 1, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4904, 444, 0, 1, '21:38:42', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4905, 448, 0, 2, '21:39:52', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4906, 442, 0, 1, '21:40:17', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4907, 442, 0, 2, '21:40:18', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4908, 459, 0, 1, '15:20:10', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4909, 459, 0, 2, '15:20:12', '00:00:00', 0, 0, 0, 0, 0, 1);
INSERT INTO `tickets_detalles` VALUES (4910, 466, 45, 1, '15:32:19', '00:00:00', 1, 0, 1, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tickets_encabezados`
-- 

CREATE TABLE `tickets_encabezados` (
  `idticket_encabezado` int(11) NOT NULL auto_increment,
  `iddepartamento` int(11) default NULL,
  `numero_tickets` int(2) default NULL,
  `fecha` date default NULL,
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idticket_encabezado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=478 ;

-- 
-- Volcar la base de datos para la tabla `tickets_encabezados`
-- 

INSERT INTO `tickets_encabezados` VALUES (10, 1, 20, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (11, 2, 25, '2011-12-04', 1);
INSERT INTO `tickets_encabezados` VALUES (12, 1, 15, '2011-12-05', 1);
INSERT INTO `tickets_encabezados` VALUES (13, 2, 15, '2011-12-05', 1);
INSERT INTO `tickets_encabezados` VALUES (14, 3, 15, '2011-12-05', 1);
INSERT INTO `tickets_encabezados` VALUES (15, 10, 15, '2011-12-05', 1);
INSERT INTO `tickets_encabezados` VALUES (16, 1, 15, '2011-12-06', 1);
INSERT INTO `tickets_encabezados` VALUES (17, 2, 15, '2011-12-06', 1);
INSERT INTO `tickets_encabezados` VALUES (18, 3, 15, '2011-12-06', 1);
INSERT INTO `tickets_encabezados` VALUES (19, 10, 15, '2011-12-06', 1);
INSERT INTO `tickets_encabezados` VALUES (20, 1, 15, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (21, 2, 15, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (22, 3, 15, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (23, 10, 15, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (24, 11, 15, '2011-12-12', 1);
INSERT INTO `tickets_encabezados` VALUES (25, 12, 5, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (26, 13, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (27, 14, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (28, 15, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (29, 16, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (30, 17, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (31, 18, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (32, 1, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (33, 2, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (34, 3, 5, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (35, 4, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (36, 5, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (37, 6, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (38, 7, 50, '2011-12-13', 1);
INSERT INTO `tickets_encabezados` VALUES (39, 1, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (40, 2, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (41, 3, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (42, 4, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (43, 5, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (44, 6, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (45, 7, 15, '2011-12-14', 1);
INSERT INTO `tickets_encabezados` VALUES (46, 1, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (47, 2, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (48, 3, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (49, 4, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (50, 5, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (51, 6, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (52, 7, 15, '2011-12-16', 1);
INSERT INTO `tickets_encabezados` VALUES (53, 1, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (54, 2, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (55, 3, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (56, 4, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (57, 5, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (58, 6, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (59, 7, 15, '2011-12-18', 1);
INSERT INTO `tickets_encabezados` VALUES (60, 1, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (61, 2, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (62, 3, 5, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (63, 4, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (64, 5, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (65, 6, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (66, 7, 50, '2011-12-19', 1);
INSERT INTO `tickets_encabezados` VALUES (67, 1, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (68, 2, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (69, 3, 5, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (70, 4, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (71, 5, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (72, 6, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (73, 7, 50, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (74, 8, 500, '2011-12-21', 1);
INSERT INTO `tickets_encabezados` VALUES (75, 1, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (76, 2, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (77, 3, 5, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (78, 4, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (79, 5, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (80, 6, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (81, 7, 50, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (82, 8, 500, '2011-12-22', 1);
INSERT INTO `tickets_encabezados` VALUES (83, 1, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (84, 2, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (85, 3, 5, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (86, 4, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (87, 5, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (88, 6, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (89, 7, 50, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (90, 8, 500, '2011-12-23', 1);
INSERT INTO `tickets_encabezados` VALUES (91, 1, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (92, 2, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (93, 3, 5, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (94, 4, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (95, 5, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (96, 6, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (97, 7, 50, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (98, 8, 500, '2011-12-28', 1);
INSERT INTO `tickets_encabezados` VALUES (99, 1, 100, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (100, 2, 50, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (101, 3, 5, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (102, 4, 50, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (103, 5, 50, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (104, 6, 50, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (105, 7, 50, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (106, 8, 500, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (107, 9, 500, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (108, 10, 500, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (109, 11, 500, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (110, 12, 100, '2011-12-29', 1);
INSERT INTO `tickets_encabezados` VALUES (111, 1, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (112, 2, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (113, 3, 5, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (114, 4, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (115, 5, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (116, 6, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (117, 7, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (118, 8, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (119, 9, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (120, 10, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (121, 11, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (122, 12, 50, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (123, 13, 500, '2011-12-30', 1);
INSERT INTO `tickets_encabezados` VALUES (124, 1, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (125, 2, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (126, 3, 5, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (127, 4, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (128, 5, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (129, 6, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (130, 7, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (131, 8, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (132, 9, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (133, 10, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (134, 11, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (135, 12, 50, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (136, 13, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (137, 14, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (138, 15, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (139, 16, 200, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (140, 17, 500, '2012-01-02', 1);
INSERT INTO `tickets_encabezados` VALUES (141, 1, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (142, 2, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (143, 3, 5, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (144, 4, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (145, 5, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (146, 6, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (147, 7, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (148, 8, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (149, 9, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (150, 10, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (151, 11, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (152, 12, 50, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (153, 13, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (154, 14, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (155, 15, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (156, 16, 200, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (157, 17, 1000, '2012-01-03', 1);
INSERT INTO `tickets_encabezados` VALUES (158, 1, 50, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (159, 2, 200, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (160, 3, 50, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (161, 4, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (162, 5, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (163, 6, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (164, 7, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (165, 8, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (166, 9, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (167, 10, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (168, 11, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (169, 12, 50, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (170, 13, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (171, 14, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (172, 15, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (173, 16, 200, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (174, 17, 1000, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (175, 18, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (176, 19, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (177, 20, 500, '2012-01-04', 1);
INSERT INTO `tickets_encabezados` VALUES (178, 1, 50, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (179, 2, 200, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (180, 3, 50, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (181, 4, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (182, 5, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (183, 6, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (184, 7, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (185, 8, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (186, 9, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (187, 10, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (188, 11, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (189, 12, 50, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (190, 13, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (191, 14, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (192, 15, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (193, 16, 200, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (194, 17, 1000, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (195, 18, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (196, 19, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (197, 20, 500, '2012-01-05', 1);
INSERT INTO `tickets_encabezados` VALUES (198, 1, 50, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (199, 2, 200, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (200, 3, 50, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (201, 4, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (202, 5, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (203, 6, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (204, 7, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (205, 8, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (206, 9, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (207, 10, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (208, 11, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (209, 12, 50, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (210, 13, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (211, 14, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (212, 15, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (213, 16, 200, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (214, 17, 1000, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (215, 18, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (216, 19, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (217, 20, 500, '2012-01-09', 1);
INSERT INTO `tickets_encabezados` VALUES (218, 1, 50, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (219, 2, 200, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (220, 3, 50, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (221, 4, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (222, 5, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (223, 6, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (224, 7, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (225, 8, 1000, '2012-01-12', 1);
INSERT INTO `tickets_encabezados` VALUES (226, 9, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (227, 10, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (228, 11, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (229, 12, 50, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (230, 13, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (231, 14, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (232, 15, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (233, 16, 200, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (234, 17, 1000, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (235, 18, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (236, 19, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (237, 20, 500, '2012-01-10', 1);
INSERT INTO `tickets_encabezados` VALUES (238, 1, 50, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (239, 2, 200, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (240, 3, 50, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (241, 4, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (242, 5, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (243, 6, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (244, 7, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (245, 8, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (246, 9, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (247, 10, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (248, 11, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (249, 12, 50, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (250, 13, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (251, 14, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (252, 15, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (253, 16, 200, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (254, 17, 1000, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (255, 18, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (256, 19, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (257, 20, 500, '2012-07-02', 1);
INSERT INTO `tickets_encabezados` VALUES (258, 1, 50, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (259, 2, 200, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (260, 3, 50, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (261, 4, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (262, 5, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (263, 6, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (264, 7, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (265, 8, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (266, 9, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (267, 10, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (268, 11, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (269, 12, 50, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (270, 13, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (271, 14, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (272, 15, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (273, 16, 200, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (274, 17, 1000, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (275, 18, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (276, 19, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (277, 20, 500, '2012-07-03', 1);
INSERT INTO `tickets_encabezados` VALUES (278, 1, 50, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (279, 2, 200, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (280, 3, 50, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (281, 4, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (282, 5, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (283, 6, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (284, 7, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (285, 8, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (286, 9, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (287, 10, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (288, 11, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (289, 12, 50, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (290, 13, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (291, 14, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (292, 15, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (293, 16, 200, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (294, 17, 1000, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (295, 18, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (296, 19, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (297, 20, 500, '2012-07-04', 1);
INSERT INTO `tickets_encabezados` VALUES (298, 1, 50, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (299, 2, 200, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (300, 3, 50, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (301, 4, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (302, 5, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (303, 6, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (304, 7, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (305, 8, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (306, 9, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (307, 10, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (308, 11, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (309, 12, 50, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (310, 13, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (311, 14, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (312, 15, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (313, 16, 200, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (314, 17, 1000, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (315, 18, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (316, 19, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (317, 20, 500, '2012-07-05', 1);
INSERT INTO `tickets_encabezados` VALUES (318, 1, 50, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (319, 2, 200, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (320, 3, 50, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (321, 4, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (322, 5, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (323, 6, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (324, 7, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (325, 8, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (326, 9, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (327, 10, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (328, 11, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (329, 12, 50, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (330, 13, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (331, 14, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (332, 15, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (333, 16, 200, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (334, 17, 1000, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (335, 18, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (336, 19, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (337, 20, 500, '2012-07-06', 1);
INSERT INTO `tickets_encabezados` VALUES (338, 1, 50, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (339, 2, 200, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (340, 3, 50, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (341, 4, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (342, 5, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (343, 6, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (344, 7, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (345, 8, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (346, 9, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (347, 10, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (348, 11, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (349, 12, 50, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (350, 13, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (351, 14, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (352, 15, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (353, 16, 200, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (354, 17, 1000, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (355, 18, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (356, 19, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (357, 20, 500, '2012-07-07', 1);
INSERT INTO `tickets_encabezados` VALUES (358, 1, 50, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (359, 2, 200, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (360, 3, 50, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (361, 4, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (362, 5, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (363, 6, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (364, 7, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (365, 8, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (366, 9, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (367, 10, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (368, 11, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (369, 12, 50, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (370, 13, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (371, 14, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (372, 15, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (373, 16, 200, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (374, 17, 1000, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (375, 18, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (376, 19, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (377, 20, 500, '2012-07-09', 1);
INSERT INTO `tickets_encabezados` VALUES (378, 1, 50, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (379, 2, 200, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (380, 3, 50, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (381, 4, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (382, 5, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (383, 6, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (384, 7, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (385, 8, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (386, 9, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (387, 10, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (388, 11, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (389, 12, 50, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (390, 13, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (391, 14, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (392, 15, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (393, 16, 200, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (394, 17, 1000, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (395, 18, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (396, 19, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (397, 20, 500, '2012-10-10', 1);
INSERT INTO `tickets_encabezados` VALUES (398, 1, 50, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (399, 2, 200, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (400, 3, 50, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (401, 4, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (402, 5, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (403, 6, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (404, 7, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (405, 8, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (406, 9, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (407, 10, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (408, 11, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (409, 12, 50, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (410, 13, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (411, 14, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (412, 15, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (413, 16, 200, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (414, 17, 1000, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (415, 18, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (416, 19, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (417, 20, 500, '2012-10-11', 1);
INSERT INTO `tickets_encabezados` VALUES (418, 1, 50, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (419, 2, 200, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (420, 3, 50, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (421, 4, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (422, 5, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (423, 6, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (424, 7, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (425, 8, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (426, 9, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (427, 10, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (428, 11, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (429, 12, 50, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (430, 13, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (431, 14, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (432, 15, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (433, 16, 200, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (434, 17, 1000, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (435, 18, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (436, 19, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (437, 20, 500, '2014-03-27', 1);
INSERT INTO `tickets_encabezados` VALUES (438, 1, 50, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (439, 2, 200, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (440, 3, 50, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (441, 4, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (442, 5, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (443, 6, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (444, 7, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (445, 8, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (446, 9, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (447, 10, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (448, 11, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (449, 12, 50, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (450, 13, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (451, 14, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (452, 15, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (453, 16, 200, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (454, 17, 1000, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (455, 18, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (456, 19, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (457, 20, 500, '2014-03-31', 1);
INSERT INTO `tickets_encabezados` VALUES (458, 1, 50, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (459, 2, 200, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (460, 3, 50, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (461, 4, 500, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (462, 5, 500, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (463, 6, 500, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (464, 7, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (465, 8, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (466, 9, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (467, 10, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (468, 11, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (469, 12, 50, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (470, 13, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (471, 14, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (472, 15, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (473, 16, 200, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (474, 17, 1000, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (475, 18, 500, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (476, 19, 500, '2014-04-23', 1);
INSERT INTO `tickets_encabezados` VALUES (477, 20, 500, '2014-04-23', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tips`
-- 

CREATE TABLE `tips` (
  `idtip` int(11) NOT NULL auto_increment,
  `fecha` date default NULL,
  `hora` time default NULL,
  `nota` varchar(255) default NULL,
  `idusuario` int(11) default NULL,
  `estatus` tinyint(1) default '1',
  PRIMARY KEY  (`idtip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `tips`
-- 

INSERT INTO `tips` VALUES (1, '2011-12-07', '05:42:27', 'Bienvenidos a nuestro servicio, entre y pongase comodo', 8, 1);
INSERT INTO `tips` VALUES (2, '2011-12-07', '05:43:03', 'Recuerden conciliar los documentos a la hora de solicitar audiencia', 8, 1);
INSERT INTO `tips` VALUES (3, '2011-12-13', '19:13:19', 'Feliz Navidad para todos nuestros usuarios', 8, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL auto_increment,
  `cedula` varchar(15) default NULL,
  `nombre` varchar(100) default NULL,
  `telefono` varchar(50) default NULL,
  `fecha_nacimiento` date default NULL,
  `sexo` enum('femenino','masculino') default NULL,
  `email` varchar(50) default NULL,
  `direccion` varchar(255) default NULL,
  `usuario` varchar(100) default NULL,
  `clave` varchar(50) default NULL,
  `nivel` int(11) default '2',
  `estatus` int(1) default '1',
  PRIMARY KEY  (`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (8, '123123', 'Administrador', '04144562296', '2011-10-04', 'masculino', 'alejaramillo@gmail.com', '', 'admin', '123', 1, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `videos`
-- 

CREATE TABLE `videos` (
  `idvideo` int(11) NOT NULL auto_increment,
  `fecha` date default NULL,
  `hora` time default NULL,
  `descripcion` varchar(255) default NULL,
  `duracion` int(5) NOT NULL,
  `idusuario` int(11) default NULL,
  `estatus` tinyint(1) default '1',
  PRIMARY KEY  (`idvideo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `videos`
-- 

INSERT INTO `videos` VALUES (4, '2011-12-19', '10:26:16', 'temptempcaminata.swf', 150, 8, 0);
INSERT INTO `videos` VALUES (3, '2011-12-19', '10:25:15', 'temptemp.swf', 150, 8, 1);
INSERT INTO `videos` VALUES (6, '2011-12-19', '10:29:50', 'paseo.swf', 630, 8, 0);
