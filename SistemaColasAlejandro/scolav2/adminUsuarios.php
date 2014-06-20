<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("classes/DBUtil.php");
include_once("includes/header.php");
?>

<div class="seccionTitle">
	Crear Usuarios
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
					Disculpe, el nombre no puede ser vac&iacute;o
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Apellido:</td>
    		<td>
    			<input type="text" name="apellido" value="" />
    			<br />
				<span class="smallError" id="formApellido" style="display: none">
					Disculpe, el apellido no puede ser vac&iacute;o
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Correo:</td>
    		<td>
    			<input type="text" name="correo" value="" />
    			<br />
				<span class="smallError" id="formCorreo" style="display: none">
					Disculpe, el formato del correo no es v&aacute;lido
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>C&eacute;dula :</td>
    		<td>
    			<input type="text" name="cedula" value="" />
    			<br />
				<span class="smallError" id="formCedula" style="display: none">
					Disculpe, el valor de c&eacute;dula es obligatorio
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
    			Tipo de Usuario
    		</td>
    		<td>
    			<select name="tipoUsuario">
    				<option value="0"> -- </option>
    				<?php
    					$query = "SELECT * FROM tipo_usuario ORDER BY nombre";
    					$rows = DBUtil::executeSelect($query);
    					foreach ($rows as $row) {
    				?>
    						<option value="<?php echo $row["id"];?>"><?php echo $row["nombre"];?></option>
    				<?php
    					}
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formTipoUsuario" style="display: none">
					Disculpe, debe indicar el Tipo de Usuario
				</span>
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