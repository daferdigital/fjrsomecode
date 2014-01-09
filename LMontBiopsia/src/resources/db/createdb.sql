CREATE  TABLE `lmont_biopsia`.`usuario_modulos` (
  `id_modulo` INT NOT NULL ,
  `id_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_modulo`, `id_usuario`) ,
  INDEX `FK_PERMISO_MODULO_idx` (`id_modulo` ASC) ,
  INDEX `FK_PERMISO_USUARIO_idx` (`id_usuario` ASC) ,
  CONSTRAINT `FK_PERMISO_MODULO`
    FOREIGN KEY (`id_modulo` )
    REFERENCES `lmont_biopsia`.`modulos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PERMISO_USUARIO`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `lmont_biopsia`.`usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'permisos de los usuarios en los modulos';

ALTER TABLE `lmont_biopsia`.`biopsias` ADD COLUMN `id_usuario_actual` INT NULL  AFTER `id_tipo_estudio` , 
  ADD CONSTRAINT `FK_BIOPSIA_USUARIO`
  FOREIGN KEY (`id_usuario_actual` )
  REFERENCES `lmont_biopsia`.`usuarios` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `FK_BIOPSIA_USUARIO_idx` (`id_usuario_actual` ASC) ;

INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Entrega', 'Entrega de materiales o Informes', 'ENTREGA');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Recepción', 'Creación o Actualización de Estudios Recien Ingresados', 'INGRESO');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Macro', 'Procesamiento de estudios en su fase Macro', 'MACRO');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Histologia', 'Procesamiento de estudios en su fase de Histologia', 'HISTOLOGIA');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Micro', 'Procesamiento de estudios en su fase Micro', 'MICRO');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('IHQ', 'Procesamiento de estudios en su fase de IHQ', 'IHQ');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Maestros', 'Modulo para gestionar las entidades del sistema', 'MAESTROS');
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Busquedas', 'Modulo de Busquedas en el sistema', 'BUSQUEDAS');

INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('1', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('2', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('3', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('4', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('5', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('6', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('7', '1');
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES ('8', '1');