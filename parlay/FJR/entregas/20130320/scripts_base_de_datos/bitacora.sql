CREATE TABLE `bitacora` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

