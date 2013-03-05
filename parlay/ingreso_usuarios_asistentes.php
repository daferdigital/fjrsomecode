<?
$id1=$_GET["id"];
echo $condicion_esp1;
if ($id1=='0' or $id1=='1'){}else{
?>
Condiciones Asistente<select size="1" name="asistente" id="select_1">
<option selected value="">Seleccione</option>
  	<option value="0" <? if ($condicion_esp1=='0'){echo "selected='selected'";}?>>No Aplica</option>
  	<option value="1" <? if ($condicion_esp1=='1'){echo "selected='selected'";}?>>Asistente Logros</option>
	<option value="2" <? if ($condicion_esp1=='2'){echo "selected='selected'";}?>>Asistente Transcripci&oacute;n</option>
</select>
<? }?>