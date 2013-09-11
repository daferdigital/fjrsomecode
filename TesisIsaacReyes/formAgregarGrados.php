<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';

include_once "includes/header.php";
?>
<tr>
	<td colspan="2" align="center">
		<form name="agregarAlumnoForm" action="formProcess/addGrado.php" method="post" onsubmit="return validarAgregarGradoForm(this);">
			<table>
				<tr>
					<td colspan="2" align="right">
						<div id="loginErrorMsg">
							<h3>
								<?php
									if(isset($_SESSION[Constants::$KEY_MESSAGE_OPERATION])){
										echo $_SESSION[Constants::$KEY_MESSAGE_OPERATION];
										unset($_SESSION[Constants::$KEY_MESSAGE_OPERATION]);
									}
								?>
							</h3>
						</div>
					</td>
				</tr>
				<tr>
					<td>Turno:</td>
					<td>
						<input type="text" name="turno" id="turno"/>
						<span class="isMandatory" id="mandatoryTurno" style="display: none;">
							<br />
							Disculpe, debe indicar el turno de este grado.
						</span>
					</td>
				</tr>
				<tr>
					<td>Grado:</td>
					<td>
						<input type="text" name="grado" id="grado"/>
						<span class="isMandatory" id="mandatoryGrado" style="display: none;">
							<br />
							Disculpe, debe indicar el grado.
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
					<td>Lugar de Nacimiento:</td>
					<td>
						<input type="text" name="lugarNacimiento" id="lugarNacimiento"/>
						<span class="isMandatory" id="mandatoryLugarNacimiento" style="display: none;">
							<br />
							Disculpe, debe indicar el lugar de nacimiento.
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
					<td>Fecha de Nacimiento:</td>
					<td>
						<input type="text" name="fechaNacimiento" id="fechaNacimiento" readonly="readonly"/>
						<input type="hidden" id="fechaNacimientoHidden" name="fechaNacimientoHidden" />
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaNacimiento",
						        targetHidden:"fechaNacimientoHidden",
						        isStripped:true,
						       	weekStartDay:0,
						        limitToToday:true,
						        dateFormat:"%d/%m/%Y",
						        dateFormatHidden:"%Y-%m-%d",
						        imgPath:"./images/"
						    });
						</script>
						<div class="isMandatory" id="mandatoryFechaNacimiento" style="display: none;">
							<br />
							Disculpe, debe indicar la fecha de nacimiento del alumno.
						</div>
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