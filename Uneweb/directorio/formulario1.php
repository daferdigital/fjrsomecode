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
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<?php 
	cargarEstilosDin();
	if ($tipoFondo==2){ cargarDegrade2(); } 
?>
<link href="scripts/estilos.css" rel="stylesheet" type="text/css" />
<!-- script para manejo de estados y ciudades -->
<script type="text/javascript">
	<?php include ("scripts/ubicaciones.php");?>
</script>
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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/validaciones.js"></script>
</head>

<body style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>
    <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" style="background: <?php echo $row2['color']; ?>">
  <tr>
    <td colspan="3"><table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
            	<td width="25%"  valign="bottom">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
				     </div><br />

				    
				</td>
               <td valign="bottom">
                 <?php include "admin/botonera/archivos/boton_sec.php"; ?>
              </td>
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
                    
	</div><br />


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
    	<div style="height:25px;"></div>
    	<!-- Espacio para las categorias -->
	     	
   		<!-- Espacio para las categorias -->
    	<div style="height:25px;"></div>
    </td>
  </tr>
  <tr>
    <td width="68%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px; font-weight: bold;">
		<!-- Espacio para el contenido -->
		                       
  		<div style="height:20px;"></div>
  	
	<?php
		 
		$linkp= "";
			
		if(isset($_REQUEST['b'])){
			$linkp= "&b=".$_REQUEST['b'];				
		}else if(isset($_REQUEST['s'])){
			$linkp= "&s=".$_REQUEST['s'];
		}	
	?>
		 
    <?php
	if(isset($_POST['nombre'])) {
		if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
			// Insert you code for processing the form here, e.g emailing the submission, entering it into a database.
			unset($_SESSION['security_code']);
			
			$nombre = addslashes(trim($_POST['nombre']));
			$rif = addslashes(trim($_POST['rif']));
			$tipo = addslashes(trim($_POST['tipoTmp']));
			$familia = addslashes(trim($_POST['familia']));
			$direccion = addslashes(trim($_POST['direccion']));
			$telefono = addslashes(trim($_POST['telefono']));
			$correo = addslashes(trim($_POST['correo']));
			$estado = addslashes(trim($_POST['estado']));
			$ciudad = addslashes(trim($_POST['ciudad']));
			$municipio = addslashes(trim($_POST['municipio']));
			$website = addslashes(trim($_POST['website']));
			$terminos = addslashes(trim($_POST['terminos']));
			//$estatus = addslashes(trim($_POST['estatus']));
			
			$guardar = mysql_query('INSERT INTO directorio(nombre,rif,tipo,familia,direccion,telefono,correo,estado,ciudad,municipio,website,terminos,estatus) VALUES("'.$nombre.'","'.$rif.'","'.$tipo.'","'.$familia.'","'.$direccion.'","'.$telefono.'","'.$correo.'","'.$estado.'","'.$ciudad.'","'.$municipio.'","'.$website.'","'.$terminos.'","1")');
			
			if($guardar == true) {
				echo '<script language="javascript">alert("Su registro ha sido exitoso.");</script>';
			}
		} else {
			// Insert your code for showing an error message here
			echo '<script language="javascript">alert("El codigo de validacion no es correcto, intente de nuevo.");</script>';
		}
}?>
         
         
 		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
       		<tr>
         		<td height="293" colspan="2" valign="top">
         		<form action="" method="post" enctype="multipart/form-data" name="miForm" id="miForm" onsubmit="prepareOficios(document.getElementById('tipo')); MM_validateForm2('nombre','Nombre','R','rif','Cedula/RIF','R','cedula','Cedula/RIF','R','tipoTmp','Area de Servicio','R','familia','Descripcion del servicio','R','direccion','Direccion','R','telefono','Telefono','R','telf','Telefono','R','municipio','Municipio','R','security_code','Codigo de validacion','R');return document.MM_returnValue">
         		  <table width="553" border="0" align="center">
         		    <tr>
         		      <td colspan="2" bgcolor="#CCCCCC" class="txt1">Llene los datos para registrarse en el Directorio de Proveedores<br /></td>
       		        </tr>
         		    <tr>
         		      <td width="256" class="txt1">::: Nombre y Apellido</td>
         		      <td width="287">
         		        <label>
         		          <input type="text" name="nombre" id="nombre"  />
       		            </label>
       		          </td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: C&eacute;dula de identidad</td>
         		      <td><label>
         		        <input type="text" name="rif" id="rif" />
       		        </label></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">
         		      		::: Area de servicio<br />
         		      		<span class="none" style="font-size: 11px; font-weight: normal;">
         		      			Para indicar varios oficios presione la tecla Control (Ctrl) 
         		      			y haga click en el nombre del oficio que desea seleccionar
         		      		</span>
         		      </td>
         		      <td>
         		        <input  type="hidden" name="tipoTmp" id="tipoTmp"/>
         		      	<select name="tipo" id="tipo"  multiple="multiple" size="5">
         		      	<?php 
         		      		$query = "SELECT id, nombre FROM oficios ORDER BY LOWER(nombre)";
         		      		$consulta = mysql_query($query);
         		      		while(list($id, $nombre) = mysql_fetch_array($consulta)){
         		      	?>
         		      			<option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
         		      	<?php 
         		      		}
         		      	?>
						</select>
					</td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Descripci&oacute;n de servicios y/o productos</td>
         		      <td><label>
         		        <textarea name="familia" id="familia" cols="45" rows="5"></textarea>
       		        </label></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Direcci&oacute;n</td>
         		      <td><span id="sprytextfield4">
         		        <label>
         		          <input type="text" name="direccion" id="direccion"  />
       		          </label>
       		        </span></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Tel&eacute;fonos/Fax</td>
         		      <td><span id="sprytextfield5">
         		        <label>
         		          <input type="text" name="telefono" id="telefono"/>
       		          </label>
       		        </span></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Correo (E-Mail)</td>
         		      <td><span id="sprytextfield6">
         		        <label>
         		          <input type="text" name="correo" id="correo"  />
       		          </label>
       		        </span></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Estado</td>
         		      <td>
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
       		          </td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Ciudad</td>
         		      <td><span id="sprytextfield8">
         		          <select name="ciudad" id="ciudad">
         		          </select>
       		        </span></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: Municipio</td>
         		      <td><input type="text" name="municipio" id="municipio"  /></td>
       		      </tr>
         		    <tr>
         		      <td class="txt1">::: WebSite<font color="red">&nbsp;</font></td>
         		      <td><span id="sprytextfield2">
         		        <label>
         		          <input name="website" type="text" id="website"  />
       		          </label>
       		        </span></td>
       		      </tr>
         		  <tr>
         		      <td><span class="txt1">:::</span> Leer:<br />
	                <a href="http://www.webinteligente.com.ve/gentedeoficio/seccion2.php?id=7&amp;mira=142&amp;s=23">Terminos y condiciones </a><br /></td>
         		      <td><p>
         		        <label>
         		            <input name="terminos" type="radio" id="terminos_0" value="Acepto" checked="checked" />
       		            Acepto</label>
         		          <br />
         		          <label>
         		            <input type="radio" name="terminos" value="No acepto" id="terminos_1" />
         		            No acepto</label>
         		          <br />
       		          </p></td>
       		      </tr>
       		      <tr>
         		      <td>::: C&oacute;digo de validaci&oacute;n</td>
         		      <td>
         		      	<img src="CaptchaSecurityImages.php?width=120&height=50&characters=5" /><br />
						<input id="security_code" name="security_code" type="text" />
         		      </td>
       		      </tr>
         		  <tr>
         		      <td>&nbsp;</td>
         		      <td><label>
         		        <input type="submit" name="button" id="button" value="Enviar" />
       		        </label></td>
       		      </tr>
       		      </table>
   		      </form></td>
       </tr>
       <tr>
         <td height="18" colspan="2">&nbsp;</td>
       </tr>

     </table>
	 
	 <div style="height:30px;"></div>
	 
	 
		
		<!-- Espacio para el contenido -->
	</td>
    <td width="32%" valign="top" align="center">
		<!-- Espacio para los banners -->
	  <div align="center">
                
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

<script type="text/javascript">
<!--
//-->
</script>
</body>
</html>
