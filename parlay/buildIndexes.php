<table style="margin-left: auto; margin-right: auto;">
	<tr>
		<td colspan="2">Ajuste de Indices</td>
	</tr>
	<tr>
		<td>Tabla</td>
		<td>Resultado</td>
	</tr>
<?php
	include_once ("./procesos/conexion.php");
	
	$query = "SHOW TABLES";
	$analyzeQuery = "ANALYZE TABLE ";
	$time0 = time();
	
	$result = DBUtil::executeSelect($query);
	foreach ($result as $tableName){
?>
	<tr>
		<td><?php echo $tableName[0];?></td>
		<td>
<?php		
		if(substr($tableName[0], 0, 6) === "vista_"){
			echo "Es una vista, no se procesa.";
		} else {
			$result1 = DBUtil::executeSelect($analyzeQuery.$tableName[0]);
			foreach ($result1 as $salida){
				echo $salida[2]."<br />".$salida[3]." (".(time() - $time0)." s)";
			}
			$time0 = time();
		}
?>
		</td>
	</tr>
<?php
	}
?>
</table>
