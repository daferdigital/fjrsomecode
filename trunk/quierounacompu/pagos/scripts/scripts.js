String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

function showAlert(msg){
	alert(msg);
}

/**
 * Open in a popup the terms and conditions
 */
function popUpTerminos(){
	var popUpURL = "terminos.php";
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var w = 1000;
	var h = 550;
	
	var newwindow = window.open(popUpURL,'name','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	
	if (window.focus) {
		newwindow.focus();
	}
	
	return false;
}

/**
 * 
 */
function checkCiaEnvio(){
	var ciaEnvio = document.getElementById("envio").options[document.getElementById("envio").selectedIndex].text;
	
	if(ciaEnvio == "MRW"){
		showAlert('Estimado cliente MRW no ASEGURA ningún tipo de producto, '
				+ 'por lo que si selecciona esta empresa como método de envio recuerde que el envio va bajo '
				+ 'RESPONSABILIDAD ABSOLUTA del COMPRADOR.\rGracias por su atención\r QUIEROUNACOMPU.COM');
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
 * @param textResponse
 */
function procesarRespuestaAjax(textResponse){
	//vemos el codigo de respuesta para saber que mensaje mostrar
	if(textResponse == "0"){
		var msg = 'Gracias por completar la información, en breve le será enviado un email con todos los datos para su archivo.\r'
			+ 'RECUERDE ESPERAR hasta que aparezca la pantalla de AGRADECIMIENTO POR SU PAGO';
		showAlert(msg);
	} else if(textResponse == "-1"){
		showAlert("Debe indicar los terminos y condiciones");
	} else if(textResponse == "1"){
		showAlert("No pudo almacenarse la informacion suministrada, favor intente de nuevo");
	} else {
		showAlert(textResponse);
	}
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
 * @param payForm
 */
function validarFormularioDePago(payForm){
	var doSubmit = true;
	//datos del cliente
	var nombre = payForm.nombre.value.trim();
	var seudonimo = payForm.seudonimo.value.trim();
	var cedula = payForm.cii.value.trim();
	var email = payForm.email.value.trim();
	var tlfCelularCliente = payForm.tlfCelularCliente.value.trim();
	var tlfLocalCliente = payForm.tlfLocalCliente.value.trim();
	//datos de pago
	var medioDePago = payForm.medio.value;
	var banco = payForm.banco.value;
	var voucher = payForm.bauche.value.trim();
	var fechaPago = payForm.fechaPago.value.trim();
	var montoPago = payForm.monto.value.trim();
	var descArticulo = payForm.articulo.value.trim();
	//datos del envio
	var ciaEnvio = payForm.envio.value;
	var destinatario = payForm.destinatario.value.trim();
	var ciDestinatario = payForm.ciDestinatario.value.trim();
	var dirDestino = payForm.dir1.value.trim();
	var ciudadDestino = payForm.ciudad.value.trim();
	var estadoDestino = payForm.estado.value.trim();
	var celularDestino = payForm.celular.value.trim();
	var tlfLocalDestino = payForm.tlfLocalDestinatario.value.trim();
	var checkTerminosCondiciones = payForm.terminos.checked;
	
	document.getElementById("spanNombre").style.display = "none";
	document.getElementById("spanSeudonimo").style.display = "none";
	document.getElementById("spanCii").style.display = "none";
	document.getElementById("spanEmail").style.display = "none";
	document.getElementById("spanMedio").style.display = "none";
	document.getElementById("spanBanco").style.display = "none";
	document.getElementById("spanArticulo").style.display = "none";
	document.getElementById("spanBauche").style.display = "none";
	document.getElementById("spanFechaPago").style.display = "none";
	document.getElementById("spanMonto").style.display = "none";
	document.getElementById("spanEnvio").style.display = "none";
	document.getElementById("spanDestinatario").style.display = "none";
	document.getElementById("spanCIDestinatario").style.display = "none";
	document.getElementById("spanDir1").style.display = "none";
	document.getElementById("spanCiudad").style.display = "none";
	document.getElementById("spanEstado").style.display = "none";
	document.getElementById("spanCelularDestinatario").style.display = "none";
	document.getElementById("spanTerminos").style.display = "none";
	
	if(seudonimo == ""){
		document.getElementById("spanSeudonimo").style.display = "inline";
		payForm.seudonimo.focus();
		doSubmit = false;
	}
	if(nombre == ""){
		document.getElementById("spanNombre").style.display = "inline";
		payForm.nombre.focus();
		doSubmit = false;
	}
	if(cedula == ""){
		document.getElementById("spanCii").style.display = "inline";
		payForm.cii.focus();
		doSubmit = false;
	}
	if(email == ""){
		document.getElementById("spanEmail").style.display = "inline";
		payForm.email.focus();
		doSubmit = false;
	}
	if(tlfCelularCliente == "" && tlfLocalCliente == ""){
		document.getElementById("spanCelularCliente").style.display = "inline";
		payForm.celular.focus();
		doSubmit = false;
	}
	if(medioDePago == "-1"){
		document.getElementById("spanMedio").style.display = "inline";
		payForm.medio.focus();
		doSubmit = false;
	}
	if(banco == "-1"){
		document.getElementById("spanBanco").style.display = "inline";
		payForm.banco.focus();
		doSubmit = false;
	}
	if(descArticulo == ""){
		document.getElementById("spanArticulo").style.display = "inline";
		payForm.articulo.focus();
		doSubmit = false;
	}
	if(voucher == ""){
		document.getElementById("spanBauche").style.display = "inline";
		payForm.bauche.focus();
		doSubmit = false;
	}
	if(fechaPago == ""){
		document.getElementById("spanFechaPago").style.display = "inline";
		document.getElementById("spanFechaPago").focus();
		doSubmit = false;
	}
	if(montoPago == ""){
		document.getElementById("spanMonto").style.display = "inline";
		payForm.monto.focus();
		doSubmit = false;
	}
	if(ciaEnvio == "-1"){
		document.getElementById("spanEnvio").style.display = "inline";
		payForm.envio.focus();
		doSubmit = false;
	}
	if(destinatario == ""){
		document.getElementById("spanDestinatario").style.display = "inline";
		payForm.destinatario.focus();
		doSubmit = false;
	}
	if(ciDestinatario == ""){
		document.getElementById("spanCIDestinatario").style.display = "inline";
		payForm.ciDestinatario.focus();
		doSubmit = false;
	}
	if(dirDestino == ""){
		document.getElementById("spanDir1").style.display = "inline";
		payForm.dir1.focus();
		doSubmit = false;
	}
	if(ciudadDestino == ""){
		document.getElementById("spanCiudad").style.display = "inline";
		payForm.ciudad.focus();
		doSubmit = false;
	}
	if(estadoDestino == "-1"){
		document.getElementById("spanEstado").style.display = "inline";
		payForm.estado.focus();
		doSubmit = false;
	}
	if(celularDestino == "" && tlfLocalDestino == ""){
		document.getElementById("spanCelularDestinatario").style.display = "inline";
		payForm.celular.focus();
		doSubmit = false;
	}
	if(checkTerminosCondiciones == false){
		document.getElementById("spanTerminos").style.display = "inline";
		payForm.terminos.focus();
		doSubmit = false;
	}
	
	if(doSubmit){
		/*
		var parameters = "nombre=" + nombre;
		parameters += "&seudonimo=" + seudonimo;
		parameters += "&cedulaCliente=" + payForm.ci.value + "-" + cedula;
		parameters += "&email=" + email;
		parameters += "&tlfCelularCliente=" + (tlfCelularCliente == "" ? "" : payForm.codCelCliente.value + tlfCelularCliente);
		parameters += "&tlfLocalCliente=" + (tlfLocalCliente == "" ? "" : payForm.codLocalCliente.value + tlfCelularCliente);
		parameters += "&medioDePago=" + medioDePago;
		parameters += "&banco=" + banco;
		parameters += "&numVoucher=" + voucher;
		parameters += "&fechaPago=" + fechaPago;
		parameters += "&monto=" + montoPago;
		parameters += "&detalleProductos=" + descArticulo;
		parameters += "&ciaEnvio=" + ciaEnvio;
		parameters += "&destinatario=" + destinatario;
		parameters += "&ciDestinatario=" + ciDestinatario;
		parameters += "&dirDestino=" + dirDestino;
		parameters += "&ciudad=" + ciudadDestino;
		parameters += "&estado=" + estadoDestino;
		parameters += "&tlfCelularDestinatario=" + (celularDestino == "" ? "" : payForm.codcel.value + celularDestino);
		parameters += "&tlfLocalDestinatario=" + (tlfLocalDestino == "" ? "" : payForm.codLocalDestinatario.value + tlfLocalDestino);
		parameters += "&observacionesEnvio=" + payForm.obs.value.trim();
		parameters += "&terminos=true";
		
		callAjax("storePay.php",
				parameters,
				"Enviar",
				"ajaxLoading");
		*/
		
		payForm.submit();
	}
	
	return doSubmit;
}

/**
 * 
 * @param elementId
 */
function eliminarElemento(elementId){
	var element = document.getElementById(elementId);
	
	element.parentNode.removeChild(element);
}

var idCounter = 1;
/**
 * 
 * @param cantidadValue
 * @param productoValue
 * @param observacionValue
 */
function addFilaProductosComprados(){
	var cantidadValue = document.getElementById("cantidadTMP").value; 
	var productoValue = document.getElementById("productoTMP").value.trim();
	var observacionValue = document.getElementById("observacionesTMP").value.trim();
	
	if(productoValue == "" || observacionValue == ""){
		alert("Disculpe, debe indicar tanto el producto como las observaciones del mismo.");
		return;
	}
	
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("detalleProductosComprados");
	
	var htmlContainerText = 
		  '    <tr bgcolor="#CCCCCC">'
		+ '        <td width="200px">'
		+ '            ' + cantidadValue
		+ '        </td>'
		+ '        <td width="200px">'
		+ '            ' + productoValue
		+ '        </td>'
		+ '        <td width="200px">'
		+ '            ' + observacionValue
		+ '        </td>'
		+ '    </tr>';
	
	nodoPadre.innerHTML += htmlContainerText;
	
	document.getElementById("productoTMP").value = "";
	document.getElementById("observacionesTMP").value = "";
	document.getElementById("articulo").value = nodoPadre.innerHTML;
}