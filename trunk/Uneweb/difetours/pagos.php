<?php

session_start();
include "conexion.php";

if($_SESSION["activo"]!= 1){
	header("location: index.php");
	exit();
}

/*Eliminar Clientes*/
if(!empty($_POST[campos])) {
	$aLista=array_keys($_POST[campos]);
	$indices= implode(',',$aLista);
	
	$sQuery="DELETE FROM pago_registrado where id IN ($indices)";
	$consulta= mysql_query($sQuery,$conexion);
	
	if(!mysql_error()){
		echo "<script> alert('La eliminacion ha sido exitosa'); </script>";
	}else{
		echo "<script> alert('No se pudo eliminar'); </script>";
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include "help/help-config.php"?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.: Administrador de Contenidos :.</title>
<link href="botonera/css-styles/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		function createXMLHTTPRequest(){
			var xmlHTTPRequest = null;
			
			//revisamos si no esta definido el objeto nativamente(navegadores tipo mozilla)
			if (typeof XMLHttpRequest == "undefined" ){
				//Ahora revisamos si el motor es mayor o igual a MSIE 5.0 
				//(mayor que microsoft internet explorer 5.0)
				if(navigator.userAgent.indexOf("MSIE 5") >= 0){
					// Si es así creamos un control activeX apartir de un objeto
					//ActiveXObject("Microsoft.XMLHTTP")
					xmlHTTPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} else {
					//si no , o si es menor a MSIE 5.0 creamos otro control activeX
					// apartir de un objeto ActiveXObject("Msxml2.XMLHTTP")
					xmlHTTPRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} 
			} else {
				// en cambio si el objeto estaba definido nativamente, solo lo instanciamos
				xmlHTTPRequest = new XMLHttpRequest();
			}
			
			return xmlHTTPRequest;
		}
		
		function getClientInfo(clientId){
			//esto podria ser una mejor manera, hay que probar 
			//var ajaxObject =  createRequest()
			var ajaxObject =  createXMLHTTPRequest();

			document.getElementById("hrefClient_" + clientId).onclick = function(){hideSpanClient(clientId);};
			document.getElementById("imgClient_" + clientId).src = "img/menu_tree_minus.gif";
			
			document.getElementById("spanClient_" + clientId).style.display = "";
			document.getElementById("spanClient_" + clientId).innerHTML = "<img src=\"img/loading.gif\"/>";
			
			ajaxObject.onreadystatechange=function() {
				if (ajaxObject.readyState==4 && ajaxObject.status==200) {
					document.getElementById("spanClient_" + clientId).innerHTML=ajaxObject.responseText;
				}
			};
			
			ajaxObject.open("POST","pagosClienteResult.php",true);
			//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
			ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxObject.send("clientId=" + clientId);
		}

		function hideSpanClient(clientId){
			document.getElementById("imgClient_" + clientId).src = "img/menu_tree_plus.gif";
			document.getElementById("spanClient_" + clientId).style.display = "none";
			document.getElementById("hrefClient_" + clientId).onclick = function(){getClientInfo(clientId);};
		}
	</script>
</head>

<body>
<div align="center">
  
    <?php  include "menu.htm"?>
  
  	<table align="center" style="width: 770px">
		<tr> 
			<td>
				<div align="right">
					<a href="destroy.php" style="float:right" title="Cerrar Sesión">
						<img src="img/close.png" border="0" />
					</a>
					<a href="help/productos1.php" onclick="return hs.htmlExpand(this, { objectType: 'ajax' } )" style=" float:right; margin-right: 3px" title="Ayuda">
						<img src="img/help.png" border="0"/>
					</a>
				</div>
			</td>
	 	</tr>
	</table>
  
  

<?php 

	$sql= "SELECT activo FROM seccion_tipo WHERE id=6";
	$consulta= mysql_query($sql,$conexion);
	$row= mysql_fetch_array($consulta);
	
	$activo= $row[0];
	
	/*Verificacion de activacion de Carrito de Compra*/
	if($activo==1){
?>	  
    
	<label style="font-size: 24px; font-family: Verdana;">
		Lista de Clientes Registrados
	</label>
	
	<div style="height: 30px;"></div>
	
	<div align="left" style="font-size: 14px; font-family: Georgia; text-align: center">
		Seleccione alguna de las opciones disponibles:
	</div>
	
  <form name="form1" method="post" action="pagos.php">	
	
		<table align="center" border="0" cellpadding="20">
		<tr>
			<td>
				<input type="submit" name="enviar" value="Eliminar"  class="botonDesign"/>
			</td>
			<td>
				<a href="excel_clientes.php" class="botonDesign" title="Exportar a Excel">
					Exportar a Excel
				</a>
			</td>
		</tr>
		</table>


	<div style="height: 20px"></div>
		
		
	<?php 
		include "conexion.php";
	    $sql="select DISTINCT id_cliente, nombre_pagador from pago_registrado order by LOWER(nombre_pagador)";
	    $consulta=mysql_query($sql,$conexion);
  	    
	    while($fila=mysql_fetch_array($consulta)){
	?>
		<div id="divClient_<?php echo $fila["id_cliente"];?>" style="text-align: left">
			<a href="#divClient_<?php echo $fila["id_cliente"];?>" id="hrefClient_<?php echo $fila["id_cliente"];?>" onclick="javascript:getClientInfo(<?php echo $fila["id_cliente"];?>);">
				<img id="imgClient_<?php echo $fila["id_cliente"];?>" src="img/menu_tree_plus.gif" border="0"/>
			</a>
			&nbsp;
  			<?php echo $fila["nombre_pagador"]?>
  		</div>
  		<span id="spanClient_<?php echo $fila["id_cliente"];?>" style="display: none"></span>
    <?php  
		} 
	?>
  </form>
  <p>&nbsp;  </p>
  
  <?php 
		}else{
	?>		
		<label style="font-size: 22px; font-family: Verdana;">
			Modulo Desactivado
		</label>
		
		<div style="height: 30px;"></div>

		<div align="center" style="font-size: 14px; font-family: Georgia; text-align: center;">  
			El m&oacute;dulo de Carrito de Compras no se encuentra activado. <br />
			Para consultas o compras, comun&iacute;quese con Uneweb 
		</div>
		
		<div style="height: 10px;"></div>
		
	<?php	
		}
	?>
</div>
</body>
</html>
