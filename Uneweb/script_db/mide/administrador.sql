-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-10-2012 a las 11:35:29
-- Versión del servidor: 5.1.65
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `webintel_winweb1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(20) NOT NULL DEFAULT '',
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `cedula` varchar(8) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(8) NOT NULL DEFAULT '',
  `tipo` tinyint(4) NOT NULL DEFAULT '0',
  `vigencia` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `apellido`, `nombre`, `cedula`, `login`, `password`, `tipo`, `vigencia`) VALUES
(4, 'admin', 'admin', '123', 'admin', '123/', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
