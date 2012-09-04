<?php 
	include_once 'includes/header.php';
?>

<td colspan="2" align="center">
	<h3><?php echo (isset($_REQUEST['message']) ? $_ERRORES[$_REQUEST['message']] : ""); ?></h3>
	<br />
	<form name="loginForm" action="servlets/doLogin.php" method="post">
		<table>
		<tr>
			<td> <b>Usuario:</b> </td>
			<td><input type="text" name="user" id="user" size="15" maxlength="100" onkeypress="return letrasONumeros(event, this.form)"> </td>
		</tr>
		<tr>
			<td> <b>Clave:</b> </td>
			<td><input type="password" name="password" id="password" size="15" maxlength="100" onkeypress="return letrasONumeros(event, this.form)"> </td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="login" id="login" value="Ingresar" onclick="wasWritedLoginAndPwd(this.form)">
			</td>
		</tr>
		</table>
	</form>
	<br />
	<br />
</td>


<?php include 'includes/footer.php'; ?>
