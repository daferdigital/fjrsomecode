<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';

include_once "includes/header.php";
?>
<tr>
	<td colspan="2" align="center">
		<form name="agregarAlumnoForm" action="formProcess/addProfesor.php" method="post" onsubmit="return validarAgregarProfesorForm(this);">
			<table>
				<tr>
					<td colspan="2" align="right">
						<div id="loginErrorMsg">
							<?php
								if(isset($_SESSION[Constants::$KEY_MESSAGE_OPERATION])){
							?>
									<h3><?php echo $_SESSION[Constants::$KEY_MESSAGE_OPERATION];?></h3>
							<?php
									unset($_SESSION[Constants::$KEY_MESSAGE_OPERATION]);
								}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td>
						<input type="text" name="nombre" id="nombre" onkeypress="return textInputOnlyLetters(event);"/>
						<span class="isMandatory" id="mandatoryNombre" style="display: none;">
							<br />
							Disculpe, debe indicar el nombre.
						</span>
					</td>
				</tr>
				<tr>
					<td>Apellido:</td>
					<td>
						<input type="text" name="apellido" id="apellido" onkeypress="return textInputOnlyLetters(event);"/>
						<span class="isMandatory" id="mandatoryApellido" style="display: none;">
							<br />
							Disculpe, debe indicar el apellido.
						</span>
					</td>
				</tr>
				<tr>
					<td>C&eacute;dula:</td>
					<td>
						<select name="ci">
					        <option value="V">V</option>
					        <option value="E">E</option>
		      			</select>
						<input type="text" name="cedula" id="cedula" maxlength="10" onkeypress="return textInputOnlyNumbers(event)"/>
						<span class="isMandatory" id="mandatoryCedula" style="display: none;">
							<br />
							Disculpe, debe indicar la c&eacute;dula.
						</span>
					</td>
				</tr>
				<tr>
					<td>Direcci&oacute;n:</td>
					<td>
						<textarea rows="6" cols="30" id="direccion" name="direccion"></textarea>
						<span class="isMandatory" id="mandatoryDireccion" style="display: none;">
							<br />
							Disculpe, debe indicar la direcci&oacute;n.
						</span>
					</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono:</td>
					<td>
						<input type="text" name="telefono" id="telefono" onkeypress="return textInputOnlyNumbers(event)"/>
						<span class="isMandatory" id="mandatoryTelefono" style="display: none;">
							<br />
							Disculpe, debe indicar el Tel&eacute;fono.
						</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Guardar" name="botonSubmit"/>
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<?php
include_once "includes/footer.html";
?>