<?php

/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */

session_start(); 
extract($_REQUEST);
include("conexion.php");
include_once("tuningPaquetes.php");
include("admin/botonera/archivos/botonFunciones.php");

$boton= obtenerBoton();
$tipoFondo= obtenerFondo();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php mostrarTitulo($boton,$empresa)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>

<?php 
	cargarEstilosDin();
	if ($tipoFondo==2){ cargarDegrade2(); } 
?>	
<link href="css/estiloBuscadores.css" type="text/css" rel="stylesheet"/>
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
<script type="text/javascript" src="buscador.js"></script>

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


<body onload="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>
	
  <div style="height:5px;"></div>
					<?php 
						$sql="select * from programas where id='$_GET[id]'";
						$consulta=mysql_query($sql,$conexion); 
						if($row= mysql_fetch_array($consulta)){
					?>
					
					<p style="margin-top: 4px;">
						<img src="<?php print "admin/".$row["foto"]; ?> " width="130" height="97" hspace="10" vspace="10" align="left" style="margin-left: 0px;"/>
			         <?php 
					 	}
					 ?>
					</p>
					<div style="height:5px;"></div>
					<b>Precio desde: <?php print number_format($row["precio"],2,".",".")."  USD."; ?> </b>
   		         <?php if($mira== 53) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario2.php?ag=<?php echo $row[titulo]; ?>"><img src="boton_contacto.png" width="130" height="24" border="0" /></a><?php } ?>
                  <?php if($mira== 81) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario3.php?ac=<?php echo $row[titulo]; ?>"><img src="boton_contacto2.png" width="130" height="24" border="0" /></a><?php } ?>
                      <?php if($mira== 70) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario4.php?av=<?php echo $row[titulo]; ?>"><img src="boton_contacto3.png" width="130" height="24" border="0" /></a><?php } ?>
                           <?php if($mira== 80) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario5.php?af=<?php echo $row[titulo]; ?>"><img src="boton_contacto4.png" width="130" height="24" border="0" /></a><?php } ?>
   		       <br />  
                <?php //mensajenoticiasx($_GET["id"]); ?>
	   		     <div style="height:5px;"></div>
	   		     
	   		     <!-- info de las salidas -->
	   		     <div style="height:5px;"></div>
	   		     <span id="#mes">
				  	Salidas: 
				  	&nbsp;&nbsp;
				  	<a href="#mes" onclick="showPrevMont()" style="font-size: 16px; font-weight: bold;"> Mes previo &lt; </a>
					&nbsp;&nbsp;
					<a href="#mes" onclick="showNextMont()" style="font-size: 16px; font-weight: bold;"> Pr&oacute;ximo mes &gt; </a>
			  	</span>
	   		     <?php echo showProgramaDivSalidasInfo($_GET["id"]); ?>
	   		     
	   		     <hr width="100%" size="2" />
				<br />
				<?php 
					//verificamos que el xml de este plan efectivamente exista antes de fijar el iframe
					$xmlFileName = "../planes/xml/plan".$_GET['id'].".xml";
					
					if(is_file($xmlFileName)){
				?>
						<iframe width="720" scrolling="auto"  height="700px" frameborder="0" marginheight="0" marginwidth="0" src="../planes/loadXML.php?id=<?php echo $_GET['id'];?>"></iframe>
				<?php	
					}
				?>
<div style="height:100px; clear: both;"></div>
</body>
</html>
