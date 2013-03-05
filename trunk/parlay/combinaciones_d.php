<?Php
	$array_ligas=dame_array_js("select idcategoria,idliga,nombre from ligas where estatus='1'",'3','_','|');
//echo $array_ligas;
?><div style="padding-top:10px;" id="combinacionesd">
	<label class="navld">Categoria: </label><?Php $atributos="name=\'sligas\' id=\'sligas\' required=\'required\'"; genera_select("select idcategoria,nombre from categorias where estatus='1'",' name="scategorias" id="scategorias" required="required"');?>
    <input type="button" id="carga_formulario" class="boton" value="Buscar" />
</div>