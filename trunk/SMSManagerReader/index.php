<?php
include_once 'classes/SessionUtil.php';
include_once 'classes/Constants.php';
include_once "includes/header.php";

if(SessionUtil::checkIfUserIsLogged()){
	header("Location: logged.php");
}
?>
<tr id="tab1">
	<td colspan="2" align="center">
		<form name="loginForm" action="formProcess/doLogin.php" method="post" onsubmit="return validarLoginForm(this);">
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
					<td>Usuario:</td>
					<td>
						<input type="text" name="usuario" id="usuario"/>
						<span class="isMandatory" id="mandatoryUsuario" style="display: none;">
							<br />
							Disculpe, debe indicar el usuario.
						</span>
					</td>
				</tr>
				<tr>
					<td>Clave:</td>
					<td>
						<input type="password" name="clave" id="clave"/>
						<span class="isMandatory" id="mandatoryClave" style="display: none;">
							<br />
							Disculpe, debe indicar la clave.
						</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Ingresar" />
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<?php
include_once "includes/footer.html";
?>