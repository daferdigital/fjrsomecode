<?Php
	$array_ligas=dame_array_js("select idcategoria,idliga,nombre from ligas where estatus='1'",'3','_','|');
//echo $array_ligas;
?><div style="padding-top:10px;" id="logrosd">
	<label class="navld">Deporte: </label><?Php $atributos="name=\'sligas\' id=\'sligas\' required=\'required\'"; genera_select("select idcategoria,nombre from categorias where estatus='1'",' name="scategorias" id="scategorias" required="required" onchange="dinamico_select(\'dinliga\',this.value,\''.$array_ligas.'\',\''.$atributos.'\')"');?>
    <label class="navld">Liga: </label> <label id="dinliga"><select name="sligas" id="sligas"><option value="">Seleccione</option></select></label>
    <label class="navld">Fecha: </label> <input type="text" readonly="readonly" name="fecha_ld" id="fecha_ld" value="<?Php echo DateUtil::getDateUnderVzlaTZDayMonthYear();?>" /> <input type="button" id="carga_formulario" class="boton" value="Buscar" />
</div>