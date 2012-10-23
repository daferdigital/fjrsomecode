<?php

/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */


/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */


session_start(); 
extract($_REQUEST);
include("conexion.php");
include("admin/botonera/archivos/botonFunciones.php");



$registro= 1;

if (isset($login1)) {

if (strcmp($clave1,$clave2)==0){
	
$fecha= date ( "Y-m-d" );
$clave=md5($_POST["clave1"]);

$sql= "SELECT login FROM clientes WHERE login='$login1'";
$consulta= mysql_query($sql,$conexion);
$num= mysql_num_rows($consulta);

if($num==0){
	
/*$row= mysql_fetch_array($consulta);

if(strcmp($login1,$row['login'])==0){*/
	if(is_numeric($cedula)){
		$sql="insert into clientes values(null,'".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["login1"]."','".$clave."',
     	 	'".$_POST["cedula"]."','".$_POST["direccionh"]."','".$_POST["direcciontar"]."','".$_POST["telefono"]."','".$fecha."','1')";

		$consulta=mysql_query($sql,$conexion);

		if (!mysql_error()) { 
?>
   			<script>alert('Se registro correctamente');</script>
<?php
   			$registro=2;
 		} else { 
?>
  			<script>alert('Error al introducir los datos, vuelva a intentarlo');</script> 
<?php 
 		}
 	}else{
?>
 		<script>alert('La cedula debe estar compuesta de solo numeros, vuelva a intentarlo');</script> 
<?php
	}
}else{
?>
		<script>
			alert('Su email ya esta siendo usado por otro usuario, por favor introduzca un email diferente');
		</script> 
<?php	
}
 }else{
	
	echo "<script>alert('Sus claves no concuerdan. Por favor introduzcalas correctamente');</script>";
}
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
  	
	<?php
		 
		$linkp= "";
			
		if(isset($_REQUEST['b'])){
			$linkp= "&b=".$_REQUEST['b'];				
		}else if(isset($_REQUEST['s'])){
			$linkp= "&s=".$_REQUEST['s'];
		}	
	?>
		 
 		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
       		<tr>
         		<td height="293" colspan="2" valign="top"><p id="Mlogin" name="Mlogin" class="titulomenor">Verificaci&oacute;n de Usuario</p>
         		<br />
       		  <div align="center"> <i>Si Ud es un <b>Usuario Registrado</b>, a continuaci&oacute;n </i><br />
                    <i>introduzca su email y clave</b></i> </div>
                  <br />
                  <form id="formu" name="formu" method="post" action="<?php echo "control2.php?op=3".$linkp;?>">
                    <table width="273" border="0" align="center">
                      <tr>
                        <td colspan="2" align="center" valign="middle" bgcolor="#EBE9ED" class="reg"><strong>Entrar</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2"><?php 
						if(isset($_GET["error"]) && $_GET["error"]==1) { 
							print "<span class='loga'>Su email o clave estan errados</span>"; 
						} 
					?></td>
                      </tr>
                      <tr>
                        <td width="56"><strong>Email</strong></td>
                        <td width="207"><input name="login" type="text" id="login" /></td>
                      </tr>
                      <tr>
                        <td><strong>Clave</strong></td>
                        <td><input name="clave" type="password" id="clave" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center"><input type="submit" id="Mlogin" name="Mlogin" value="Entrar" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right"></td>
                      </tr>
                    </table>
                  </form>
                  <br />
                  <br />
                  <?php 
  
  	if($registro!=2){
  ?>
                  <div align="center"> <i>Sino, por favor introduzca sus datos personales</i><br />
                    <i>en el siguiente <b>Formulario de Registro</b></i> </div>
                  <br />
                  <form id="form2" name="form1" method="post" action="<?php "formulario2.php?$linkp";?>">
                    <table width="59%" border="0" align="center">
                      <tr>
                        <td colspan="2" align="center" valign="middle" bgcolor="#CCCCCC"><strong class="reg">Registro de Usuario </strong></td>
                      </tr>
                      <tr>
                        <td width="41%"><strong>Email</strong></td>
                        <td width="59%"><input name="login1" type="text" id="login1" maxlength="30" size="21" /></td>
                      </tr>
                      <tr>
                        <td><strong>Clave</strong></td>
                        <td><input name="clave1" type="password" id="clave1" maxlength="30" size="21" /></td>
                      </tr>
                      <tr>
                        <td><strong>Confirmar Clave</strong></td>
                        <td><input name="clave2" type="password" id="clave2" maxlength="30" size="21" /></td>
                      </tr>
                      <tr>
                        <td><strong>Nombre</strong></td>
                        <td><input name="nombre" type="text" id="nombre" maxlength="30" size="21"/></td>
                      </tr>
                      <tr>
                        <td><strong>Apellido</strong></td>
                        <td><input name="apellido" type="text" id="apellido" maxlength="30" size="21"/></td>
                      </tr>
                      <tr>
                        <td><strong>Cedula</strong></td>
                        <td><input name="cedula" type="text" id="cedula" maxlength="8" size="21"/></td>
                      </tr>
                      <tr>
                        <td><strong>Telefono</strong></td>
                        <td><input name="telefono" type="text" id="telefono" maxlength="30" size="21"/></td>
                      </tr>
                      <tr>
                        <td valign="middle"><strong>Direcci&oacute;n <br />
                        </strong></td>
                        <td><textarea name="direccionh" id="direccionh" cols="16" rows="3" ></textarea></td>
                      </tr>
                      <tr>
                        <td valign="middle"><strong>Comentario</strong></td>
                        <td><textarea name="direcciontar" id="direcciontar" cols="16" rows="3" ></textarea></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><label>
                          <input name="Submit2" type="submit"  value="Registrar" />
                        </label></td>
                      </tr>
                    </table>
                </form>	<?php
		}else{
			echo "<div style='height: 60px;'></div>";				
		}
	?></td>

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
