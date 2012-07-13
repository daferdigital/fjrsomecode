<?php 
	include("conexion.php"); 
	//$conexion = getConnection();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Transamerica viajes y turismo</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>

<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>

<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<link href="scripts/estilos.css" rel="stylesheet" type="text/css" />

<!-- jQuery -->

<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>

<!-- Slide -->

<script type="text/javascript" src="scripts/jquery.cycle.all.latest.js"></script>

<!-- Acordion -->

<script type="text/javascript" src="scripts/jquery.dimensions.js"></script>

<script type="text/javascript" src="scripts/jquery.accordion.js"></script>

<!-- Scripts -->

<link rel="stylesheet" href="scripts/nivo/nivo-slider.css" type="text/css" media="screen" />

<script type="text/javascript" src="scripts/scripts.js"></script>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body >
    <table width="1034" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
    	<td colspan="3">
	    	<table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
				<td width="25%"  valign="bottom">
					<div style="margin-left: 13px;"></div>
				</td>
				<td valign="bottom"></td>
            </tr>
	        </table>
	    </td>	   
	</tr>          
	<tr>
		<td colspan="2">
			<!-- Espacio para el flash, sustituir por el verdadero -->
		</td>
	</tr>
  	<tr>
	    <td colspan="2" align="center" >
	        <!-- Espacio para la Botonera Principal -->
			<br />
			<!-- Espacio para la Botonera Principal -->
	    </td>
	</tr>
	<tr>
		<td colspan="2">
	    	<div style="height:25px;"></div>
	    	<!-- Espacio para las categorias -->
	   		<!-- Espacio para las categorias -->
	    	<div style="height:25px;"></div>
	    </td>
	</tr>
	<tr>
		<td width="68%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
			<!-- Espacio para el contenido -->
			<div style="height:20px;"></div>
			<div align="left">
				<form id="form1" name="form1" method="post" action="buscar.php?<?php echo $linkp; ?>">
			        <div align="center">
			        	<label style="font-family: Verdana; font-size: 22px;">B&uacute;squeda</label>
					</div>
					
					<br />
					
					<div align="center" >
					  	Puede realizar una B&uacute;squeda en base a un Tema de Inter&eacute;s
					</div>

					<div style="height: 5px"></div>

		    		<div align="center" >
						<p>Ingrese palabras claves:
			            <input name="buscar" type="text" class="blue" id="buscar" />
			            <input type="submit" name="Submit" value="Buscar" />
			          	</p>
					</div>

		    		<div style="height: 13px"></div>

	        		<div align="left" style="padding-left: 35px;">
					<?php 
					    $num1 = $num2 = 0;
						if(isset($_POST["buscar"])){
							$sql  = "SELECT DISTINCT id, titulo, descripcion, seccion from programas where descripcion like '%$_POST[buscar]%'";
					        $sql .= " and status='1' order by titulo desc";
							$consulta = mysql_query($sql, $conexion);
							$num1 = mysql_numrows($consulta);
					
							while($fila = mysql_fetch_array($consulta)){
					?>
					            <a href="seccion2.php?id=<?php echo $fila[0];?>&mira=<?php echo $fila[3]; ?>" >
					            	<?php echo " <img class='check' src='admin/img-commons/check.png' border='0' style='float: left'/>  ".$fila[1]."<br>"; ?>
					            </a>
				 	<?php  
					 		}
					?>
					</div>

					<div align="left" style="padding-left: 35px;"> 
					<?php  
							$sql = "SELECT DISTINCT id, nombre, descripcion from productos where descripcion like '%$_POST[buscar]%' and status='1' order by nombre desc";
							$consulta = mysql_query($sql, $conexion);
							$num2 = mysql_numrows($consulta);
				
							while($fila = mysql_fetch_array($consulta)){
					?>
								<a href="productos2.php?id=<?php print $fila[0];?>">
					            	<?php echo "<img class='check' src='admin/img-commons/check.png' border='0' style='float: left'/> ".$fila[1]."<br>";  ?>
					        	</a>
					<?php  
							}
				        }
				    ?>
    
				    <?php
				    	$count = 0;
				    	$completeValues = "";
				    	$completeValuesAsArray;
				    	$idsToSearch = "";
				    	
				    	if(isset($_POST["titulos"]) && $_POST["titulos"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["titulos"]."||";
				    	}
				    	if(isset($_POST["precio"]) && $_POST["precio"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["precio"]."||";
				    	}
				    	if(isset($_POST["duracion"]) && $_POST["duracion"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["duracion"]."||";
				    	}
				    	if(isset($_POST["itinerario"]) && $_POST["itinerario"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["itinerario"]."||";
				    	}
				    	if(isset($_POST["puerto"]) && $_POST["puerto"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["puerto"]."||";
				    	}
				    	if(isset($_POST["destinos"]) && $_POST["destinos"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["destinos"]."||";
				    	}
				    	if(isset($_POST["navieras"]) && $_POST["navieras"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["navieras"]."||";
				    	}
				    	if(isset($_POST["fecha"]) && $_POST["fecha"] != 0){
				    		$count ++;
				    		$completeValues .= $_POST["fecha"]."||";
				    	}
				    	
				    	if($count > 0) {
				    		$completeValuesAsArray = explode("||", $completeValues);
				    		$completeValuesAsArray = array_count_values($completeValuesAsArray);
					   		reset($completeValuesAsArray);
					   		
					   		while ($var = each($completeValuesAsArray)) {
					   			if(($var[1] == $count) && ($var[0] != "")){
					   				//tenemos un criterio que hizo match con las combinaciones
					   				if(! $idsToSearch == ""){
					   					$idsToSearch .= ", ";
					   				}
					   				
					   				$idsToSearch .= $var[0];
					   			}
					   		}
					    	
					   		if($idsToSearch != ""){
					   			$sql  = "SELECT id, titulo, descripcion, foto, seccion
					   			FROM programas
					   			WHERE id IN ($idsToSearch)";
					   			$sql .= " AND status='1' ORDER BY titulo DESC";
					   			//echo $sql."<br>";
					   			
					   			$consulta = mysql_query($sql, $conexion);
					   			$num1 = mysql_numrows($consulta);
					   			
					   			while($fila = mysql_fetch_array($consulta)){
					?>
									<table width="600" border="0">
										<tr>
											<th height="31" colspan="2" align="left" background="banda.png" class="txt_1" >&nbsp;&nbsp;<?php echo " ".$fila[1]."<br>"; ?></th>
										</tr>
										<tr>
											<td width="10%" height="56"><img src="<?php echo "admin/".$fila[3]; ?>" width="130" height="95"/></td>
										    <td width="74%"><div align="left">
												<?php echo substr(html_entity_decode($fila[2]),0,200);?>...
												<div style="height:5px;"></div>
							                   		<a href="servicios2.php?id=<?php echo $fila[0];?>&mira=<?php echo $fila[4]; ?>" >
							    	   					<i>M&aacute;s detalles </i>
							    	   				</a>
							    	   				<br />
							    	   			</div>
							    	   		</td>
							    	   	</tr>
									</table>
				 	<?php  
					   			}
					 		}
				        }
				    ?>
             
				 	<?php 
				 		mysql_close($conexion);
					 	if($num1==0 && $num2==0){
				            echo "<p align='center'><b>Su b&uacute;squeda no arrojo resultados</b></p>";
				        }
				 	?>              
        			</div>
        		</form>
        	</div>

			<div style="height:30px;"></div>		
			<!-- Espacio para el contenido -->
		</td>
	    <td width="32%" valign="top" align="center">
			<!-- Espacio para los banners -->
			<div align="center">
	        	<form id="form1" name="form1" method="post" action="buscar.php">
	        		<div align="center">
		          		<p>
	          			<input name="buscar" type="text" class="blue" id="buscar" />
	            		<input type="submit" name="Submit" value="Buscar" />
						</p>
	        	</form>

				<div style="height: 20px;"></div>
      		</div>
      		<!-- Espacio para los banners -->
      	</td>
	</tr>
	</table>
</body>
</html>
