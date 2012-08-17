<?php

/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */


session_start(); 
extract($_REQUEST);
include("conexion.php");
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
</style></head>


<body onload="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>
    <table width="1034" border="0" align="center" cellpadding="0" cellspacing="0" style="background: <?php echo $row2[color]; ?>">
  <tr>
    <td colspan="3"><table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
            	<td width="25%"  valign="bottom">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
				      <br /></div>
				     

				</td>
               <td valign="bottom"><div align="right">
                 <?php include "admin/botonera/archivos/boton_sec.php"; ?>
              </div></td>
            </tr>
        </table></td>
    </tr>          
  <tr>
	<td colspan="4"><br />

	 			    	    
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
						  }
						  ?>

                          </div>
  </div>
                    <div id="tabs">

                        
	    <div id="base_c"> 
                        
	                      <?php
						  $tab = mysql_query('SELECT img,link FROM tabs ORDER BY id ASC');
						  $i=1;
						  while($a_tab = mysql_fetch_array($tab))
						  {
						  ?>
                        
                        <div id="c<?php echo $i; ?>">
                          <a href="<?php echo $a_tab['link']; ?>" target="_self" id="img"><img src="tabs/<?php echo $a_tab['img']; ?>" border="0" /></a>
                         
</div>
                        <?php
						
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						/* LINK DE IMAGEN */
						
						/* NOTA: 
						
						Se se va a poner algun Link para algun producto debe de señalarse en el Enlace el ID del Producto señalado en la Base de datos.
						
						Ejemplo: ... href="productos.php?id_producto=1"...   Los ID de producto de cada Item del Panel de Tabs se le agrega en el Administrador.
						 
						 */
                       ?>
                      <?php
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						  $i++;
						  }
						  ?>                       
                     
                       
                       
                       
                      <div id="controles"><span id="b-6" class="i"></span>
                       <span id="b-2" class="d"></span></div>
	    </div>
                      <div id="botones">
                      
                       
                       
                      
                      
          <div id="b-1">1</div>
                          <div id="b-2">2</div>
              <div id="b-3">3</div>
      <div id="b-4">4</div>
            <div id="b-5">5</div>
                          <div id="b-6">6</div>
                      </div> 
	    </div> 
                      
                      
</div>
		<!-- Espacio para el flash, sustituir por el verdadero -->
	</td>
  </tr>
  <tr>
    <td colspan="4" align="right" >
        <!-- Espacio para la Botonera Principal -->
       <br /><br />

 <?php	
        
            if($orientacion==1){
                include "admin/botonera/archivos/boton_princH.php";
            }
            
        ?>
        <!-- Espacio para la Botonera Principal -->
    </td>
  </tr>
  <tr>
    <td colspan="2">
    	<div style="height:5px;"></div>
    	<!-- Espacio para las Subsecciones -->
    	      <?php if($mira== 53) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#C9D9F2">   
	        <?php } if($mira== 81) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#DEEF9C">    
	        <?php } if($mira== 70) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#D6E9F7">   
             <?php } if($mira== 72) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#DDD0E6">
	        <?php } ?>
              <?php if($mira== 88) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#FEECA5">
	        <?php } ?>
               <?php if($mira== 80) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#EAEAEA">
	        	        <?php } ?>
            
            
            <tr>
    	    <td width="94" align="center" valign="middle" style="padding-left: 10px; padding-right: 22px"> Seleccione una categor&iacute;a </td>
    	    <td class="menucat2" width="150" align="left" valign="top"><?php categorias_serv(0,4)?></td>
    	    <td class="menucat2" width="150" align="left" valign="top"><?php categorias_serv(4,4)?></td>
    	    <td class="menucat2" width="150" align="left" valign="top"><?php categorias_serv(8,4)?></td>
    	    <td class="menucat2" width="150" align="left" valign="top"><?php categorias_serv(12,4)?></td>
    	    <td class="menucat2" width="150" align="left" valign="top"><?php categorias_serv(16,4)?></td>
  	    </tr>
  	  </table>
    	<!-- Espacio para las categorias -->
    	<div style="height:5px;"></div>
    </td>
  </tr>
  <tr>
    <td width="68%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
		<!-- Espacio para el contenido -->
		                       
  	<div style="height:20px;"></div>
	<table width="600" border="0"  align='left' cellpadding="8" cellspacing="0">
		<tr>
			<td width="368" height="28" valign="top" align="left" style="padding-left: 6px;">
			<?php 
				
				include "conexion.php";
				
				$sql="select tipo.categoria,programas.categoria from tipo,programas where programas.id='$_GET[id]' and programas.categoria=tipo.id";
				
				$consulta=mysql_query($sql,$conexion);
				$fila=mysql_fetch_array($consulta); 
				
				echo "<b class='titulomenor'>".$fila[0]."</b>"; 
			?>
			<div style="height:20px;"></div>
			</td>
			<td width="77" valign="top">
				<strong><a href="javascript:imprSelec('seleccion')" >Imprimir</a></strong>
				<div style="height:20px;"></div>
			</td>
       </tr>
       <tr> 
			<td colspan="2" valign="top" align="left"> 
			   <div id="seleccion">  
               
               <?php if($mira== 53) {?>
               <table width="600" height="30" border="0" background="banda.png"> 
               <?php } if($mira== 81) {?>
               <table width="600" height="30" border="0" background="banda2.png"> 
               <?php } if($mira== 70) {?>
               <table width="600" height="30" border="0" background="banda3.png"> 
               <?php }?> 
                        <?php if($mira== 72) {?>
               <table width="600" height="30" border="0" background="banda5.png"> 
               <?php } if($mira== 88) {?>
               <table width="600" height="30" border="0" background="banda4.png">
               <?php } if($mira== 80) {?>
               <table width="600" height="30" border="0" background="banda7.png">
                <?php } if($mira== 83) {?>
               <table width="600" height="30" border="0" background="banda7.png">
               <?php } ?>                                       
                                                                 
                           
                           
                <tr>
                    <td class="txt_1"><strong style="margin-left: 6px;">
                                      
                                       &nbsp;
                                       <?php titulosec($_GET[id]); ?>
                                    </strong></td>
                    </tr>
                </table>

			   		
			   
					
  <div style="height:5px;"></div>
					<?php 
						$sql="select * from programas where id='$_GET[id]'";
						$consulta=mysql_query($sql,$conexion); 
						if($row= mysql_fetch_array($consulta)){
					?>
					
					<p style="margin-top: 4px;">
						<img src="<?php print "admin/".$row[foto]; ?> " width="130" height="97" hspace="10" vspace="10" align="left" style="margin-left: 0px;"/>
			         <?php 
					 	}
					 ?>
					</p>
					<div style="height:5px;"></div>
					<b>Precio desde: <?php print number_format($row[precio],2,".",".")."  USD. </b>"; ?>
   		         <?php if($mira== 53) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario2.php?ag=<?php echo $row[titulo]; ?>"><img src="boton_contacto.png" width="130" height="24" border="0" /></a><?php } ?>
                  <?php if($mira== 81) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario3.php?ac=<?php echo $row[titulo]; ?>"><img src="boton_contacto2.png" width="130" height="24" border="0" /></a><?php } ?>
                      <?php if($mira== 70) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario4.php?av=<?php echo $row[titulo]; ?>"><img src="boton_contacto3.png" width="130" height="24" border="0" /></a><?php } ?>
                
                           <?php if($mira== 80) {?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="formulario5.php?af=<?php echo $row[titulo]; ?>"><img src="boton_contacto4.png" width="130" height="24" border="0" /></a><?php } ?>
   		       <br />  
                <?php mensajenoticiasx($_GET[id]); ?>
	   		     <div style="height:5px;"></div>
	   		     <hr width="100%" size="2" />
				<br />
				<iframe width="720" scrolling="auto" height="3850" frameborder="0" marginheight="0" marginwidth="0" src="planes/loadXML.php?id=<?php echo $_GET[id];?>"></iframe>
			   </div>
			</td>
       </tr>
     </table>
     
     
<div style="height:100px; clear: both;"></div>
		
		
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
            
			<label><?php banner1(1,260,360,$mira); ?></label><div style="height: 20px;"></div>
	        <label><?php banner1(2,260,360,$mira); ?></label><div style="height: 20px;"></div>
	        <label><?php banner1(3,260,360,$mira); ?></label><div style="height: 20px;"></div>
	        <label><?php banner1(4,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(5,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(6,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(7,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(8,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(9,260,360,$mira); ?></label><div style="height: 20px;"></div>
            <label><?php banner1(10,260,360,$mira); ?></label><div style="height: 20px;"></div>
	        
	        
      	</div>
      	<!-- Espacio para los banners -->
	</td>
  </tr>
</table>
</div>

<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?82doQBVL964VxZncxDMgWW5NG5KHbKOh';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
</body>
</html>
