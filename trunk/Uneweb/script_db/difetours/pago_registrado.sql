-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-12-2012 a las 12:41:27
-- Versión del servidor: 5.1.65
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `difetour_datasb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_registrado`
--

CREATE TABLE IF NOT EXISTS `pago_registrado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pagador` varchar(255) NOT NULL,
  `cia_pagadora` varchar(255) DEFAULT NULL,
  `ci_rif` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `cod_transaccion` varchar(45) NOT NULL,
  `cod_factura` varchar(45) NOT NULL,
  `comentarios` varchar(255) NOT NULL,
  `fecha_pago` date NOT NULL,
  `id_cliente` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `pago_registrado`
--

INSERT INTO `pago_registrado` (`id`, `nombre_pagador`, `cia_pagadora`, `ci_rif`, `email`, `direccion`, `telefono`, `celular`, `cod_transaccion`, `cod_factura`, `comentarios`, `fecha_pago`, `id_cliente`) VALUES
(5, 'Gabriela Bracho Kerla Mijares', '', '234', 'kerlabracho@hotmail.com', '', '0212-9538412', '', '3344444', 'banesco', '$80000', '2012-12-07', '19'),
(6, 'Gabriela Bracho Kerla Mijares', '', '234', 'kerlabracho@hotmail.com', 'chacaito', '0212-9538412', '', '46546464', 'Ban Of American', '$100000', '2012-12-04', '19'),
(8, 'MARÍA ELENA MORALES MÁRQUEZ MAXIMILIANO MORALES PRIETO', '', '27CL', 'maxmorales8@hotmail.com', '', '0414-7489894 /0', '', 'quick pay no. 15940', 'del chase al bank of america', '1.000.00 $', '2012-12-03', '24'),
(9, 'Diana Pineda Jose Pineda', '', '4 MX', 'jpineda@outlook.com', '', '04166054953', '', 'TC 5333 JOSE PINEDA MANDARIN', 'TC PROCESADA EN MANDARIN', '1.000.00 $', '2012-12-04', '25'),
(10, 'Diana Pineda Jose Pineda', '', '4 MX', 'jpineda@outlook.com', '', '04166054953', '', 'TC 6325 JOSE PINEDA MANDARIN', 'TC PROCESADA EN MANDARIN', '300.00 $', '2012-12-10', '25'),
(11, 'Diana Pineda Jose Pineda', '', '4 MX', 'jpineda@outlook.com', '', '04166054953', '', 'TC 6325 JOSE PINEDA MANDARIN', 'TC PROCESADA EN MANDARIN', '100.00 $', '2012-12-10', '25'),
(12, 'Diana Pineda Jose Pineda', '', '4 MX', 'jpineda@outlook.com', '', '04166054953', '', 'TC 1145 JOSE PINEDA MANDARIN', 'TC PROCESADA EN MANDARIN', '100.00 $', '2012-12-10', '25'),
(13, 'valeria cavaliere anita cavaliere', '', '65 mx', 'difetours@gmail.com', '', '04166054953', '', 'TC 6325 JOSE PINEDA MANDARIN', 'TC PROCESADA EN MANDARIN', '100.00 $', '2012-12-05', '26'),
(14, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 9624 IRAIDA ORELLANA', '', '380.00 $', '2012-09-24', '27'),
(15, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 6030 GIOVANNI AUFIERO', '', '380.00 $', '2012-10-17', '27'),
(16, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 3223 GIOVANNI AUFIERO C', '', '285 $', '2012-10-17', '27'),
(17, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 7145 LEIDA ORELLANA', '', '380.00 $', '2012-10-24', '27'),
(18, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 3223 GIOVANNI AUFIERO C', '', '95 $', '2012-10-24', '27'),
(19, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC MC 8928 REAN VELIZ', '', '380.00 $', '2012-11-22', '27'),
(20, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 7334 MARIELLA AUFIERO', '', '95.00', '2012-11-23', '27'),
(21, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 7334 MARIELLA AUFIERO', '', '95 $', '2012-11-28', '27'),
(22, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 7334 MARIELLA AUFIERO', '', '95 $', '2012-12-03', '27'),
(23, 'Andrea Maricruz Aufiero Orella Maricruz de Aufiero', '', '1 cl', 'maricruzore@gmail.com', '', '04126793284', '', 'TC VA 7334 MARIELLA AUFIERO', '', '95 $', '2012-12-04', '27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
