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
	
	$result = DBUtil::executeSelect($query);
	foreach ($result as $tableName){
		$result1 = DBUtil::executeSelect($analyzeQuery.$tableName[0]);
?>
	<tr>
		<td><?php echo $tableName[0];?></td>
		<td>
<?php		
		foreach ($result1 as $salida){
			echo $salida[2]."<br />".$salida[3];
		}
?>
		</td>
	</tr>
<?php
	}
?>
</table>
