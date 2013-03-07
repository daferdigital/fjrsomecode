-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2012 at 10:53 AM
-- Server version: 5.0.92
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kijam_ray`
--

-- --------------------------------------------------------

--
-- Table structure for table `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` int(11) NOT NULL auto_increment,
  `id_jefe` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_parroquia` int(11) NOT NULL,
  `nombre_inmueble` varchar(100) collate utf8_spanish_ci NOT NULL,
  `piso` varchar(100) collate utf8_spanish_ci NOT NULL,
  `apartamento` varchar(100) collate utf8_spanish_ci NOT NULL,
  `direccion` text collate utf8_spanish_ci NOT NULL,
  `trabaja` smallint(6) NOT NULL,
  `vivienda` smallint(6) NOT NULL,
  `tipo_vivienda` smallint(6) NOT NULL,
  `tiempo_vivienda` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`),
  KEY `id_estado` (`id_estado`,`id_municipio`,`id_parroquia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `direcciones`
--

-- --------------------------------------------------------

--
-- Table structure for table `encuestas`
--

CREATE TABLE IF NOT EXISTS `encuestas` (
  `id` int(11) NOT NULL auto_increment,
  `id_jefe` int(11) NOT NULL,
  `cooperacion_vecinos` int(11) NOT NULL default '0',
  `violencia_vecinal` int(11) NOT NULL default '0',
  `abuso_autoridades` int(11) NOT NULL default '0',
  `prostitucion` int(11) NOT NULL default '0',
  `alcoholismo` int(11) NOT NULL default '0',
  `enfermos_terminales` int(11) NOT NULL default '0',
  `discapacitados` int(11) NOT NULL default '0',
  `delincuencia` int(11) NOT NULL default '0',
  `indigentes` int(11) NOT NULL default '0',
  `ninos_abandono` int(11) NOT NULL default '0',
  `extrema_densidad_poblacional` int(11) NOT NULL default '0',
  `comercio_drogas` int(11) NOT NULL default '0',
  `consumo_drogas` int(11) NOT NULL default '0',
  `servicios_publicos` int(11) NOT NULL default '0',
  `basura` int(11) NOT NULL default '0',
  `seguridad_urbana` int(11) NOT NULL default '0',
  `aguas_servidas_emposadas` int(11) NOT NULL default '0',
  `residuos_toxicos` int(11) NOT NULL default '0',
  `barros_pantanos` int(11) NOT NULL default '0',
  `ruidos` int(11) NOT NULL default '0',
  `fabricas_contaminantes` int(11) NOT NULL default '0',
  `licorerias` int(11) NOT NULL default '0',
  `transito_vehicular` int(11) NOT NULL default '0',
  `terrenos_baldios` int(11) NOT NULL default '0',
  `falta_espacios_recreacion` int(11) NOT NULL default '0',
  `falta_espacios_deportivos` int(11) NOT NULL default '0',
  `victima_delito` int(11) NOT NULL default '0',
  `otros_problemas_comunidad` text collate utf8_spanish_ci NOT NULL,
  `mision_robinson` int(11) NOT NULL default '0',
  `mision_ribas` int(11) NOT NULL default '0',
  `mision_mercal` int(11) NOT NULL default '0',
  `mision_negra_hipolita` int(11) NOT NULL default '0',
  `mision_habitat` int(11) NOT NULL default '0',
  `mision_vivienda` int(11) NOT NULL default '0',
  `mision_barrio_adentro` int(11) NOT NULL default '0',
  `mision_ciencia` int(11) NOT NULL default '0',
  `mision_cultura` int(11) NOT NULL default '0',
  `simoncito` int(11) NOT NULL default '0',
  `unidad_educativa` int(11) NOT NULL default '0',
  `liceo` int(11) NOT NULL default '0',
  `universidad` int(11) NOT NULL default '0',
  `aguas_blancas` int(11) NOT NULL default '0',
  `aguas_servidas` int(11) NOT NULL default '0',
  `sistema_electrico` int(11) NOT NULL default '0',
  `recoleccion_basura` int(11) NOT NULL default '0',
  `telefonia` int(11) NOT NULL default '0',
  `transporte` int(11) NOT NULL default '0',
  `mecanismo_informacion` int(11) NOT NULL default '0',
  `servicios_comunitarios` int(11) NOT NULL default '0',
  `gas_domestico` int(11) NOT NULL default '0',
  `alumbrado_publico` int(11) NOT NULL default '0',
  `modulos_seguridad` int(11) NOT NULL default '0',
  `familiar_enfermo` int(11) NOT NULL default '0',
  `ayuda_familiar_enfermo` int(11) NOT NULL default '0',
  `simon_rodriguez` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `encuestas`
--

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL auto_increment,
  `estado` varchar(100) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `estados` (`estado`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'Distrito Capital'),
(2, 'Amazonas'),
(3, 'Miranda'),
(4, 'Caracas Prueba');

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE IF NOT EXISTS `familias` (
  `id` int(11) NOT NULL auto_increment,
  `id_jefe` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `parentesco` varchar(100) collate utf8_spanish_ci NOT NULL,
  `salud` varchar(100) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_jefe` (`id_jefe`,`id_persona`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `familias`
--


-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(11) NOT NULL auto_increment,
  `id_estado` int(11) NOT NULL,
  `municipio` varchar(100) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_estado` (`id_estado`,`municipio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`id`, `id_estado`, `municipio`) VALUES
(3, 1, 'Libertador'),
(5, 3, 'Guaicaipuro');

-- --------------------------------------------------------

--
-- Table structure for table `parroquias`
--

CREATE TABLE IF NOT EXISTS `parroquias` (
  `id` int(11) NOT NULL auto_increment,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `parroquia` varchar(100) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_estado` (`id_estado`,`id_municipio`,`parroquia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `parroquias`
--

INSERT INTO `parroquias` (`id`, `id_estado`, `id_municipio`, `parroquia`) VALUES
(3, 1, 3, 'San Juan'),
(2, 1, 3, 'San Pedro'),
(4, 1, 3, 'Sucre'),
(5, 3, 5, 'Los Teques'),
(9, 1, 3, 'El Recreo');

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL auto_increment,
  `nacionalidad` varchar(1) character set ascii NOT NULL default 'V',
  `cedula` int(11) NOT NULL,
  `nombres` varchar(200) collate utf8_spanish_ci NOT NULL,
  `apellidos` varchar(200) collate utf8_spanish_ci NOT NULL,
  `sexo` varchar(1) collate utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado_civil` smallint(6) NOT NULL,
  `instruccion` varchar(100) collate utf8_spanish_ci NOT NULL,
  `profesion` varchar(100) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nacionalidad` (`nacionalidad`,`cedula`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `personas`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(128) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`user`),
  UNIQUE KEY `email` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `mail`, `name`, `rol`) VALUES
(1, 'admin', 'f9fdfad12602bd83fe1ed3f0c07fba8a', 'info@domain.com', 'Administrador', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
