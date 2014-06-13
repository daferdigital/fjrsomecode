<?Php 
	include_once("includes/header.php");
	include_once("classes/DBUtil.php");
	$sql_dptos="select * from departamentos WHERE activo='1' ORDER BY LOWER(nombre)";
	$departamentos = DBUtil::executeSelect($sql_dptos);
		
	if(count($departamentos) > 0){
?>
		<div id="terminal">
		<?php 
			foreach ($departamentos as $dpto){
				//tenemos el listado de departamentos, los dibujamos
		?>
			<div class="dptoTitle">
				<span><?php echo $dpto["descripcion"];?></span>
				<img src="imagenes/arrowDown.png" id="imgDpto<?php echo $dpto["id"];?>" onclick="subDptoInfo('<?php echo $dpto["id"];?>')"/>
			</div>
			<div id="detailDpto<?php echo $dpto["id"];?>" style="display: none;"></div>
		<?php
			} //fin del foreach
		?>
		</div>
	<?php
	} else {//fin del if(mysql_num_rows($departamentos)>0)
	?>
    	<div align="center" class="advertencia">
    		No se han cargado taquillas para el d&iacute;a <?Php echo date("d/m/Y");?>
    	</div>
<?Php
	}
	
	include("includes/footer.php");
?>