INSERT INTO `cliente` (`id`, `cedula`, `nombres`, `apellidos`, `edad`, `telefono`, `correo`, `direccion`, `activo`) VALUES ('-2', '', '', '', '0', '', '', '', '1');

ALTER TABLE `lmont_biopsia`.`biopsias` DROP FOREIGN KEY `FK_BIOPSIA_CLIENTE` ;

ALTER TABLE `lmont_biopsia`.`biopsias` CHANGE COLUMN `id_cliente` `id_cliente` INT(11) NOT NULL DEFAULT -2  , 
  ADD CONSTRAINT `FK_BIOPSIA_CLIENTE`
  FOREIGN KEY (`id_cliente` )
  REFERENCES `lmont_biopsia`.`cliente` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `lmont_biopsia`.`macro_fotos` CHANGE COLUMN `foto` `foto` LONGBLOB NULL  , CHANGE COLUMN `file_name` `file_name` VARCHAR(250) NULL DEFAULT ''  , ADD COLUMN `id_pk` INT NOT NULL AUTO_INCREMENT  AFTER `es_foto_per_operatoria` 
, DROP PRIMARY KEY 
, ADD PRIMARY KEY (`id_pk`) ;

ALTER TABLE `lmont_biopsia`.`cliente` DROP INDEX `cedula_UNIQUE` ;

ALTER TABLE `lmont_biopsia`.`cliente` CHANGE COLUMN `direccion` `direccion` TEXT NULL  , ADD COLUMN `tipo_edad` INT NULL DEFAULT 2 COMMENT '1 para meses, 2 para anhos'  AFTER `activo` ;

ALTER TABLE `lmont_biopsia`.`biopsias_microscopicas` CHANGE COLUMN `diagnostico` `diagnostico` TEXT NULL  , ADD COLUMN `diagnostico_ihq` TEXT NULL DEFAULT NULL  AFTER `estudio_ihq` ;

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
INSERT INTO `lmont_biopsia`.`modulos` (`nombre`, `descripcion`, `key`) VALUES ('Informe Complementario', 'Modulo para generar Informes complementarios de Biopsias ya procesadas', 'INFORME_COMPLEMENTARIO');

INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (3, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (4, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (5, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (6, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (7, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (8, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (9, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (10, 1);
INSERT INTO `lmont_biopsia`.`usuario_modulos` (`id_modulo`, `id_usuario`) VALUES (11, 1);
