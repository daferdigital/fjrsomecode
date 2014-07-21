<?php
	include_once '../classes/DBUtil.php';
	
	$query  = "SELECT d.nombre as dpto, sd.nombre as subDpto, sd.id";
	$query .= " FROM departamentos d, sub_departamento sd";
	$query .= " WHERE d.id = sd.id_departamento";
	$query .= " AND sd.activo = '1'";
	$query .= " ORDER BY d.nombre, sd.nombre";
	
	$subUnidades = DBUtil::executeSelect($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>
    <fieldset>
        <legend>Origen del ticket</legend>
        <table>
            <tr>
                <td>Sub-Unidad: </td>
                <td>
                	<select name="subUnidadOrigen" id="subUnidadOrigen">
                		<option value="">--</option>
                		<?php 
                			foreach ($subUnidades as $subUnidad){
						?>
								<option value="<?php echo $subUnidad["id"];?>">
									<?php echo $subUnidad["dpto"]." - ".$subUnidad["subDpto"];?>
								</option>
						<?php
							}
                		?>
                	</select>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <hr></hr>
    
    <fieldset>
        <legend>Destino del ticket</legend>
        <table>
            <tr>
                <td>Sub-Unidad: </td>
                <td>
                	<select name="subUnidad" id="subUnidad">
                		<option value="">--</option>
                		<?php 
                			foreach ($subUnidades as $subUnidad){
						?>
								<option value="<?php echo $subUnidad["id"];?>">
									<?php echo $subUnidad["dpto"]." - ".$subUnidad["subDpto"];?>
								</option>
						<?php
							}
                		?>
                	</select>
                </td>
            </tr>
        </table>
    </fieldset>
    
</body>
</html>