String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

/**
 * 
 * @param idTipoPago
 * @returns
 */
function checkTipoPago(idTipoPago){
	var trBancoDestino = document.getElementById("bancoAllInfo");
	var trBancoOrigen = document.getElementById("trBancoOrigen");
	document.getElementById("bauche").onkeypress = textInputOnlyNumbers;
	
	if(idTipoPago == 5){
		//es mercado pago
		//no mostramos el banco origen ni el destino
		trBancoDestino.style.display = "none";
		trBancoOrigen.style.display = "none";
	} else {
		trBancoDestino.style.display = "";
		if(idTipoPago == 6){
			//es pago via transferencia otros bancos
			//debemos indicar que el campo de vauche es alfanumerico
			document.getElementById("bauche").onkeypress = textNoSpaces;
			document.getElementById("trBancoOrigen").style.display = "";
			document.getElementById("bancoOrigen").disabled = false;
		} else {
			document.getElementById("trBancoOrigen").style.display = "none";
			document.getElementById("bancoOrigen").disabled = true;
		}
	}
}

/**
 * 
 * @param tipoDoc
 * @param cedula
 * @returns {Boolean}
 */
function isValidCIValue(tipoDoc, cedula, messageSpanId){
	//obtenemos el tipo de documento
	//para saber que longitud debe tener
	var isValid = true;
	var length = cedula.length;
	
	if(tipoDoc == "V" || tipoDoc == "E"){
		//verificamos la longitud del valor
		if(length < 6 || length > 8){
			isValid = false;
			document.getElementById(messageSpanId).innerHTML = "<br />Disculpe, su cedula debe tener minimo 6 digitos y maximo 8";
		}
	} else if(tipoDoc == "J" || tipoDoc == "G"){
		if(length != 9){
			isValid = false;
			document.getElementById(messageSpanId).innerHTML = "<br />Disculpe, la longitud obligatoria del RIF es de 9 digitos";
		}
	}
	
	return isValid;
}

/**
 * 
 * @param tipoDoc
 * @param cedula
 * @returns {Boolean}
 */
function isValidVaucheValue(tipoPago, vauche, messageSpanId){
	//obtenemos el tipo de documento
	//para saber que longitud debe tener
	var isValid = true;
	var length = vauche.length;
	var idBanco = document.getElementById("banco").value;
	var message = "";
	
	var digitosMercadoPago = 9;
	var digitosBanesco = 11;
	var digitosMercantil = 11;
	var digitosVenezuela = 13;
	
	//1 es deposito
	//2 es transferencia desde el mismo banco
	//5 es mercado pago
	//6 es transferencia desde otro banco
	
	//banco 1 es Banesco
	//banco 2 es Mercantil
	//banco 3 es Venezuela
	if(tipoPago == 5){
		//es mercado pago, como no aplica el banco, procedemos a validar longitud
		if(length != digitosMercadoPago){
			isValid = false;
			message = "Disculpe, para MercadoPago se espera que el codigo de transacción sea de " + digitosMercadoPago + " digitos.";
			message += "<br />Recuerde que el n&uacute;mero del comprobante de pago es el que emite MercadoLibre cuando se carga el pago.";
			
			if(length < digitosMercadoPago){
				message += "<br />Le recomendamos rellenar con " + (digitosMercadoPago - length) + " cero(s) a la izquierda para completar los " + digitosMercadoPago + " digitos.";
			} else {
				message += "<br />Le recomendamos tomar los " + digitosMercadoPago  + " digitos de derecha a izquierda obviando los digitos extra.";
			}
		}
	} else {
		if(tipoPago == 1 || tipoPago == 2){
			//es deposito o transferencia desde el mismo banco, vemos el banco para validar longitud
			if(idBanco == 1){
				if(length != digitosBanesco){
					isValid = false;
					message = "Disculpe, para transacciones de Banesco se esperan codigos de " + digitosBanesco + " digitos";
					message += "<br />Como su codigo tiene " + length + " digitos.";
					
					if(length < digitosBanesco){
						message += "<br />Le recomendamos rellenar con " + (digitosBanesco - length) + " cero(s) a la izquierda para completar los " + digitosBanesco + " digitos.";
					} else {
						message += "<br />Le recomendamos tomar los " + digitosBanesco  + " digitos de derecha a izquierda obviando los digitos extra.";
					}
				}
			}
			if(idBanco == 2){
				if(length != digitosMercantil){
					isValid = false;
					message = "Disculpe, para transacciones del Banco Mercantil se esperan codigos de " + digitosMercantil + " digitos";
					message += "<br />Como su codigo tiene " + length + " digitos.";
					
					if(length < digitosMercantil){
						message += "<br />Le recomendamos rellenar con " + (digitosMercantil - length) + " cero(s) a la izquierda para completar los " + digitosMercantil + " digitos.";
					} else {
						message += "<br />Le recomendamos tomar los " + digitosMercantil  + " digitos de derecha a izquierda obviando los digitos extra.";
					}
				}
			}
			if(idBanco == 3){
				if(length != digitosVenezuela){
					isValid = false;
					message = "Disculpe, para transacciones del Banco de Venezuela se esperan codigos de " + digitosVenezuela + " digitos";
					message += "<br />Como su codigo tiene " + length + " digitos.";
					
					if(length < digitosVenezuela){
						message += "<br />Le recomendamos rellenar con " + (digitosVenezuela - length) + " cero(s) a la izquierda para completar los " + digitosVenezuela + " digitos.";
					} else {
						message += "<br />Le recomendamos tomar los " + digitosVenezuela  + " digitos de derecha a izquierda obviando los digitos extra.";
					}
				}
			}
		} else if(tipoPago == 6){
			//es transferencia desde otro banco
		}
	}
	
	if(! isValid){
		document.getElementById(messageSpanId).innerHTML = "<br />" + message;
	}
	
	return isValid;
}

/**
 * 
 * @param montoPago
 * @returns {Boolean}
 */
function isValidMonto(montoPago){
	var regExp = /^(\d{1,3}(\.\d{3})*(,\d{2})?)$|^(\d{1,3}(\.\d{3})*)$|^((\d*)(,\d{2})?)$/;
	
	if(! regExp.test(montoPago.trim())){
		return false;
	}
	
	return true;
}

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
	var key = (window.Event) ? e.which : e.keyCode;
	
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
	var key = (window.Event) ? e.which : e.keyCode;
	
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
	var key = (window.Event) ? e.which : e.keyCode;
	
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
	var key = (window.Event) ? e.which : e.keyCode;
	
	//alert(key);
	
	//9 backspace
	//32 space
	if(key == 32){
		return false;
	} else {
		return true;
	}
}

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
 * @param urlToLoad
 */
function loadAjaxPopUp(urlToLoad){
	$('#popup2').bPopup({
    	contentContainer:'.content',
    	loadUrl: urlToLoad //Uses jQuery.load()
	});
}

/**
 * 
 */
function verOtrosEnvios(payForm){
	var cedula = payForm.cii.value.trim();
	var doSubmit = true;
	
	document.getElementById("spanCii").style.display = "none";
	document.getElementById("spanCiiBadValue").style.display = "none";
	
	if(cedula == ""){
		document.getElementById("spanCii").style.display = "inline";
		payForm.cii.focus();
		doSubmit = false;
	} else {
		if(! isValidCIValue(payForm.ci.value, cedula, "spanCiiBadValue")){
			document.getElementById("spanCiiBadValue").style.display = "inline";
			payForm.cii.focus();
			doSubmit = false;
		}
	}
	
	if(doSubmit){
		//muestro via ajax los envios de este usuario
		loadAjaxPopUp("showPendingEnvios.php?ciRif=" + payForm.ci.value + "-" + cedula);
	}
}

function validarDatosDelCliente(payForm){
	var doSubmit = true;
	//datos del cliente
	var nombre = payForm.nombre.value.trim();
	var seudonimo = payForm.seudonimo.value.trim();
	var cedula = payForm.cii.value.trim();
	var email = payForm.email.value.trim();
	var tlfCelularCliente = payForm.tlfCelularCliente.value.trim();
	var tlfLocalCliente = payForm.tlfLocalCliente.value.trim();
	
	document.getElementById("spanNombre").style.display = "none";
	document.getElementById("spanSeudonimo").style.display = "none";
	document.getElementById("spanCii").style.display = "none";
	document.getElementById("spanCiiBadValue").style.display = "none";
	document.getElementById("spanEmail").style.display = "none";
	document.getElementById("spanEmailFormat").style.display = "none";
	document.getElementById("spanCelularCliente").style.display = "none";
	document.getElementById("spanCelularClienteLength").style.display = "none";
	document.getElementById("spanLocalClienteLength").style.display = "none";
	
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
	} else {
		if(! isValidCIValue(payForm.ci.value, cedula, "spanCiiBadValue")){
			document.getElementById("spanCiiBadValue").style.display = "inline";
			payForm.cii.focus();
			doSubmit = false;
		}
	}
	if(email == ""){
		document.getElementById("spanEmail").style.display = "inline";
		payForm.email.focus();
		doSubmit = false;
	} else {
		//el campo del correo tiene un valor, verificamos que sea un correo valido
		if(! checkIfIsAValidMail(email)){
			document.getElementById("spanEmailFormat").style.display = "inline";
			payForm.email.focus();
			doSubmit = false;
		}
	}
	if(tlfCelularCliente == "" && tlfLocalCliente == ""){
		document.getElementById("spanCelularCliente").style.display = "inline";
		payForm.tlfCelularCliente.focus();
		doSubmit = false;
	} else {
		//alguno tiene valores, verifico si cumple con la longitud
		if(tlfCelularCliente != "" && (tlfCelularCliente.length != payForm.tlfCelularCliente.maxLength)){
			document.getElementById("spanCelularClienteLength").style.display = "inline";
			payForm.tlfCelularCliente.focus();
			doSubmit = false;
		}
		if(tlfLocalCliente != "" && (tlfLocalCliente.length != payForm.tlfLocalCliente.maxLength)){
			document.getElementById("spanLocalClienteLength").style.display = "inline";
			payForm.tlfLocalCliente.focus();
			doSubmit = false;
		}
	}
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 * @returns {Boolean}
 */
function wasTouchedDatosDelCliente(payForm){
	var wasTouched = false;
	//datos del cliente
	var nombre = payForm.nombre.value.trim();
	var nombreHidden = payForm.nombre_hidden.value.trim();
	var seudonimo = payForm.seudonimo.value.trim();
	var seudonimoHidden = payForm.seudonimo_hidden.value.trim();
	var cedula = payForm.cii.value.trim();
	var cedulaHidden = payForm.ci_hidden.value.trim() + "-" + payForm.cii_hidden.value.trim();
	var email = payForm.email.value.trim();
	var emailHidden = payForm.email_hidden.value.trim();
	var tlfCelularCliente = payForm.codCelCliente.value.trim() + "-" + payForm.tlfCelularCliente.value.trim();
	var tlfCelularClienteHidden = payForm.codCelCliente_hidden.value.trim() + "-" + payForm.tlfCelularCliente_hidden.value.trim();
	var tlfLocalCliente = payForm.codLocalCliente.value.trim() + "-" + payForm.tlfLocalCliente.value.trim();
	var tlfLocalClienteHidden = payForm.codLocalCliente_hidden.value.trim() + "-" + payForm.tlfLocalCliente_hidden.value.trim();
	
	if(seudonimo != seudonimoHidden){
		wasTouched = wasTouched || true;
	}
	if(nombre != nombreHidden){
		wasTouched = wasTouched || true;
	}
	if((payForm.ci.value + "-" + cedula) != cedulaHidden){
		wasTouched = wasTouched || true;
	}
	if(email != emailHidden){
		wasTouched = wasTouched || true;
	}
	if("-" == tlfCelularClienteHidden){
		if(payForm.tlfCelularCliente.value.trim() != payForm.tlfCelularCliente_hidden.value.trim()){
			wasTouched = wasTouched || true;
		}
	} else if(tlfCelularCliente != tlfCelularClienteHidden){
		wasTouched = wasTouched || true;
	}
	if("-" == tlfLocalClienteHidden){
		if(payForm.tlfLocalCliente.value.trim() != payForm.tlfLocalCliente_hidden.value.trim()){
			wasTouched = wasTouched || true;
		}
	} else if(tlfLocalCliente != tlfLocalClienteHidden){
		wasTouched = wasTouched || true;
	}
	
	return wasTouched;
}

function validarDatosDelPago(payForm){
	var doSubmit = true;
	
	//datos de pago
	var medioDePago = payForm.medio.value;
	var bancoDestino = payForm.banco.value;
	var bancoOrigen = payForm.bancoOrigen.value;
	var voucher = payForm.bauche.value.trim();
	var fechaPago = payForm.fechaPago.value.trim();
	var montoPago = payForm.monto.value.trim();
	var descArticulo = payForm.articulo.value.trim();
	
	document.getElementById("spanMedio").style.display = "none";
	document.getElementById("spanBanco").style.display = "none";
	document.getElementById("spanBancoOrigen").style.display = "none";
	document.getElementById("spanArticulo").style.display = "none";
	document.getElementById("spanBauche").style.display = "none";
	document.getElementById("spanBaucheBadValue").style.display = "none";
	document.getElementById("spanFechaPago").style.display = "none";
	document.getElementById("spanMonto").style.display = "none";
	document.getElementById("spanMontoBadValue").style.display = "none";
	document.getElementById("spanArchivoPago").style.display = "none";
	
	if(medioDePago == "-1"){
		document.getElementById("spanMedio").style.display = "inline";
		payForm.medio.focus();
		doSubmit = false;
	}
	if(document.getElementById("bancoAllInfo").style.display != "none" && bancoDestino == "-1"){
		document.getElementById("spanBanco").style.display = "inline";
		payForm.banco.focus();
		doSubmit = false;
	}
	if(document.getElementById("trBancoOrigen").style.display != "none" && bancoOrigen == "-1"){
		document.getElementById("spanBancoOrigen").style.display = "inline";
		payForm.banco.focus();
		doSubmit = false;
	}
	if(descArticulo == ""){
		document.getElementById("spanArticulo").style.display = "inline";
		payForm.addProduct.focus();
		doSubmit = false;
	}
	if(voucher == ""){
		document.getElementById("spanBauche").style.display = "inline";
		payForm.bauche.focus();
		doSubmit = false;
	} else if (! isValidVaucheValue(medioDePago, voucher, "spanBaucheBadValue")){
		document.getElementById("spanBaucheBadValue").style.display = "inline";
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
	} else {
		//tenemos un monto, lo validamos
		if(! isValidMonto(montoPago)){
			document.getElementById("spanMontoBadValue").style.display = "inline";
			payForm.monto.focus();
			doSubmit = false;
		}
	}
	if(medioDePago == 6 && document.getElementById("archivoTransferencia").value == ""){
		document.getElementById("spanArchivoPago").style.display = "inline";
		payForm.monto.focus();
		doSubmit = false;
	}
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 * @returns {Boolean}
 */
function wasTouchedDatosDelPago(payForm){
	var wasTouched = false;
	
	//datos de pago
	var medioDePago = payForm.medio.value.trim();
	var medioDePagoHidden = payForm.medio_hidden.value.trim();
	var bancoDestino = payForm.banco.value.trim();
	var bancoDestinoHidden = payForm.banco_hidden.value.trim();
	var bancoOrigen = payForm.bancoOrigen.value.trim();
	var bancoOrigenHidden = payForm.bancoOrigen_hidden.value.trim();
	var voucher = payForm.bauche.value.trim();
	var voucherHidden = payForm.bauche_hidden.value.trim();
	var fechaPago = payForm.fechaPagoHidden.value.trim();
	var fechaPagoHidden = payForm.fechaPago_hidden.value.trim();
	var montoPago = payForm.monto.value.trim();
	var montoPagoHidden = payForm.monto_hidden.value.trim();
	var descArticulo = payForm.articulo.value.trim();
	var descArticuloHidden = payForm.articulo_hidden.value.trim();
	
	if(medioDePago =! medioDePagoHidden){
		wasTouched = wasTouched || true;
	}
	if(document.getElementById("trBancoOrigen").style.display != "none"){
		if(bancoOrigen != bancoOrigenHidden){
			wasTouched = wasTouched || true;
		}
	}
	if(descArticulo != descArticuloHidden){
		wasTouched = wasTouched || true;
	}
	if(voucher != voucherHidden){
		wasTouched = wasTouched || true;
	}
	if(fechaPago != fechaPagoHidden){
		wasTouched = wasTouched || true;
	}
	if(montoPago != montoPagoHidden){
		wasTouched = wasTouched || true;
	}
	
	return wasTouched;
}

/**
 * 
 * @param payForm
 * @returns {Boolean}
 */
function validarDatosDelEnvio(payForm){
	var doSubmit = true;
	
	//datos del envio
	var ciaEnvio = payForm.envio.value;
	var destinatario = payForm.destinatario.value.trim();
	var ciDestinatario = payForm.ciDestinatario.value.trim();
	var dirDestino = payForm.dir1.value.trim();
	var ciudadDestino = payForm.ciudad.value.trim();
	var estadoDestino = payForm.estado.value.trim();
	var celularDestino = payForm.celular.value.trim();
	var tlfLocalDestino = payForm.tlfLocalDestinatario.value.trim();
	
	document.getElementById("spanEnvio").style.display = "none";
	document.getElementById("spanDestinatario").style.display = "none";
	document.getElementById("spanCIDestinatario").style.display = "none";
	document.getElementById("spanCIDestinatarioBadValue").style.display = "none";
	document.getElementById("spanDir1").style.display = "none";
	document.getElementById("spanCiudad").style.display = "none";
	document.getElementById("spanEstado").style.display = "none";
	document.getElementById("spanCelularDestinatario").style.display = "none";
	document.getElementById("spanCelularDestinatarioLength").style.display = "none";
	document.getElementById("spanLocalDestinatarioLength").style.display = "none";
	
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
	} else if(! isValidCIValue(payForm.ciDest.value, ciDestinatario, "spanCIDestinatarioBadValue")){
		document.getElementById("spanCIDestinatarioBadValue").style.display = "inline";
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
	} else {
		//alguno tiene valores, verifico si cumple con la longitud
		if(celularDestino != "" && (celularDestino.length != payForm.celular.maxLength)){
			document.getElementById("spanCelularDestinatarioLength").style.display = "inline";
			payForm.celular.focus();
			doSubmit = false;
		}
		if(tlfLocalDestino != "" && (tlfLocalDestino.length != payForm.tlfLocalDestinatario.maxLength)){
			document.getElementById("spanLocalDestinatarioLength").style.display = "inline";
			payForm.tlfLocalDestinatario.focus();
			doSubmit = false;
		}
	}
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 * @returns {Boolean}
 */
function wasTouchedDatosDelEnvio(payForm){
	var wasTouched = false;
	
	//datos del envio
	var ciaEnvio = payForm.envio.value.trim();
	var ciaEnvioHidden = payForm.envio_hidden.value.trim();
	var destinatario = payForm.destinatario.value.trim();
	var destinatarioHidden = payForm.destinatario_hidden.value.trim();
	var ciDestinatario = payForm.ciDest.value.trim() + "-" + payForm.ciDestinatario.value.trim();
	var ciDestinatarioHidden = payForm.ciDest_hidden.value.trim() + "-" + payForm.ciDestinatario_hidden.value.trim();
	var dirDestino = payForm.dir1.value.trim();
	var dirDestinoHidden = payForm.dir1_hidden.value.trim();
	var ciudadDestino = payForm.ciudad.value.trim();
	var ciudadDestinoHidden = payForm.ciudad_hidden.value.trim();
	var estadoDestino = payForm.estado.value.trim();
	var estadoDestinoHidden = payForm.estado_hidden.value.trim();
	var celularDestino = payForm.codcel.value.trim() + "-" + payForm.celular.value.trim();
	var celularDestinoHidden = payForm.codcel_hidden.value.trim() + "-" + payForm.celular_hidden.value.trim();
	var tlfLocalDestino = payForm.codLocalDestinatario.value.trim() + "-" + payForm.tlfLocalDestinatario.value.trim();
	var tlfLocalDestinoHidden = payForm.codLocalDestinatario_hidden.value.trim() + "-" + payForm.tlfLocalDestinatario_hidden.value.trim();
	
	if(ciaEnvio != ciaEnvioHidden){
		wasTouched = wasTouched || true;
	}
	if(destinatario != destinatarioHidden){
		wasTouched = wasTouched || true;
	}
	if(ciDestinatario != ciDestinatarioHidden){
		wasTouched = wasTouched || true;
	}
	if(dirDestino != dirDestinoHidden){
		wasTouched = wasTouched || true;
	}
	if(ciudadDestino != ciudadDestinoHidden){
		wasTouched = wasTouched || true;
	}
	if(estadoDestino != estadoDestinoHidden){
		wasTouched = wasTouched || true;
	}
	if("-" == celularDestinoHidden){
		if (payForm.celular.value.trim() != payForm.celular_hidden.value.trim()){
			wasTouched = wasTouched || true;
		}
	} else if(celularDestino != celularDestinoHidden){
		wasTouched = wasTouched || true;
	}
	if("-" == tlfLocalDestinoHidden){
		if (payForm.tlfLocalDestinatario.value.trim() != payForm.tlfLocalDestinatario_hidden.value.trim()){
			wasTouched = wasTouched || true;
		}
	} else if(tlfLocalDestino != tlfLocalDestinoHidden){
		wasTouched = wasTouched || true;
	}
	
	return wasTouched;
}

/**
 * 
 */
function checkIfUserHaveNotPendingPay(){
	//si el usuario quiere registrar un nuevo envio
	//pero ya tiene uno en status "No Encontrado"
	//debe indicarsele que no puede registrar nada nuevo
	//hasta que no termine de actualizar el de "No Encontrado"
	var result = false;
	
	try {
		$.ajax({
			url: "checkIfUserHaveNotPendingPay.php",
			dataType: "json",
			data: {ci: $("#ci").val() + "-" + $("#cii").val()},
			async : false,
			type: "POST", 
			success: function(response){
				//solo recibimos uno de los posibles envios no encontrados que posea
				if(response != "IS_OK"){
					$.map(response, function(valor, clave){
						alert("Disculpe, usted posee un registro en estado de \"Pago no encontrado\".\n"
								+ "Será redirigido a una página donde podrá modificarlo antes de poder crear nuevas solicitudes");
						result = true;
						window.location = "actualizarEnvio.php?id=" + valor;
					});
				}
			},
			error: function(response){
				try{
					alert("Hubo un error en la verificación de sus posibles pagos pendientes.\n"
							+ "El error que mostro el sistema fue: " + response 
							+ "\n. Por favor tome un print de esta pantalla y envienoslo.\n"
							+ "Muchas Gracias");
				}catch(err){
					
				}
			}
		});
	} catch (e) {
		// TODO: handle exception
		try{
			alert("Hubo un error en la verificación de sus posibles pagos pendientes.\n"
					+ "El error que mostro el sistema fue: " + e.message 
					+ "\n. Por favor tome un print de esta pantalla y envienoslo.\n"
					+ "Muchas Gracias");
		}catch(err){
			
		}
	}
	
	return result;
}
/**
 * 
 * @param payForm
 * @returns
 */
function validarFormularioDePago(payForm){
	var doSubmit = false;
	
	document.getElementById("Enviar").style.display = "none";
	document.getElementById("ajaxLoading").style.display = "inline";
	
	try {
		if(! checkIfUserHaveNotPendingPay()){
			//inhabilitamos el boton de envio para prevenir multiples envios del mismo form
			var doSubmitCliente = validarDatosDelCliente(payForm);
			var doSubmitPago = validarDatosDelPago(payForm);
			var doSubmitEnvio = validarDatosDelEnvio(payForm);
			var checkTerminosCondiciones = payForm.terminos.checked;
			
			document.getElementById("spanTerminos").style.display = "none";
			
			if(checkTerminosCondiciones == false){
				document.getElementById("spanTerminos").style.display = "inline";
				payForm.terminos.focus();
			}
			
			doSubmit = doSubmitCliente && doSubmitPago && doSubmitEnvio && checkTerminosCondiciones;
			if(doSubmit){
				payForm.submit();
			}
		}
	}catch(err){
		try {
			alert("Disculpe, hubo un error procesando su envio.\n"
					+ "El error fue: " + err.message
					+ "\n. Por favor, tome un print de esta pantalla y envienoslo para nosotros poder prestarle un mejor servicio.");
		} catch(err){
			
		}
	}
		
	document.getElementById("ajaxLoading").style.display = "none";
	document.getElementById("Enviar").style.display = "";
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 */
function wasTouchedFormularioNotifNoEnc(payForm){
	var wasTouchedCliente = wasTouchedDatosDelCliente(payForm);
	var wasTouchedPago = wasTouchedDatosDelPago(payForm);
	var wasTouchedEnvio = wasTouchedDatosDelEnvio(payForm);
	
	return wasTouchedCliente || wasTouchedPago || wasTouchedEnvio;
}

/**
 * 
 * @param payForm
 */
function validarFormularioNotifNoEnc(payForm){
	//primero vemos si el usuario modifico algun campo del formulario
	//en caso de que solo hizo un guardar sin tocar nada
	//debemos frenar la validacion y envio del formulario
	//y alertar al usuario para que haga al menos un ajuste
	var doSubmit = false;
	
	if(wasTouchedFormularioNotifNoEnc(payForm)){
		var doSubmitCliente = validarDatosDelCliente(payForm);
		var doSubmitPago = validarDatosDelPago(payForm);
		var doSubmitEnvio = validarDatosDelEnvio(payForm);
		
		doSubmit = doSubmitCliente && doSubmitPago && doSubmitEnvio;
		if(doSubmit){
			payForm.submit();
		}
	} else {
		alert("Disculpe, no se detectó ningún cambio en los valores de este envío.\nPor favor actualize dicho registro e intente de nuevo.");
	}
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 */
function validarFormularioPagoConfirmado(payForm){
	var doSubmitCliente = validarDatosDelCliente(payForm);
	var doSubmitEnvio = validarDatosDelEnvio(payForm);
	
	var doSubmit = doSubmitCliente && doSubmitEnvio;
	if(doSubmit){
		payForm.submit();
	}
	
	return doSubmit;
}

/**
 * 
 * @param payForm
 */
function validarFormularioPresupuestadoFacturado(payForm){
	var doSubmitEnvio = validarDatosDelEnvio(payForm);
	
	var doSubmit = doSubmitEnvio;
	if(doSubmit){
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
 */
function limpiarProductosComprados(){
	//obtenemos el nodo padre donde colocaremos el container para la info de los productos
	var nodoPadre = document.getElementById("detalleProductosComprados");
	
	var htmlContainerText = 
		  '    <thead>'
		+ '        <tr class="Estilo17">'
		+ '            <th width="200px">Cantidad</th>'
		+ '            <th width="200px">Producto</th>'
		+ '            <th width="200px">Observaciones</th>'
		+ '        </tr>'
		+ '    </thead>';
	
	nodoPadre.innerHTML = htmlContainerText;
	
	document.getElementById("articulo").value = "";
}

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
	
	if(productoValue == ""){
		alert("Disculpe, debe indicar de manera obligatoria el detalle del producto.");
		return;
	}
	
	//obtenemos el nodo padre donde colocaremos el container para la info de los productos
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

function actualizarEnvio(idEnvio){
	window.location = "actualizarEnvio.php?id=" + idEnvio;
}