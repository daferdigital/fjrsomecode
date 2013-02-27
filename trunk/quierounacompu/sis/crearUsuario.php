<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

PageAccess::validateAccess(Constants::$OPCION_ADMIN_CREAR_USUARIO);

BitacoraDAO::registrarComentario("Acceso a pagina para crear usuarios");
?>

<div class="seccionTitle">
	Crear Usuarios
	<br />
	<span>
		(Agregue aqu&iacute; cuentas de usuario en el sistema)
	</span>
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
<form action="formProcess/storeUser.php" method="post">
    <table class="borderCollapse">
    	<tr>
    		<td>Nombre:</td>
    		<td>
    			<input type="text" name="nombre" value="" />
    			<br />
				<span class="smallError" id="formNombre" style="display: none">
					Disculpe, el nombre no puede ser vacio
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Apellido:</td>
    		<td>
    			<input type="text" name="apellido" value="" />
    			<br />
				<span class="smallError" id="formApellido" style="display: none">
					Disculpe, el apellido no puede ser vacio
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Correo:</td>
    		<td>
    			<input type="text" name="correo" value="" />
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
    			<input type="text" name="login" maxlength="10" value="" />
    			<br />
				<span class="smallError" id="formLogin" style="display: none">
					Disculpe, debe indicar un login
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Clave:
    		</td>
    		<td>
    			<input type="password" name="clave" maxlength="10" value="" />
    			<br />
				<span class="smallError" id="formClave" style="display: none">
					Disculpe, la clave no puede ser vacia
				</span>
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
						<option value="<?php echo $i;?>">
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
    			<input type="button" value="Guardar" name="guardar" onclick="javascript:guardarUsuario(this.form);"/>
    		</td>
    	</tr>
    </table>
</form>
</div>

<?php include_once("includes/footer.php");?>