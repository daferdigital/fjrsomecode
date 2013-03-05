<div class="mensajerias" id="mensajerias" style="display:none;">Hola</div>
<div class="titulo">Anular Tickets</div>
<fieldset style="width:500px;"><legend>Indique el código del ticket a anular</legend>
<form name="anular" method="post" action="">
	<table width="100%">
    	<tr><td align="right" width="150px"><label class="tit_campos">Código del ticket</label></td><td><input type="text" value="" class="numeric" required="required" name="codigo_ticket" id="codigo_ticket"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td colspan="2" align="center"><input type="button" class="boton" value="Anular" onclick="javascript: mostrarmens='si';comentario='Indique el código del ticket a anular'; nolistado='no';permitir_imprimir='no'; validar(document.anular,'anular_ticket.php');"> <input type="reset" class="boton" value="Limpiar campo"></td></tr>
    </table>
</form>    
</fieldset>

<script language="javascript">

	$(".numeric").numeric();
	
</script>