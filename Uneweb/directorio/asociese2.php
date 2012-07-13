<?php

/**
 * @author David Antunes
 * @project WinWeb - 2009
 */


session_start(); 
extract($_REQUEST);
include("conexion.php");
include("admin/botonera/archivos/botonFunciones.php");


$boton= obtenerBoton();
$tipoFondo= obtenerFondo();

if(isset($_GET['o']) && !empty($_GET['o'])){
	$nombre = 2;
}else{
	$nombre = 1;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php mostrarTitulo($boton,$empresa)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>
<!-- script para manejo de estados y ciudades -->
<script type="text/javascript">
	<?php include ("scripts/ubicaciones.php");?>
</script>
<?php 
	cargarEstilosDin();
	if ($tipoFondo==2){ cargarDegrade2(); } 
?>

<style type="text/css">
<!--
.texto {	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: italic;
	color: #936;
}
.texto {	font-family: Verdana, Geneva, sans-serif;
	font-size: 16px;
	font-style: italic;
	color: #936;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
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
<script language="javascript">
// Javascript Nato
function estado(id_red,valor) {
	location.href='asociese.php?id='+id_red+'&o='+valor;
}
// javascript jQuery
$(function(){
	// Agregar Mas Productos al Hacer Click en VER MAS
	$('body').find('div#agregar').live('click',function(){
		// Orden
		var orden = $('input#orden').val();
		// Ultimo ID Consultado
		var ultimo = $('input#ultimo:first').val();
		// Conteo de Numeros de Pagina
		var num = $('span#conteo_num:last').text();

		$.ajax({
			cache: false,
			async: true,
			url: 'directorio_buscar.php',
			data: 'id_orden='+orden+'&ultimo='+ultimo+'&num='+num,
			type: "GET",
			dataType: 'html',
			success: function listo(datos) {	
				$('div#agregar,input#ultimo:first').remove();
				$('body table#table_agregar').append(datos);
			}
		 });

		return false;
	});
});

function MM_openBrWindow(theURL,winName,features) { 
	//v2.0
    window.open(theURL,winName,features);
}
</script>

</head>

<body onload="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>
    <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" style="background: <?php echo $row2['color']; ?>">
  <tr>
    <td colspan="3"><table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
            	<td width="25%"  valign="bottom">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
				      <br /></div><br />

				     

				</td>
               <td valign="bottom"><div align="right">
                 <?php include "admin/botonera/archivos/boton_sec.php"; ?>
              </div></td>
            </tr>
        </table></td>
    </tr>          
  <tr>
	<td colspan="4">
	 			    	    
	<div id="base">


                    <div id="slide">
                          <div class="slideshow">
                          <?php
							  include('scripts/conexion.php');
							  
							  $slide = mysql_query('SELECT img,link FROM slideshow ORDER BY id DESC');
							  while($a_slide = mysql_fetch_array($slide)) {
						  ?>
                          <a href="<?php echo $a_slide['link']; ?>" target="_self"><img src="slideshow/<?php echo $a_slide['img']; ?>" width="682" height="250" border="0" /></a>
                          <?php
							  	$i++;
							  }
						  ?>
                          </div>
  					</div>
                    
                    
                  <div id="tabs">
                        <div id="fondo_tabs"></div>
	    				<div id="base_c"> 
	                      <?php
						  $tab = mysql_query('SELECT img,link FROM tabs ORDER BY id ASC');
						  
						  while($a_tab = mysql_fetch_array($tab))
						  {
/*							  <a href="<?php echo $a_tab['link']; ?>" target="_self" id="img"><img src="tabs/<?php echo $a_tab['img']; ?>" border="0" /></a>*/
						  ?>  
                            
                       <a href="<?php echo $a_tab['link']; ?>" target="_blank">  <img src="tabs/<?php echo $a_tab['img']; ?>" border="0" width="342" height="250" /></a> 
                        <?php
						   
						  }
						  ?>                       
					    </div>
					</div>   
                    
	</div><br />

		<!-- Espacio para el flash, sustituir por el verdadero -->
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" >
        <!-- Espacio para la Botonera Principal -->
        <?php	
        	if($orientacion==1){
                include "admin/botonera/archivos/boton_princH.php";
            }
            
        ?><br />

        <!-- Espacio para la Botonera Principal -->
    </td>
  </tr>
  <tr>
    <td colspan="2">
       </td>
  </tr>
  <tr>
    <td width="77%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
		<!-- Espacio para el contenido -->
		                       
  		  	
	<?php
		 
		$linkp= "";
			
		if(isset($_REQUEST['b'])){
			$linkp= "&b=".$_REQUEST['b'];				
		}else if(isset($_REQUEST['s'])){
			$linkp= "&s=".$_REQUEST['s'];
		}	
	?>
		 
		<table width="790" border="0" align="center" cellpadding="0" cellspacing="0" id="table_agregar">

  <tr>
    <td height="40" colspan="2" align="center" bgcolor="#6CC" class="txt_29" style="border: 1px solid #3098ef; color:#000;"><strong>Directorio de Especialistas y Servicios</strong></td>
  </tr>
  
  <tr > 
  	<td width="390" align="left" valign="middle" class="txt_7" style="background-color:#EAEAEA; border-left:1px solid #CCCCCC; border-top::1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; padding-left:10px;"> 
    	<form id="buscar_directorio" name="buscar_directorio" method="post" action="asociese2.php" enctype="multipart/form-data">
    		<table width="370">
    			<tr>
    				<td align="left">
    					Qu&eacute; Buscas? <br /> Rubro, Producto o Marca
    					<br /><br />
    					<input  type="text" name="rubro"/>
    				</td>
    				<td align="right">
    					A Qui&eacute;n? <br /> Nombre de la empresa
    					<br /><br />
    					<input  type="text" name="empresa"/>
    				</td>
    			</tr>
    			<tr>
    				<td align="left">
    					En Qu&eacute; Ciudad?
    					<br /><br />
    					<select name="estado" id="estado" onchange="cargarCiudades(this.form.estado.value, this.form.ciudad)">
         		      	<option value="-1">Seleccione:</option>
         		      	<?php 
	         		      	$query = "SELECT id, nombre FROM ubicaciones WHERE tipo_ubicacion = 1 ORDER BY LOWER(nombre)";
	         		      	$consulta = mysql_query($query);
	         		      	while(list($edoId, $edoNombre) = mysql_fetch_array($consulta)){
	         		    ?>
								<option value="<?php echo $edoNombre;?>"><?php echo $edoNombre;?></option>
	         		    <?php 
	         		      	}
         		      	?>
       		        	</select>
       		        	<br /><br />
       		        	<select name="ciudad" id="ciudad">
         		        </select>
    				</td>
    				<td align="right">
    					En Qu&eacute; Municipio?
    					<br /><br />
    					<input  type="text" name="municipio"/>
    				</td>
    			</tr>
    			<tr>
    				<td colspan="2" align="center">
    					<input type="submit" name="buscar" class="txt_9" value="&gt;&gt;" />
    				</td>
    			</tr>
    		</table>
    		
  		</form>
  	</td>
    <td width="390" height="40" align="right" valign="middle" class="mi_texto1" style="background-color:#EAEAEA; border-right:1px solid #CCCCCC; border-top::1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;">
    	<strong>Ordenar por &gt;</strong> 
    	<a href="asociese2.php?b=11&mira=164&o=1">Alfabeto</a> 
    	| 
    	<a href="asociese2.php?b=11&mira=164&o=2">Estado</a>
    </td>
  </tr>
  <tr >
    <td colspan="2" align="left" valign="middle" class="txt_7">&nbsp;</td>
  </tr>
 <tr>
<td colspan="2" valign="top"> 
  
<?php
	  @$pagina = $_GET['pagina'];
	  $registros = 16;
	  if (!$pagina){
		  $inicio = 0; $pagina = 1; 
	  } else {
	  	$inicio = ($pagina - 1) * $registros; 
	  }

// Id
$limit = $registros;
$orden = "";

if(isset($_POST['buscar']) && !empty($_POST['buscar'])) {
	if($_POST['rubro'] != ""){
		$orden .= " AND LOWER(tipo) LIKE LOWER(\"%".addslashes(trim($_POST['rubro']))."%\")";
	}
	if($_POST['empresa'] != ""){
		$orden .= " AND LOWER(nombre) LIKE LOWER(\"%".addslashes(trim($_POST['empresa']))."%\")";
	}
	if($_POST['estado'] != "-1"){
		$orden .= " AND LOWER(estado) LIKE LOWER(\"%".addslashes(trim($_POST['estado']))."%\")";
		if($_POST['ciudad'] != ""){
			$orden .= " AND LOWER(ciudad) LIKE LOWER(\"%".addslashes(trim($_POST['ciudad']))."%\")";
		}
	}
	if($_POST['municipio'] != ""){
		$orden .= " AND LOWER(municipio) LIKE LOWER(\"%".addslashes(trim($_POST['municipio']))."%\")";
	}
} else {
	// Si se solicita orden por Alfabeto
	if(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '1'){
		$orden .= 'ORDER BY nombre ASC';
	}else if(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '2') {
		// Si se solicita orden por direccion
		$orden .= 'ORDER BY estado ASC';
	} else {
		$orden .= ' ORDER BY nombre ASC';
	}
}

include('conexion.php');
$cuantos = mysql_query('SELECT id FROM directorio WHERE estatus = 2 '.$orden);

if(isset($_GET['buscar']) && !empty($_GET['buscar'])) {
	$resultados = mysql_query('SELECT * FROM directorio WHERE estatus = 2 '.$orden.'');
} else {
	$resultados = mysql_query('SELECT * FROM directorio WHERE estatus = 2 '.$orden.' LIMIT '.$inicio.', '.$registros.'');
}

$q = mysql_num_rows($cuantos);
$total_paginas = ceil($q / $registros);
$cont = 0;
$cont_1=1;

$cont_1=0;
$limit = $registros;

if($q > 0) {

if(isset($_GET['buscar']) && !empty($_GET['buscar'])) {
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="30" align="left" valign="middle" bgcolor="26c7fe" class="txt_9" style="border:1px solid #3098ef; color:#000;"><u>Buscando:</u>  <span style="font-size:15px;"><strong><?php echo $buscar; ?></strong></span></td>
</tr>
</table>
<?php
}
$letra ='';
$mi_estado = '';
	while($r=mysql_fetch_array($resultados)) {
		/// TITULOS DE ORDEN
			//ESTADO
			if(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '2') {
				$mi_estado_a = $r['estado'];
				if($mi_estado != $mi_estado_a) {
					$mi_estado = $mi_estado_a;
					?>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td height="30" align="center" valign="middle" bgcolor="#6CC" class="txt_9" style="border:1px solid #3098ef; color:#000;"><span style="font-size:17px;"><strong><?php echo $mi_estado_a; ?></strong></span></td>
					</tr>
					</table>
					<?php
				}
			} else {
				$letra_a = substr(strtoupper($r['nombre']),0,1);
				if($letra != $letra_a) {
					$letra = $letra_a;
					?>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td height="30" align="center" valign="middle" bgcolor="#6CC" class="txt_9" style="border:1px solid #3098ef; color:#000;"><span style="font-size:17px;"><strong><?php echo $letra; ?></strong></span></td>
					</tr>
					</table>
					<?php
				}
			}
?>      
	<table width="390" border="0" cellspacing="3" cellpadding="0" style="background-color:#FFFFFF; <?php if($cont_1 != $limit){echo 'float:left;';}?>">
	<tr>
		<td height="30" colspan="2" class="txt_29" style="background-color:#DDDDDD; border:1px solid #CCCCCC; color:#243e77; text-transform:uppercase; padding:6px;">
			<strong>
			<?php 
				echo $r['nombre']; 
				if($cont_1 == $limit) {
					echo '<input type="hidden" name="ultimo" id="ultimo" value="2" />';
				}
			?>
			<br />
			</strong>
		</td>
	</tr>
	<tr>
		<td height="19" class="mi_texto"><strong>Actividad Comercial:</strong></td>
		<td height="19" class="mi_texto"><strong><span style="font-size:11px; color:#000;"><?php echo $r['tipo']; ?></span></strong></td>
	</tr>
	<tr>
	    <td width="36%" height="19" class="mi_texto"><strong> Estado / Ciudad:</strong></td>
	    <td width="64%" height="19" class="mi_texto"><?php echo $r['estado']; ?> / <?php echo $r['ciudad']; ?></td>
	</tr>
	<tr>
		<td height="19" class="mi_texto"><strong> Productos:</strong></td>
		<td height="19" class="mi_texto"><?php echo (strlen($r['familia']) > 40 ? substr($r['familia'], 0, 37)."..." : $r['familia']); ?></td>
	</tr>
	<tr>
		<td height="19" class="mi_texto"><strong>Contacto:</strong></td>
		<td height="19" class="mi_texto">
			<a href="contacto.php?id=<?php echo $r['id']?>" target="popup" onClick="window.open(this.href, this.target, 'width=750,height=400,scrollbars=yes'); return false;">
				<img style="text-decoration: none; border: 0px;" src="contactar1.png" width="100" height="19" />
			</a>
		</td>
	</tr>
	<tr>
		<td height="19" class="mi_texto"><strong>Promedio Calificaciones:</strong></td>
		<td height="19" class="mi_texto">
			<?php
				$query = "SELECT IFNULL(ROUND(AVG(calificacion_recibida)), -1) AS prom FROM servicio_contactado WHERE calificacion_recibida > -1 AND id_especialista = ".$r['id'];
				$result = mysql_query($query);
				list($avg) = mysql_fetch_array($result);
				
				if($avg >= 0){
					echo "<img src=\"Images/p".$avg.".jpg\"/>";
				} else{
					//este usuario aun no ha sido calificado
					echo "[Este especialista aun no ha sido calificado]";
				}
			?>
		</td>
	</tr>
	</table>
	
	
	<?php
		if($cont==1) {
			$cont=0;
			//echo '</td></tr><tr><td colspan="2" valign="top">';
		} else {
			$cont++;
		}
	
	  $cont_1++;

	}
} else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="100" align="center" class="txt_26">No se encontraron Resultados.</td>
  </tr>
</table>
	
<?php
}
?>



</td>
</tr>
</table>
	 <?php
// 	
	if(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '1') {
		$url_orden = 'o=1&';
	}
	elseif(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '2') {
		$url_orden = 'o=2&';
	} else {
		$url_orden = 'o=1&';
	}

	if(($pagina - 1) > 0) { echo "<a href='".$_SERVER['PHP_SELF']."?".$url_orden."b=11&mira=164&pagina=".($pagina-1)."'><strong><</strong></a> "; }
	  for ($i=1; $i<=$total_paginas; $i++) {
		  if($pagina == $i) { 
		  	echo " <span><b>".$pagina."</b></span> "; 
		  } else { 
		  	echo " <a href='".$_SERVER['PHP_SELF']."?".$url_orden."b=11&mira=164&pagina=$i'>$i</a> "; 
		  }
	  }
	  if(($pagina + 1)<=$total_paginas) { echo " <a href='".$_SERVER['PHP_SELF']."?".$url_orden."b=11&mira=164&pagina=".($pagina+1)."'><strong>></strong></a>"; }
	  ?>        
    <br />
<br />
<br />
 <div style="height:30px;"></div>
	 
	 
		
		<!-- Espacio para el contenido -->
	</td>
    <td width="23%" valign="top" align="center">
    	
		<!-- Espacio para los banners -->
		<div align="center">
			<div align="center">
	       		<label><?php banner1(1,220,220,$mira); ?></label><div style="height: 20px;"></div>
		        <label><?php banner1(2,220,220,$mira); ?></label><div style="height: 20px;"></div>
		        <label><?php banner1(3,220,220,$mira); ?></label><div style="height: 20px;"></div>
		        <label><?php banner1(4,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(5,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(6,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(7,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(8,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(9,220,220,$mira); ?></label><div style="height: 20px;"></div>
	            <label><?php banner1(10,220,220,$mira); ?></label><div style="height: 20px;"></div>
      	    </div>
   	    </div>
      	<!-- Espacio para los banners -->
	</td>
  </tr>
</table>
</div>
</body>
</html>
