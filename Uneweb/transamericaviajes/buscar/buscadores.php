<?php 
	include_once("conexion.php");
	include_once("tuningPaquetes.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="admin/botonera/css-styles/style.css" type="text/css" rel="stylesheet"/>
<link href="css/estiloBuscadores.css" type="text/css" rel="stylesheet"/>
<script src="admin/botonera/scripts/images.js" type="text/javascript"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<script type="text/javascript" src="buscador.js"></script>

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

<body>
		
<div align="center">
	<?php $mira = $_REQUEST["mira"];?>
	
	<?php if($mira == 53) {
		obtenerInformacion($mira);
	?>
	<form action="buscar.php" method="post" name="filtro" id="filtro" style="margin:0 0 0 0">
	<div style="background-color:#1997e1; height:25px; padding-top:10px" class="txt_1" align="center">
	    BUSCADOR DE CRUCEROS
  	</div>

  	<div style="background-color:#efefef; padding-right:8px;">
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
  	
	</form>
	<?php }?>
	
	<?php if($mira == 70){
		obtenerInformacion($mira);
	?>
    <div align="center" >
    <form action="buscar.php" method="post" name="filtro" id="filtro" style="margin:0 0 0 0">
    
    	 <div style="background-color:#1997e1; height:25px; padding-top:10px" class="txt_1" align="center">
			BUSCADOR DE CIRCUITOS
		</div>

  		<div style=" background-color:#efefef; padding-right:8px; height:200px">

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
	<?php }?>
</div>

</body>
</html>
