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

$idSolicitud = $_GET["id"];
$query = "SELECT * FROM solicitud WHERE id = ".$idSolicitud." AND activo='1'";
$solicitudInfo = DBUtil::executeSelect($query);

if(count($solicitudInfo) <= 0){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_ID_DONT_EXISTS;
	header("Location: formListarSolicitudes.php");
	return;
}

$solicitudInfo = $solicitudInfo[0];
?>
<tr>
	<td colspan="2" align="center">
		<form name="updateSolicitudForm" action="formProcess/updateSolicitud.php" method="post" onsubmit="return validarAgregarSolicitudForm(this);">
			<input type="hidden" name="id" value="<?php echo $solicitudInfo["id"];?>"/>
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
					<td>Funcionario:</td>
					<td>
						<select name="funcionario" id="funcionario">
							<option value="">- -</option>
							<?php
								$query = "SELECT id, nombre, apellido, cedula FROM personal WHERE activo='1' ORDER BY nombre, apellido";
								$resultado = DBUtil::executeSelect($query);
								foreach ($resultado as $funcionario){
							?>
								<option value="<?php echo $funcionario["id"]?>" <?php echo ($funcionario["id"] == $solicitudInfo["id_personal"] ? " selected" : "");?>><?php echo $funcionario["cedula"]." (".$funcionario["nombre"]." ".$funcionario["apellido"].")";?></option>
							<?php
								} 
							?>
						</select>
						<span class="isMandatory" id="mandatoryFuncionario" style="display: none;">
							<br />
							Disculpe, debe indicar a que funcionario le ser&aacute; generado el permiso o vacaci&oacute;n.
						</span>
					</td>
				</tr>
				<tr>
					<td>Tipo de Solicitud:</td>
					<td>
						<select id="tipoSolicitud" name="tipoSolicitud">
							<option value="">- -</option>
							<?php
								$query = "SELECT id, nombre FROM permiso ORDER BY nombre";
								$resultado = DBUtil::executeSelect($query);
								foreach ($resultado as $tipoPermiso){
							?>
								<option value="<?php echo $tipoPermiso["id"]?>" <?php echo ($tipoPermiso["id"] == $solicitudInfo["id_tipo_permiso"] ? " selected" : "");?>><?php echo $tipoPermiso["nombre"];?></option>
							<?php
								} 
							?>
						</select>
						<span class="isMandatory" id="mandatoryTipoSolicitud" style="display: none;">
							<br />
							Disculpe, debe indicar el tipo de permiso que desea gestionar o asignar.
						</span>
					</td>
				</tr>
				<tr>
					<td>Fecha de Salida:</td>
					<td>
						<?php
							$fecha = strtotime($solicitudInfo["fecha_inicio"]);
							$fecha = date("d/m/Y", $fecha);
						?>
						<input type="text" name="fechaSalida" id="fechaSalida" readonly="readonly" value="<?php echo $fecha;?>"/>
						<input type="hidden" id="fechaSalidaHidden" name="fechaSalidaHidden" value="<?php echo $solicitudInfo["fecha_inicio"]?>"/>
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaSalida",
						        targetHidden:"fechaSalidaHidden",
						        isStripped:true,
						       	weekStartDay:0,
						        limitToToday:false,
						        dateFormat:"%d/%m/%Y",
						        dateFormatHidden:"%Y-%m-%d",
						        imgPath:"./images/"
						    });
						</script>
						<div class="isMandatory" id="mandatoryFechaSalida" style="display: none;">
							<br />
							Disculpe, debe indicar la fecha de salida para este permiso.
						</div>
					</td>
				</tr>
				<tr>
					<td>Fecha de Llegada:</td>
					<td>
						<?php
							$fecha = strtotime($solicitudInfo["fecha_fin"]);
							$fecha = date("d/m/Y", $fecha);
						?>
						<input type="text" name="fechaLlegada" id="fechaLlegada" readonly="readonly" value="<?php echo $fecha;?>"/>
						<input type="hidden" id="fechaLlegadaHidden" name="fechaLlegadaHidden" value="<?php echo $solicitudInfo["fecha_fin"]?>"/>
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaLlegada",
						        targetHidden:"fechaLlegadaHidden",
						        isStripped:true,
						       	weekStartDay:0,
						        limitToToday:false,
						        dateFormat:"%d/%m/%Y",
						        dateFormatHidden:"%Y-%m-%d",
						        imgPath:"./images/"
						    });
						</script>
						<div class="isMandatory" id="mandatoryFechaLlegada" style="display: none;">
							<br />
							Disculpe, debe indicar la fecha de llegada para este permiso.
						</div>
						<div class="isMandatory" id="mandatoryFechaRango" style="display: none;">
							<br />
							Disculpe, la fecha de salida no puede ser mayor a la de llegada.
						</div>
					</td>
				</tr>
				<tr>
					<td>Comentario:</td>
					<td>
						<textarea rows="6" cols="30" id="comentario" name="comentario"><?php echo $solicitudInfo["comentario"]?></textarea>
						<span class="isMandatory" id="mandatoryComentario" style="display: none;">
							<br />
							Disculpe, debe indicar una breve descripci&oacute;n o comentario para este permiso.
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