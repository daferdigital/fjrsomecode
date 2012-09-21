<?php



/**

 * @author David Antunes

 * @project 3WEditable - 2009

 */





session_start(); 

extract($_REQUEST);

	include_once("conexion.php");
	include_once("tuningPaquetes.php");

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


<script type="text/javascript" src="buscador.js"></script>

<?php 

	cargarEstilosDin();

	if ($tipoFondo==2){ cargarDegrade2(); } 

?>
<script type="text/javascript">
		function validateCedulaAndSubmit(formToValidate){
			var doSubmit = true;
			var cedulaValue = formToValidate.cedula.value;
			
			if(cedulaValue == null || cedulaValue == ''){
				alert('Disculpe debe indicar un numero de cedula');
				doSubmit = false;
			}

			if (doSubmit) {
				formToValidate.submitButton.disabled = true;
				formToValidate.submit();
			}
		}

		function validateLocalizadorAndSubmit(formToValidate){
			var doSubmit = true;
			var localizadorValue = formToValidate.localizador.value;
			
			if(localizadorValue == null || localizadorValue == ''){
				alert('Disculpe debe indicar un numero de localizador');
				doSubmit = false;
			}

			if (doSubmit) {
				formToValidate.submitButton.disabled = true;
				formToValidate.submit();
			}
		}
	</script>
    <script type="text/javascript">
	function validateCedulaAndSubmit(formToValidate){
		var doSubmit = true;
		var cedulaValue = formToValidate.cedula.value;
		
		if(cedulaValue == null || cedulaValue == ''){
			alert('Disculpe debe indicar un numero de cedula');
			doSubmit = false;
		}
		
		if (doSubmit) {
			formToValidate.submitButton.disabled = true;
			formToValidate.submit();
		}
	}

	function validateLocalizadorAndSubmit(formToValidate){
		var doSubmit = true;
		var localizadorValue = formToValidate.localizador.value;
		
		if(localizadorValue == null || localizadorValue == ''){
			alert('Disculpe debe indicar un numero de localizador');
			doSubmit = false;
		}
		
		if (doSubmit) {
			formToValidate.submitButton.disabled = true;
			formToValidate.submit();
		}
	}


</script>

<link href="css/estiloBuscadores.css" type="text/css" rel="stylesheet"/>
    
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



<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->





</head>



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

	<td colspan="4">
<br />

	 			    	    

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

    <td colspan="4" >

    	<div style="height:5px;"></div>

    	<!-- Espacio para las subsecciones -->

          <?php if($mira== 53) {?>

	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#C9D9F2">

	        <?php } ?>

                   <?php if($mira== 81) {?>

	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#DEEF9C">

	        <?php } ?>

                               <?php if($mira== 70) {?>

	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#D6E9F7">

	        <?php } ?>
            
            	     	 <?php if($mira== 72) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#DDD0E6">
	        <?php } ?>
              <?php if($mira== 88) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#FEECA5">
	        <?php } ?>
               <?php if($mira== 80) {?>
	     	<table width="1024" height="25" border="0" align="center"  bgcolor="#EAEAEA">
	        <?php } ?>

            <tr>

	            <td width="94" align="center" valign="middle" style="padding-left: 10px; padding-right: 22px">

	           		Seleccione una categor&iacute;a

	          	</td>

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

    <td width="75%" valign="top" align="center" style="padding-left: 15px; padding-right: 15px;">

		<!-- Espacio para el contenido -->

		

	<?php 

	

		/*Inicializacion de la pagina*/

		$fin= 6;

		

		if(isset($_GET[pag])){ 

			$ini=$_GET[pag]*$fin - $fin;

		}else{

			$ini=0;

		}

		

		

		if(isset($_GET[tot])){

			

    		/*Seleccion del Contenido*/

    		$sql="select * from programas where status=1 and categoria='$_GET[tot]' order by id asc limit $ini, $fin";

			$sql2="select * from programas where status=1 and categoria='$_GET[tot]' order by id asc";

			

			/*Consulta y calculo del numero de paginas*/

			$consulta= mysql_query($sql,$conexion);

			$consulta2= mysql_query($sql2,$conexion);

			$numero= mysql_num_rows($consulta2);

			$pagina= ceil($numero/$fin);

			//echo "num: $numero<br>";

			//echo "pag: $pagina<br>";	

	

		

			/*Seleccion del Titulo*/

			$sql3="select categoria from tipo where id='$_GET[tot]'";

			$consulta3=mysql_query($sql3,$conexion);

	

			$fila=mysql_fetch_array($consulta3); 

			

			echo "<p class='titulomenor'>".$fila[0]."</p>"; 

			

			

			/*Mostrar del Contenido*/

			echo "<table align='left' border='0' cellpadding='0' cellspacing='8' >";

		

			while($row= mysql_fetch_array($consulta)){	

	?>

		

			<tr>

				<td colspan="2" align="center" valign="top"><table width="601">

				  <thead><?php if($mira== 53) {?>

				    <tr>

				      <th height="31" colspan="2" align="left" background="banda.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>

			        </tr> <?php } ?>

                          <?php if($mira== 81) {?>

                     <tr>

				      <th height="31" colspan="2" align="left" background="banda2.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>

			        </tr>  <?php } ?>

                         <?php if($mira== 70) {?>

                     <tr>

				      <th height="31" colspan="2" align="left" background="banda3.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>

			        </tr>  <?php } ?>
                    		  <?php if($mira== 72) {?>
                     <tr>
				      <th height="31" colspan="2" align="left" background="banda5.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>
			        </tr>  <?php } ?>
                     <?php if($mira== 88) {?>
                     <tr>
				      <th height="31" colspan="2" align="left" background="banda4.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>
			        </tr>  <?php } ?>
                       <?php if($mira== 80) {?>
                     <tr>
				      <th height="31" colspan="2" align="left" background="banda7.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>
			        </tr>  <?php } ?>
                      <?php if($mira== 83) {?>
                     <tr>
				      <th height="31" colspan="2" align="left" background="banda7.png" class="txt_1" >&nbsp;&nbsp;<?php echo $row[titulo];?></th>
			        </tr>  <?php } ?>

			      </thead>

				  <tr>

				    <td width="10%" height="56"><img src="<?php echo "admin/".$row[foto]; ?>" width="130" height="95"/></td>

				    <td width="74%"><div align="left">

    						<?php echo substr(html_entity_decode($row[descripcion]),0,200);?>...

<div style="height:5px;"></div> <?php $link= linkServicios2($row[id]); ?>

                   			<a href="<?php echo $link;?>">

    	   						<i>M&aacute;s detalles </i>

      						</a><br />

                 		</div></td>

			      </tr>

				  <tr>

				    <td height="39" colspan="2" align="left"><b>Precio desde: <?php print number_format($row[precio],2,".",".")."  USD. </b>"; ?><br />

			        <hr /></td>

			      </tr>

		      </table></td>

			</tr>

	  <?php

			} 

	?>	

			<tr>

				<td align='left' colspan='4' style="padding-left: 36px;">

					<!-- Contador de Paginas -->

				
					página(s)<?php 

						$i=1; 

						

						$link2= linkServicios();

						

						while($i<=$pagina){

					?>

							<a href="<?php echo $link2;?>&pag=<?php echo $i;?>">

								<?php echo $i; ?>

							</a>

					<?php 

							$i++;

						}

					?>

					
					<!-- Contador de Paginas -->

				</td>

			</tr>

		</table>

		

	<?php

		}else{

			

			$sql= "SELECT * FROM antesala WHERE seccion='$mira'";

			$consulta= mysql_query($sql,$conexion);

			

			if($row= @mysql_fetch_array($consulta)){

	?>			

			

<div style='height: 30px;'></div>

			

			<div align="center">

			

				<label style="font-size: 18px;"><?php echo $row[descripcion]; ?></label>

				

				<div style='height: 5px;'></div>

				

				<?php  

					if($row[foto_existe]==1){

				?>							    

					<img src="<?php echo "admin/".$row[foto];?>" style="width: 700px; height: 460px;" />

				<?php

					}else{

				?>

					<div style='height: 200px;'></div>

				<?php		

					}

				?>		

				

			</div>	

			

			

	<?php						

			}

		}	

 	

	?>

	
<br />
<br />

		

		

		

		<!-- Espacio para el contenido -->

	</td>

    <td width="25%" valign="top" align="center">

<div style='height: 30px;'></div>

		<div align="center">


<div align="center">
	<?php $mira = $_REQUEST["mira"];?>
	
	<?php if($mira == 53) {
		obtenerInformacion($mira);
	?>
	<form action="buscar.php" method="post" name="filtro" id="filtro" style="margin:0 0 0 0">
	<div style="background:url(buscar1.jpg); height:25px; width:300px; padding-top:10px" class="txt_1" align="center">
	    BUSCADOR DE CRUCEROS
  	</div>

  	<div style=" background:url(buscar2.jpg); padding-right:8px;">
		<div style=" height:10px"></div>
		<select name="titulosHID" id="titulosHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
    		<option value='0' selected="selected">Cualquier paquete</option>
    		<?php   
    			foreach ($keysComboPaquete as $key){
    		?>
    			<option value="<?php echo $arregloComboPaquete["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>
		<select name="titulos" id="titulos" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangePaquete()">
    		<option value='0' selected="selected">Cualquier paquete</option>
    		<?php   
    			foreach ($keysComboPaquete as $key){
    		?>
    			<option value="<?php echo $arregloComboPaquete["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>

	    <div style=" height:10px"></div>
		<select name="puertoHID" id="puertoHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
			<option value='0'>Cualquier puerto</option>
			<?php   
    			foreach ($keysComboPuerto as $key){
    		?>
    			<option value="<?php echo $arregloComboPuerto["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
	    <select name="puerto" id="puerto" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangePuerto()">
			<option value='0'>Cualquier puerto</option>
			<?php   
    			foreach ($keysComboPuerto as $key){
    		?>
    			<option value="<?php echo $arregloComboPuerto["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>

		<div style=" height:10px"></div>
		<select name="destinosHID" id="destinosHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
			<option value='0'>Cualquier destino</option>
			<?php   
    			foreach ($keysComboDestino as $key){
    		?>
    			<option value="<?php echo $arregloComboDestino["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
		<select name="destinos" id="destinos" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangeDestino()">
			<option value='0'>Cualquier destino</option>
			<?php   
    			foreach ($keysComboDestino as $key){
    		?>
    			<option value="<?php echo $arregloComboDestino["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>

		<div style=" height:10px"></div>
		<select name="navierasHID" id="navierasHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
	        <option value='0'>Cualquier naviera</option>
	        <?php   
    			foreach ($keysComboNaviera as $key){
    		?>
    			<option value="<?php echo $arregloComboNaviera["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>
    	<select name="navieras" id="navieras" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangeNaviera()">
	        <option value='0'>Cualquier naviera</option>
	        <?php   
    			foreach ($keysComboNaviera as $key){
    		?>
    			<option value="<?php echo $arregloComboNaviera["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>
		
	    <div style=" height:10px"></div>
		
		<select name="precioHID" id="precioHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
	        <option value='0'>Cualquier precio</option>
	        <?php   
    			foreach ($keysComboPrecio as $key){
    				$key = $key." - ".($key + 499);
    		?>
    			<option value="<?php echo $arregloComboPrecio[$key]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
		<select name="precio" id="precio" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangePrecio()">
	        <option value='0'>Cualquier precio</option>
	        <?php   
    			foreach ($keysComboPrecio as $key){
    				$key = $key." - ".($key + 499);
    		?>
    			<option value="<?php echo $arregloComboPrecio[$key]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
		
    	<div style=" height:10px"></div>
		
		<select name="fechaHID" id="fechaHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
			<option value='0'>Cualquier fecha</option>
			<?php
			    foreach ($keysComboFecha as $key){
    		?>
    			<option value="<?php echo $arregloComboFecha["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
		<select name="fecha" id="fecha" onclick="showDaysDiv()" style="font-size:14px;color:#0351a0; width:175px;">
			<option value='0'>Cualquier fecha</option>
		</select>
		
		<div id="mainDivDates" style="display:none;" class="roundedDrop capaSuperior">
		<div class="innerContent" >
			<fieldset>
				<label class="clearfixAlt anyMonthOption" style="display: inline-block;">
					<input id="dateAll" value="" class="any-default selected" type="checkbox" onclick="unCheckDays()"> 
					<span class="labelText">
						Cualquier d&iacute;a
					</span>
				</label>
				<span style="display: inline-block;">
					<a href="#fecha" onclick="showPrevMont()" style="font-size: 16px; font-weight: bold;"> &lt; </a>
					&nbsp;&nbsp;
					<a href="#fecha" onclick="showNextMont()" style="font-size: 16px; font-weight: bold;"> &gt; </a>
				</span>
				
				<?php echo $divDiasInfo;?>
				
		    </fieldset>
			<a class="closeSelectBtn" id="closeLeavingSelect" href="#fecha" onclick="javascript:document.getElementById('mainDivDates').style.display = 'none';">
				Cerrar
			</a>
		</div>
	</div>
	
		
		<div style=" height:10px"></div>
		<input type="button" value="Buscar" onclick="buscarCrucero(this.form)" />
		
    	<div style="clear:both"></div>
    	<div style=" height:10px"></div>
  	
	</form></div>
	<br />
<br />

 <div align="center" >
<form action="reportePDFV2.php" method="post" name="formCedula" id="formCedula">
         <table width="300" height="93" align="center"  background="micuentas.jpg">
           <tr>
             <td colspan="2" align="center"><b>Consultar por Localizador</b></td>
           </tr>
           <tr>
             <td align="right">N&uacute;mero de Localizador:</td>
             <td><input type="text" name="cedula" value="" /></td>
           </tr>
           <tr>
             <td colspan="2" align="center"><input name="submitButton" type="button" id="submitButton" onClick="javascript:validateCedulaAndSubmit(this.form)" value="Buscar Por Localizador"/></td>
           </tr>
         </table>
       </form></div>
	<?php }?>
	
<?php if($mira == 70){
		obtenerInformacion($mira);
	?>
    <div align="center" >
    <form action="buscar.php" method="post" name="filtro" id="filtro" style="margin:0 0 0 0">
    
    	 <div style="background:url(buscar1.jpg); height:25px; width:300px; padding-top:10px" class="txt_1" align="center">
			BUSCADOR DE CIRCUITOS
		</div>

  		<div style=" background:url(buscar3.jpg); padding-right:8px; height:200px">

   		<div style=" height:10px"></div>
		
		<select name="titulosHID" id="titulosHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
    		<option value='0' selected="selected">Cualquier paquete</option>
    		<?php   
    			foreach ($keysComboPaquete as $key){
    		?>
    			<option value="<?php echo $arregloComboPaquete["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>
	    
		<select name="titulos" id="titulos" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangePaqueteCircuito()">
    		<option value='0' selected="selected">Cualquier paquete</option>
    		<?php   
    			foreach ($keysComboPaquete as $key){
    		?>
    			<option value="<?php echo $arregloComboPaquete["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
	    </select>	  
		
		<div style=" height:10px"></div>

		<select name="precioHID" id="precioHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
	        <option value='0'>Cualquier precio</option>
	        <?php   
    			foreach ($keysComboPrecio as $key){
    				$key = $key." - ".($key + 499);
    		?>
    			<option value="<?php echo $arregloComboPrecio["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>
    	<select name="precio" id="precio" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangePrecioCircuito()">
	        <option value='0'>Cualquier precio</option>
	        <?php   
    			foreach ($keysComboPrecio as $key){
    				$key = $key." - ".($key + 499);
    		?>
    			<option value="<?php echo $arregloComboPrecio["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
		</select>

		<div style=" height:10px"></div>

		<select name="duracionHID" id="duracionHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
			<option value='0'>Cualquier duracion</option>
			<?php   
    			foreach ($keysComboDuracion as $key){
    		?>
    			<option value="<?php echo $arregloComboDuracion["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
    	</select>
    	<select name="duracion" id="duracion" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangeDuracionCircuito()">
			<option value='0'>Cualquier duracion</option>
			<?php   
    			foreach ($keysComboDuracion as $key){
    		?>
    			<option value="<?php echo $arregloComboDuracion["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
    	</select>
		
		<div style=" height:10px"></div>
		
		<select name="itinerarioHID" id="itinerarioHID" style="font-size:14px;color:#0351a0; width:175px; display: none">
	        <option value='0'>Cualquier itinerario</option>
			<?php   
    			foreach ($keysComboItinerario as $key){
    		?>
    			<option value="<?php echo $arregloComboItinerario["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
    	</select>
    	<select name="itinerario" id="itinerario" style="font-size:14px;color:#0351a0; width:175px" onchange="onChangeItinerarioCircuito()">
	        <option value='0'>Cualquier itinerario</option>
			<?php   
    			foreach ($keysComboItinerario as $key){
    		?>
    			<option value="<?php echo $arregloComboItinerario["$key"]; ?>" ><?php echo $key; ?></option>
    		<?php
    			}
    		?>
    	</select>

     	<div style=" height:10px"></div>
		
		<input type="button" value="Buscar" onclick="buscarCircuito(this.form)" />

  		</div>
	</form>
	</div>
	<br />
<br />
<br />
 <div align="center" >
<form action="reportePDFV2.php" method="post" name="formCedula" id="formCedula">
         <table width="300" height="93" align="center"  background="micuentas.jpg">
           <tr>
             <td colspan="2" align="center"><b>Consultar por Localizador</b></td>
           </tr>
           <tr>
             <td align="right">N&uacute;mero de Localizador:</td>
             <td><input type="text" name="cedula" value="" /></td>
           </tr>
           <tr>
             <td colspan="2" align="center"><input name="submitButton" type="button" id="submitButton" onClick="javascript:validateCedulaAndSubmit(this.form)" value="Buscar Por Localizador"/></td>
           </tr>
         </table>
       </form></div>
	<?php }?>


   <div style="height: 25px;"></div>
       <?php if($mira== 81) {?>
       
       <div align="center" >
       <form action="reportePDFV2.php" method="post" name="formCedula" id="formCedula">
         <table width="300" height="93" align="center"  background="micuentas.jpg">
           <tr>
             <td colspan="2" align="center"><b>Consultar por c&eacute;dula</b></td>
           </tr>
           <tr>
             <td align="right">N&uacute;mero de C&eacute;dula:</td>
             <td><input type="text" name="cedula" value="" /></td>
           </tr>
           <tr>
             <td colspan="2" align="center"><input name="submitButton" type="button" id="submitButton" onClick="javascript:validateCedulaAndSubmit(this.form)" value="Buscar Por Cedula"/></td>
           </tr>
         </table>
       </form><?php 
} 

?></div>
  
            
			        

	        

	        

      	</div>
        
        <?php
        	//si estamos en una categoria (no subseccion) no debemos ver los banners
        	//en cambio, estando en cualquier subseccion (atributo 'tot') si debemos mostrar los banners
        	if (isset($_GET['tot'])) {
        ?>
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
		<?php
			}
		?>

      	<!-- Espacio para los banners -->

	</td>

  </tr>

</table>


</body>

</html>

