<?php
	include_once '../classes/DBConnection.php';
	include_once '../classes/DBUtil.php';
	
	header("Content-Type: text/html; charset=iso-8859-1");
	$tipoContenido = $_POST["contenido"];
?>
	<input type="hidden" name="tipo" value="Papeleria Fiscal"/>
	<input type="hidden" name="contenido" value="<?php echo $tipoContenido;?>"/>
	
	<?php
		$query = "SELECT tm.id, tm.nombre AS tipo, m.id AS modeloId, m.nombre, m.numero, m.clasico";
		$query .= " FROM tipos_modelos tm, modelos m";
		$query .= " WHERE tm.id = m.id_tipo_modelo";
		$query .= " ORDER BY tm.nombre, m.nombre, m.numero";
		
		$results = DBUtil::executeSelect($query);
		if(count($results) < 1){
			echo "<h3>No se encontraron modelos registrados en el sistema</h3><br />";
		} else {
			$columns = 3;
			$count = 1;
	?>
			<table>
				<tr>
					<td colspan="3" align="center"> Modelos (click sobre el nombre para realizar el pedido)</td>
				</tr>
				<?php 
					foreach ($results AS $modelo){
						if($count > $columns){
							//debo cerrar el nuevo TR
							$count = 1;
							echo "</tr>";
						}
						if($count == 1){
							echo "<tr>";
						}
						
						
						$imagePath = "../imagenes/miniaturas/";
						$imagePath .= str_replace(" ", "", $modelo["tipo"])."/";
						$imagePath .= str_replace(" ", "", $modelo["nombre"]);
						$imagePath .= $modelo["numero"].".jpg";
						
						$imageName = "[".$modelo["tipo"]."] ";
						$imageName .= $modelo["nombre"]." ".$modelo["numero"];
				?>
						<td>
							<a href="#" onclick="javascript:showModeloForm(<?php echo $modelo["modeloId"];?>)">
								<img border="0" alt="<?php echo $count;?>" src="<?php echo $imagePath;?>" />
								<br />
								<?php echo $imageName;?>
							</a>
						</td>
				<?php
						$count++;
					}
				?>
			</table>
	<?php
		}
	?>