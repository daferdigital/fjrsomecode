<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../includes/session.php';

//a esta pagina se llega desde modificar usuario o reactivar usuario
if(isset($_POST[Constants::$KEY_MODULE_TO_REDIRECT])){
	//tenemos la informacion de a donde debemos regresar despues de esto
	//verificamos el permiso asociado
	
	if($_POST[Constants::$KEY_MODULE_TO_REDIRECT] == Constants::$OPCION_ADMIN_MODIFICAR_USUARIO){
		PageAccess::validateAccess(Constants::$OPCION_ADMIN_MODIFICAR_USUARIO);
		BitacoraDAO::registrarComentario("Acceso autorizado al ajax de modificar usuario");
	} else if($_POST[Constants::$KEY_MODULE_TO_REDIRECT] == Constants::$OPCION_ADMIN_REACTIVAR_USUARIO){
		PageAccess::validateAccess(Constants::$OPCION_ADMIN_REACTIVAR_USUARIO);
		BitacoraDAO::registrarComentario("Acceso autorizado al ajax de reactivar usuario");
	} else {
		//opcion de acceso no conocida
		$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_UNKNOWN_ACCESS;
		BitacoraDAO::registrarComentario("Opcion de acceso [".$_POST[Constants::$KEY_MODULE_TO_REDIRECT]
				."] no conocida en la pagina ajax/getUsuarioForm.php");
		
		header("Location: ../index.php");
	}
} else {
	//opcion de acceso no indicada
	$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_UNKNOWN_ACCESS;
	BitacoraDAO::registrarComentario("Opcion de acceso no indicada al accesar a la pagina ajax/getUsuarioForm.php");
	
	header("Location: ../index.php");
}

if($_POST["usrId"] == "-1"){
	die();
}

$userDTO = UsuarioDAO::getUserDTO($_POST["usrId"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
	<form action="formProcess/updateUser.php" method="post">
		<input type="hidden" name="usrId" value="<?php echo $userDTO->getId();?>"/>
		<input type="hidden" name="<?php echo Constants::$KEY_MODULE_TO_REDIRECT;?>" value="<?php echo $_POST[Constants::$KEY_MODULE_TO_REDIRECT];?>"/>
		
	    <table class="borderCollapse">
	    	<tr>
	    		<td>Nombre:</td>
	    		<td>
	    			<input type="text" name="nombre" value="<?php echo $userDTO->getNombre()?>" />
	    			<br />
					<span class="smallError" id="formNombre" style="display: none">
						Disculpe, el nombre no puede ser vacio
					</span>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>Apellido:</td>
	    		<td>
	    			<input type="text" name="apellido" value="<?php echo $userDTO->getApellido()?>" />
	    			<br />
					<span class="smallError" id="formApellido" style="display: none">
						Disculpe, el apellido no puede ser vacio
					</span>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>Correo:</td>
	    		<td>
	    			<input type="text" name="correo" value="<?php echo $userDTO->getCorreo()?>" />
	    			<br />
					<span class="smallError" id="formCorreo" style="display: none">
						Disculpe, el correo no puede ser vacio
					</span>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			Login:
	    		</td>
	    		<td>
	    			<input type="text" name="login" maxlength="20" value="<?php echo $userDTO->getLogin()?>" />
	    			<br />
					<span class="smallError" id="formLogin" style="display: none">
						Disculpe, debe indicar un login
					</span>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			Clave:
	    			<br />
	    			(dejar en blanco para mantener la anterior)
	    		</td>
	    		<td>
	    			<input type="password" name="clave" maxlength="20" value="" />
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			Tiempo de Sesi&oacute;n:
	    			<br />
	    			(minutos)
	    		</td>
	    		<td>
	    			<select name="tiempoSesion">
	    				<?php 
	    					for($i = 10; $i < 61; $i++){
						?>
							<option value="<?php echo $i;?>" <?php echo ($userDTO->getTiempoSesion() == $i."") ? " selected" : "";?>>
								<?php echo $i;?>
							</option>
						<?php
							}
	    				?>
	    			</select> 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			Cuenta activa?
	    		</td>
	    		<td>
	    			<input type="radio" name="active" value="1" <?php echo ($userDTO->getActive() == "1") ? " checked" : ""?>/> S&iacute;
	    			<input type="radio" name="active" value="0" <?php echo ($userDTO->getActive() != "1") ? " checked" : ""?>/> No
	    		</td>
	    	</tr>
	    	<tr>
	    		<td >&nbsp;</td>
	    		<td>
	    			<input type="button" value="Guardar" name="guardar" onclick="javascript:modificarUsuario(this.form);"/>
	    		</td>
	    	</tr>
	    </table>
</form>
</body>
</html>