<?php
include_once 'classes/Constants.php';
include_once 'classes/SessionUtil.php';
include_once 'classes/DBUtil.php';
include_once 'classes/UsuarioDTO.php';
include_once "includes/header.php";

if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: index.php");
}
if(SessionUtil::userReachInactivity()){
	header("Location: index.php");
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
					<td>Nombre: </td>
					<td>
						<input type="text" name="nombre" id="nombre" />
					</td>
				</tr>
				<tr>
					<td>Apellido: </td>
					<td>
						<input type="text" name="apellido" id="apellido" />
					</td>
				</tr>
				<tr>
					<td>C&eacute;dula:</td>
					<td>
						<select name="ci" id="ci">
					        <option value="">- -</option>
					        <option value="V">V</option>
					        <option value="E">E</option>
		      			</select>
						<input type="text" name="cedula" id="cedula" maxlength="10" onkeypress="return textInputOnlyNumbers(event);"/>
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
								<option value="<?php echo $cargo["id"];?>"><?php echo $cargo["nombre"];?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Funcionarios Activos?:</td>
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
						<input type="button" value="Buscar" onclick="searchPersonal(1);">
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