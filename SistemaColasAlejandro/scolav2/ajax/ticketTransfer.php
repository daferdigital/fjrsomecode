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
	<br />
	<br />
	<fieldset>
        <legend><b>Origen del ticket</b></legend>
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
                	<br />
                	<span class="smallError" id="formSubUnidadOrigen" style="display: none">
						Disculpe, debe indicar la Sub-Unidad de origen.
					</span>
                </td>
            </tr>
            <tr>
                <td>N&uacute;mero del Ticket: </td>
                <td>
                	<input type="text" name="numTicketOrigen" id="numTicketOrigen"/>
                	<br />
                	<span class="smallError" id="formNumTicketOrigen" style="display: none">
						Disculpe, debe indicar el n&uacute;mero del ticket.
					</span>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <br />
    <hr></hr>
    <br />
    
    <fieldset>
        <legend><b>Destino del ticket</b></legend>
        <table>
            <tr>
                <td>Sub-Unidad: </td>
                <td>
                	<select name="subUnidadDestino" id="subUnidadDestino">
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
                	<br />
                	<span class="smallError" id="formSubUnidadDestino" style="display: none">
						Disculpe, debe indicar la Sub-Unidad de destino.
					</span>
                </td>
            </tr>
        </table>
    </fieldset>
    <br />
	<br />
	<table style="width: 100%;">
		<tr>
			<td align="center">
				<input type="button" name="doTransfer" onclick="javascript:doTransferTicket();" value="Transferir" />			
			</td>
		</tr>
	</table>
	<br />
	<br />
</body>
</html>