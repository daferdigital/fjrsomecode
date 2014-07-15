<?Php 
	include_once("classes/DBUtil.php");
	include_once("classes/UsuarioDTO.php");
	include_once("includes/header.php");
	
	$usuarioDTO = $_SESSION["usuario"];
	
	$query =  "SELECT d.nombre AS dpto, sd.nombre AS unidad, t.id, t.nombre AS taquilla";
	$query .= " FROM departamentos d, sub_departamento sd, taquilla t";
	$query .= " WHERE t.id_operador=".$usuarioDTO->getId();
	$query .= " AND t.id_sub_departamento=sd.id";
	$query .= " AND sd.id_departamento=d.id";
	$query .= " ORDER BY d.nombre, sd.nombre, t.orden";
	
	$taquillas = DBUtil::executeSelect($query);
?>
	<div id="mensaje_eventos" style="display:none;"></div>
	<table align="left">
	<?php 
		foreach ($taquillas as $taquilla){
	?>
			<tr>
	    		<td align="right">
	    			<label class="subtit_form">Departamento: </label>
	    		</td>
	    		<td><?Php echo $taquilla['dpto'];?></td>
    		</tr>
    		<tr>
    			<td align="right">
    				<label class="subtit_form">Taquilla: </label>
    			</td>
    			<td><?Php echo $taquilla['taquilla'];?></td></tr>
        	<tr>
        		<td align="right">
        			<label class="subtit_form">Operador: </label>
        		</td>
        		<td><?Php echo $usuarioDTO->getNombreCompleto();?></td>
        	</tr>
        	<tr>
        		<td>
        			<label class="subtit_form" style="color:#00F;">Atendiendo al ticket n&uacute;mero: </label>
        			<label id="anumero_<?php echo $taquilla[id];?>" class="anumero" style="color:#F00;">0</label>
                </td>
                <td>
                	<input type="button" value="LLAMAR SIGUIENTE" border="0" style="cursor:pointer; background-color:#030; color:#CCC; font-weight:bold; padding:3PX; border:#000 2px solid;" onclick="javascript:llamarTicket(<?php echo $taquilla[id];?>);" />
        		</td>
        	</tr>
        	<tr>
        		<td colspan="2">
        			<hr></hr>
        		</td>
        	</tr>
	<?php
		}
	?>
    </table>
<?php 
	include("includes/footer.php");
?>