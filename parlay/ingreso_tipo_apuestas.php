<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idtipo_apuesta';
</script>
<div class="titulo">Registro / Edici&oacute;n de Tipos de Apuestas</div>
<form name="form1" method="post" action="procesos/guardar_tipo_apuestas.php">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre del tipo de apuesta:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Especial para:</label> <select name="tipo" id="tipo"><option value="">Seleccione</option><option value="juego">Juego</option><option value="equipo">Equipo</option></select> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.form1,'tipo_apuestas.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idtipo_apuesta" id="idtipo_apuesta" value="" />
    <div id="listado">
    <?Php
		include("procesos/listar_tipo_apuestas.php");
	?>
    </div>
</form>