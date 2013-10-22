<?php 
	include_once './classes/DBConnection.php';
	include_once './classes/DBUtil.php';
	include_once './classes/UtilClass.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  	<title>Complete su pedido</title>
  	<link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  	<link rel="stylesheet" href="css/papeleria.css" />
  	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  	<script type="text/javascript" src="js/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/papeleria.js"></script>
</head>
<body>
	<?php 
		$query = "SELECT tm.id, tm.nombre AS tipo, m.id AS modeloId, m.nombre, m.numero, m.clasico";
		$query .= " FROM tipos_modelos tm, modelos m";
		$query .= " WHERE tm.id = m.id_tipo_modelo";
		$query .= " AND m.id = ".$_GET["id"];
		$query .= " ORDER BY tm.nombre, m.nombre, m.numero";
		
		$clasico = true;
		$formaLibre = true;
		$horizontal = false;
		$numero = 0;
		$habilitarFuente = false;
		$insertarLogo = false;
		
		$modelo = DBUtil::executeSelect($query);
		$imagePath = "";
		if(count($modelo) < 1){
			echo "<h2>No se encontro informacion sobre el modelo solicitado.</h2>";
		} else {
			$modelo = $modelo[0];
			$imagePath = "../imagenes/";
			$imagePath .= str_replace(" ", "", $modelo["tipo"])."/";
			$imagePath .= str_replace(" ", "", $modelo["nombre"]);
			$imagePath .= $modelo["numero"].".jpg";
			
			$clasico = $modelo["clasico"] == "1" ? true : false;
			$formaLibre = $modelo["id"] == "1" ? true : false;
			$horizontal = $modelo["id"] == "2" ? true : false;
			$numero = $modelo["numero"];
			
			if($clasico || $formaLibre){
				$habilitarFuente = true;
			}
			
			if($clasico || $formaLibre || $horizontal){
				$insertarLogo = true;
				
				if($horizontal && $numero == 4){
					$insertarLogo = false;
				}
			}
		}
	?>
	<div style="display: inline-block;">
		<h3>Datos del pedido</h3>
  		<table class="formModelo">
  			<tr>
	  			<td>
	  				RIF
	  				<br />
	  				<input type="text" name="rif" id="rif"/>
	  				<br />
	  				Ejemplo: J-12345678-0
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Nombre o Raz&oacute;n Social
	  				<br />
	  				<input type="text" name="razonSocial" id="razonSocial"/>
	  			</td>
  			</tr>
  			<?php
  				if($habilitarFuente){
  			?>
  			<tr>
  				<td>
  					<?php echo UtilClass::buildFontTable("1");?>
	  			</td>
  			</tr>
  			<?php
  				}
  			?>
  			<tr>
  				<td>
  					<br />
	  				Profesi&oacute;n o Servicio que presta
	  				<br />
	  				(max 3 palabras)
	  				<br />
	  				<input type="text" name="servicio" id="servicio"/>
	  			</td>
  			</tr>
  			<?php
  				if($habilitarFuente){
  			?>
  			<tr>
  				<td>
  					<?php echo UtilClass::buildFontTable("2");?>
	  			</td>
  			</tr>
  			<?php
  				}
  			?>
  			<tr>
  				<td>
  					<br />
	  				Direcci&oacute;n Fiscal (l&iacute;nea 1)
	  				<br />
	  				<input type="text" name="dirFiscalLinea1" id="dirFiscalLinea1"/>
	  				<br />
	  				Direcci&oacute;n Fiscal (l&iacute;nea 2)
	  				<br />
	  				<input type="text" name="dirFiscalLinea2" id="dirFiscalLinea2"/>
	  			</td>
  			</tr>
  			<?php
  				if($habilitarFuente){
  			?>
  			<tr>
  				<td>
  					<?php echo UtilClass::buildFontTable("3");?>
	  			</td>
  			</tr>
  			<?php
  				}
  			?>
  			<tr>
  				<td>
  					<br />
	  				Tel&eacute;fono / otro
	  				<br />
	  				<input type="text" name="telefono" id="telefono"/>
	  			</td>
  			</tr>
  			<?php
  				if($habilitarFuente){
  			?>
  			<tr>
  				<td>
  					<?php echo UtilClass::buildFontTable("4");?>
	  			</td>
  			</tr>
  			<?php
  				}
  			?>
  			<tr>
  				<td>
  					<br />
	  				E-mail
	  				<br />
	  				<input type="text" name="email" id="email"/>
	  			</td>
  			</tr>
  			<?php
  				if($habilitarFuente){
  			?>
  			<tr>
  				<td>
  					<?php echo UtilClass::buildFontTable("5");?>
	  			</td>
  			</tr>
  			<?php
  				}
  			?>
  			<tr>
  				<td>
  					<br />
	  				Tama&ntilde;o: 
	  				<br />
	  				<input type="radio" name="pageSize" id="sizeCarta" value="Carta" /> Carta
	  				<br />
	  				<input type="radio" name="pageSize" id="mediaCarta" value="Media Carta"/> Media Carta
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Tipo de presentaci&oacute;n: 
	  				<br />
	  				<input type="radio" name="presentacion" id="engomado" value="Engomado"/>Engomado
	  				<br />
	  				<input type="radio" name="presentacion" id="hojasSueltas" value="Hojas Sueltas"/>Hojas Sueltas
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Ha tenido alg&uacute;n documento fiscal <br />anteriormente?
	  				<br />
	  				<input type="radio" name="previoDocFiscal" id="si" value="si" onclick="javascript:showPrevDocumentAndControl(this);" />S&iacute;
	  				<input type="radio" name="previoDocFiscal" id="no" value="no" onclick="javascript:showPrevDocumentAndControl(this);" />No
	  			</td>
  			</tr>
  			<tr id="trUltimoNumDoc" style="display: none;">
  				<td>
  					<br />
	  				Cual fue su &uacute;ltima numeraci&oacute;n <br /> de documento?
	  				<br />
	  				Desde: <input type="text" name="prevNumDocDesde" id="prevNumDocDesde" />
	  				<br />
	  				Hasta: <input type="text" name="prevNumDocHasta" id="prevNumDocHasta" />
	  			</td>
  			</tr>
  			<tr id="trUltimoNumControl" style="display: none;">
  				<td>
  					<br />
	  				Cual fue su &uacute;ltima numeraci&oacute;n <br /> de control?
	  				<br />
	  				Desde: <input type="text" name="prevNumControlDesde" id="prevNumControlDesde" />
	  				<br />
	  				Hasta: <input type="text" name="prevNumControlHasta" id="prevNumControlHasta" />
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Cantidad de blocks a ordenar:
	  				<br />
	  				<input type="text" name="cantidadBlocks" id="cantidadBlocks" />
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				N&deg; de documento inicial:
	  				<br />
	  				<input type="text" name="numDocInicial" id="numDocInicial" />
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				N&deg; de control inicial:
	  				<br />
	  				<input type="text" name="numControlInicial" id="numControlInicial" />
	  			</td>
  			</tr>
  			<?php
  				if($insertarLogo){ 
  			?>
  			<tr>
  				<td>
  					<br />
	  				<input type="checkbox" name="insertarLogo" id="insertarLogo" value="Insertar Logo"/> Insertar Logo
	  				<br />
	  				<select name="opcionInsertarLogo" id="opcionInsertarLogo" class="formModelo">
	  					<option value="Peque&ntilde;o">Peque&ntilde;o</option>
	  					<option value="Mediano">Mediano</option>
	  					<option value="Grande">Grande</option>
	  				</select>
	  				<br />
	  				<input type="file" name="logo" id="logo" />
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				<input type="checkbox" name="insertarFondo" id="insertarFondo" value="Insertar Fondo"/> Insertar Fondo
	  				<br />
	  				<select name="opcionInsertarFondo" id="opcionInsertarFondo" class="formModelo">
	  					<option value="Peque&ntilde;o">Peque&ntilde;o</option>
	  					<option value="Mediano">Mediano</option>
	  					<option value="Grande">Grande</option>
	  				</select>
	  				<br />
	  				<input type="file" name="logo" id="logo" />
	  			</td>
  			</tr>
  			<?php
  				} 
  			?>
  			<tr>
  				<td>
  					<br />
	  				Preferencias de impresi&oacute;n
	  				<br />
	  				<select name="preferenciaImpresion" id="preferenciaImpresion" class="formModelo">
	  					<option value="">Seleccione</option>
	  					<option value="Original y 1 copia">Original y 1 copia</option>
	  					<option value="Original y 2 copias">Original y 2 copias</option>
	  					<option value="Original y 3 copias">Original y 3 copias</option>
	  				</select>
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Preferencias de papel
	  				<br />
	  				<select name="preferenciaPapel" id="preferenciaPapel" class="formModelo">
	  					<option value="">Seleccione</option>
	  					<option value="Papel Bond">Papel Bond</option>
	  					<option value="Papel Quimico">Papel Quimico</option>
	  				</select>
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Opciones de color
	  				<br />
	  				<select name="opcionesColor" id="opcionesColor" class="formModelo">
	  					<option value="">Seleccione</option>
	  					<option value="1 Color">1 Color</option>
	  					<option value="Full Color">Full Color</option>
	  				</select>
	  			</td>
  			</tr>
  			<tr>
  				<td>
  					<br />
	  				Copia de RIF:
	  				<br />
	  				<input type="file" name="copiaRIF" id="copiaRIF" />
	  			</td>
  			</tr>
  		</table>
	</div>
</body>
</html>