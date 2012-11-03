-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-06-2012 a las 18:56:19
-- Versión del servidor: 5.0.95
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `transame_datost`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL default '',
  `tipo` int(11) NOT NULL default '0',
  `principal` int(11) NOT NULL default '0',
  `activo` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`, `tipo`, `principal`, `activo`) VALUES
(53, 'Cruceros', 12, 0, 1),
(56, 'Inicio', 1, 1, 1),
(61, 'Contacto', 9, 0, 1),
(63, 'Noticias y Eventos', 2, 0, 1),
(65, 'Preguntas frecuentes', 2, 0, 1),
(66, 'Contáctenos', 9, 0, 1),
(67, 'Solicite Presupuesto', 10, 0, 1),
(68, 'Quinceañeras', 8, 0, 1),
(69, 'Links', 12, 0, 1),
(70, 'Circuitos', 12, 0, 1),
(72, 'Temporadas', 12, 0, 1),
(74, 'fotos', 4, 0, 1),
(75, 'Galeria ', 4, 0, 1),
(76, 'Disney', 4, 0, 1),
(77, 'Paquetes Margarita', 5, 0, 1),
(78, 'Paquetes Disney', 5, 0, 1),
(80, 'Casas en Orlando', 12, 0, 1),
(81, 'Campamentos ', 12, 0, 1),
(82, 'Mi cuenta', 13, 0, 1),
(83, 'Información', 2, 0, 1),
(85, 'Centros de Salud', 5, 0, 1),
(88, 'Viajes de Novios', 14, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
