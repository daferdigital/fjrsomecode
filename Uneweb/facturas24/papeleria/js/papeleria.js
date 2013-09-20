var ajaxImageName = "loadIndicator.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

/**
 * 
 * @param frameName
 * @param loadingImageId
 * @param containerName
 */
function loadFrame(frameName, containerId, tipoContenido) {
	var container = document.getElementById(containerId);
	var url = "frames/" + frameName + ".php";
	var parameters = "contenido=" + tipoContenido;
	
	if(container == null){
		alert("No se encontro el container '" + containerId + "'");
	} else {
		callAjax(url, parameters, containerId, null);
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
 * @param idAnswerContainer si es null mostramos la respuesta del ajax como un alert
 * @param urlToRefresh url to refresh after ajax, can be null
 */
function callAjax(url, parameters, idAnswerContainer, urlToRefresh){
	var ajaxObject =  createXMLHTTPRequest();

	if(idAnswerContainer != null){
		document.getElementById(idAnswerContainer).style.display="inline";
		document.getElementById(idAnswerContainer).innerHTML = "<img src=\"images/" + ajaxImageName + "\"/>";
	}
	
	ajaxObject.onreadystatechange=function() {
		if (ajaxObject.readyState==4 && ajaxObject.status==200) {
			if(idAnswerContainer != null){
				document.getElementById(idAnswerContainer).innerHTML = ajaxObject.responseText;
			} else {
				//alert(ajaxObject.responseText);
				//$('#darkContainer').click();
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
 * @param forma
 * @returns {Boolean}
 */
function validarSolicitud(forma){
	var doSubmit = true;
	
	//verificamos los campos existentes para validarlos
	var spanCantidad = document.getElementById("mandatoryCantidad");
	if(spanCantidad != null){
		spanCantidad.style.display= "none";
		var field = document.getElementById("cantidad");
		if(field != null && field.value == ""){
			spanCantidad.style.display= "";
			doSubmit = false;
		}
	}
	
	var spanImpresion = document.getElementById("mandatoryImpresion");
	if(spanImpresion != null){
		spanImpresion.style.display= "none";
		var items = document.getElementsByName("impresion");
		var oneIsChecked = false;
		
		if(items != null){
			for ( var i = 0; i < items.length; i++) {
				if(items[i].checked){
					oneIsChecked = true;
					break;
				}
			}
			
			doSubmit = oneIsChecked;
			if(! oneIsChecked){
				spanImpresion.style.display= "";
			}
		}
	}
	
	var spanArtFile = document.getElementById("mandatoryArtFile");
	if(spanArtFile != null){
		spanArtFile.style.display= "none";
		var field = document.getElementById("artFile");
		if(field != null && field.value == ""){
			spanArtFile.style.display= "";
			doSubmit = false;
		}
	}
	
	
	
	return doSubmit;
}
