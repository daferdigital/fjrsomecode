<?php
	session_start();
	
	if(isset($_SESSION["loggedAsAdmin"]) && $_SESSION["loggedAsAdmin"] == "logged"){
		//acceso valido al sistema
	} else {
		session_destroy();
		//acceso no permitido, llevamos a index
		header("location: index.php");
	}

	include("../admin/botonera/archivos/botonFunciones.php");

	$linkp= "";
			
	if(isset($_REQUEST["b"])){
		$linkp= "&b=".$_REQUEST["b"]."&mira=".$mira;				
	}else if(isset($_REQUEST["s"])){
		$linkp= "&s=".$_REQUEST["s"]."&mira=".$mira;
	}
		
	$boton= obtenerBoton();
	$tipoFondo= obtenerFondo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php mostrarTitulo($boton,$empresa)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<script src="../admin/botonera/scripts/images.js" type="text/javascript"></script>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>

<?php 
	cargarEstilosDin();
	if ($tipoFondo==2){ cargarDegrade2(); } 
?>
<link href="../scripts/estilos.css" rel="stylesheet" type="text/css" />
<!-- jQuery -->
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<!-- Slide -->
<script type="text/javascript" src="../scripts/jquery.cycle.all.latest.js"></script>
<!-- Acordion -->
<script type="text/javascript" src="../scripts/jquery.dimensions.js"></script>
<script type="text/javascript" src="../scripts/jquery.accordion.js"></script>
<!-- Scripts -->
<script type="text/javascript" src="../scripts/scripts.js"></script>	
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
                <td valign="bottom"><?php include "../admin/botonera/archivos/boton_sec.php"; ?></td>
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
						  include('../scripts/conexion.php');
						  
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
                include "../admin/botonera/archivos/boton_princH.php";
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
 		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
       <tr>
         <td  colspan="3" bgcolor="#CCCCCC" align="center"><p><br />
             <span class="txt_4">Mensajes del Sistema</span></p>
         </td>
       </tr>
       <tr>
         <td height="18" colspan="3" bgcolor="#C4ECFF">&nbsp;</td>
       </tr>

        </table>
	 
	 <form action="sendMessage.php" method="post" enctype="multipart/form-data">
	 <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
	 	<tr>
            <td width="25%" style="padding-left: 6px;">
				<b>Mensaje a Enviar</b>
			</td>
			<td align="center">
				<textarea name="comentarios" cols="40" rows="8"></textarea>
			</td>
		</tr>
		<tr>
            <td width="25%" style="padding-left: 6px;">
				<b>Archivos Adjuntos</b>
			</td>
			<td align="center">
				<br />
				<input type="file" name="adjunto[]"/>
				<br />
				<input type="file" name="adjunto[]"/>
				<br />
				<input type="file" name="adjunto[]"/>
				<br />
				<input type="file" name="adjunto[]"/>
			</td>
		</tr>
		<tr>
            <td width="25%" style="padding-left: 6px;">
				<b>Destinatarios</b>
				<br />
				Ctrl+click para seleccionar varios
			</td>
			<td align="center">
				<br />
				<input type="checkbox" value="1" name="todosClientes"/> Enviar a todos
				<br />
				<select multiple="multiple" name="clientes[]" size="7" style="width: 80%">
				<?php 
				    $query = "SELECT id, login, nombre, apellido FROM clientes ORDER BY nombre, apellido";
				    $result = mysql_query($query);
				    
				    while($row = mysql_fetch_array($result)){
				    	echo "<option value=\"".$row["id"].";".$row["login"]."\">".$row["nombre"].$row["apellido"]."</option>";
				    }
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr align="center">
			<td colspan="2"><input type="button" value="Enviar Mensaje" onclick="javascript: this.form.submit()"/> </td>
		</tr>
	 </table>
	 </form>
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
<?php 
	mysql_close();
?>
</body>
</html>
