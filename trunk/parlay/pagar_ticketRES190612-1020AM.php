<div class="mensajerias" id="mensajerias" style="display:none;">Hola</div>
<div class="titulo">Pagar Tickets</div>
<fieldset style="width:600px;"><legend>Indique el código del ticket y el codigo cliente del ticket a pagar</legend>
<form name="pagar" method="post" action="">
	<table width="100%">
    	<tr><td align="right" width="150px"><label class="tit_campos">Serial de Cobro: </label></td><td><input type="text" value="" class="numeric" required="required" name="codigo_ticket" id="codigo_ticket"> <label class="campo_obligatorio">*</label></td></tr>
        <tr><td align="right" width="150px"><label class="tit_campos">Código cliente: </label></td><td><input type="text" value="" class="numeric" required="required" name="codigo_cliente" id="codigo_cliente"> <label class="campo_obligatorio">*</label></td></tr>
        <tr id="bot_cons"><td colspan="2" align="center"><input type="button" class="boton" value="Consultar" onclick="javascript: detalle_del_ticket='mostrar';mostrarmens='si';comentario='Indique tanto código del ticket como código del cliente'; nolistado='no';permitir_imprimir='no'; validar(document.pagar,'verificar_pagar_ticket.php');"> <input type="reset" class="boton" value="Limpiar campo" onclick="javascript:$('#detalle_del_ticket').html('');"></td></tr>
    </table>
    <div id="detalle_del_ticket" class="detalle_del_ticket" style="display:none;">
    	
    </div>
</form>    
</fieldset>

<script language="javascript">
	$(".numeric").numeric();
	$("#detalle_del_ticket > *").attr('required',false);	
</script>