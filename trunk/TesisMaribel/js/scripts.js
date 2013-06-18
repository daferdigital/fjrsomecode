String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

//variable para almacenar los cargos para relacionarlos con los dptos en las busquedas
window.cargos = new Array();
var indice = 0;
var ajaxImageName = "ajax.gif";

/**
 * 
 * @param mail
 * @returns {Boolean}
 */
function checkIfIsAValidMail(mail){
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(! re.test(mail.trim())){
		return false;
	}
	
	return true;
}

/**
 * 
 * @param e
 * @returns {Boolean}
 */
function textInputOnlyNumbers(e){
	var key = (e.which != null) ? e.which : e.keyCode;
	
	//alert(key);
	
	if((key >= 48 && key <= 57) || key == 9 || key == 8){
		return true;
	} else {
		return false;
	}
}

/**
 * 
 * @param e
 * @returns {Boolean}
 */
function textInputCurrency(e){
	///(^\d{1,3}(\.?\d{3})*(,\d{2})?$)
	var key = (e.which != null) ? e.which : e.keyCode;
	
	//alert(key);
	
	if((key >= 48 && key <= 57) || key == 9 || key == 8 || key == 44 || key == 46){
		return true;
	} else {
		return false;
	}
}

/**
 * 
 * @param e
 * @returns {Boolean}
 */
function textInputOnlyLetters(e){
	var key = (e.which != null) ? e.which : e.keyCode;
	
	//alert(key);
	
	//97-122 a-z
	//65-90 A-Z
	//241 ñ
	//209 Ñ
	//225-233-237-243-250 á é í ó ú
	//9 backspace
	if((key >= 97 && key <= 122) || (key >= 65 && key <= 90)
			|| (key == 241 || key == 209 || key == 32 || key == 225 || key == 233 
					|| key == 237 || key == 243 || key == 250 || key == 9 
					|| key == 8)){
		return true;
	} else {
		return false;
	}
}

/**
 * 
 * @param e
 * @returns {Boolean}
 */
function textNoSpaces(e){
	var key = (e.which != null) ? e.which : e.keyCode;
	
	//alert(key);
	
	//9 backspace
	//32 space
	if(key == 32){
		return false;
	} else {
		return true;
	}
}

/**
 * 
 * @param checkName
 * @returns {Boolean}
 */
function isCheckedAny(checkName){
	var nodeList = document.getElementsByName(checkName);
	var isChecked = false;
	
	if(nodeList != null){
		var items = nodeList.length;
		
		for (var i = 0; i < items; i++) {
			//tengo los input
			if(nodeList.item(i).checked){
				isChecked = true;
				break;
			}
		}
	}
	
	return isChecked;
}

function displayElement(elementId, show){
	if(show){
		document.getElementById(elementId).style.display = "";
	} else {
		document.getElementById(elementId).style.display = "none";
	}
}

/**
 * 
 * @param forma
 */
function validateForm(forma){
	var doSubmit = true;
	
	//apagamos los mensajes de error
	document.getElementById("spanErrorNombre").style.display = "none";
	document.getElementById("spanErrorApellido").style.display = "none";
	document.getElementById("spanErrorTipoCi").style.display = "none";
	document.getElementById("spanErrorValueCi").style.display = "none";
	document.getElementById("spanErrorLengthCi").style.display = "none";
	document.getElementById("spanErrorLugarNacimiento").style.display = "none";
	document.getElementById("spanErrorFechaNacimiento").style.display = "none";
	document.getElementById("spanErrorSexo").style.display = "none";
	document.getElementById("spanErrorEdoCivil").style.display = "none";
	document.getElementById("spanErrorTieneHijos").style.display = "none";
	document.getElementById("spanErrorDireccion").style.display = "none";
	document.getElementById("spanErrorTelefonoHabitacion").style.display = "none";
	document.getElementById("spanErrorTelefonoCelular").style.display = "none";
	document.getElementById("spanErrorCorreo").style.display = "none";
	document.getElementById("spanErrorgradoInstruccion").style.display = "none";
	document.getElementById("spanErrorProfesion").style.display = "none";
	document.getElementById("spanErrorEspecialidad").style.display = "none";
	document.getElementById("spanErrorExperiencia").style.display = "none";
	document.getElementById("spanErrorCuantosTrabajos").style.display = "none";
	document.getElementById("spanErrorTiempoTrabajo").style.display = "none";
	document.getElementById("spanErrorCargoAspirado").style.display = "none";
	document.getElementById("spanErrorExEmpleado").style.display = "none";
	document.getElementById("spanErrorExDpto").style.display = "none";
	document.getElementById("spanErrorMotivoRetiro").style.display = "none";
	document.getElementById("spanErrorHorario").style.display = "none";
	
	//validamos el nombre
	if(forma.nombre.value.trim() == ""){
		forma.nombre.focus();
		document.getElementById("spanErrorNombre").style.display = "";
		doSubmit = false;
	}
	
	//validamos el apellido
	if(forma.apellido.value.trim() == ""){
		forma.apellido.focus();
		document.getElementById("spanErrorApellido").style.display = "";
		doSubmit = false;
	}
	
	//validamos la cedula
	if(forma.tipoCi.value.trim() == ""){
		forma.tipoCi.focus();
		document.getElementById("spanErrorTipoCi").style.display = "";
		doSubmit = false;
	} else {
		if(forma.ci.value.trim() == ""){
			forma.ci.focus();
			document.getElementById("spanErrorValueCi").style.display = "";
			doSubmit = false;
		} else {
			//validamos la longitud de la cedula introducida
			if(forma.ci.value.trim().length < 6 || forma.ci.value.trim().length > 8 ){
				document.getElementById("spanErrorLengthCi").style.display = "";
				forma.ci.focus();
				doSubmit = false;
			}
		}
	}
	
	//validamos el lugar de nacimiento
	if(forma.lugarNacimiento.value.trim() == ""){
		forma.lugarNacimiento.focus();
		document.getElementById("spanErrorLugarNacimiento").style.display = "";
		doSubmit = false;
	}
	
	//validamos la fecha de nacimiento
	if(forma.fechaNacimiento.value.trim() == ""){
		document.getElementById("spanErrorFechaNacimiento").style.display = "";
		document.getElementById("spanErrorFechaNacimiento").focus();
		doSubmit = false;
	}
	
	//validamos el genero
	if(document.getElementById("sexoFem").checked == false && document.getElementById("sexoMas").checked == false){
		document.getElementById("spanErrorSexo").style.display = "";
		document.getElementById("sexoFem").focus();
		doSubmit = false;
	}
	
	//validamos el estado civil
	if(forma.edoCivil.value.trim() == ""){
		document.getElementById("spanErrorEdoCivil").style.display = "";
		forma.edoCivil.focus();
		doSubmit = false;
	}
	
	//validamos si tiene hijos
	if(document.getElementById("siTieneHijos").checked == false && document.getElementById("noTieneHijos").checked == false){
		document.getElementById("spanErrorTieneHijos").style.display = "";
		document.getElementById("siTieneHijos").focus();
		doSubmit = false;
	}
	
	//validamos la direccion de habitacion
	if(forma.direccion.value.trim() == ""){
		document.getElementById("spanErrorDireccion").style.display = "";
		forma.direccion.focus();
		doSubmit = false;
	}
	
	//validamos el numero de telefono de habitacion
	if(forma.telefonoHab.value.trim() == "" || forma.telefonoHab.value.trim().length != 11){
		document.getElementById("spanErrorTelefonoHabitacion").style.display = "";
		forma.telefonoHab.focus();
		doSubmit = false;
	}
	
	//validamos el numero de telefono celular
	if(forma.telefonoCel.value.trim() == "" || forma.telefonoCel.value.trim().length != 11){
		document.getElementById("spanErrorTelefonoCelular").style.display = "";
		forma.telefonoCel.focus();
		doSubmit = false;
	}
	
	//validamos el correo
	if(! checkIfIsAValidMail(forma.correo.value.trim())){
		document.getElementById("spanErrorCorreo").style.display = "inline";
		forma.correo.focus();
		doSubmit = false;
	}
	
	//validamos el grado de instruccion
	if(forma.gradoInstruccion.value.trim() == ""){
		document.getElementById("spanErrorgradoInstruccion").style.display = "inline";
		forma.gradoInstruccion.focus();
		doSubmit = false;
	}
	
	//validamos la profesion
	if(forma.profesionalEn.value.trim() == ""){
		document.getElementById("spanErrorProfesion").style.display = "inline";
		forma.profesionalEn.focus();
		doSubmit = false;
	}
	
	//validamos la especialidad
	if(forma.especialistaEn.value.trim() == ""){
		document.getElementById("spanErrorEspecialidad").style.display = "inline";
		forma.especialistaEn.focus();
		doSubmit = false;
	}
	
	//validamos la experiencia laboral
	if(! isCheckedAny("expLaboral")){
		document.getElementById("spanErrorExperiencia").style.display = "inline";
		document.getElementById("siExpLaboral").focus();
		doSubmit = false;
	}
	
	//validamos la cantidad de trabajos en el pasado año
	if(document.getElementById("siExpLaboral").checked
			&& ! isCheckedAny("cuantosTrabajos")){
		document.getElementById("spanErrorCuantosTrabajos").style.display = "inline";
		document.getElementById("1Trabajo").focus();
		doSubmit = false;
	}
	
	//validamos la antiguedad en el ultimo trabajo
	if(document.getElementById("siExpLaboral").checked
			&& ! isCheckedAny("tiempoTrabajo")){
		document.getElementById("spanErrorTiempoTrabajo").style.display = "inline";
		document.getElementById("tiempoDias").focus();
		doSubmit = false;
	}
	
	//validamos la antiguedad en el ultimo trabajo
	if(! isCheckedAny("cargoAspirado")){
		document.getElementById("spanErrorCargoAspirado").style.display = "inline";
		document.getElementById("cargo1").focus();
		doSubmit = false;
	}
	
	//validamos si es un ex empleado
	if(! isCheckedAny("trabajoMuralla")){
		document.getElementById("spanErrorExEmpleado").style.display = "inline";
		document.getElementById("siExEmpleado").focus();
		doSubmit = false;
	}
	
	//validamos el ex dpto, solo si se indico ser ex empleado
	if(document.getElementById("siExEmpleado").checked
			&& forma.dptoTrabajo.value.trim() == ""){
		document.getElementById("spanErrorExDpto").style.display = "inline";
		forma.dptoTrabajo.focus();
		doSubmit = false;
	}
	
	//validamos el motivo del retiro, solo si se indico ser ex empleado
	if(document.getElementById("siExEmpleado").checked
			&& forma.motivoRetiro.value.trim() == ""){
		document.getElementById("spanErrorMotivoRetiro").style.display = "inline";
		forma.motivoRetiro.focus();
		doSubmit = false;
	}
	
	//validamos el horario solicitado
	if(! isCheckedAny("horario[]")){
		document.getElementById("spanErrorHorario").style.display = "inline";
		document.getElementById("horarioMixto").focus();
		doSubmit = false;
	}
	
	if(doSubmit){
		forma.submit();
	}
}

/**
 * 
 */
function validarLogin(forma){
	var doSubmit = true;
	
	forma.login.value = forma.login.value.trim();
	forma.clave.value = forma.clave.value.trim();
	
	document.getElementById("spanNotEmptyLogin").style.display = "none";
	document.getElementById("spanNotEmptyPassword").style.display = "none";
	
	//verificamos que el campo login tenga algun valor
	if(forma.login.value == ""){
		document.getElementById("spanNotEmptyLogin").style.display = "";
		doSubmit = false;
	}
	
	//verificamos que el campo clave tenga algun valor
	if(forma.clave.value == ""){
		document.getElementById("spanNotEmptyPassword").style.display = "";
		doSubmit = false;
	}
	
	return doSubmit;
}

function startDelayToShowCargos(dptoValue){
	document.getElementById("cargo").style.display = "none";
	document.getElementById("cargoAjax").style.display = "";
	
	setTimeout(function(){
		checkCargos(dptoValue);
	}, 500);
}

function checkCargos(dptoValue){
	var selectCargos = document.getElementById("cargo");
	
	selectCargos.options.length = 0;
	selectCargos.options[selectCargos.options.length] = new Option("Todos", "");
	
	if(dptoValue.trim() != ""){
		//se desean ver todos los departamentos, asi que limpio los cargos
		var yaEncontreElDpto = false;
		
		for ( var i = 0; i < window.cargos.length; i++) {
			if(window.cargos[i].idDpto == dptoValue){
				selectCargos.options[selectCargos.options.length] = new Option(window.cargos[i].nombre,
						window.cargos[i].id);
				
				yaEncontreElDpto = true;
			} else if(yaEncontreElDpto){
				break;
			}
		}
	}
	
	document.getElementById("cargoAjax").style.display = "none";
	document.getElementById("cargo").style.display = "";
	
}


/**
 * funcion para crear un objeto del tipo XMLHTTPRequest segun el navegador
 * 
 * @returns objeto XMLHTTPRequest creado
 */
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

/**
 * 
 * @param url
 * @param parameters
 * @param idAnswerContainer si es null mostramos la respuesta del ajax como un alert
 */
function callAjax(url, parameters, idAnswerContainer, urlToRefresh){
	var ajaxObject =  createXMLHTTPRequest();

	if(idAnswerContainer != null){
		document.getElementById(idAnswerContainer).style.display="inline";
		document.getElementById(idAnswerContainer).innerHTML = "<img src=\"img/" + ajaxImageName + "\"/>";
	}
	
	ajaxObject.onreadystatechange=function() {
		if (ajaxObject.readyState==4 && ajaxObject.status==200) {
			if(idAnswerContainer != null){
				document.getElementById(idAnswerContainer).innerHTML = ajaxObject.responseText;
			} else {
				alert(ajaxObject.responseText);
				$('#darkContainer').click();
			}
		
			if(urlToRefresh != null){
				window.location = urlToRefresh;
			}
		}
	};
	
	ajaxObject.open("POST", url, true);
	//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
	ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxObject.send(parameters);
}

/**
 * Llamada Ajax para obtener registros por pagina del log del transacciones del sistema
 * @param pageNumber
 */
function searchCVS(pageNumber){
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchCVS";
	parameters += "&dpto=" + document.getElementById("dpto").value;
	parameters += "&cargo=" + document.getElementById("cargo").value;
	parameters += "&cedula=" + document.getElementById("cedula").value;
	parameters += "&fechaDesde=" + document.getElementById("fechaDesdeHidden").value;
	parameters += "&fechaHasta=" + document.getElementById("fechaHastaHidden").value;
	
	callAjax("ajax/cvList.php",
			parameters,
			"ajaxPageResult",
			null);
}