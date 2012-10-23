<?php

/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */


session_start(); 
extract($_REQUEST);
include("conexion.php");
include("admin/botonera/archivos/botonFunciones.php");

if($_SESSION["usuario"]==1315){
	//$i=0; //Nada
}else{
	header("location: formulario2.php?$linkp");
}

//datos de la cuenta
$banco = "Banesco";
$tipo_cta = "Corriente";
$num_cta = "XXXXX-XXXXX-XXXXX-XXXXX";

$boton= obtenerBoton();
$tipoFondo= obtenerFondo();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php mostrarTitulo("",$empresa)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<?php 
	cargarEstilosDin();
	if ($tipoFondo==2){ cargarDegrade2(); } 
?>
<link href="scripts/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/jsDatePick_ltr.css" rel="stylesheet" type="text/css" />
<!-- jQuery -->
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<!-- Slide -->
<script type="text/javascript" src="scripts/jquery.cycle.all.latest.js"></script>
<!-- Acordion -->
<script type="text/javascript" src="scripts/jquery.dimensions.js"></script>
<script type="text/javascript" src="scripts/jquery.accordion.js"></script>
<!-- Scripts -->
<script type="text/javascript" src="scripts/scripts.js"></script>
<script src="scripts/jsDatePick.full.1.3.js" type="text/javascript"></script>

<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener un correo.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe contener números.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
    } if (errors) alert('Favor llenar los campos:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
</head>

<body onload="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>

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
    	<div style="height:5px;"></div>
    	<!-- Espacio para las categorias -->
	     	<table width="716" height="25" border="0" align="center">
	        <tr>
	        	<!--
	            <td width="100" align="center" valign="middle" class="menucat1">
	           		Seleccione una Categor&iacute;a
	          	</td>
		        <td class="menucat2" width="140" align="left" valign="top"><?php categorias_prod(0,3)?></td>
	         	<td class="menucat2" width="130" align="left" valign="top"><?php categorias_prod(3,3)?></td>
	         	<td class="menucat2" width="145" align="left" valign="top"><?php categorias_prod(6,3)?></td>
	         	<td class="menucat2" width="150" align="left" valign="top"><?php categorias_prod(9,3)?></td>
	         	-->
	       	</tr>
	   		</table>
   		<!-- Espacio para las categorias -->
    	<div style="height:5px;"></div>
    </td>
  </tr>
  <tr>
    <td width="68%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">
		<!-- Espacio para el contenido -->
		                       
  		<div style="height:20px;"><?php
		 
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
  		
  		  <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
  		    <tr>
  		      <td width="34%" align="center" ><a href="reporte1.php"><img src="boton_contactor.png"  border="0" width="130" height="24" /></a></td>
  		      <td width="32%" align="center" valign="top"><a href="formulario4.php"><img border="0" src="boton_contactoh.png" width="130" height="24" /></a></td>
  		      <td width="34%" height="21" align="center" valign="top"><a href="formulario5.php"><img  border="0" src="boton_contactoc.png" width="130" height="24" /></a></td>
	        </tr>
	      </table>  <div style="height:20px;"></div>
  		  <p>&nbsp;</p>
  		</div>
  		
  		<form action="registrarPago.php" method="post" name="miForm" id="miForm" onsubmit="MM_validateForm('cedrif','','NisNum','email','','NisEmail','telefono','','NisNum','cel','','NisNum','transaccion','','NisNum','direccion','','R','fechaPago','','R');return document.MM_returnValue">
  		  <table width="390" border="0" align="center">

		<tr>
        	<td height="23" colspan="2"><br />
				
			<div align="center" >
			  	<p>&nbsp;</p>
			  	<p><span style="font-family: Verdana; font-size: 22px;">Reporte de Pago<br />
			  	  </span>Favor realizar sus dep&oacute;sitos en:
			  	  </p>
			</div>
		     
		    <div style="height: 13px"></div>
		    
		    <div align="left" style="padding-left: 25px;">
				<ul >
					<li><b>Banco:</b> <?php echo $banco;?></i></li>
					<li><b>Tipo de Cuenta:</b> <?php echo $tipo_cta;?></i></li>
					<li><b>No de Cuenta:</b> <?php echo $num_cta;?></i></li>
				</ul>
		    </div>
			
			<br />
			
			<div align="center" name="nota" id="nota">
			  	Una vez realizado el dep&oacute;sito, favor notificarlo <br /> suministrando los siguientes datos:
			</div>
        </tr>
    </table>
	
	<div style="height: 30px"></div> 
	
	<table width="365" border="0" style="border: 1px solid black;" align="center" cellpadding="2" cellspacing="0">   
        <tr>
            <td width="148" style="padding-left: 6px;">
				Nombre y Apellido:
			</td>
			<td width="207" align="center">
				<input name="nombre" type="text" id="nombre" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Compa&ntilde;ia (opcional):
			</td>
			<td align="center">
				<input type="text" name="compania" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				C&eacute;dula / RIF
			</td>
			<td align="center">
				<input name="cedula_rif" type="text" id="cedula_rif" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Email
			</td>
			<td align="center">
				<input name="email" type="text" id="email" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Direcci&oacute;n
			</td>
			<td align="center">
				<textarea name="direccion" cols="19" rows="4" id="direccion"></textarea>
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Tel&eacute;fono
			</td>
			<td align="center">
				<input name="telefono" type="text" id="telefono" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Celular
			</td>
			<td align="center">
				<input name="celular" type="text" id="celular" size="25" maxlength="30" />
			</td>
		</tr>
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Nro de Transacci&oacute;n
			</td>
			<td align="center">
				<input name="transaccion" type="text" id="transaccion" size="25" maxlength="30" />
			</td>
		</tr>
		<tr>
            <td style="padding-left: 6px;">
				Nro de Factura
			</td>
			<td align="center">
				<?php
		
					if(isset($factura) && $factura>0){
				?>		
					<input name="factura" type="text" id="factura" value="<?php echo $factura; ?>" size="25" 
					maxlength="30" readonly="yes" />
				<?php 
					}else{
				?>			
					<input name="factura" type="text" id="factura" size="25" maxlength="30" />	
				<?php	 } ?>	
			</td>
		</tr>
		<tr>
			<td width="148" style="padding-left: 6px;">
				Fecha del pago
			</td>
			<td width="207" align="center">
				<input type="text" id="fechaPago" name="fechaPago" size="25" readonly="true"/>
			
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaPago",        
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%Y-%m-%d",
				        imgPath:"css/img/"
				    });
				</script>
			</td>
		</tr>		
		<tr style="background: #CCCCCC;">
            <td style="padding-left: 6px;">
				Comentarios
			adicionales</td>
			<td align="center">
				<textarea name="comentarios" cols="19" rows="4"></textarea>
			</td>
		</tr>
	</table>

	<div style="height: 20px"></div>
	 
	<div align="center">
    	<input type="submit" name="enviar" value="Enviar" />
    </div>          

  </form>	
		
	<div style="height:60px;"></div>
		
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
