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
	location.href='asociese2.php?id='+id_red+'&o='+valor;
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
    <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" style="background: <?php echo $row2[color]; ?>">
  <tr>
    <td colspan="3"><table align="center" cellpadding="0" border="0" cellspacing="2" width="100%">	
			<tr>
            <td  valign="bottom">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
				      </div>		
<?php include "admin/botonera/archivos/boton_sec.php"; ?></td>
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
						  while($a_slide = mysql_fetch_array($slide))
						  {
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
                    
	</div>

		<!-- Espacio para el flash, sustituir por el verdadero -->
	</td>
  </tr>
  <tr>
    <td colspan="4" align="right" >
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
    <td width="80%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
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
    <td height="40" colspan="2" align="center" bgcolor="#CCCCCC" class="txt_29" style="border: 1px solid #3098ef; color:#000;"><strong>Directorio de Miembros</strong></td>
  </tr>
  
  <tr > 
  	<td width="474" align="left" valign="middle" class="txt_7" style="background-color:#EAEAEA; border-left:1px solid #CCCCCC; border-top::1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; padding-left:10px;"> 
    	<form id="buscar_directorio" name="buscar_directorio" method="post" action="asociese2.php" enctype="multipart/form-data">
    		<table width="475">
    			<tr>
    				<td width="225" align="left">
    					Qu&eacute; Buscas? <br /> 
   					  	&Aacute;rea de servicio<br /><br />
   						<label>
   					  		<select name="rubro" id="rubro">
                      			<option value="">Seleccione</option>
                       			<?php
					   				$query = "SELECT id, nombre FROM oficios ORDER BY LOWER(nombre)";
        			   				$oficios = mysql_query($query);
        							
        							while(list($id, $nombre) = mysql_fetch_array($oficios)){
						        ?>
						   				<option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
						        <?php 
						        	}
						        ?>
				      		</select>
				    	</label>
				    </td>
    				<td width="238" align="right">Apellido / Nombre<br /><br />
    					<input  type="text" name="nombre"/>
    				</td>
    			</tr>
    			<tr>
    				<td align="left">
    					En Qu&eacute; Ciudad?
    					<br /><br />
    					<select name="estado" id="estado" >
         		      	<option value="-1">Seleccione:</option>
         		      	<?php 
	         		      	$query = "SELECT estado FROM directorio GROUP BY estado";
	         		      	$consulta = mysql_query($query);
	         		      	while(list($estado) = mysql_fetch_array($consulta)){
	         		    ?>
								<option value="<?php echo $estado;?>"><?php echo $estado;?></option>
	         		    <?php 
	         		      	}
         		      	?>
       		        	</select>
       		        	<br /><br /></td>
    				<td width="238" align="right">C&eacute;dula<br /><br />
    					<input  type="text" name="cedula"/>
    				</td>
    			</tr>
    			<tr>
    				<td colspan="2" align="center">
    					<input type="submit" name="buscar" class="txt_9" value="Iniciar B&uacute;squeda" />
    				</td>
    			</tr>
    		</table>
    		
  		</form>
  	</td>
    <td width="316" height="40" align="left" valign="middle" class="mi_texto1" style="background-color:#EAEAEA; border-right:1px solid #CCCCCC; border-top::1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;">
    	<strong>Ordenar por &gt;</strong><a href="asociese2.php?b=11&mira=164&o=2">Ciudad</a>
    </td>
  </tr>
  <tr >
    <td colspan="2" align="left" valign="middle" class="txt_7">&nbsp;</td>
  </tr>
 <tr>
<td colspan="2" valign="top"> 
  
<?php
	  @$pagina = $_GET['pagina'];
	  $registros = 32;
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
	if($_POST['nombre'] != ""){
		//vemos si el nombre contiene espacios
		$nombre = trim($_POST['nombre']);
		//convertimos el nombre en un arrar
		$items = explode(" ", $nombre);
		foreach ($items as $item){
			$orden .= " AND LOWER(nombre) LIKE LOWER(\"%".addslashes(trim($item))."%\")";
		}
	}
	if($_POST['estado'] != "-1"){
		$orden .= " AND LOWER(estado) LIKE LOWER(\"%".addslashes(trim($_POST['estado']))."%\")";		
	}
	if($_POST['cedula'] != ""){
		$orden .= " AND LOWER(rif) LIKE LOWER(\"%".addslashes(trim($_POST['cedula']))."%\")";
	}
	/*
	if($_POST['municipio'] != ""){
		$orden .= " AND LOWER(municipio) LIKE LOWER(\"%".addslashes(trim($_POST['municipio']))."%\")";
	}
	*/
	$orden .= ' ORDER BY nombre ASC';
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

//echo $orden;
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
					<td height="30" align="center" valign="middle" bgcolor="#CCCCCC" class="txt_9" style="border:1px solid #3098ef; color:#000;"><span style="font-size:17px;"><strong><?php echo $mi_estado_a; ?></strong></span></td>
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
					<td height="30" align="center" valign="middle" bgcolor="#CCCCCC" class="txt_9" style="border:1px solid #3098ef; color:#000;"><span style="font-size:17px;"><strong><?php echo $letra; ?></strong></span></td>
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
		<td height="19" class="mi_texto"><strong>Profesi&oacute;n:</strong></td>
		<td height="19" class="mi_texto"><strong><span style="font-size:11px; color:#000;"><?php echo $r['tipo']; ?></span></strong></td>
	</tr>
	<tr>
	    <td width="36%" height="19" class="mi_texto"><strong> Estado / Ciudad:</strong></td>
	    <td width="64%" height="19" class="mi_texto"><?php echo $r['estado']; ?> <?php echo $r['ciudad']; ?></td>
	</tr>
	<tr>
	  <td height="19" class="mi_texto"><strong>Tel&eacute;fonos:</strong></td>
	  <td height="19" class="mi_texto"><?php echo $r['telefono']; ?></td>
	  </tr>
	<tr>
	  <td height="19" class="mi_texto">&nbsp;</td>
	  <td height="19" class="mi_texto">
	    <a href="contacto.php?id=<?php echo $r['id']?>" target="popup" onClick="window.open(this.href, this.target, 'width=750,height=400,scrollbars=yes'); return false;">
	      <img style="text-decoration: none; border: 0px;" src="contactar1.png" width="100" height="19" />
	      </a>
	    </td>
	  </tr>
	</table>
	
	
	<?php
		if($cont==1) {
			$cont=0;
			//echo '</td></tr><tr><td colspan="2" valign="top">';
		}
		else
		{
			$cont++;
		}
	
	  $cont_1++;

	}
	
	
}
else
{?>
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
	if(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '1')
	{
		$url_orden = 'o=1&';
	}
	elseif(isset($_GET['o']) && !empty($_GET['o']) && $_GET['o'] == '2')
	{
		$url_orden = 'o=2&';
	}
	else
	{
		$url_orden = 'o=1&';
	}

	if(($pagina - 1) > 0) { echo "<a href='".$_SERVER['PHP_SELF']."?".$url_orden."b=11&mira=164&pagina=".($pagina-1)."'><strong><</strong></a> "; }
	  for ($i=1; $i<=$total_paginas; $i++)
	  {
		  if($pagina == $i)
		  { 
		  	echo " <span><b>".$pagina."</b></span> "; 
		  } 
		  else 
		  { 
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
    <td width="20%" valign="top" align="center">
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
