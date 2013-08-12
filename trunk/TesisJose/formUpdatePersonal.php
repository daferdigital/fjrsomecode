<?php
include_once 'classes/Constants.php';
include_once 'classes/SessionUtil.php';
include_once 'classes/DBUtil.php';
include_once "includes/header.php";

if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: index.php");
	return;
}
if(SessionUtil::userReachInactivity()){
	header("Location: index.php");
	return;
}

$idPersonal = $_GET["id"];
$query = "SELECT * FROM personal WHERE id = ".$idPersonal." AND activo='1'";
$resultado = DBUtil::executeSelect($query);

if(count($resultado) <= 0){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_ID_DONT_EXISTS;
	header("Location: formListarPersonal.php");
	return;
}

$resultado = $resultado[0];
?>
<tr>
	<td colspan="2" align="center">
		<form name="updatePersonalForm" action="formProcess/updatePersonal.php" method="post" onsubmit="return validarAgregarPersonalForm(this);">
			<input type="hidden" name="id" value="<?php echo $resultado["id"];?>"/>
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
						<input type="text" name="nombre" id="nombre" value="<?php echo $resultado["nombre"];?>" />
						<span class="isMandatory" id="mandatoryNombre" style="display: none;">
							<br />
							Disculpe, debe indicar el nombre.
						</span>
					</td>
				</tr>
				<tr>
					<td>Apellido:</td>
					<td>
						<input type="text" name="apellido" id="apellido" value="<?php echo $resultado["apellido"];?>"/>
						<span class="isMandatory" id="mandatoryApellido" style="display: none;">
							<br />
							Disculpe, debe indicar el apellido.
						</span>
					</td>
				</tr>
				<tr>
					<td>C&eacute;dula:</td>
					<td>
						<?php 
							$cedula = explode("-", $resultado["cedula"]);
						?>
						<select name="ci">
					        <option value="V" <?php echo ($cedula[0] == "V" ? "selected" : "")?>>V</option>
					        <option value="E" <?php echo ($cedula[0] == "E" ? "selected" : "")?>>E</option>
		      			</select>
						<input type="text" name="cedula" id="cedula" maxlength="10" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $cedula[1];?>"/>
						<span class="isMandatory" id="mandatoryCedula" style="display: none;">
							<br />
							Disculpe, debe indicar la c&eacute;dula.
						</span>
					</td>
				</tr>
				<tr>
					<td>Direcci&oacute;n:</td>
					<td>
						<textarea rows="6" cols="30" id="direccion" name="direccion"><?php echo $resultado["direccion"];?></textarea>
						<span class="isMandatory" id="mandatoryDireccion" style="display: none;">
							<br />
							Disculpe, debe indicar la direcci&oacute;n.
						</span>
					</td>
				</tr>
				<tr>
					<td>Turno:</td>
					<td>
						<input type="text" name="turno" id="turno" value="<?php echo $resultado["turno"];?>"/>
						<span class="isMandatory" id="mandatoryTurno" style="display: none;">
							<br />
							Disculpe, debe indicar el turno.
						</span>
					</td>
				</tr>
				<tr>
					<td>Ubicaci&oacute;n:</td>
					<td>
						<input type="text" name="ubicacion" id="ubicacion" value="<?php echo $resultado["ubicacion"];?>"/>
						<span class="isMandatory" id="mandatoryUbicacion" style="display: none;">
							<br />
							Disculpe, debe indicar la ubicaci&oacute;n.
						</span>
					</td>
				</tr>
				<tr>
					<td>Fecha de Ingreso:</td>
					<td>
						<?php
							$fecha = strtotime($resultado["fecha_ingreso"]);
							$fecha = date("d/m/Y", $fecha);
						?>
						<input type="text" name="fechaIngreso" id="fechaIngreso" readonly="readonly" value="<?php echo $fecha;?>"/>
						<input type="hidden" id="fechaIngresoHidden" name="fechaIngresoHidden" value="<?php echo $resultado["fecha_ingreso"]?>"/>
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
						<div class="isMandatory" id="mandatoryFechaIngreso" style="display: none;">
							<br />
							Disculpe, debe indicar la fecha de ingreso.
						</div>
					</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono:</td>
					<td>
						<input type="text" name="telefono" id="telefono" onkeypress="return textInputOnlyNumbers(event)" maxlength="11" value="<?php echo $resultado["telefono"];?>"/>
						<span class="isMandatory" id="mandatoryTelefono" style="display: none;">
							<br />
							Disculpe, debe indicar el n&uacute;mero de tel&eacute;fono.
						</span>
					</td>
				</tr>
				<tr>
					<td>Cargo:</td>
					<td>
						<select id="cargo" name="cargo">
							<option value="">- -</option>
							<?php 
							$query = "SELECT id, nombre FROM cargo ORDER BY nombre";
							$result = DBUtil::executeSelect($query);
							foreach ($result as $cargo) {
							?>
								<option value="<?php echo $cargo["id"];?>" <?php echo ($cargo["id"] == $resultado["id_cargo"] ? " selected" : "")?>><?php echo $cargo["nombre"];?></option>
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
						<select name="supervisor">
							<option value="">- -</option>
							<?php 
							$query = "SELECT id, nombre, apellido FROM personal WHERE id_cargo=3 ORDER BY nombre";
							$result = DBUtil::executeSelect($query);
							foreach ($result as $supervisor) {
							?>
								<option value="<?php echo $supervisor["id"];?>" <?php echo ($supervisor["id"] == $resultado["id_supervisor"] ? " selected" : "")?>><?php echo $supervisor["nombre"]." ".$supervisor["apellido"];?></option>
							<?php
							}
							?>
						</select>
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