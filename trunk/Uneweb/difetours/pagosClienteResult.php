<?php 
	include "conexion.php";
	$sql="select * from pago_registrado where id_cliente=".$_POST["clientId"];
	$consulta=mysql_query($sql,$conexion);
?>

<table width="1100" border="1">
	<tr>
  		<th width="14%">Seleccione</th>
	    <th width="17%">Nombre del Pasajero y Representante</th>
	    <th width="15%">e-mail</th>
	    <th width="8%">Nro. de Expediente</th>
	    <th width="14%">Tel&eacute;fono</th>	
	    <th width="8%">Nro. Transacci&oacute;n</th>
	    <th width="8%">Banco</th>
	    <th width="7%">Monto</th>
	    <th width="9%">Fecha de Pago</th>
  	</tr>
	<?php 
		while($fila=mysql_fetch_array($consulta)){
	?>
    <tr>
    	<td align="center">
			<input type='checkbox' name="campos[<?php echo $fila[0];?>]"/> 
	  	</td>	
      	<td><?php print $fila[1];?></td>
      	<td><?php print $fila[4];?></td>
        <td><?php print $fila[3];?></td>
        <td><?php print $fila[6];?></td>
        <td><?php print $fila[8];?></td>
        <td><?php print $fila[9];?></td>
        <td><?php print $fila[10];?></td>
        <td><?php print $fila[11];?></td>
    <?php  
		} 
	?>
</table>
  
<?php 
	mysql_close($conexion);
?>