<?php
include_once 'classes/SessionUtil.php';
include_once 'classes/DBUtil.php';
include_once 'classes/Constants.php';
include_once "includes/header.php";

if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: index.php");
}
?>
<tr>
	<td colspan="2" align="center">
		<form name="agregarPersonalForm" action="formProcess/addPersonal.php" method="post" onsubmit="return validarAgregarPersonalForm(this);">
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
						<input type="text" name="nombre" id="nombre"/>
						<span class="isMandatory" id="mandatoryNombre" style="display: none;">
							<br />
							Disculpe, debe indicar el nombre.
						</span>
					</td>
				</tr>
				<tr>
					<td>Apellido:</td>
					<td>
						<input type="text" name="apellido" id="apellido"/>
						<span class="isMandatory" id="mandatoryApellido" style="display: none;">
							<br />
							Disculpe, debe indicar el apellido.
						</span>
					</td>
				</tr>
				<tr>
					<td>C&eacute;dula:</td>
					<td>
						<select style="FONT-SIZE: 10pt" size="1" name="ci">
					        <option value="V" selected>V</option>
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
					<td>Turno:</td>
					<td>
						<input type="text" name="turno" id="turno" />
						<span class="isMandatory" id="mandatoryTurno" style="display: none;">
							<br />
							Disculpe, debe indicar el turno.
						</span>
					</td>
				</tr>
				<tr>
					<td>Ubicaci&oacute;n:</td>
					<td>
						<input type="text" name="ubicacion" id="ubicacion" />
						<span class="isMandatory" id="mandatoryUbicacion" style="display: none;">
							<br />
							Disculpe, debe indicar la ubicaci&oacute;n.
						</span>
					</td>
				</tr>
				<tr>
					<td>Fecha de Ingreso:</td>
					<td>
						<input type="text" name="fechaIngreso" id="fechaIngreso" readonly="readonly"/>
						<input type="hidden" id="fechaIngresoHidden" name="fechaIngresoHidden" />
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaIngreso",
						        targetHidden:"fechaIngresoHidden",
						        isStripped:true,
						       	weekStartDay:0,
						        limitToToday:false,
						        dateFormat:"%d/%m/%Y",
						        dateFormatHidden:"%Y-%m-%d",
						        imgPath:"./images/"
						    });
						</script>
						<span class="isMandatory" id="mandatoryFechaIngreso" style="display: none;">
							<br />
							Disculpe, debe indicar la fecha de ingreso.
						</span>
					</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono:</td>
					<td>
						<input type="text" name="telefono" id="telefono" onkeypress="return textInputOnlyNumbers(event)"/>
						<span class="isMandatory" id="mandatoryTelefono" style="display: none;">
							<br />
							Disculpe, debe indicar el n&uacute;mero de tel&eacute;fono.
						</span>
					</td>
				</tr>
				<tr>
					<td>Cargo:</td>
					<td>
						<select>
							<option value="">- -</option>
							<?php 
							$query = "SELECT id, nombre FROM cargo ORDER BY nombre";
							$result = DBUtil::executeSelect($query);
							foreach ($result as $cargo) {
							?>
								<option value="<?php echo $cargo["id"];?>"><?php echo $cargo["nombre"];?></option>
							<?php
							}
							?>
						</select>
						<span class="isMandatory" id="mandatoryCargo" style="display: none;">
							<br />
							Disculpe, debe indicar el cargo.
						</span>
					</td>
				</tr>
				<tr>
					<td>Supervisor:</td>
					<td>
						<select>
							<option value="">- -</option>
							<?php 
							$query = "SELECT id, nombre, apellido FROM personal WHERE cargo=3 ORDER BY nombre";
							$result = DBUtil::executeSelect($query);
							foreach ($result as $supervisor) {
							?>
								<option value="<?php echo $supervisor["id"];?>"><?php echo $supervisor["nombre"]." ".$supervisor["apellido"];?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Guardar" />
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<?php
include_once "includes/footer.html";
?>