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
									<option value="<?php echo $row["id"];?>">
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
					<td>Descripci&oacute;n:</td>
					<td>
						<textarea rows="5" id="descripcion" name="descripcion"></textarea>
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