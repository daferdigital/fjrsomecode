<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';
include_once 'classes/UsuarioDTO.php';

session_start();

include_once "includes/header.php";
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
					<td>Alumnos Retirados?:</td>
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
						<input type="button" value="Buscar" onclick="searchAlumnos(1);">
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