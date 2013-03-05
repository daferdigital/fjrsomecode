<div class="mensajerias" id="mensajerias" style="display:none;">Hola</div>
<div class="titulo">Pagar Tickets</div>
<fieldset style="width:500px;"><legend>Indique el código del ticket y el codigo cliente del ticket a pagar</legend>
<form name="pagar" method="post" action="">
	<table width="100%">
    	<tr><td align="right" width="150px"><label class="tit_campos">Serial de Cobro: </label></td><td><input type="text" value="" class="numeric" required="required" name="codigo_ticket" id="codigo_ticket"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td align="right" width="150px"><label class="tit_campos">Código cliente: </label></td><td><input type="text" value="" class="numeric" required="required" name="codigo_cliente" id="codigo_cliente"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td colspan="2" align="center"><input type="button" class="boton" value="Pagar" onclick="javascript: mostrarmens='si';comentario='Indique tanto código del ticket como código del cliente'; nolistado='no'; validar(document.pagar,'pagar_ticket.php');"> <input type="reset" class="boton" value="Limpiar campo"></td></tr>
    </table>
</form>    
</fieldset>

<script language="javascript">

	$(".numeric").numeric();
	
</script>