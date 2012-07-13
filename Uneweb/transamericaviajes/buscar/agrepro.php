<?php 
session_start();
include "conexion.php";
include "utilCalendarDay.php";


if($_SESSION["activo"]!= 1){
	header("location: index.php");
	exit();
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

"http://www.w3.org/TR/html4/loose.dtd">

<html>

	<head>
<?php include "help/help-config.php"?>
	

	<title>.: Administrador de Contenidos :.</title>

	

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

		<link href="../contenido/css/estilo.css" rel="stylesheet" type="text/css">
		<link href="css/estiloBuscadores.css" type="text/css" rel="stylesheet"/>
		<script type="text/javascript" src="buscador.js"></script>
	    <style type="text/css">

<!--

-->

        </style>

	

<script type="javascript"> </script>

</head>

<body>
		  <div align="center">
		  
		  	<?php include "menu.htm"?>
		  	
		  	<table align="center" style="width: 770px">
				<tr> 
					<td>
						<div align="right">
							<a href="destroy.php" style="float:right" title="Cerrar Sesión">
								<img src="img/close.png" border="0" />
							</a>
							 <a href="help/seccion7.php" onclick="return hs.htmlExpand(this, { objectType: 'ajax' } )" style=" float:right; margin-right: 3px" title="Ayuda">
								<img src="img/help.png" border="0"/>
							</a>
						</div>
					</td>
			 	</tr>
			</table>
		  
	  		<label style="font-size: 24px; font-family: Verdana;">
				Crear Tema
			</label>
			
			<div style="height: 30px;"></div>

			<div align="center" style="font-size: 14px; font-family: Georgia; text-align: center;">  
				Seleccione la secci&oacute;n donde desea agregar el Tema:<br /><br />
						
				<b>Nota: </b> solo puede agregar Temas en las Secciones de tipo: <br />
				<b>Noticias Tipo Revista, Noticias Tipo Blog y Servicios</b>   
			</div>
			
			<div style="height: 20px;"></div>
			
		  
		  <form name="form2" method="post" action="">
		    <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
		      <select name="seccion" id="seccion">
			<?php   
				include("conexion.php");
				$sql="select * from secciones WHERE tipo in (2,3,12) order by nombre";
				$ver=mysql_query($sql,$conexion);
				
				while($fila=mysql_fetch_array($ver)){  ?>
		          <option value="<?php print $fila[0]; ?>"
				  	<?php if(isset($_POST["seccion"]) && ($_POST["seccion"]==$fila[0])){ echo "selected='selected'";} ?>
				  >				  
				  	<?php print $fila[1]; ?>
				  </option>
		  <?php }?>
	            </select>
	        </font>
	          <label>
	          <input type="submit" name="Submit2" value="Escoger" />
	          
	          </label>
		    </div>
		  </form>
		  
		  <div style="height: 15px;"></div>
		  
		  <?php 
		  
		  
		  
		  if(isset($_POST["seccion"])){ 
		  	
		  	$sql3="select tipo from secciones WHERE id='$_POST[seccion]'";
		  	$consulta3= mysql_query($sql3, $conexion);
		  	$row3= mysql_fetch_array($consulta3);
		  	
		  	$tipoSeccion= $row3[0];
			  	
		  ?>
		  
		  <p align="center">&nbsp;</p>
		  
		  <p align="center"><b> Insertar Temas </b>
		  
		    
		    <br /><br />
	        <strong>Indicaciones:</strong> Colocar Fuente Arial, Tama&ntilde;o xsmall, los p&aacute;rrafos <strong>no </strong>deben estar muy separados 
	        
	        
	        <div style="height: 25px;"></div>
		   <?php



include("fckeditor/FCKeditor/fckeditor.php") ;

include("conexion.php");



$cate="select id,categoria from tipo";



$ver=mysql_query($cate,$conexion);



?>
    </font><font size="2" face="Arial, Helvetica, sans-serif"><strong><a href="../contenido/cargaravan.php"></a></strong></font></p>

		  <div align="center">
		    <form action="" method="post" enctype="multipart/form-data" name="form1">
              <p align="center"><font size="2" face="Arial, Helvetica, sans-serif">Titulo
                <input name="titulo" type="text" id="titulo" size="30">
              </font></p>
		      <p align="center"><font size="2" face="Arial, Helvetica, sans-serif">Descripcion: </font>
		          <?php

				// Creamos El Area de Texto description_art

				$oFCKeditor = new FCKeditor('dale') ; // es el id y name del campo de texto

				$oFCKeditor->BasePath = 'fckeditor/FCKeditor/'; // ruta al script fckeditor

				$oFCKeditor->Width  = '700' ; // ancho del formulario

				$oFCKeditor->Height = '500' ; // alto del formulario

				$oFCKeditor->Create() ; // ordena se cree el textarea

				?>
              </p>
		      <p align="center">
                <label></label>
                <font size="2" face="Arial, Helvetica, sans-serif">Imagen
                  <input name="imagen" type="file" id="imagen" />
              </font><br>
		      Im&aacute;genes tama&ntilde;o 195 x 147 pixel, formato JPEG, GIF </p>
		      <p align="center">&nbsp;</p>
		      <p align="center">Status:
		        <label>
                  <select name="status" id="status">
                    <option value="1">Vigente</option>
                    <option value="2">No Vigente</option>
                  </select>
                </label>
                <input name="seccion" type="hidden" id="seccion" value="<?php print $_POST[seccion]?>">
		      </p>
		      
		      <?php
      			
      			if($tipoSeccion==12){
		      ?>
		      <p align="center">Precio:
		            <input name="precio" type="text" id="precio" value="" /> BsF.
			        <br>
			      </p>
			  <?php
			  	}
			  ?>  
			  <br>
			  <br>
			  
			  <span id="#mes">
			  	Salidas: 
			  	&nbsp;&nbsp;
			  	<a href="#mes" onclick="showPrevMont()" style="font-size: 16px; font-weight: bold;"> Mes previo &lt; </a>
				&nbsp;&nbsp;
				<a href="#mes" onclick="showNextMont()" style="font-size: 16px; font-weight: bold;"> Pr&oacute;ximo mes &gt; </a>
			  </span> 
			  <?php echo getDivDiasInfo(); ?>
			  
<p align="center">
        <label>Subsecciones:
                  <select name="tipo" id="tipo">
                  <?php
					$cate="select id,categoria from tipo where  seccion='$_POST[seccion]' ";
					$ver=mysql_query($cate,$conexion);

		while(list($id,$descat)=mysql_fetch_array($ver)){ ?>
                  <option value="<?php print $id; ?>"><?php print $descat; ?></option><?php }?>
                </select>
        </label>
 				
				 <br /><br />               
                <label style="color:red">  <b>Nota:</b> Debe Agregar Subsecciones antes de Agregar Temas</label>
              </p>
		      <p>
                <label></label>
              </p>
		      <p align="center">
                <input type="submit" name="Submit" value="Enviar">
              </p>
		      <p align="center">&nbsp;</p>
	        </form>
		    <font size="2" face="Arial, Helvetica, sans-serif">
		    <?php

				if(isset($_POST["titulo"])){
					$img=$_FILES['imagen']['tmp_name'];
					$tipoimg=getimagesize($_FILES['imagen']['tmp_name']);
					
					if($tipoimg[2]==1){
						$ext=".gif";
					} elseif($tipoimg[2]==2){
						$ext=".jpg";
					} elseif($tipoimg[2]==3){
						$ext=".png";
					} else{ 
						$tipoimagen=1; 
					}

					if($tipoimagen==1){
						print "El archivo de la imagen no es valido escoja solo archivos de tipo gif,jpg,swf solamente"; 
					} else{
						include("conexion.php");
						$buscar="SELECT max(id)FROM programas";
						$consulta2=mysql_query($buscar,$conexion);

						if(list($idnot)=mysql_fetch_array($consulta2)){
							$dimagen2=$idnot+1;
						}
						
						$dimagen="imgnot/noticia_".$dimagen2.$ext;
						
						if(!copy($_FILES['imagen']['tmp_name'],$dimagen)){
							echo "No subio la imagen";
						} else{
							echo "La imagen subio con exito";
						}
						
						$sql="insert into programas values('','$_POST[titulo]','$_POST[dale]','$_POST[precio]','$dimagen','$_POST[status]','$_POST[tipo]','$_POST[seccion]','$_POST[salidas]')";
						
						$consulta=mysql_query($sql,$conexion);
						
						if(!mysql_error()){
							print("<br>");
							print("La insercion tuvo exito");} else{ print("disculpe estamos en mantenimiento intente en 5 minutos");
						}
					}

					mysql_close($conexion);
				}
		  }?>
		    </font></div>
		  <p>&nbsp;</p>

        </div>

</body>

</html>

