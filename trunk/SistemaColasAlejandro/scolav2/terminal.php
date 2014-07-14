<?Php 
	include_once("classes/DBUtil.php");
	include_once("includes/headerTerminal.php");
	$sql_dptos="SELECT * FROM departamentos WHERE activo='1' ORDER BY LOWER(nombre)";
	$departamentos = DBUtil::executeSelect($sql_dptos);
	
	if(count($departamentos) > 0){
		$filas = (int) (count($departamentos) / 2);
		$resto = (int) (count($departamentos) % 2);
?>
		<table id="terminal">
		<?php 
			for ($i = 0; $i < $filas; $i++){
		?>
				<tr>
					<td class="terminalTD">
						<div class="dptoTitleClosed" id="title_<?php echo $departamentos[$i*2]["id"];?>">
							<?php echo strtoupper($departamentos[$i*2]["nombre"])?>
						</div>
						<div id="detailDpto_<?php echo $departamentos[$i*2]["id"];?>" style="display: none;">
						</div>
						<div class="actionDpto">
							<img id="<?php echo $departamentos[$i*2]["id"];?>" src="imagenes/desplegar.png">
						</div>
						<script type="text/javascript">
							setInterval(function(){refreshSubDptoInfo('<?php echo $departamentos[$i*2]["id"];?>')}, 2000);
						</script>
					</td>
					<td class="terminalTD">
						<?php 
							if(isset($departamentos[($i*2)+1])){
						?>
								<div class="dptoTitleClosed" id="title_<?php echo $departamentos[($i*2)+1]["id"];?>">
									<?php echo strtoupper($departamentos[($i*2)+1]["nombre"])?>
								</div>
								<div id="detailDpto_<?php echo $departamentos[($i*2)+1]["id"];?>" style="display: none;">
								</div>
								<div class="actionDpto"">
									<img id="<?php echo $departamentos[($i*2)+1]["id"];?>" src="imagenes/desplegar.png">
								</div>
								<script type="text/javascript">
									setInterval(function(){refreshSubDptoInfo('<?php echo $departamentos[($i*2)+1]["id"];?>')}, 2000);
								</script>
						<?php
							}
						?>
					</td>
				</tr>
		<?php
			}
			
			if($resto > 0){
		?>
				<tr>
					<td class="terminalTD">
						<div class="dptoTitleClosed" id="title_<?php echo $departamentos[$i*2]["id"];?>">
							<?php echo strtoupper($departamentos[$i*2]["nombre"])?>
						</div>
						<div id="detailDpto_<?php echo $departamentos[$i*2]["id"];?>" style="display: none;">
						</div>
						<div class="actionDpto">
							<img id="<?php echo $departamentos[$i*2]["id"];?>" src="imagenes/desplegar.png">
						</div>
						<script type="text/javascript">
							setInterval(function(){refreshSubDptoInfo('<?php echo $departamentos[($i*2)]["id"];?>')}, 2000);
						</script>
					</td>
				</tr>
		<?php
			}
		?>
		</table>
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
	
	include("includes/footerV2.php");
?>