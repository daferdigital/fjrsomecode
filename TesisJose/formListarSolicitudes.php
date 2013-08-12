<?php
include_once 'classes/Constants.php';
include_once 'classes/SessionUtil.php';
include_once 'classes/DBUtil.php';
include_once 'classes/UsuarioDTO.php';
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
?>
<tr>
	<td colspan="2" align="center">
		<form action="" method="post" enctype="application/x-www-form-urlencoded">
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
					<td>Funcionario: </td>
					<td>
						<select name="funcionario" id="funcionario">
							<option value="">- -</option>
							<?php
								$query = "SELECT id, nombre, apellido, cedula FROM personal WHERE activo='1' ORDER BY nombre, apellido";
								$resultado = DBUtil::executeSelect($query);
								foreach ($resultado as $funcionario){
							?>
								<option value="<?php echo $funcionario["id"]?>"><?php echo $funcionario["cedula"]." (".$funcionario["nombre"]." ".$funcionario["apellido"].")";?></option>
							<?php
								} 
							?>
						</select>
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
								<option value="<?php echo $tipoPermiso["id"]?>"><?php echo $tipoPermiso["nombre"];?></option>
							<?php
								} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Fecha de Salida:</td>
					<td>
						<input type="text" name="fechaSalida" id="fechaSalida" readonly="readonly"/>
						<input type="hidden" id="fechaSalidaHidden" name="fechaSalidaHidden" />
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
					</td>
				</tr>
				<tr>
					<td>Fecha de Llegada:</td>
					<td>
						<input type="text" name="fechaLlegada" id="fechaLlegada" readonly="readonly"/>
						<input type="hidden" id="fechaLlegadaHidden" name="fechaLlegadaHidden" />
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
					</td>
				</tr>
				<tr>
					<td>Solicitudes Eliminadas?:</td>
					<td>
						<select id="activo" name="activo">
							<option value="">- -</option>
							<option value="1">S&iacute;</option>
							<option value="0">No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="button" value="Buscar" onclick="searchSolicitudes(1);">
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<div style="width: 100%" id="ajaxPageResult">
			&nbsp;
		</div>
	</td>
</tr>
<?php 
include_once "includes/footer.html";
?>