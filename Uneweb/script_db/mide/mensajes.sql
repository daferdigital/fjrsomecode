CREATE  TABLE `mensajes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `body` TEXT NOT NULL ,
  `idadmin` INT NOT NULL ,
  `fecha_envio` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;
