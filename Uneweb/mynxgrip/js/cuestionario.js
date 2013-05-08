var ajaxImageName = "ajax.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

/**
 * 
 * @param pregunta
 */
function desmarcarRespuestaMarcada(pregunta){
	var i = 0;
	
	while(document.getElementById(pregunta + "_" + i) != null){
		document.getElementById(pregunta + "_" + i).checked = false;
		i++;
	}
}

/**
 * 
 * @param pregunta
 * @returns {Number}
 */
function obtenerRespuestaMarcada(pregunta){
	var i = 0;
	var respuesta = 0;
	
	while(document.getElementById(pregunta + "_" + i) != null){
		//alert(pregunta + "_" + i + ".checked=" + document.getElementById(pregunta + "_" + i).checked);
		if(document.getElementById(pregunta + "_" + i).checked == true){
			respuesta = i + 1;
			break;
		}
		
		i++;
	}
	
	return respuesta;
}

/**
 * 
 */
function procesarRespuestaAjax(ajaxResponse){
	//alert(ajaxResponse);
	var arrayResponse = ajaxResponse.split("|");
	
	if(arrayResponse[0] != null){
		alert(arrayResponse[0]);
	}
	if(arrayResponse[1] == 0){
		//se respondio correctamente el formulario
		//refrescamos toda la pagina
		window.location = arrayResponse[2];
	} else {
		//el cuestionario en cuestion se respondio mal
		//alert(arrayResponse[2]);
		var respuestasErradas = arrayResponse[2].split(",");
		for ( var i = 0; i < respuestasErradas.length; i++) {
			var pregunta = respuestasErradas[i];
			desmarcarRespuestaMarcada(pregunta);
		}
	}
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
 * @param htmlElementToHide
 */
function callAjax(url, parameters, htmlElementToHide, idImgLoading){
	var ajaxObject =  createXMLHTTPRequest();

	document.getElementById(htmlElementToHide).style.display="none";
	document.getElementById(idImgLoading).style.display = "inline";
	
	ajaxObject.onreadystatechange=function() {
		if (ajaxObject.readyState==4 && ajaxObject.status==200) {
			document.getElementById(htmlElementToHide).style.display="inline";
			document.getElementById(idImgLoading).style.display = "none";
			
			procesarRespuestaAjax(ajaxObject.responseText);
		}
	};
	
	ajaxObject.open("POST", url, true);
	//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
	ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxObject.send(parameters);
}

/**
 * 
 * @returns {Boolean}
 */
function validarFormulario(){
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var message = "";
	var parameters = "";
	var enviarForm = true;
	
	if(document.getElementById("nombre").value.trim() == ""){
		message += "Disculpe, debe indicar el nombre.\n";
		enviarForm = false;
		document.getElementById("nombre").focus();
	}
	if(! re.test(document.getElementById("correo").value.trim())){
		message += "Disculpe, la direccion de correo posee un formato invalido.\n";
		enviarForm = false;
		document.getElementById("correo").focus();
	}

	if(!enviarForm){
		alert(message);
	}else{
		//preparamos la consulta via jax
		parameters += "nombre=" + document.getElementById("nombre").value.trim();
		parameters += "&correo=" + document.getElementById("correo").value.trim();
		parameters += "&numeroCuestionario=" + document.getElementById("numeroCuestionario").value.trim();
		for ( var i = 1; i < 23; i++) {
			parameters += "&respuesta_" + i + "=" + obtenerRespuestaMarcada(i);
		}
		
		//alert(parameters);
		
		callAjax("enviar2.php",
				parameters,
				"Enviar",
				"ajaxLoading");
	}
}