function showDaysDiv(){
	var offsetLeft = document.getElementById("fecha").offsetLeft;
	offsetLeft -= 450;
	
	document.getElementById("mainDivDates").style.marginLeft = offsetLeft +"px";
	document.getElementById("mainDivDates").style.marginTop = "35px";
	document.getElementById('mainDivDates').style.display = 'block';
}

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
		
		if(checkArray[i].className != ""){
			//el elemento a estaba seleccionado
			checkArray[i].className = "";
			document.getElementById(checkArray[i].title).className = "";
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

function putAsChecked(checkElement, value){
	if(checkElement != null){
		if(checkElement.className == ""){
			//no estaba seleccionado antes de este click
			document.getElementById(checkElement.title).className = "selected";
			checkElement.className = "clicked";
		} else {
			document.getElementById(checkElement.title).className = "";
			checkElement.className = "";
		}
	}
	
	//recorremos todos los nodos para indicar los valores
	//del campo oculto
	var i = 0;
	var checkArray = document.getElementsByName("date");
	var viajesValue = "";
	
	for(i = 0; i < checkArray.length; i++){
		if(checkArray[i].className != ""){
			//el elemento a esta seleccionado
			if(viajesValue != ""){
				viajesValue += ",";
			}
				
			viajesValue += checkArray[i].title;
		}
	}
	
	document.getElementById("salidas").value = viajesValue;
}

function doLabelClick(aElement, valueToCheck){
	var allElementsAreUnClicked = true;
	
	if(aElement != null){
		//vemos si el elemento estaba seleccionado o no
		//para habilitar el label o no
		if(document.getElementById(valueToCheck).className == ""){
			aElement.className = "clicked";
			document.getElementById(valueToCheck).className = "selected";
			document.getElementById("dateAll").checked = false;
		} else {
			aElement.className = "";
			document.getElementById(valueToCheck).className = "";
		}
	}
	
	//activamos los valores en los combos
	//que hagan match con las fechas seleccionadas.
	//recorremos los valores de dias a ver cuales estan en checked
	var i = 0;
	var checkArray = document.getElementsByName("date");
	var viajesValue = "";
	
	for(i = 0; i < checkArray.length; i++){
		if(checkArray[i].className != ""){
			//el elemento a estaba seleccionado
			if(viajesValue != ""){
				viajesValue += "||";
			}
				
			viajesValue += document.getElementById("dateHID" + valueToCheck).value;
		}
	}
	
	
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (viajesValue == "");
	
	arrayValues1 = getDateValues();
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
		arrayValues6 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
	}
	
	if(viajesValue == ""){
		//reponemos todos los select
		document.getElementById("fecha").options[0].text = "Cualquier fecha";
		document.getElementById("fecha").options[0].value = "0";
	}else {
		document.getElementById("fecha").options[0].text = "...";
		document.getElementById("fecha").options[0].value = viajesValue;
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
	
	for(i = currentSelect.options.length -1; i > 0; i--){
		existOption = false;
		
		for(a = 0; a < valuesToSearch.length; a++){
			var myRE1 = new RegExp(valuesToSearch[a] + "\\|\\|");
			var myRE2 = new RegExp("\\|\\|" + valuesToSearch[a] + "\\|\\|");
			var myRE3 = new RegExp("\\|\\|" + valuesToSearch[a]);
			
			if((currentSelect.options[i].value.match(myRE1) != null)
					||(currentSelect.options[i].value.match(myRE2) != null)
					||(currentSelect.options[i].value.match(myRE3) != null)
					||(currentSelect.options[i].value == valuesToSearch[a])){
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

function llenarFechaConValorParticular(valueToSearch){
	var i = 0, j = 0;
	var existOption = false;
	var myRE1 = new RegExp(valueToSearch + "\\|\\|");
	var myRE2 = new RegExp("\\|\\|" + valueToSearch + "\\|\\|");
	var myRE3 = new RegExp("\\|\\|" + valueToSearch);
	var allDates = document.getElementsByName("date");
	var value = "";
	
	for(i = 0; i < allDates.length; i++){
		value = document.getElementById("dateHID" + allDates[i].title).value;
		
		if((value.match(myRE1) != null)
				||(value.match(myRE2) != null)
				||(value.match(myRE3) != null)
				||(value == valueToSearch)){
			//encontramos el valor
			document.getElementById(allDates[i].title).className = "";
			allDates[i].style.display = "";
		}
	}
}

function llenarFechaConValorParticularV2(valuesToSearch){
	var a = 0, i = 0;
	var existOption = false;
	var allDates = document.getElementsByName("date");
	var value = "";
	
	for(i = 0; i < allDates.length; i++){
		existOption = false;
		if(document.getElementById(allDates[i].title).className != "disabled"){
			for(a = 0; a < valuesToSearch.length; a++){
				var myRE1 = new RegExp(valuesToSearch[a] + "\\|\\|");
				var myRE2 = new RegExp("\\|\\|" + valuesToSearch[a] + "\\|\\|");
				var myRE3 = new RegExp("\\|\\|" + valuesToSearch[a]);
				
				value = document.getElementById("dateHID" + allDates[i].title).value;
				
				if((value.match(myRE1) != null)
						||(value.match(myRE2) != null)
						||(value.match(myRE3) != null)
						||(value == valuesToSearch[a])){
					//encontramos el valor
					existOption = true;
					break;
				}
			}
			
			if(! existOption){
				document.getElementById(allDates[i].title).className = "disabled";
				allDates[i].style.display = "none";
			}
		}
	}
}

function modificarSelectDependiente(selectObjHID, selectObj, valuesToSearch, mustClean){
	if(selectObj != null){
		//pregunto si este select no esta previamente seleccionado
		if(selectObj.value == "0"){
			if(mustClean){
				selectObj.options.length = 1;
				var i = 0;
				for(i = 0; i < valuesToSearch.length; i++){
					llenarSelectConValorParticular(selectObjHID, selectObj, valuesToSearch[i]);
				}
			}else{
				llenarSelectConValorParticularV2(selectObjHID, selectObj, valuesToSearch);
			}
		}
	}
}

function modificarFechas(valuesToSearch, mustClean){
	//pregunto si no hay fechas previamente seleccionadas
	var allDates = document.getElementsByName("date");
	var i = 0;
	var hayFechasSeleccionadas = false;
	
	for(i = 0; i < allDates.length; i++){
		if(allDates[i].className != ""){
			hayFechasSeleccionadas = true;
			break;
		}
	}
	
	if(! hayFechasSeleccionadas){
		if(mustClean){
			for(i = 0; i < allDates.length; i++){
				document.getElementById(allDates[i].title).className = "disabled"; 
				
				if(allDates[i].className != ""){
					allDates[i].className = "";
				}
			}
			
				for(i = 0; i < valuesToSearch.length; i++){
					llenarFechaConValorParticular(valuesToSearch[i]);
				}
		}else{
			llenarFechaConValorParticularV2(valuesToSearch);
		}
	}
}

function disabledEnabledDates(){
	if(document.getElementById("dateAll").checked == true){
		//tengo la opcion de cualquier día
	}
}

function onChangeSelectValues(selectObj, elementosEnSelectHID){
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

function getDateValues(){
	//verifico si debo obtener los valores de las fechas o no
	//solo se obtendran en 2 condiciones
	//1.- que las fechas esten integras como en la carga inicial
	//2.- o que tengan valores especificos de fecha seleccionados
	var fechasIntegras = false, fechasEspecificas = false;
	var allDates = document.getElementsByName("date");
	var valoresIntegros = 0, i = 0;
	var dateValues = "";
	
	for(i = 0; i < allDates.length; i++){
		if(allDates[i].className != ""){
			fechasEspecificas = true;
			break;
		}else{
			valoresIntegros ++;
		}
	}
	
	//verificamos la condicion para proceder a obtener los valores segun las fechas.
	if(fechasEspecificas){
		//obtengo los valores de todas las fechas seleccionadas
		for(i = 0; i < allDates.length; i++){
			if(allDates[i].className != ""){
				if(dateValues != ""){
					dateValues += "||";
				}
				
				dateValues += document.getElementById("dateHID" + allDates[i].title).value;
			}
		}
		
		dateValues = dateValues.split("||");
	} else if(valoresIntegros == allDates.length){
		for(i = 0; i < allDates.length; i++){
			if(dateValues != ""){
				dateValues += "||";
			}
				
			dateValues += document.getElementById("dateHID" + allDates[i].title).value; 
		}
		
		dateValues = dateValues.split("||");
	}
	
	return dateValues;
}

function onChangePaquete(){
	//obtenemos los valores de los selects que estan seleccionados
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (document.getElementById("titulos").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("titulos").options.length == document.getElementById("titulosHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues6 = getDateValues();
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarFechas(arrayValues, esDevolucionDeFiltro);
	}
}

function onChangePuerto(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (document.getElementById("puerto").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("puerto").options.length == document.getElementById("puertoHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues6 = getDateValues();
	}
	
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarFechas(arrayValues, esDevolucionDeFiltro);
	}
}

function onChangeDestino(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (document.getElementById("destinos").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("destinos").options.length == document.getElementById("destinosHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues6 = getDateValues();
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarFechas(arrayValues, esDevolucionDeFiltro);
	}
}

function onChangeNaviera(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (document.getElementById("navieras").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("navieras").options.length == document.getElementById("navierasHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues6 = getDateValues();
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarFechas(arrayValues, esDevolucionDeFiltro);
	}
}


function onChangePrecio(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null, arrayValues5 = null, arrayValues6 = null;
	var esDevolucionDeFiltro = (document.getElementById("precio").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("precio").options.length == document.getElementById("precioHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("puerto"),
				document.getElementById("puertoHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("destinos"),
				document.getElementById("destinosHID").options.length);
		arrayValues5 = onChangeSelectValues(document.getElementById("navieras"),
				document.getElementById("navierasHID").options.length);
		arrayValues6 = getDateValues();
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("puertoHID"), document.getElementById("puerto"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("destinosHID"), document.getElementById("destinos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("navierasHID"), document.getElementById("navieras"), arrayValues, esDevolucionDeFiltro);
		modificarFechas(arrayValues, esDevolucionDeFiltro);
	}
}

function onChangePaqueteCircuito(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null;
	var esDevolucionDeFiltro = (document.getElementById("titulos").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("titulos").options.length == document.getElementById("titulosHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("duracion"),
				document.getElementById("duracionHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("itinerario"),
				document.getElementById("itinerarioHID").options.length);
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, null, null);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("duracionHID"), document.getElementById("duracion"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("itinerarioHID"), document.getElementById("itinerario"), arrayValues, esDevolucionDeFiltro);
	}
}

function onChangePrecioCircuito(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null;
	var esDevolucionDeFiltro = (document.getElementById("precio").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("precio").options.length == document.getElementById("precioHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("duracion"),
				document.getElementById("duracionHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("itinerario"),
				document.getElementById("itinerarioHID").options.length);
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, null, null);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("duracionHID"), document.getElementById("duracion"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("itinerarioHID"), document.getElementById("itinerario"), arrayValues, esDevolucionDeFiltro);
	}
}

function onChangeDuracionCircuito(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null;
	var esDevolucionDeFiltro = (document.getElementById("duracion").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("duracion").options.length == document.getElementById("duracionHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("duracion"),
				document.getElementById("duracionHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("itinerario"),
				document.getElementById("itinerarioHID").options.length);
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, null, null);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("itinerarioHID"), document.getElementById("itinerario"), arrayValues, esDevolucionDeFiltro);
	}
}

function onChangeItinerarioCircuito(){
	var arrayValues1 = null, arrayValues2 = null, arrayValues3 = null, arrayValues4 = null;
	var esDevolucionDeFiltro = (document.getElementById("itinerario").value == "0");
	
	if((! esDevolucionDeFiltro) || (document.getElementById("itinerario").options.length == document.getElementById("itinerarioHID").options.length)){
		arrayValues1 = onChangeSelectValues(document.getElementById("itinerario"),
				document.getElementById("itinerarioHID").options.length);
	}
	
	if(esDevolucionDeFiltro){
		arrayValues2 = onChangeSelectValues(document.getElementById("titulos"),
				document.getElementById("titulosHID").options.length);
		arrayValues3 = onChangeSelectValues(document.getElementById("precio"),
				document.getElementById("precioHID").options.length);
		arrayValues4 = onChangeSelectValues(document.getElementById("duracion"),
				document.getElementById("duracionHID").options.length);
	}
	
	var arrayValues = startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, null, null);
	if(arrayValues != null){
		modificarSelectDependiente(document.getElementById("titulosHID"), document.getElementById("titulos"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("precioHID"), document.getElementById("precio"), arrayValues, esDevolucionDeFiltro);
		modificarSelectDependiente(document.getElementById("duracionHID"), document.getElementById("duracion"), arrayValues, esDevolucionDeFiltro);
	}
}

function startProcessWithValues(arrayValues1, arrayValues2, arrayValues3, arrayValues4, arrayValues5, arrayValues6){
	//concatenamos los arrays
	var arrayValues = null;
	
	//alert(arrayValues1+"\n"+ arrayValues2 +"\n"+  arrayValues3 +"\n"+  arrayValues4 +"\n"+  arrayValues5);
	if(arrayValues1 != null){
		arrayValues = arrayValues1;
	}
	if(arrayValues2 != null){
		if(arrayValues == null){
			arrayValues = arrayValues2;
		}else{
			arrayValues = arrayValues.concat(arrayValues2);
		}
	}
	if(arrayValues3 != null){
		if(arrayValues == null){
			arrayValues = arrayValues3;
		}else{
			arrayValues = arrayValues.concat(arrayValues3);
		}
	}
	if(arrayValues4 != null){
		if(arrayValues == null){
			arrayValues = arrayValues4;
		}else{
			arrayValues = arrayValues.concat(arrayValues4);
		}
	}
	if(arrayValues5 != null){
		if(arrayValues == null){
			arrayValues = arrayValues5;
		}else{
			arrayValues = arrayValues.concat(arrayValues5);
		}
	}
	if(arrayValues6 != null){
		if(arrayValues == null){
			arrayValues = arrayValues6;
		}else{
			arrayValues = arrayValues.concat(arrayValues6);
		}
	}
	
	var uniqueValues = arrayValues.filter(function(itm,i,a){
	    return i==a.indexOf(itm);
	});
	
	//alert(uniqueValues);
	
	return uniqueValues;
}
