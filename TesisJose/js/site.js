var ajaxImageName = "ajax.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

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
		document.getElementById(idAnswerContainer).style.margin="auto";
		document.getElementById(idAnswerContainer).innerHTML = "<img src=\"images/" + ajaxImageName + "\"/>";
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
 * 
 * @param e
 * @returns {Boolean}
 */
function textInputOnlyNumbers(e){
	var key = (window.Event) ? e.which : e.keyCode;
	
	//alert(key);
	
	if((key >= 48 && key <= 57) || key == 9 || key == 8){
		return true;
	} else {
		return false;
	}
}

function validarLoginForm(forma){
	var doSubmit = true;
	
	document.getElementById("mandatoryUsuario").style.display = "none";
	document.getElementById("mandatoryClave").style.display = "none";
	
	//validamos los campos
	if(forma.usuario.value.trim() == ""){
		document.getElementById("mandatoryUsuario").style.display = "";
		doSubmit = false;
	}
	
	if(forma.clave.value.trim() == ""){
		document.getElementById("mandatoryClave").style.display = "";
		doSubmit = false;
	}
	
	return doSubmit;
}

function validarAgregarPersonalForm(forma){
	var doSubmit = true;
	
	document.getElementById("mandatoryNombre").style.display = "none";
	document.getElementById("mandatoryApellido").style.display = "none";
	document.getElementById("mandatoryCedula").style.display = "none";
	document.getElementById("mandatoryDireccion").style.display = "none";
	document.getElementById("mandatoryTurno").style.display = "none";
	document.getElementById("mandatoryUbicacion").style.display = "none";
	document.getElementById("mandatoryFechaIngreso").style.display = "none";
	document.getElementById("mandatoryTelefono").style.display = "none";
	document.getElementById("mandatoryCargo").style.display = "none";
	
	//validamos los campos
	if(forma.nombre.value.trim() == ""){
		document.getElementById("mandatoryNombre").style.display = "";
		forma.nombre.focus();
		doSubmit = false;
	}
	
	if(forma.apellido.value.trim() == ""){
		document.getElementById("mandatoryApellido").style.display = "";
		forma.apellido.focus();
		doSubmit = false;
	}
	
	if(forma.cedula.value.trim() == ""){
		document.getElementById("mandatoryCedula").style.display = "";
		forma.cedula.focus();
		doSubmit = false;
	}
	
	if(forma.direccion.value.trim() == ""){
		document.getElementById("mandatoryDireccion").style.display = "";
		forma.direccion.focus();
		doSubmit = false;
	}
	
	if(forma.turno.value.trim() == ""){
		document.getElementById("mandatoryTurno").style.display = "";
		forma.turno.focus();
		doSubmit = false;
	}
	
	if(forma.ubicacion.value.trim() == ""){
		document.getElementById("mandatoryUbicacion").style.display = "";
		forma.ubicacion.focus();
		doSubmit = false;
	}
	
	if(forma.fechaIngreso.value.trim() == ""){
		document.getElementById("mandatoryFechaIngreso").style.display = "";
		$(window).scrollTop($('#mandatoryFechaIngreso').offset().top);
		doSubmit = false;
	}
	
	if(forma.telefono.value.trim() == ""){
		document.getElementById("mandatoryTelefono").style.display = "";
		forma.telefono.focus();
		doSubmit = false;
	}
	
	if(forma.cargo.value.trim() == ""){
		document.getElementById("mandatoryCargo").style.display = "";
		forma.cargo.focus();
		doSubmit = false;
	}
	
	return doSubmit;
}

/**
 * Llamada Ajax para obtener el listado del personal del sistema
 * @param pageNumber
 */
function searchPersonal(pageNumber){
	var cedula = document.getElementById("ci").value;
	if(cedula != ""){
		cedula =+ "-";
	}
	
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchPersonal";
	parameters += "&nombre=" + document.getElementById("nombre").value;
	parameters += "&apellido=" + document.getElementById("apellido").value;
	parameters += "&cedula=" + cedula + document.getElementById("cedula").value.trim();
	parameters += "&cargo=" + document.getElementById("cargo").value;
	
	callAjax("ajax/getListarPersonal.php",
			parameters,
			"ajaxPageResult",
			null);
}