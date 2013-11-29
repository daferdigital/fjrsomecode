<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';

include_once "includes/header.php";

//obtenemos el registro
$query = "SELECT g.turno, g.grado, g.descripcion, g.id_profesor";
$query .= " FROM grados g";
$query .= " WHERE g.id=".$_GET["id"];

$grado = DBUtil::executeSelect($query);
if(count($grado) < 1){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "La informaci&oacute;n solicitada no pudo ser localizada.";
	header("Location: formListarGrados.php");
} else {
	$grado = $grado[0];
}
?>
<tr>
	<td colspan="2" align="center">
		<form name="agregarAlumnoForm" action="formProcess/updateGrado.php" method="post" onsubmit="return validarAgregarGradoForm(this);">
			<input type="hidden" name="id" value="<?php echo $_GET["id"];?>" />
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
					<td>Profesor Encargado:</td>
					<td>
						<select name="profesor" id="profesor">
							<option value="0">Seleccione</option>
							<?php
								$query = "SELECT id, nombre, apellido, cedula";
								$query .= " FROM profesores";
								$query .= " ORDER BY nombre, apellido";
								
								$results = DBUtil::executeSelect($query);
								foreach ($results AS $row){
							?>
									<option value="<?php echo $row["id"];?>" <?php echo $grado["id_profesor"] == $row["id"] ? " selected " : "";?>>
										<?php echo $row["nombre"]." ".$row["apellido"]." (".$row["cedula"].")";?>
									</option>
							<?php
								}
							?>
						</select>
						<span class="isMandatory" id="mandatoryProfesor" style="display: none;">
							<br />
							Disculpe, debe indicar el profesor encargado de este turno.
						</span>
					</td>
				</tr>
				<tr>
					<td>Turno:</td>
					<td>
						<input type="text" name="turno" id="turno" value="<?php echo htmlentities($grado["turno"]);?>"/>
						<span class="isMandatory" id="mandatoryTurno" style="display: none;">
							<br />
							Disculpe, debe indicar el turno de este grado.
						</span>
					</td>
				</tr>
				<tr>
					<td>Grado:</td>
					<td>
						<input type="text" name="grado" id="grado" value="<?php echo htmlentities($grado["grado"]);?>"/>
						<span class="isMandatory" id="mandatoryGrado" style="display: none;">
							<br />
							Disculpe, debe indicar el grado.
						</span>
					</td>
				</tr>
				<tr>
					<td>Descripci&oacute;n:</td>
					<td>
						<textarea rows="5" id="descripcion" name="descripcion"><?php echo $grado["descripcion"];?></textarea>
						<span class="isMandatory" id="mandatoryDescripcion" style="display: none;">
							<br />
							Disculpe, debe indicar una descripci&oacute;n.
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