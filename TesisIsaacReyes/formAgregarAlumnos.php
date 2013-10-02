<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';

include_once "includes/header.php";
?>
<tr>
	<td colspan="2" align="center">
		<form name="agregarAlumnoForm" action="formProcess/addAlumno.php" method="post" onsubmit="return validarAgregarAlumnoForm(this);">
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
					<td>C&eacute;dula Alumno:</td>
					<td>
						<input type="text" name="cedula" id="cedula" maxlength="10" onkeypress="return textInputOnlyNumbers(event)"/>
						<span class="isMandatory" id="mandatoryCedula" style="display: none;">
							<br />
							Disculpe, debe indicar la c&eacute;dula del Alumno.
						</span>
					</td>
				</tr>
				<tr>
					<td>Sexo:</td>
					<td>
						<input type="radio" name="sexo" id="sexo_f" value="f"/> Femenino
						<input type="radio" name="sexo" id="sexo_m" value="m"/> Masculino
						<span class="isMandatory" id="mandatorySexo" style="display: none;">
							<br />
							Disculpe, debe indicar el sexo del Alumno.
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
					<td>Grado:</td>
					<td>
						<select name="grado" id="grado">
							<option value="">Seleccione</option>
							<?php
								$query = "SELECT g.id AS idGrado, g.turno, g.grado, g.id_profesor, p.nombre, p.apellido, p.cedula";
								$query .= " FROM grados g, profesores p";
								$query .= " WHERE g.id_profesor = p.id ";
								$query .= " ORDER BY g.grado, g.turno, p.nombre, p.apellido, p.cedula";

								$results = DBUtil::executeSelect($query);
								foreach ($results AS $row){
							?>
								<option value="<?php $row["id"];?>">
									<?php echo $row["grado"]." (".$row["turno"].") Prof: ".$row["nombre"]." ".$row["apellido"];?>
								</option>
							<?php
								}
							?>
						</select>
						<span class="isMandatory" id="mandatoryGrado" style="display: none;">
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
					<td>Nombre Representante</td>
					<td>
						<input type="text" name="representante" id="representante" />
						<div class="isMandatory" id="mandatoryRepresentante" style="display: none;">
							<br />
							Disculpe, debe indicar el nombre del Representante.
						</div>
					</td>
				</tr>
				<tr>
					<td>C&eacute;dula Representante:</td>
					<td>
						<select name="ci">
					        <option value="V">V</option>
					        <option value="E">E</option>
		      			</select>
						<input type="text" name="cedulaR" id="cedulaR" maxlength="10" onkeypress="return textInputOnlyNumbers(event)"/>
						<span class="isMandatory" id="mandatoryCedulaRepresentante" style="display: none;">
							<br />
							Disculpe, debe indicar la c&eacute;dula del Representante.
						</span>
					</td>
				</tr>
				<tr>
					<td>Literal:</td>
					<td>
						<textarea rows="6" cols="30" name="literal" id="literal"></textarea>
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