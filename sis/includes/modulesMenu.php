<?php
	include_once 'classes/Constants.php';
	include_once 'classes/EnvioDAO.php';
	include_once 'classes/PageAccess.php';
	
	if(! PageAccess::userIsLogged()){
		header("Location: ../index.php");
	}
	
	$usuarioDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	$modulesAllowed = $usuarioDTO->getModulesAllowed();
?>
<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
<ul>
<?php
	if($usuarioDTO->canAccessCategoryModule(Constants::$CATEGORIA_BUSQUEDA)){
?>
		<li>
			<a href="#" class="MenuBarItemSubmenu">B&uacute;squeda</a>
			<ul>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_NOTIFICADOS])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
							Notificados
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_PAGOS_CONFIRMADOS])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO;?>">
							Pagos Confirmados
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_PAGOS_NO_ENCONTRADOS])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO;?>">
							Pagos No Encontrados
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_PRESUPUESTADO])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_PRESUPUESTADO;?>">
							Presupuestados
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_FACTURADO])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_FACTURADO;?>">
							Facturados
						</a>
					</li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_BUSQUEDA][Constants::$OPCION_BUSQUEDA_ENVIADO])){
			?>
					<li>
						<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_ENVIADO;?>">
							Enviados
						</a>
					</li>
			<?php
				}
			?>
			</ul>
		</li>
<?php	
	} 
?>

<?php
	if(isset($modulesAllowed[Constants::$OPCION_BUSQUEDA_AVANZADA])){
?>
		<li>
			<a href="searchEnviosAvanzado.php">B&uacute;squeda Avanzada</a>
		</li>
<?php
	}
?>
<?php
	if($usuarioDTO->canAccessCategoryModule(Constants::$CATEGORIA_ADMINISTRACION)){
?>
		<li>
			<a href="#">Administraci&oacute;n</a>
			<ul>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_ADMINISTRACION][Constants::$OPCION_ADMIN_CREAR_USUARIO])){
			?>
					<li><a href="crearUsuario.php">Crear Usuario</a></li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_ADMINISTRACION][Constants::$OPCION_ADMIN_MODIFICAR_USUARIO])){
			?>
					<li><a href="modificarUsuario.php">Modificar Usuario</a></li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_ADMINISTRACION][Constants::$OPCION_ADMIN_REACTIVAR_USUARIO])){
			?>
					<li><a href="reactivarUsuario.php">Reactivar Usuario</a></li>
			<?php
				}
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_ADMINISTRACION][Constants::$OPCION_ADMIN_PERMISOS])){
			?>
					<li><a href="permisos.php">Permisos</a></li>
			<?php
				}
			?>
			</ul>
		</li>
<?php
	}
?>

<?php
	if($usuarioDTO->canAccessCategoryModule(Constants::$CATEGORIA_LOGS)){
?>
		<li>
			<a href="#">Logs</a>
			<ul>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_LOGS][Constants::$OPCION_LOGS_TRANSACCIONES])){
			?>
					<li><a href="logTransacciones.php">Transacciones</a></li>
			<?php
				} 
			?>
			<?php
				if(isset($modulesAllowed[Constants::$CATEGORIA_LOGS][Constants::$OPCION_LOGS_SISTEMA])){
			?>
					<li><a href="logSistema.php">Sistema</a></li>
			<?php
				} 
			?>
			</ul>
		</li>
<?php
	}
?>

<?php
	if(isset($modulesAllowed[Constants::$OPCION_PERFIL])){
?>
		<li>
			<a href="perfil.php">Perfil</a>
		</li>
<?php
	}
?>
</ul>
<br style="clear: right;" />
</div>
