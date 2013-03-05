<?Php session_start();?>
<script language="javascript">
	clave_actual='<?Php echo $_SESSION['datos']['clave'];?>';
</script>
<div class="titulo">Cambio de clave</div>
<form method="post" name="form1">
<fieldset style="width:400px;">
	<legend>Indique clave actual y la nueva clave</legend>
    <table width="100%">
    	<tr><td align="right"><label>Clave actual:</label></td><td><input type="password" id="cactual_" name="cactual" value="" required="required"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td align="right"><label>Clave nueva:</label></td><td><input type="password" id="cnueva_" name="cnueva" value="" required="required"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td align="right"><label>Repita clave nueva:</label></td><td><input type="password" id="rcnueva_" name="rcnueva" value="" required="required"> <label class="campo_obligatorio">*</label></td></tr>
    </table>
</fieldset><br>
<br>

<div align="center" style="width:400px;"><input type="button" onclick="javascript: nolistado='no';validar(document.form1,'cclave.php');" class="boton" value="Guardar cambios"></div>
</form>
<br>
<br>
<br>