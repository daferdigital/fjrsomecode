CREATE  TABLE `mensaje_clientes` (
  `id_mensaje` INT NOT NULL ,
  `id_cliente` INT NOT NULL ,
  `leido` CHAR(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_mensaje`, `id_cliente`) )
ENGINE = InnoDB;

ALTER TABLE `mensaje_clientes` 
  ADD CONSTRAINT `FK_MENSAJE_CLIENTE`
  FOREIGN KEY (`id_mensaje` )
  REFERENCES `mensajes` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `FK_MENSAJE_CLIENTE_idx` (`id_mensaje` ASC) ;
