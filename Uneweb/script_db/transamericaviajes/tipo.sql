-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-06-2012 a las 18:48:52
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
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` tinyint(4) NOT NULL auto_increment,
  `categoria` varchar(50) NOT NULL default '',
  `seccion` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `categoria`, `seccion`) VALUES
(42, 'Europa', 70),
(22, 'Preguntas', 68),
(21, 'Ubicanos en Google Maps', 68),
(7, 'PROMOCIONES', 66),
(51, 'Aviso Legal y Privacidad', 83),
(44, 'Suramérica', 70),
(43, 'Trasatlánticos', 53),
(41, 'Europa', 53),
(39, 'Caribe', 53),
(40, 'Suramérica', 53),
(23, 'Preguntas y Respuestas', 65),
(50, 'Propuestas Transamerica', 88),
(29, 'Promociones', 72),
(52, 'Townhouse', 80),
(49, 'Concurso Creativo', 83),
(33, 'Casas y Villas ', 80),
(46, 'Inglés', 81),
(47, 'Cruceros Disney', 53),
(48, 'Futbol ', 81),
(53, 'Medio Oriente', 53);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
