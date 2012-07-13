-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2012 a las 16:44:40
-- Versión del servidor: 5.0.95
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `webintel_boge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directorio`
--

CREATE TABLE IF NOT EXISTS `directorio` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `rif` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `familia` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` text NOT NULL,
  `correo` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `municipio` varchar(200) NOT NULL,
  `website` varchar(64) NOT NULL,
  `terminos` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1236 ;

--
-- Volcado de datos para la tabla `directorio`
--

INSERT INTO `directorio` (`id`, `nombre`, `rif`, `tipo`, `familia`, `direccion`, `telefono`, `correo`, `estado`, `ciudad`, `municipio`, `website`, `terminos`, `estatus`) VALUES
(1234, 'Oswaldo Perez', '13693310', 'Aire Acondicionado', 'Cajetines, bombillos, enchufes, cargadores', 'Av. Boleíta Centro Comercial', '9538412', 'oswaldo@elmerr.com', 'Distrito Capital', 'Caracas', 'Baruta', 'www.gentedeoficio.com/oswaldo', 'Acepto', 2),
(1235, 'Oscar Muños', '13693310', 'Artesano', 'Duendes, esculturas, muñequería, vasijas', 'La California, av. los jabillos', '2568790', 'info@duendes.com', 'Distrito Capital', 'Caracas', 'Sucre', 'www.duendes.com', 'Acepto', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
