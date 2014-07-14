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
		if(Constants::$TIPO_USUARIO_TERMINAL == $usuarioDTO->getTipoUsuario()){
	?>
			<li>
				<a href="terminal.php">Mostrar Terminal</a>
			</li>
	<?php
		}
	?>
	<?php
		if(Constants::$TIPO_USUARIO_OPERADOR == $usuarioDTO->getTipoUsuario()){
	?>
			<li>
				<a href="operador.php">Taquillas</a>
			</li>
	<?php
		}
	?>
	<?php
		if(Constants::$TIPO_USUARIO_ADMIN == $usuarioDTO->getTipoUsuario()){
	?>
			<li>
				<a href="#">Usuarios</a>
				<ul>
					<li>
						<a href="createUsuarios.php">Crear Usuarios</a>
					</li>
					<li>
						<a href="adminUsuarios.php">Actualizar Usuarios</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Unidades</a>
				<ul>
					<li>
						<a href="createUnidades.php">Crear Unidades</a>
					</li>
					<li>
						<a href="adminUnidades.php">Actualizar Unidades</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Sub Unidades</a>
				<ul>
					<li>
						<a href="createSubUnidades.php">Crear Sub-Unidades</a>
					</li>
					<li>
						<a href="adminSubUnidades.php">Actualizar Sub-Unidades</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Taquillas</a>
				<ul>
					<li>
						<a href="createTaquillas.php">Crear Taquillas</a>
					</li>
					<li>
						<a href="adminTaquillas.php">Actualizar Taquillas</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="tips.php">Tips</a>
			</li>
			<li>
				<a href="videos.php">Videos</a>
			</li>
			<li>
				<a href="reportes.php">Reportes</a>
			</li>
	<?php
		}
	?>
</ul>
<br style="clear: right;" />
</div>
