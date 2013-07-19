
create database seguridad3;
use seguridad3;




CREATE TABLE `cargo` (
  `idcargo` varchar(10) NOT NULL default '',
  `Nombrecargo` varchar(20) default NULL,
  `idsupervisor` varchar(8) NOT NULL,
  PRIMARY KEY  (`idcargo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `permisos` (
  `idcargo` int(10) NOT NULL default '0',
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` varchar(15) default NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` date NOT NULL,
  `turno` enum('d','n') NOT NULL,
  `ubicacion` varchar(20) NOT NULL,
  PRIMARY KEY  (`idcargo`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `nombre` (`nombre`,`apellido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `personal` (
  `cod` int(8) NOT NULL auto_increment,
  `nombre` varchar(20) default NULL,
  `apellido` varchar(20) default NULL,
  `cedula` char(10) NOT NULL,
  `direccion` varchar(30) default NULL,
  `turno` enum('d','n') default NULL,
  `ubicacion` varchar(20) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `telefono` char(12) default NULL,
  `cargo` varchar(20) NOT NULL,
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `nombre` (`nombre`,`apellido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;






CREATE TABLE `vacaciones` (
  `cod` int(8) NOT NULL auto_increment,
  `cod_supervisor` int(8) default NULL,
  `cod_vigilante` int(8) default NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` varchar(20) default NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` date NOT NULL,
  `turno` enum('d','n') NOT NULL,
  `ubicacion` varchar(20) NOT NULL,
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `nombre` (`nombre`,`apellido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

