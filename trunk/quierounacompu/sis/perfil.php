<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

PageAccess::validateAccess(Constants::$OPCION_PERFIL);

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$idUsuario = $userDTO->getId();
BitacoraDAO::registrarComentario("Acceso a perfil del usuario: ".$userDTO->getNombreCompleto());
?>

<div class="seccionTitle">
	Perfil
</div>

<div class="seccionDetail">
<?php
	if(isset($_SESSION[Constants::$KEY_MESSAGE_OPERATION])){
?>
		<h3>
			<?php 
				echo $_SESSION[Constants::$KEY_MESSAGE_OPERATION];
				unset($_SESSION[Constants::$KEY_MESSAGE_OPERATION]);
			?>
		</h3>
<?php	
	} 
?>
<form action="formProcess/storePerfil.php" method="post">
    <table class="borderCollapse">
    	<tr>
    		<td>Nombre:</td>
    		<td>
    			<input type="text" name="nombre" value="<?php echo $userDTO->getNombre();?>" />
    			<br />
				<span class="smallError" id="formNombre" style="display: none">
					Disculpe, el nombre no puede ser vacio
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Apellido:</td>
    		<td>
    			<input type="text" name="apellido" value="<?php echo $userDTO->getApellido();?>" />
    			<br />
				<span class="smallError" id="formApellido" style="display: none">
					Disculpe, el apellido no puede ser vacio
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Correo:</td>
    		<td>
    			<input type="text" name="correo" value="<?php echo $userDTO->getCorreo();?>" />
    			<br />
				<span class="smallError" id="formCorreo" style="display: none">
					Disculpe, el correo no puede ser vacio
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Clave:
    			<br />
    			(deje en blanco para <br/> mantener la clave anterior)
    		</td>
    		<td><input type="password" name="clave" maxlength="10" value="" /></td>
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
    			Registros por p&aacute;gina:
    		</td>
    		<td>
    			<select name="registrosPorPagina">
    				<?php 
    					for($i = 30; $i < 101; $i++){
					?>
						<option value="<?php echo $i;?>" <?php echo ($userDTO->getRegistrosPorPagina() == $i."") ? " selected" : "";?>>
							<?php echo $i;?>
						</option>
					<?php
						}
    				?>
    			</select> 
    		</td>
    	</tr>
    	<tr>
    		<td >&nbsp;</td>
    		<td>
    			<input type="button" value="Guardar" name="guardar" onclick="javascript:guardarPerfil(this.form);"/>
    		</td>
    	</tr>
    </table>
</form>
</div>

<?php include_once("includes/footer.php");?>