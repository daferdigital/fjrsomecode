<?php
/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */

session_start(); 
extract($_REQUEST);
include("conexion.php");
include("admin/botonera/archivos/botonFunciones.php");

$linkp= "";
			
if(isset($_REQUEST["b"])){
	$linkp= "&b=".$_REQUEST["b"]."&mira=".$mira;				
}else if(isset($_REQUEST["s"])){
	$linkp= "&s=".$_REQUEST["s"]."&mira=".$mira;
}
		
if($_SESSION["usuario"]==1315){
	$i=0; //Nada
}else{
	header("location: formulario2.php?$linkp");
}


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
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

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
<script type="text/javascript" src="scripts/scripts.js"></script>	
</head>

<body onLoad="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>

<div id="cuerpo" align="center" style="margin: 0px;">
<table width="1030" border="0" align="center" cellpadding="0" cellspacing="0" style="background: <?php echo $row2[color]; ?>">
  <tr>
    <td colspan="2">
    	<table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
            	<td width="25%" valign="middle">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
					</div><br />

				</td>
                <td valign="bottom"><?php include "admin/botonera/archivos/boton_sec.php"; ?></td>
            </tr>
        </table>    
	</td>	   
  </tr>          
  <tr>
	<td colspan="2">
	 
		<div id="base">


                    <div id="slide">
                          <div class="slideshow">
                          
                          <?php
						  include('scripts/conexion.php');
						  
						  $slide = mysql_query('SELECT img,link FROM slideshow ORDER BY id DESC');
						  while($a_slide = mysql_fetch_array($slide))
						  {
						  ?>
                          <a href="<?php echo $a_slide['link']; ?>" target="_self"><img src="slideshow/<?php echo $a_slide['img']; ?>" width="1024" height="250" border="0" /></a>
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
            
        ?>
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
		                       
 
  	
	<?php
		 
		if($_SESSION["usuario"]==1315){	
	?>
  			<div class="bien">
                  Bienvenido <b><?php echo $_SESSION["nombre"]; ?></b><br />
                  <div class="bien2">
				  	<a class="logb" href="destroy2.php?op=1&tot=<?php echo $_GET["tot"].$linkp; ?>">
				  		Cerrar Sesi&oacute;n
			  		</a>
 				  </div>
            </div>
            <div style="height:20px;"></div>  
	<?php 
	
		}
	?>
		  		<div style="height:20px;"></div>
 		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
       		<tr>
         		<td width="34%" align="center" ><a href="reporte1.php"><img src="boton_contactor.png"  border="0" width="130" height="24" /></a>
         		</td>
       		  <td width="32%" align="center" valign="top"><a href="formulario4.php"><img  border="0" src="boton_contactoh.png" width="130" height="24" /></a></td>
         		<td width="34%" height="21" align="center" valign="top"><a href="formulario5.php"><img border="0" src="boton_contactoc.png" width="130" height="24" /></a></td>

          </tr>

       

       <tr>
         <td  colspan="3" bgcolor="#CCCCCC" align="center"><p><br />
             <span class="txt_4">Pagos realizados</span></p>
         </td>
       </tr>
       <tr>
         <td height="18" colspan="3" bgcolor="#C4ECFF">&nbsp;</td>
       </tr>

        </table>
	 
	 <div style="height:30px;"></div>
	 
	 <?php
	    $currentPage = isset($_GET["page"]) ? $_GET["page"] : 0; 
	 	$pageRecords = 10;
	 	$totalPages;
	 	
	 	//obtenemos el total de registros
	 	$query = "SELECT COUNT(*) FROM pago_registrado WHERE id_cliente=".$_SESSION["codigo"];
	 	$records = mysql_fetch_array(mysql_query($query));
	 	
	 	if($records[0] > 0){
	 		//tenemos registros
	 		$totalPages = (int) ($records[0] / $pageRecords);
	 		if(($records[0] % $pageRecords) > 0){
	 			$totalPages += 1;
	 		}
	 		//ajustamos nuestra cuenta con indices basados en cero
	 		$totalPages += -1;
	 	} else {
	 		$totalPages = -1;
	 	}
	 ?>
	 
	 <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
	 	<th align="center">
	 		Factura
	 	</th>
	 	<th align="center">
	 		Fecha del Pago
	 	</th>
	 	<th align="center">
	 		Nombre
	 	</th>
	 	<th align="center">
	 		Compa&ntilde;ia
	 	</th>
	 	<?php 
	 		if($totalPages < 0){
	 	?>
	 		<tr style="background: #CCCCCC;">
	 			<td colspan="4" align="center">
	 				Disculpe no se encontraron pagos registrados en su cuenta.
	 			</td>
	 		</tr>
	 	<?php
	 		} else {
	 			//tenemos pagos
	 			$query = "SELECT id, cod_factura, DATE(fecha_pago) AS fecha_pago, nombre_pagador, cia_pagadora "
	 			." FROM pago_registrado"
	 			." WHERE id_cliente=".$_SESSION["codigo"]
	 			." ORDER BY fecha_pago desc, cod_factura"
	 			." LIMIT ".($pageRecords * $currentPage).",".($pageRecords);
	 			
	 			$result = mysql_query($query);
	 			$putStyle = true;
	 			
	 			echo "<input type=\"hidden\ name=\"numRows\" value=\"".mysql_num_rows($result)."\" />";
	 			echo "<input type=\"hidden\ name=\"query\" value=\"".$query."\" />";
	 			
	 			if(mysql_num_rows($result) > 0){
	 				//dibujamos los pagos
	 				while($pago = mysql_fetch_array($result)){
	 	?>
	 					<tr align="center" <?php echo ($putStyle ? "style=\"background: #CCCCCC;\"" : "");?>>
	 						<td><?php echo $pago["cod_factura"];?></td>
	 						<td><?php echo $pago["fecha_pago"];?></td>
	 						<td><?php echo $pago["nombre_pagador"];?></td>
	 						<td><?php echo $pago["cia_pagadora"];?></td>
	 					</tr>
	 	<?php
	 					$putStyle = !$putStyle;
	 				}
	 			} else {
	 	?>
	 				<tr style="background: #CCCCCC;">
			 			<td colspan="4" align="center">
			 				Disculpe. P&aacute;gina fuera de rango
			 			</td>
			 		</tr>
	 	<?php
	 			}
	 		}
	 		
	 		mysql_close();
	 	?>
	 	
	 	<tr>
	 		<td colspan="4" align="center">
	 		<?php 
	 			if($currentPage > 0){
	 		?>
	 			<a href="formulario4.php?page=0" title="P&aacute;gina inicial"><img border="0" src="img/yearBackward_normal.gif"></img></a>
	 			&nbsp;&nbsp;&nbsp;&nbsp;
	 			<a href="formulario4.php?page=<?php echo $currentPage - 1;?>" title="P&aacute;gina anterior"><img border="0" src="img/monthBackward_normal.gif"></img></a>
	 			&nbsp;&nbsp;&nbsp;&nbsp;
	 		<?php	
	 			}
	 		?>
	 		<?php 
	 			if($currentPage < $totalPages){
	 		?>
	 			<a href="formulario4.php?page=<?php echo $currentPage + 1;?>" title="P&aacute;gina siguiente"><img border="0" src="img/monthForward_normal.gif"></img></a>
	 			&nbsp;&nbsp;&nbsp;&nbsp;
	 			<a href="formulario4.php?page=<?php echo $totalPages;?>" title="&Uacute;ltima p&aacute;gina"><img border="0" src="img/yearForward_normal.gif"></img></a>
	 			&nbsp;&nbsp;&nbsp;&nbsp;
	 		<?php	
	 			}
	 		?>
	 			
	 		</td>
	 	</tr>
	 </table>
		
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
          		</div>
        	</form>
        
			<div style="height: 20px;"></div>
            
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
      	<!-- Espacio para los banners -->
	</td>
  </tr>
</table>
</div>

</body>
</html>
