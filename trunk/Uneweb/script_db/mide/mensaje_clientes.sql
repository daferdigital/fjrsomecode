CREATE  TABLE `mensaje_clientes` (
  `id_mensaje` INT NOT NULL ,
  `id_cliente` INT NOT NULL ,
  `leido` CHAR(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_mensaje`, `id_cliente`) )
ENGINE = InnoDB;
