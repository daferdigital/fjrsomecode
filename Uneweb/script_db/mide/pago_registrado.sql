CREATE TABLE `pago_registrado` (
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
  `fecha_pago` datetime NOT NULL,
  `id_cliente` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
