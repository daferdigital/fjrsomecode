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

ALTER TABLE `lmont_biopsia`.`biopsias` ADD COLUMN `informe_complementario` MEDIUMBLOB NULL  AFTER `ultimo_informe_impreso` ;

ALTER TABLE `lmont_biopsia`.`biopsias` ADD COLUMN `fecha_impresion_informe` DATE NULL DEFAULT NULL  AFTER `ultimo_informe_impreso` , ADD COLUMN `fecha_impresion_complementario` DATE NULL DEFAULT NULL  AFTER `informe_complementario` ;


-- 20140423
CREATE TABLE `diagnostico_maestro` (
  `id_biopsia` int(11) NOT NULL,
  `tipo_diagnostico` char(1) NOT NULL COMMENT 'campo para indicar el tipo de diagnostico asociado al registro',
  `id_firmante_1` int(11) NOT NULL,
  `id_firmante_2` int(11) default NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_biopsia`,`tipo_diagnostico`),
  KEY `FK_DIAGNOSTICO_BIOPSIA_idx` (`id_biopsia`),
  KEY `FK_DIAGNOSTICO_FIRMANTE1_idx` (`id_firmante_1`),
  KEY `FK_DIAGNOSTICO_FIRMANTE2_idx` (`id_firmante_2`),
  CONSTRAINT `FK_DIAGNOSTICO_BIOPSIA` FOREIGN KEY (`id_biopsia`) REFERENCES `biopsias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DIAGNOSTICO_FIRMANTE1` FOREIGN KEY (`id_firmante_1`) REFERENCES `patologos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DIAGNOSTICO_FIRMANTE2` FOREIGN KEY (`id_firmante_2`) REFERENCES `patologos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `diagnostico_detalle` (
  `id_biopsia` int(11) NOT NULL,
  `tipo_diagnostico` char(1) NOT NULL,
  `linea` int(11) NOT NULL,
  `seccion` varchar(45) NOT NULL,
  `texto_seccion` text,
  `imagen1_name` varchar(250) default NULL,
  `imagen1_data` mediumblob,
  `imagen2_name` varchar(250) default NULL,
  `imagen2_data` mediumblob,
  `imagen3_name` varchar(250) default NULL,
  `imagen3_data` mediumblob,
  `diagnostico_complementario` text,
  `comentario_complementario` text,
  PRIMARY KEY  (`id_biopsia`,`tipo_diagnostico`),
  KEY `FK_DIAGNOSTICO_MAESTRO_idx` (`id_biopsia`),
  CONSTRAINT `FK_DIAGNOSTICO_MAESTRO` FOREIGN KEY (`id_biopsia`, `tipo_diagnostico`) REFERENCES `diagnostico_maestro` (`id_biopsia`, `tipo_diagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

