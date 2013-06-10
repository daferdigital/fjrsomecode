<?php 
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php mostrarTitulo($boton,$empresa)?></title>
	<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
	<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>
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
</head>

<body onload="<?php onloadFun(); ?>" style="<?php cargarFondo($tipoFondo);?>" <?php aplicarClase($tipoFondo);?>>
<?php
function form_mail($sPara, $sAsunto, $sTexto, $sDe)
{
$bHayFicheros = 0;
$sCabeceraTexto = "";
$sAdjuntos = "";

if ($sDe)$sCabeceras = "From:".$sDe."\n";
else $sCabeceras = "";
$sCabeceras .= "MIME-version: 1.0\n";
foreach ($_POST as $sNombre => $sValor)
$sTexto = $sTexto."\n".$sNombre." = ".$sValor;

foreach ($_FILES as $vAdjunto)
{
if ($bHayFicheros == 0)
{
$bHayFicheros = 1;
$sCabeceras .= "Content-type: multipart/mixed;";
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

$sTexto = $sCabeceraTexto.$sTexto;
}
if ($vAdjunto["size"] > 0)
{
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";

$oFichero = fopen($vAdjunto["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);
}
}

if ($bHayFicheros)
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";
return(mail($sPara, $sAsunto, $sTexto, $sCabeceras));
}

//cambiar aqui el email
if (form_mail("descargamynx@gmail.com", "Registro para descarga",
"Los datos introducidos en el formulario Centro de aprendizaje son:\n\n", $_POST[email]))
echo "Su solicitud ha sido exitosa";
?>
<div id="cuerpo" align="center" style="margin: 0px;">
<table width="1039" border="0" align="center">
	<tr>
    <td colspan="2">
    	<table align="center" cellpadding="0" border="0" cellspacing="0" width="100%">	
			<tr>
            	<td width="25%" valign="middle">
					<div style="margin-left: 13px;"> 
						<?php logo(); ?>
					</div>
				</td>
                <td valign="bottom"><?php include "admin/botonera/archivos/boton_sec.php"; ?></td>
            </tr>
        </table>    
            
      </td>	   
  </tr>          
  <tr>
	<td colspan="2">
		<!-- Espacio para el flash, sustituir por el verdadero -->
	    
			<div id="base">


                    <div id="slide">
                          <div class="slideshow">
                          
                          <?php
						  include('scripts/conexion.php');
						  
						  $slide = mysql_query('SELECT img,link FROM slideshow ORDER BY id DESC');
						  while($a_slide = mysql_fetch_array($slide))
						  {
						  ?>
                          <a href="<?php echo $a_slide['link']; ?>" target="_self"><img src="slideshow/<?php echo $a_slide['img']; ?>" width="1024" height="350" border="0" /></a>
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
    <td colspan="2"><h2>Bienvenidos al Centro de aprendizaje de MynxGrip Grip<br />
    </h2>
    <p>&nbsp; </p></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><h3>Al finalizar el TUTORIAL 1 se encuentra el link del CUESTIONARIO 1</h3></td>
    <td bgcolor="#000000"><h3>Al finalizar el TUTORIAL 2 se encuentra el link del CUESTIONARIO 2</h3></td>
  </tr>
  <tr>
    <td width="537"><h1><a href="http://www.bormedicave.com/tutorial/Fundamentos de Technology del Mynx Grip F1.pdf">Descargar TUTORIAL 1</a></h1></td>
    <td width="495"><h1><a href="http://www.bormedicave.com/tutorial/Fundamentos de Technology del Mynx Grip F2.pdf">Descargar TUTORIAL 2</a></h1></td>
  </tr>
  <tr>
    <td><a href="http://www.bormedicave.com/tutorial/Fundamentos de Technology del Mynx Grip F1.pdf"><img src="img1.jpg" width="460" height="250" /></a></td>
    <td><a href="http://www.bormedicave.com/tutorial/Fundamentos de Technology del Mynx Grip F2.pdf"><img src="img2.jpg" width="457" height="248" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
