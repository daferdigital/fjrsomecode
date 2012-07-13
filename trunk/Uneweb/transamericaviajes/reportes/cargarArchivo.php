<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Cargar Archivos de Datos</title>
	
	<script type="text/javascript">
		function validateAndSubmit(formToValidate){
			var doSubmit = true;
			var radioButtonList = formToValidate.tipoArchivo;
			var radioLength = 0;
			var radioValue = null;
			
			if(! radioButtonList){
				doSubmit = false;
			} else {
				radioLength = radioButtonList.length;
				
				for(var i = 0; i < radioLength; i++) {
					if(radioButtonList[i].checked) {
						radioValue = radioButtonList[i].value;
						break;
					}
				}
			}

			if(radioValue == null){
				alert('Disculpe debe indicar el tipo de archivo a procesar');
				doSubmit = false;
			} else if(formToValidate.archivoFisico.value == ''){
				alert('Disculpe debe indicar la ruta del archivo a procesar');
				doSubmit = false;
			}

			if (doSubmit) {
				formToValidate.submitButton.disabled = true;
				document.getElementById("resultadoEjecucion").style.display = "none";
				formToValidate.submit();
			}
		}
	</script>
</head>
<body>
    <?php
        $huboError = false;
        $showPageAfterFileLoad = false;
        $doProcess = false;
        
    	if(isset($_POST['sendedForm'])){
    		//debemos procesar el formulario
    		//veamos la extension del archivo en cuestion
    		//el sistema solo acepta archivos de tipo *.xls (excel 2003)
    		$poidsMax = ini_get('upload_max_filesize');
    		
    		//validamos el tipo de archivo
    		if(strpos($_FILES['archivoFisico']['name'], ".xls") > 0){
    			include ('procesarArchivoExcel.php');
    			
    			if(move_uploaded_file($_FILES['archivoFisico']['tmp_name'],
    					 getUploadedXLSFileToProcess())){
    				$showPageAfterFileLoad = true;
    				
    				initErrorFile();
    				
    				$huboError = procesarArchivo($_POST['tipoArchivo']);
    			} else {
    				if($_FILES['archivoFisico']['size'] == 0){
    					echo "Debido a la configuracion actual de PHP, los archivos a subir no pueden pesar mas de $poidsMax.<br>";
    				} else {
    					echo "Por alguna razon el archivo no fue subido al servidor, favor intente de nuevo.<br>";
    				}
    			}
    		} else if((strpos($_FILES['archivoFisico']['name'], ".txt") > 0) || (strpos($_FILES['archivoFisico']['name'], ".csv") > 0)){
    			include ('procesarArchivoTxt.php');
    			
    			$showPageAfterFileLoad = true;
    			
    			initErrorFile();
    			
    			$huboError = procesarArchivo($_POST['tipoArchivo'], file($_FILES["archivoFisico"]['tmp_name']));
    		} else{
    			//tipo de archivo no soportado
    			echo "Tipo de archivo no soportado<br>";
    		}
    	}
    ?>
    
	<form action="cargarArchivo.php" name="cargarArchivo" method="post" enctype="multipart/form-data">
	<input type="hidden" name="sendedForm" value="true">
	<table align="center">
		<tr>
			<td colspan="2" align="center"><b>Cargar Archivos de Datos</b><br /><br /></td>
		</tr>
		<tr>
			<td>Tipo de Archivo:</td>
			<td>
				<input type="radio" name="tipoArchivo" value="clientes" /> Clientes <br />
				<input type="radio" name="tipoArchivo" value="ventasPaquetes" /> Ventas paquetes cr&eacute;dito <br />
				<input type="radio" name="tipoArchivo" value="lineasVentasPaquetes" /> L&iacute;neas ventas paquetes cr&eacute;dito <br />
				<input type="radio" name="tipoArchivo" value="recibos" /> Recibos <br />
			</td>
		</tr>
		<tr>
			<td>Archivo:</td>
			<td>
				<input type="file" name="archivoFisico" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="submitButton" value="Cargar" onclick="javascript:validateAndSubmit(this.form)"/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<span id="resultadoEjecucion">
					<?php 
						if($showPageAfterFileLoad){
							if($huboError == true){
								echo "<br /><br />"
								."<a href=\"descargarArchivoResultados.php\">Hubo errores haga click aqu&iacute; para obtener el detalle</a>";
							} else {
								echo "<br /><br /><b>La carga de datos fue completada de manera exitosa.</b>";
							}
						}
					?>
				</span>
			</td>
		</tr>
	</table>
	</form>
</body>
</html>
