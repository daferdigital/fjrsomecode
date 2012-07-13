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

function buscarCrucero(formulario){
	var submitForm = false;

	if(formulario.titulos.value != "0"){
		submitForm = true;
	}else if(formulario.puerto.value != "0"){
		submitForm = true;
	}else if(formulario.destinos.value != "0"){
		submitForm = true;
	}else if(formulario.navieras.value != "0"){
		submitForm = true;
	}else if(formulario.precio.value != "0"){
		submitForm = true;
	}else if(formulario.fecha.value != "0"){
		submitForm = true;
	}

	if(submitForm){
		formulario.submit();
	}else{
		alert("Disculpe, debe seleccionar al menos un filtro de busqueda");
	}
}

function buscarCircuito(formulario){
	var submitForm = false;

	if(formulario.titulos.value != "0"){
		submitForm = true;
	}else if(formulario.precio.value != "0"){
		submitForm = true;
	}else if(formulario.duracion.value != "0"){
		submitForm = true;
	}else if(formulario.itinerario.value != "0"){
		submitForm = true;
	}

	if(submitForm){
		formulario.submit();
	}else{
		alert("Disculpe, debe seleccionar al menos un filtro de busqueda");
	}
}

function showPrevMont(){
	findNodo = false;
	nodo = 0;
	
	while(!findNodo){
		if(document.getElementById(nodo) != null){
			if(document.getElementById(nodo).style.display == "block"){
				break;
			}
		}
		
		nodo ++;
	}
	
	if(document.getElementById(nodo - 1) != null){
		document.getElementById(nodo + 1).style.display = "none";
		document.getElementById(nodo - 1).style.display = "block";
	}
}

function showNextMont(){
	findNodo = false;
	nodo = 0;
	
	while(!findNodo){
		if(document.getElementById(nodo) != null){
			if(document.getElementById(nodo).style.display == "block"){
				break;
			}
		}
		
		nodo ++;
	}
	
	if(document.getElementById(nodo + 2) != null){
		document.getElementById(nodo).style.display = "none";
		document.getElementById(nodo + 2).style.display = "block";
	}
}

function unCheckDays(){
	var i = 0;
	var checkArray = document.getElementsByName("date");
	
	for(i = 0; i < checkArray.length; i++){
		
		if(checkArray[i].checked == true){
			checkArray[i].checked = false;
			document.getElementById(checkArray[i].value).className = "";
		}
	}
	
	doLabelClick(null);
}

function llenarSelectVacio(currentSelectHID, currentSelect){
	var i = 0;
	for(i = 1; i < currentSelectHID.options.length; i++){
		currentSelect.options[currentSelect.length] = new Option(currentSelectHID.options[i].text,
				currentSelectHID.options[i].value);
	}
}

function llenarSelectConValorParticular(currentSelectHID, currentSelect, valueToSearch){
	var i = 0, j = 0;
	var existOption = false;
	var myRE1 = new RegExp(valueToSearch + "\\|\\|");
	var myRE2 = new RegExp("\\|\\|" + valueToSearch + "\\|\\|");
	var myRE3 = new RegExp("\\|\\|" + valueToSearch);
	
	for(i = 1; i < currentSelectHID.options.length; i++){
		if((currentSelectHID.options[i].value.match(myRE1) != null)
				||(currentSelectHID.options[i].value.match(myRE2) != null)
				||(currentSelectHID.options[i].value.match(myRE3) != null)
				||(currentSelectHID.options[i].value == valueToSearch)){
			//encontramos el valor, verificamos que no este repetido en el select no oculto
			existOption = false;
			
			for(j = 0; j < currentSelect.options.length; j++){
				if(currentSelect.options[j].text == currentSelectHID.options[i].text){
					existOption = true;
				}
			}
			
			if(! existOption){
				//ahora colocamos esta opcion en el select no oculto
				currentSelect.options[currentSelect.length] = new Option(currentSelectHID.options[i].text,
						currentSelectHID.options[i].value);
			}
		}
	}
}

function llenarSelectConValorParticularV2(currentSelectHID, currentSelect, valuesToSearch){
	var a = 0, i = 0;
	var existOption = false;
	
	for(i = 1; i < currentSelect.options.length; i++){
		existOption = false;
		
		for(a = 1; a < valuesToSearch.length; a++){
			var myRE1 = new RegExp(valuesToSearch[a] + "\\|\\|");
			var myRE2 = new RegExp("\\|\\|" + valuesToSearch[a] + "\\|\\|");
			var myRE3 = new RegExp("\\|\\|" + valuesToSearch[a]);
			
			if((currentSelect.options[i].value.match(myRE1) != null)
					||(currentSelect.options[i].value.match(myRE2) != null)
					||(currentSelect.options[i].value.match(myRE3) != null)
					||(currentSelect.options[i].value == valuesToSearch)){
				//encontramos el valor
				existOption = true;
				break;
			}
		}
		
		if(! existOption){
			//ahora colocamos esta opcion en el select no oculto
			currentSelect.options[i] = null;
		}
	}
}

function putAsChecked(checkElement){
	if(checkElement != null){
		if(checkElement.checked == true){
			document.getElementById(checkElement.value).className = "selected";
		} else {
			document.getElementById(checkElement.value).className = "";
		}
	}
	
	//recorremos todos los nodos para indicar los valores
	//del campo oculto
	var i = 0;
	var checkArray = document.getElementsByName("date");
	var viajesValue = "";
	
	for(i = 0; i < checkArray.length; i++){
		if(checkArray[i].checked == true){
			if(viajesValue != ""){
				viajesValue += ",";
			}
				
			viajesValue += checkArray[i].value;
		}
	}
	
	document.getElementById("salidas").value = viajesValue;
	alert(viajesValue);
}

function doLabelClick(checkElement){
	if(checkElement != null){
		if(checkElement.checked == true){
			document.getElementById(checkElement.value).className = "selected";
			document.getElementById("dateAll").checked = false;
		} else {
			document.getElementById(checkElement.value).className = "";
		}
	}
	
	//activamos los valores en los combos
	//que hagan match con las fechas seleccionadas.
	//recorremos los valores de dias a ver cuales estan en checked
	var i = 0;
	var checkArray = document.getElementsByName("date");
	var viajesValue = "";
	
	for(i = 0; i < checkArray.length; i++){
		if(checkArray[i].checked == true){
			if(viajesValue != ""){
				viajesValue += "||";
			}
				
			viajesValue += document.getElementById("dateHID" + checkArray[i].value).value;
		}
	}
	
	document.getElementById("titulos").options.length = 1;
	document.getElementById("puerto").options.length = 1;
	document.getElementById("destinos").options.length = 1;
	document.getElementById("navieras").options.length = 1;
	document.getElementById("precio").options.length = 1;
	
	if(viajesValue == ""){
		//reponemos todos los select
		llenarSelectVacio(document.getElementById("titulosHID"), document.getElementById("titulos"));
		llenarSelectVacio(document.getElementById("puertoHID"), document.getElementById("puerto"));
		llenarSelectVacio(document.getElementById("destinosHID"), document.getElementById("destinos"));
		llenarSelectVacio(document.getElementById("navierasHID"), document.getElementById("navieras"));
		llenarSelectVacio(document.getElementById("precioHID"), document.getElementById("precio"));
		
		document.getElementById("fecha").options[0].text = "Cualquier fecha";
		document.getElementById("fecha").options[0].value = "0";
	}else{
		//ajustamos los select con los valores seleccionados
		//hacemos el split de los valores
		
		splitValues = viajesValue.split("||");
		sortedSplitValues = splitValues.sort();
		
		var uniqueValuesStr = "";
		var uniqueValues=sortedSplitValues.filter(function(itm,i,a){
		    return i==a.indexOf(itm);
		});

		//revisamos en cada select los valores actuales que hacen match con los dias.
		for (var i = 0; i < uniqueValues.length; i++) {
			if(uniqueValuesStr != ""){
				uniqueValuesStr += "||";
			}
			uniqueValuesStr += uniqueValues[i];
			
			llenarSelectConValorParticular(document.getElementById("titulosHID"), document.getElementById("titulos"), uniqueValues[i]);
			llenarSelectConValorParticular(document.getElementById("puertoHID"), document.getElementById("puerto"), uniqueValues[i]);
			llenarSelectConValorParticular(document.getElementById("destinosHID"), document.getElementById("destinos"), uniqueValues[i]);
			llenarSelectConValorParticular(document.getElementById("navierasHID"), document.getElementById("navieras"), uniqueValues[i]);
			llenarSelectConValorParticular(document.getElementById("precioHID"), document.getElementById("precio"), uniqueValues[i]);
		}
		
		document.getElementById("fecha").options[0].text = "...";
		document.getElementById("fecha").options[0].value = uniqueValuesStr;
	}
}

function onChangeSelect(selectObj, elementosEnSelectHID){
	var values = "";
	
	if(selectObj != null){
		//vemos si cambio a algun valor distinto del por defecto
		if(selectObj.value != "0"){
			//el valor de este select cambio a uno especifico
			//debemos modificar los otros select en base a este
			values = selectObj.value;
		} else if(selectObj.options.length == elementosEnSelectHID) {
			//debemos modificar en base a todas las combinaciones de valores
			//siempre y cuando este select no este previamente filtrado
			
			for(var i = 1; i < selectObj.options.length; i++){
				if(values != ""){
					values += "||";
				}
				
				values += selectObj.options[i].value;
			}
		}else{
			return null;
		}
		
		splitValues = values.split("||");
		sortedSplitValues = splitValues.sort();
		
		var uniqueValues=sortedSplitValues.filter(function(itm,i,a){
		    return i==a.indexOf(itm);
		});
		
		return uniqueValues;
	}
	
	return null;
}

function modificarSelectDependiente(selectObjHID, selectObj, valuesToSearch, mustClean){
	if(selectObj != null){
		var i = 0;
		
		if(mustClean){
			alert("here " + valuesToSearch);
			selectObj.options.length = 1;
			
			for(i = 0; i < valuesToSearch.length; i++){
				llenarSelectConValorParticular(selectObjHID, selectObj, valuesToSearch[i]);
			}
		} else{
			//pregunto si este select no esta previamente seleccionado
			if(selectObj.value == "0"){
				alert(valuesToSearch);
				llenarSelectConValorParticularV2(selectObjHID, selectObj, valuesToSearch);
			}
		}
	}
}

function onChangePaquete(){
	var arrayValues = onChangeSelect(document.getElementById("titulos"),
			document.getElementById("titulosHID").options.length);
	var mustClean = (document.getElementById("titulos").options.length == document.getElementById("titulosHID").options.length);
	
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, mustClean);
	}
}

function onChangePuerto(){
	var arrayValues = onChangeSelect(document.getElementById("puerto"),
			document.getElementById("puertoHID").options.length);
	var mustClean = (document.getElementById("puerto").options.length == document.getElementById("puertoHID").options.length);
	
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, mustClean);
	}
}

function onChangeDestino(){
	var arrayValues = onChangeSelect(document.getElementById("destinos"),
			document.getElementById("destinosHID").options.length);
	var mustClean = (document.getElementById("destinos").options.length == document.getElementById("destinosHID").options.length);
	
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, mustClean);
	}
}

function onChangeNaviera(){
	var arrayValues = onChangeSelect(document.getElementById("navieras"),
			document.getElementById("navierasHID").options.length);
	var mustClean = (document.getElementById("navieras").options.length == document.getElementById("navierasHID").options.length);
	
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, mustClean);
	}
}


function onChangePrecio(){
	var arrayValues = onChangeSelect(document.getElementById("precio"),
			document.getElementById("precioHID").options.length);
	var mustClean = (document.getElementById("precio").options.length == document.getElementById("precioHID").options.length);
	
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, mustClean);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, mustClean);
	}
}
