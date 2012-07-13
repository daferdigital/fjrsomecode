<?php
include("incluir/encabezado.html");
?>

<div align="center">
<b>Validar de Usuarios</b><br><br>
<form action="validar.php" method="post">
<table border="1" cellspacing="3" cellpadding="3">
    <tr>
        <td>Correo</td>
        <td><input name="correo" type="text"></td>
    </tr>
    <tr>
        <td>Clave</td>
        <td><input name="clave" type="password"></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
<input type="submit" value="Enviar">
        	<input type="reset" value="Borrar">
        	<input type="hidden" name="id" value="1">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <a href="menu.php">Usuarios No Registrados</a>
        </td>
    </tr>
	<tr>
        <td colspan="2" align="center">
        <a href="index.php">Ir a Inicio</a>
        </td>
    </tr>
</table>
</form>
</div>
<?php
include("incluir/pie.html");
?>
