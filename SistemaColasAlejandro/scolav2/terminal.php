<?Php 
	include_once("classes/DBUtil.php");
	include_once("includes/header.php");
	$sql_dptos="select * from departamentos WHERE activo='1' ORDER BY LOWER(nombre)";
	$departamentos = DBUtil::executeSelect($sql_dptos);
		
	if(count($departamentos) > 0){
		$cuenta = 1;
?>
		<div id="terminal">
		<?php 
			foreach ($departamentos as $dpto){
				//tenemos el listado de departamentos, los dibujamos
		?>
			<div class="dptoTitle">
				<span>
					<?php echo $dpto["nombre"];?>
					<img src="imagenes/arrowDown.png" id="imgDpto<?php echo $dpto["id"];?>" onclick="subDptoInfo('<?php echo $dpto["id"];?>')"/>
				</span>
			</div>
			
			<div class="subDptoDiv" id="detailDpto<?php echo $dpto["id"];?>" style="display: none;"></div>
			<script type="text/javascript">
				setInterval(function(){refreshSubDptoInfo('<?php echo $dpto["id"];?>')}, 1000);
			</script>
		<?php
				$cuenta++;
				if($cuenta % 2 == 0){
					echo "<br />";
				}
			} //fin del foreach
		?>
		</div>
		<div>
			<iframe id="pivoteImpresion" src="" style="display: none;">
			</iframe>
		</div>
	<?php
	} else {//fin del if(mysql_num_rows($departamentos)>0)
	?>
    	<div align="center" class="advertencia">
    		No se tiene informaci&oacute;n de Unidades/Sub-unidades para el d&iacute;a <?Php echo date("d/m/Y");?>
    	</div>
<?Php
	}
	
	include("includes/footer.php");
?>