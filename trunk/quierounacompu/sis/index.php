<?php include("includes/header.php");?>

<!-- index.php -->
	<form action="doLogin.php" method="post">
		<table class="loginTable">
			<tr>
				<td colspan="2" align="right" class="estilo2" bgcolor="#4d60fe">
					Sistema Integral de Seguimiento
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

<?php include("includes/footer.php");?>