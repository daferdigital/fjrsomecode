<?php
include_once 'classes/Constants.php';
include_once 'classes/DBUtil.php';
include_once 'classes/UsuarioDTO.php';
include_once "includes/header.php";
?>
<tr>
	<td colspan="2" align="center">
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
				<td>Nombre Profesor: </td>
				<td>
					<input type="text" name="nombre" id="nombre" />
				</td>
			</tr>
			<tr>
				<td>Apellido Profesor: </td>
				<td>
					<input type="text" name="apellido" id="apellido" />
				</td>
			</tr>
			<tr>
				<td>Grado:</td>
				<td>
					<input type="text" name="grado" id="grado"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="button" value="Buscar" onclick="searchGrados(1);">
				</td>
			</tr>
		</table>
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