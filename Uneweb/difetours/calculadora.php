<style>
<!--
#resultadoCalculadora  {
	border: thin dotted #FFCC00;
	clear: none;
	font-size: small;
	padding: 5px;
	margin-right: 15px;
	margin-left: 15px;	
}

.calculator-input {
	font-size: small;
}
.calculator-input-dropdown {
	font-size: 70%;
	/*font-size:100%;*/
}
-->
</style>
<script>
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

	function getEstadiaInfo(){
		var ajaxObject =  createXMLHTTPRequest();
		document.getElementById("UpdateProgress1").style.display="inline";
		
		ajaxObject.onreadystatechange=function() {
			if (ajaxObject.readyState==4 && ajaxObject.status==200) {
				document.getElementById("UpdateProgress1").style.display="none";
				document.getElementById("UpdatePanel1").innerHTML = ajaxObject.responseText;
				//fue modificada la estadia, debo actualizar el total final
				getTotalInfo();
			}
		};
		
		ajaxObject.open("POST", "ajaxEstadia.php", true);
		//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
		ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxObject.send("estadia="+document.getElementById("estadia").value);
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

		var params = "";
		ajaxObject.send(params);
	}

	function validSelects(){
		//verificamos los selects para ver si procedemos a buscar o no
		var areValids = true;
		var selectFormaEstudio = document.getElementById("formaEstudio").value;
		var selectEstadia = document.getElementById("estadia").value;
		var selectSemanas = document.getElementById("cantidadSemanas").value;
		var selectsVacios = 0;

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
		
		//se necesitan los 3 selects con valores validos para procesar
		//solo se mostraran errores cuando al menos esten 2 seleccionados
		if(selectsVacios > 0){
			areValids = false;
			if(selectsVacios == 1){
				//tengo un select vacio, muestro su mensaje de error
				if(selectFormaEstudio == ""){
					document.getElementById("RequiredFieldValidator1").style.display = "inline";
				}
				if(selectEstadia == ""){
					document.getElementById("RequiredFieldValidator2").style.display = "inline";
				}
				if(selectSemanas == ""){
					document.getElementById("RequiredFieldValidator3").style.display = "inline";
				}
			}
		} else {
			//algunos tienen valores, verificamos cuantos son
			areValids = true;
		}

		return areValids;
	}
	
	function __doPostBack(componentName){
		if(validSelects()){
			if(componentName == "formaEstudio" || componentName == "cantidadSemanas"){
				//actualizo el total
			}else{
				//actualizo segun estadia
				getEstadiaInfo();
			}
		} else {
			document.getElementById("UpdatePanel1").innerHTML = "";
			document.getElementById("UpdatePanelFeeTable").innerHTML = "";
		}
	}
</script>

<div id="resultadoCalculadora">
	<table width="90%" border="0" cellpadding="2" cellspacing="2">
		<tr style="font-size:80%">
			<td>Forma de estudio</td>
            <td>Tipo de Estadia</td>
            <td>Cantidad de Semanas</td>
        </tr>
        <tr>
            <td>
            	<select name="formaEstudio" onchange="javascript:setTimeout('__doPostBack(\'formaEstudio\')', 0)" id="formaEstudio" class="calculator-input-dropdown">
            		<option selected="selected" value="">Forma de Estudio</option>
					<option value="intensive">Tiempo Completo Intensivo(30 clases/semana)</option>
					<option value="standard">Tiempo Completo (24 clases/semana)</option>
					<option value="part-timeAM">Medio tiempo AM (17 clases/semana)</option>
					<option value="part-timePM">Medio tiempo PM (13 clases/semana)</option>
				</select>
			</td>
            <td>
            	<select name="estadia" onchange="javascript:setTimeout('__doPostBack(\'estadia\')', 0)" id="estadia" class="calculator-input-dropdown">
					<option selected="selected" value="">Indique su tipo de estadia</option>
					<option value="homestay">Completa (todas las comidas)</option>
					<option value="homestay-half-board">Media (sin almuerzo)</option>
					<option value="roomstay">Dormitorio (sin comidas)</option>
					<option value="none">Ninguna</option>
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
        			Por favor seleccione su forma de estudio
        		</span>
        	</td>
            <td>
            	<span id="RequiredFieldValidator2" class="calculator-validator" style="color: red; display: none;">
                	Por favor seleccione su tipo de estadia
                </span>
            </td>
            <td>
            	<span id="RequiredFieldValidator3" class="calculator-validator" style="color: red; display: none;">
            		Por favor seleccione la cantidad de semanas
            	</span>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
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
        	<td colspan="3" class="calculator-input">
        		<div id="UpdatePanel1">
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="3" align="center" class="calculator-input">
        		<div id="UpdatePanelFeeTable">
        		</div>
        	</td>
        </tr>
    </table>
</div>