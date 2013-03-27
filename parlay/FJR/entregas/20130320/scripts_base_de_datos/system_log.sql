CREATE TABLE `system_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `query` text NOT NULL,
  `result` text,
  `was_error` char(1) NOT NULL DEFAULT '0',
  `query_time` int(10) unsigned NOT NULL COMMENT 'tiempo en segundos que tardo en ejecutarse la consulta almacenada en este registro',
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

