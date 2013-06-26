-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-06-2013 a las 19:25:20
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `constancias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_constancia`
--

CREATE TABLE IF NOT EXISTS `alumno_constancia` (
  `cedula` varchar(50) COLLATE latin1_bin NOT NULL,
  `nombre` varchar(250) COLLATE latin1_bin NOT NULL,
  `trimestre` varchar(10) COLLATE latin1_bin NOT NULL,
  `horario` varchar(250) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcar la base de datos para la tabla `alumno_constancia`
--

INSERT INTO `alumno_constancia` (`cedula`, `nombre`, `trimestre`, `horario`) VALUES
('10616519', 'MEJIAS BERMEJO ZULMA ZULEIMA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('10618219', 'SOLORZANO, WILMAN', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('10924864', 'TORRES ECHENIQUE, HENRY OMAR', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('11235938', 'ESAA ROJAS, GRISEL MIGUELINA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('11236252', 'MONTILLA, ELSA MARGARITA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('12581621', 'CABRERA CORONA, LUISA ELENA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('12903991', 'LEAL GARCIA, JOSE ANTONIO', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('13560146', 'DIAZ CASTILLO, ANA CAROLINA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('13639528', 'SEGOVIA CHACON, OMAR ALEXANDER', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('13732541', 'PERDOMO VELASQUEZ, DEIDYS CAROLINA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('14521103', 'LEAL, BENNY BIENNEY', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('15145739', 'PADILLA, JOSE MELECIO', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('16640114', 'SANOJA, MARIA ALEJANDRA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('17202342', 'PARRA DORANTE, MARIA DEL VALLE', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('18328732', 'GARRIDO INFANTE, YILENNY YOSMARBY', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('18580655', 'GONZALEZ GOLINDANO  DEIRA YLIANA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20092583', 'CASTILLO LAYA, YURAIMA NOHELIA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20611595', 'GALAN FLORES  JONATHAN JOSE', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20722970', 'ESPAÑA VENERO, DENNIS ALEJANDRINA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20724278', 'FUENTES GUTIERREZ, VICTOR GERARDO', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20724434', 'ROMERO MATUTE, MICHAEL STEEK', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20724536', 'ROMERO, CHARLY', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('20907932', 'LAYA CASTILLO  ROXANA JOSSELIN', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('21292079', 'PARRA DORANTE, MARIA DE LOS ANGELES', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('21293290', 'DEPABLOS GONZALEZ, YELIMER VANESSA', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('22684386', 'BRICEÑO SUAREZ, JOEL MISAEL', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('24103818', 'LINARES LINARES, ROBERT MACKENCY', 'I', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('24540584', 'NARVAEZ PEREZ MAR LUIS RUBI', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('24540671', 'NARANJO LUZ MARIANA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('25064449', 'PEÑALOZA MENDOZA DANIEL ALEXANDER', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('25260051', 'ESPINOZA GARCIA, PETRA MARIA', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('8169943', 'MUJICA ROJAS, FELIX FRANCISCO', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM'),
('8190951', 'PADILLA, DARIO', 'II', 'Sábados de 8:00 AM a 4:00 PM y los Domingos de 8:00 AM a 2:00 PM');
