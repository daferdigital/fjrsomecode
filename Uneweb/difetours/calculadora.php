<?php 
	include "conexion.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<style>
	<!--
	#resultadoCalculadora  {
		border: thin dotted #FFCC00;
		clear: none;
		font-size: 80%;
		padding: 5px;
		margin-right: 15px;
		margin-left: 15px;	
	}
	
	.calculator-input {
		font-size: small;
	}
	.calculator-input-dropdown {
		font-size: 90%;
		/*font-size:100%;*/
	}
	-->
	</style>
	<script>
	    var waitEstadia = false;
	    
		function createXMLHTTPRequest(){
			var xmlHTTPRequest = null;
			
			//revisamos si no esta definido el objeto nativamente(navegadores tipo mozilla)
			if (typeof XMLHttpRequest == "undefined" ){
				//Ahora revisamos si el motor es mayor o igual a MSIE 5.0 
				//(mayor que microsoft internet explorer 5.0)
				if(navigator.userAgent.indexOf("MSIE 5") >= 0){
					// Si es así creamos un control activeX apartir de un objeto
					//ActiveXObject("Microsoft.XMLHTTP")
					xmlHTTPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} else {
					//si no , o si es menor a MSIE 5.0 creamos otro control activeX
					// apartir de un objeto ActiveXObject("Msxml2.XMLHTTP")
					xmlHTTPRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} 
			} else {
				// en cambio si el objeto estaba definido nativamente, solo lo instanciamos
				xmlHTTPRequest = new XMLHttpRequest();
			}
			
			return xmlHTTPRequest;
		}

		function getComboDestinoModalidad(){
			var ajaxObject =  createXMLHTTPRequest();

			document.getElementById("UpdateProgress1").style.display="inline";
			ajaxObject.onreadystatechange=function() {
				if (ajaxObject.readyState==4 && ajaxObject.status==200) {
					document.getElementById("UpdateProgress1").style.display="none";
					document.getElementById("destinoModalidad").innerHTML = ajaxObject.responseText;
				}
			};
			
			ajaxObject.open("POST", "ajaxDestinoModalidad.php", false);
			//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
			ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxObject.send("destino="+document.getElementById("destino").value);
			document.getElementById("UpdateProgress1").style.display="none";
		}

		function getComboDestinoEstadia(){
			var ajaxObject =  createXMLHTTPRequest();

			document.getElementById("UpdateProgress1").style.display="inline";
			ajaxObject.onreadystatechange=function() {
				if (ajaxObject.readyState==4 && ajaxObject.status==200) {
					document.getElementById("UpdateProgress1").style.display="none";
					document.getElementById("destinoEstadia").innerHTML = ajaxObject.responseText;
				}
			};
			
			ajaxObject.open("POST", "ajaxDestinoEstadia.php", false);
			//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
			ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxObject.send("destino="+document.getElementById("destino").value);
			document.getElementById("UpdateProgress1").style.display="none";
		}
		
		function getEstadiaInfo(){
			var ajaxObject =  createXMLHTTPRequest();

			document.getElementById("UpdateProgress1").style.display="inline";
			ajaxObject.onreadystatechange=function() {
				if (ajaxObject.readyState==4 && ajaxObject.status==200) {
					document.getElementById("UpdateProgress1").style.display="none";
					document.getElementById("UpdatePanel1").innerHTML = ajaxObject.responseText;
				}
			};
			
			ajaxObject.open("POST", "ajaxEstadia.php", false);
			//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
			ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxObject.send("estadia="+document.getElementById("estadia").value);
			document.getElementById("UpdateProgress1").style.display="none";
		}
	
		function getTotalInfo(){
			var ajaxObject =  createXMLHTTPRequest();
	
			document.getElementById("UpdateProgress1").style.display="inline";
	
			ajaxObject.onreadystatechange=function() {
				if (ajaxObject.readyState==4 && ajaxObject.status==200) {
					document.getElementById("UpdateProgress1").style.display="none";
					document.getElementById("UpdatePanelFeeTable").innerHTML = ajaxObject.responseText;
				}
			};
			
			ajaxObject.open("POST", "ajaxTotal.php", true);
			//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
			ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
			var params = "cantidadSemanas=" + document.getElementById("cantidadSemanas").value;
			params += "&formaEstudio=" + document.getElementById("formaEstudio").value;
			params += "&estadia=" + document.getElementById("estadia").value;
			params += "&destino=" + document.getElementById("destino").value;
	
			if(document.getElementById("UpdatePanel1").innerHTML != ""){
				//tenemos estadia seleccionada, vemos su detalle
				if(document.getElementById("AirportPickupRequired_0").checked){
					params += "&AirportPickupRequired=" + document.getElementById("AirportPickupRequired_0").value;
				} else if(document.getElementById("AirportPickupRequired_1").checked){
					params += "&AirportPickupRequired=" + document.getElementById("AirportPickupRequired_1").value;
				} else if(document.getElementById("AirportPickupRequired_2").checked){
					params += "&AirportPickupRequired=" + document.getElementById("AirportPickupRequired_2").value;
				}

				if(document.getElementById("accommAge_0") != null){
					if(document.getElementById("accommAge_0").checked){
						params += "&accommAge=" + document.getElementById("accommAge_0").value;
					} else if(document.getElementById("accommAge_1").checked){
						params += "&accommAge=" + document.getElementById("accommAge_1").value;
					}
				}
			}
	
			ajaxObject.send(params);
		}
	
		function validSelects(){
			//verificamos los selects para ver si procedemos a buscar o no
			var areValids = true;
			var selectDestino = document.getElementById("destino").value;
			var selectFormaEstudio = document.getElementById("formaEstudio").value;
			var selectEstadia = document.getElementById("estadia").value;
			var selectSemanas = document.getElementById("cantidadSemanas").value;
			var selectsVacios = 0;
	
			if(selectDestino == ""){
				selectsVacios ++;
			}
			if(selectFormaEstudio == ""){
				selectsVacios ++;
			}
			if(selectEstadia == ""){
				selectsVacios ++;
			}
			if(selectSemanas == ""){
				selectsVacios ++;
			}
	
			document.getElementById("RequiredFieldValidator1").style.display = "none";
			document.getElementById("RequiredFieldValidator2").style.display = "none";
			document.getElementById("RequiredFieldValidator3").style.display = "none";
			document.getElementById("RequiredFieldValidator4").style.display = "none";
			
			//se necesitan los 3 selects con valores validos para procesar
			//solo se mostraran errores cuando al menos esten 2 seleccionados
			if(selectsVacios > 0){
				areValids = false;
				
				document.getElementById("UpdatePanelFeeTable").innerHTML = "";
				if(selectEstadia == ""){
					document.getElementById("UpdatePanel1").innerHTML = "";
				}
				
				if(selectsVacios == 1){
					//tengo un select vacio, muestro su mensaje de error
					if(selectDestino == ""){
						document.getElementById("RequiredFieldValidator1").style.display = "inline";
					}
					if(selectFormaEstudio == ""){
						document.getElementById("RequiredFieldValidator2").style.display = "inline";
					}
					if(selectEstadia == ""){
						document.getElementById("RequiredFieldValidator3").style.display = "inline";
					}
					if(selectSemanas == ""){
						document.getElementById("RequiredFieldValidator4").style.display = "inline";
					}
				}
			} else {
				//algunos tienen valores, verificamos cuantos son
				areValids = true;
			}
	
			return areValids;
		}
		
		function __doPostBack(componentName){
			if(componentName == "estadia"){
				getEstadiaInfo();
			}
			if(componentName == "destino"){
				getComboDestinoModalidad();
				getComboDestinoEstadia();
			}
	
			if(validSelects()){
				getTotalInfo();
			}
		}
	</script>
</head>
<body>
<div id="resultadoCalculadora">
	<table width="90%" border="0" cellpadding="2" cellspacing="2">
		<tr>
			<td>Destino</td>
			<td>Modalidad de estudio</td>
            <td>Tipo de Estadia</td>
            <td>Cantidad de Semanas</td>
        </tr>
        <tr>
            <td>
            	<select name="destino" onchange="javascript:setTimeout('__doPostBack(\'destino\')', 0)" id="destino" class="calculator-input-dropdown">
            		<option selected="selected" value="">Destino</option>
					<?php
						$query = "SELECT id, destino FROM curso_destino ORDER BY id";
						$result = mysql_query($query);
						while ($row = mysql_fetch_array($result)){
					?>
						<option value="<?php echo $row["id"];?>"><?php echo $row["destino"];?></option>
					<?php
						}
					?>
				</select>
			</td>
			<td id="destinoModalidad">
            	<select name="formaEstudio" onchange="javascript:setTimeout('__doPostBack(\'formaEstudio\')', 0)" id="formaEstudio" class="calculator-input-dropdown">
            		<option selected="selected" value="">Modalidad de Estudio</option>
				</select>
			</td>
            <td id="destinoEstadia">
            	<select name="estadia" onchange="javascript:setTimeout('__doPostBack(\'estadia\')', 0)" id="estadia" class="calculator-input-dropdown">
					<option selected="selected" value="">Indique su tipo de estadia</option>
				</select>
			</td>
			<td>
            	<select name="cantidadSemanas" onchange="javascript:setTimeout('__doPostBack(\'cantidadSemanas\')', 0)" id="cantidadSemanas" class="calculator-input-dropdown">
					<option selected="selected" value="">Indique cantidad de semanas</option>
					<?php
						for($i = 1; $i < 53; $i++){
							if($i == 1){
								print "<option value=\"".$i."\">".$i." semana</option>";
							} else {
								print "<option value=\"".$i."\">".$i." semanas</option>";
							}
						}	
					?>
				</select>
			</td>
        </tr>
        <tr>
        	<td>
        		<span id="RequiredFieldValidator1" class="calculator-validator" style="color: red; display: none;">
        			Por favor indique su destino
        		</span>
        	</td>
        	<td>
        		<span id="RequiredFieldValidator2" class="calculator-validator" style="color: red; display: none;">
        			Por favor seleccione su forma de estudio
        		</span>
        	</td>
            <td>
            	<span id="RequiredFieldValidator3" class="calculator-validator" style="color: red; display: none;">
                	Por favor seleccione su tipo de estadia
                </span>
            </td>
            <td>
            	<span id="RequiredFieldValidator4" class="calculator-validator" style="color: red; display: none;">
            		Por favor seleccione la cantidad de semanas
            	</span>
            </td>
        </tr>
        <tr>
        	<td colspan="3">
        		&nbsp;
            </td>
            <td align="center">
            	<div id="UpdateProgress1" style="display: none;">
            		<div>
            			<img src="img/cargando.gif" width="16" height="16" alt="por favor espere"> ... Actualizando 
            		</div>
	            </div>
	        </td>
        </tr>
        <tr>
        	<td colspan="4" class="calculator-input">
        		<div id="UpdatePanel1">
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="4" align="center" class="calculator-input">
        		<div id="UpdatePanelFeeTable">
        		</div>
        	</td>
        </tr>
    </table>
</div>
</body>
</html>