<?php 
	include_once("includes/header.php");
	include_once("classes/PageAccess.php");
	
	//si el usuario esta logueado, lo llevo a la pagina despues del login
	if(PageAccess::userIsLogged()){
		header("Location: mainMenu.php");
	}
?>

<!-- index.php -->
	<form action="formProcess/doLogin.php" method="post">
		<table class="loginTable">
			<tr>
				<td colspan="2" align="center">
					<div id="loginErrorMsg">
						<?php
						if(isset($_SESSION[Constants::$KEY_MESSAGE_ERROR])){
						?>
							<span  class="smallError" >
								<?php echo $_SESSION[Constants::$KEY_MESSAGE_ERROR];?>
							</span>
						<?php
								unset($_SESSION[Constants::$KEY_MESSAGE_ERROR]);
							}
						?>	
						
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
				<td colspan="2" align="center" class="estilo2" bgcolor="#00CC88">
					Servicio Autonomo de Tributaci&oacute;n Nacional (SATRIM)
				</td>
			</tr>
			<tr>
				<td>
					Usuario:
				</td>
				<td>
					<input type="text" name="login"/>
					<br />
					<span class="smallError" id="formLogin" style="display: none">
						Debe introducir su login
					</span>
				</td>
			</tr>
			<tr>
				<td>
					Clave:
				</td>
				<td>
					<input type="password" name="clave"/>
					<br />
					<span class="smallError" id="formClave" style="display: none">
						Debe colocar la clave
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" value="Ingresar" onclick="javascript:validarLoginForm(this.form)"/>
					<input type="submit" hidden="" />
				</td>
			</tr>
		</table>
	</form>

<?php include_once("includes/footer.php");?>
