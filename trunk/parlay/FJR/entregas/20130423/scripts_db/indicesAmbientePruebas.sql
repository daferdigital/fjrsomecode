ALTER TABLE `categorias_apuestas_combinaciones` 
ADD INDEX `idx_categoria_apuesta` (`idcategoria_apuesta` ASC) 
, ADD INDEX `idx_categoria_apuesta_combinar` (`idcategoria_apuesta_combinar` ASC) ;

ALTER TABLE `logros` 
ADD INDEX `idx_administrador` (`idadministrador` ASC) 
, ADD INDEX `idx_administrador_actualiza` (`idadministrador_actualiza` ASC) ;

ALTER TABLE `logros_equipos_categorias_apuestas_banqueros` 
ADD INDEX `idx_logro_equipo_categoria_apuesta` (`idlogro_equipo_categoria_apuesta` ASC) ;

ALTER TABLE `logros_equipos_categorias_apuestas_banqueros_aciertos` 
ADD INDEX `idx_logro_equipo_categoria_apuesta_banquero` (`idlogro_equipo_categoria_apuesta_banquero` ASC) ;

ALTER TABLE `logros_hora_varchar` 
ADD INDEX `idx_administrador` (`idadministrador` ASC) ;

ALTER TABLE `perfil_accesos` 
ADD INDEX `idx_perfil_programa` (`id_perfil_programa` ASC) 
, ADD INDEX `idx_usuario` (`idusuario` ASC) 
, ADD INDEX `idx_perfil` (`id_perfil` ASC) ;

ALTER TABLE `perfil_programas` 
ADD INDEX `idx_perfil_padre` (`id_perfil_padre` ASC) ;

ALTER TABLE `perfiles_modulos` 
ADD INDEX `idx_perfil` (`idperfil` ASC) 
, ADD INDEX `idx_modulo` (`idmodulo` ASC) ;

ALTER TABLE `usuario` 
ADD INDEX `idx_perfil` (`idperfil` ASC) ;

ALTER TABLE `ventas_detalles` 
ADD INDEX `idx_logro_equipo_categoria_apuesta_banquero` (`idlogro_equipo_categoria_apuesta_banquero` ASC) ;

