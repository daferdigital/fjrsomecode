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
				formToValidate.submit();
			}
		}
	</script>
</head>
<body>
    <?php
        $resultadoCarga = "";
        
    	if(isset($_POST['sendedForm'])){
    		//debemos procesar el formulario
    		//veamos el tipo de archivo
    		//application/vnd.ms-excel 
    		//text/plain
    		
    		//validamos el tipo de archivo
    		if($_FILES['archivoFisico']['type'] == 'application/vnd.ms-excel' || $_FILES['archivoFisico']['type'] == 'text/plain'){
    			include ('procesarArchivo.php');
    			$resultadoCarga = procesarArchivo($_POST['tipoArchivo'], file($_FILES['archivoFisico']['tmp_name']));
    			
    			//move_uploaded_file($filename, 'tmp/'.date("d/m/Y_h:i:s"));
    		}else{
    			//tipo de archivo no soportado
    			echo "Tipo de archivo no soportado: ".$_FILES['archivoFisico']['type'];
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
						if($resultadoCarga != ""){
							echo "<br /><br />".$resultadoCarga;
						}
					?>
				</span>
			</td>
		</tr>
	</table>
	</form>
</body>
</html>
