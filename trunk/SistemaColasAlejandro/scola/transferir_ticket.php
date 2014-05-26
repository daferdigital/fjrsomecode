<?
include ("procesos/conexion.php");
date_default_timezone_set("America/Caracas");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM :.</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.validity.1.2.0/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="reportes/datepicker/epoch_classes.js"></script>
<script language="javascript" src="reportes/old.sm.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validity.1.2.0/jQuery.validity.js"></script>
<link type="text/css" href="js/jquery.validity.1.2.0/jquery.validity.css" rel="stylesheet" />
<script>
            $(function() { 
                $("form").validity(function() {
                    $("#serial")
                        .require()
                        .match("number");
/*                        .range(0, 100);*/
						
                    $("#departamento")
                        .require();
                    $("#dob")
                        .require()
                        .match("date")
                        .lessThanOrEqualTo(new Date());
                });
            });

/*
function validar(consulta){
	
	if (consulta.fecha_desde.value == ""){
	 alert("Introduzca la Fecha de Inicio"); 
		 consulta.fecha_desde.focus(); 
		 return (false); 
	 }

	if (consulta.fecha_hasta.value == ""){
	 alert("Introduzca la Fecha Final"); 
		 consulta.fecha_hasta.focus(); 
		 return (false); 
	 }

	if (consulta.presentacion.value == ""){
	 alert("Indique el formato de salida"); 
		 consulta.presentacion.focus(); 
		 return (false); 
	 }

	if (consulta.estilo.value == ""){
	 alert("Indique el estilo"); 
		 consulta.estilo.focus(); 
		 return (false); 
	 }

}*/
</script> 
<style type="text/css">
.desaparece {display:none}
</style>
</head>

<? 

$serial1=$_POST["serial"];
$departamento1=$_POST["departamento"];

if ($serial1!=''){
	$query = mysql_query("SELECT * FROM tickets_detalles WHERE idticket_detalle ='$serial1' ");
		if($row=mysql_fetch_array($query)){
	
		$sql="UPDATE tickets_detalles SET `correlativo`='$serial1', `idticket_encabezado`='$departamento1', 
				`atendido`= '0', `atendiendo`= '0', `llamando`= '0', `idoperador_taquilla`= '0'	WHERE idticket_detalle='$serial1' "	or die(mysql_error());
			mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());?>
            
			<script language="javascript">
                jQuery(document).ready(function(){
                    jQuery('#mensaje_eventos').html('Operación ejecutada con éxito');
                    jQuery('#mensaje_eventos').show('slow');
                    setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
                });
            </script><?
		}else{?>
			<script language='JavaScript'>alert('El serial de ticket no existe');</script><?
		}  

}
?>


<body>
<div align="center"><img src="imagenes/HEADER_LOCKHEART.png" width="803" height="103" border="0" /></div>
<form method="post" name="consulta" action="" onSubmit="return validar(this)">
<table width="800" border="0" align="center">
  <tr>
    <td colspan="2" align="left">
   
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>Transferir Ticket</strong></td>
  </tr>
  <tr>
    <td width="242" align="right">&nbsp;</td>
    <td width="354">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Serial de Ticket:</td>
    <td><input id="serial" name="serial" class="caja_tex" value="<? echo $_GET["serialt"];?>" readonly="readonly" type="text" size="15" />
      </td>
  </tr>
  <tr>
    <td  align="right">Departamento a Transferir:</td>
    <td><strong>
      <select id="departamento" size="1" name="departamento">
        <?
		//".date('Y-m-j')."
		
	$result1 = mysql_query("SELECT te . * , d.descripcion
							FROM tickets_encabezados te
							LEFT JOIN departamentos d ON ( te.iddepartamento = d.iddepartamento )
							WHERE fecha = '".date("Y-m-d")."' ORDER BY d.descripcion", $conexion);
	 $num_rows1 = mysql_num_rows($result1);
	if ($num_rows1 != 0){?>
        <option selected="selected" value="">Seleccione..</option>
        <?
			for($i=1;$i<=$num_rows1;$i++){
			$j=$i-1;
			$descripcion=mysql_result($result1, $j, "descripcion");
			$id=mysql_result($result1, $j, "idticket_encabezado");
			echo "<option value=".$id.">".$descripcion."</option>";}}?>
      </select>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" class="boton" value="Transferir Ticket" />
      <!-- <input type="reset" class="boton" value="Limpiar Datos" />-->  <a href="operador.php" target="_self" class="boton">REGRESAR MEN&Uacute; OPERADOR</a> </td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div id="mensaje_eventos" style="display:none;"></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>  
</body>
</html>