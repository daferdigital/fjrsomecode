var ajaxImageName = "ajax.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

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
 * @param urlToOpen
 */
function openPopUp(urlToOpen){
	var w = 750;
	var h = 600;
	var title = "Manifiesto en Formato PDF";
	
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2)-50;
	
	return window.open(urlToOpen, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left); 
}


/**
 * 
 * @param checkName
 */
function processAll(checkName){
	var mainCheck = document.getElementById("mainCheck").checked; 
	var checkList = document.getElementsByName(checkName);
	
	for ( var i = 0; i < checkList.length; i++) {
		checkList[i].checked = mainCheck;
	}
}

/**
 * 
 * @param tableName
 * @param checkName
 */
function doDelivery(checkName){
	var message = "Esta seguro que desea enviar estos registros al manifiesto?";
	message += "\n\nRecuerde actualizar el listado de envios luego de visualizar el manifiesto.";
	
	var doDelivery = confirm(message);

	if(doDelivery){
		var checkList = document.getElementsByName(checkName);
		var ids = "";
		
		for ( var i = 0; i < checkList.length; i++) {
			if(checkList[i].checked){
				if(ids != ""){
					ids += ",";
				}
				
				ids += checkList[i].value;
			}
		}
		
		if(ids == ""){
			alert("Debe seleccionar los registros que desea enviar al manifiesto.");
			doDelivery = false;
		}
		
		if(doDelivery){
			//llamamos al ajax de borrar
			//y luego llamamos al ajax para recargar el listado manteniendo los filtros
			//por seguridad buscaremos siempre la pagina 1
			/*
			var params = "ids=" + ids;
			callAjax("ajax/doDelivery.php", 
					params,
					null,
					null,
					false);
			*/
			openPopUp("ajax/showManifiesto.php?ids="+ids);
		}
		
		setTimeout(callAjax("ajax/getEnviosEnviados.php",
				"statusEnvio=6",
				"ajaxPageResult",
				null),
			5000);
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
 * @param newUserForm
 */
function guardarUsuario(newUserForm){
	var nombre = newUserForm.nombre.value.trim();
	var apellido = newUserForm.apellido.value.trim();
	var correo = newUserForm.correo.value.trim();
	var login = newUserForm.login.value.trim();
	var clave = newUserForm.clave.value.trim();
	
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formApellido").style.display = "none";
	document.getElementById("formCorreo").style.display = "none";
	document.getElementById("formLogin").style.display = "none";
	document.getElementById("formClave").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(apellido == ""){
		doSubmit = false;
		document.getElementById("formApellido").style.display = "inline";
	}
	if(correo == ""){
		doSubmit = false;
		document.getElementById("formCorreo").style.display = "inline";
	}
	if(login == ""){
		doSubmit = false;
		document.getElementById("formLogin").style.display = "inline";
	}
	if(clave == ""){
		doSubmit = false;
		document.getElementById("formClave").style.display = "inline";
	}
	
	if (doSubmit) {
		newUserForm.submit();
	}
}

/**
 * 
 * @param updateUserForm
 */
function modificarUsuario(updateUserForm){
	var nombre = updateUserForm.nombre.value.trim();
	var apellido = updateUserForm.apellido.value.trim();
	var correo = updateUserForm.correo.value.trim();
	var login = updateUserForm.login.value.trim();
	updateUserForm.clave.value = updateUserForm.clave.value.trim();
	
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formApellido").style.display = "none";
	document.getElementById("formCorreo").style.display = "none";
	document.getElementById("formLogin").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(apellido == ""){
		doSubmit = false;
		document.getElementById("formApellido").style.display = "inline";
	}
	if(correo == ""){
		doSubmit = false;
		document.getElementById("formCorreo").style.display = "inline";
	}
	if(login == ""){
		doSubmit = false;
		document.getElementById("formLogin").style.display = "inline";
	}
	
	if (doSubmit) {
		updateUserForm.submit();
	}
}

/**
 * Validamos el formulario de perfil y en caso de ser valido, enviamos el formulario
 * @param perfilForm
 */
function guardarPerfil(perfilForm){
	var nombre = perfilForm.nombre.value.trim();
	var apellido = perfilForm.apellido.value.trim();
	var correo = perfilForm.correo.value.trim();
	
	//ajustamos el valor de la clave
	perfilForm.clave.value = perfilForm.clave.value.trim();
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formApellido").style.display = "none";
	document.getElementById("formCorreo").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(apellido == ""){
		doSubmit = false;
		document.getElementById("formApellido").style.display = "inline";
	}
	if(correo == ""){
		doSubmit = false;
		document.getElementById("formCorreo").style.display = "inline";
	}
	if (doSubmit) {
		perfilForm.submit();
	}
}

function validarLoginForm(loginForm){
	var login = loginForm.login.value.trim();
	var clave = loginForm.clave.value.trim();
	
	document.getElementById("formLogin").style.display = "none";
	document.getElementById("formClave").style.display = "none";
	document.getElementById("loginErrorMsg").style.display = "none";
	
	//vemos si no estan vacios los campos
	var doSubmit = true;
	if(login == ""){
		doSubmit = false;
		document.getElementById("formLogin").style.display = "inline";
	}
	if(clave == ""){
		doSubmit = false;
		document.getElementById("formClave").style.display = "inline";
	}
	
	if (doSubmit) {
		loginForm.submit();
	}
}

/**
 * 
 * @param hideMessage
 */
function obtenerPermisosUsuario(hideMessage){
	if(hideMessage) {
		if(document.getElementById("ajaxAnswerMsg") != null){
			document.getElementById("ajaxAnswerMsg").style.display = "none";
		}
	}
	
	var parameters = "usrId=" + document.getElementById("usuarioPermiso").value;
	callAjax("ajax/getPermisoUsuario.php", 
			parameters, 
			"ajaxAnswerContainer",
			null);
}

/**
 * 
 * @param hideMessage
 * @param moduleToRecirect
 */
function obtenerDatosUsuario(hideMessage, moduleToRecirect){
	if(hideMessage) {
		if(document.getElementById("ajaxAnswerMsg") != null){
			document.getElementById("ajaxAnswerMsg").style.display = "none";
		}
	}
	
	var parameters = "usrId=" + document.getElementById("selectUsuario").value;
	parameters += "&moduleToRedirect=" + moduleToRecirect;
	
	callAjax("ajax/getUsuarioForm.php", 
			parameters, 
			"ajaxAnswerContainer",
			null);
}

/**
 * Llamada Ajax para obtener registros por pagina del log del sistema
 * @param pageNumber
 */
function logSistemaAjax(pageNumber){
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=logSistemaAjax";
	parameters += "&usuario=" + document.getElementById("usuario").value;
	parameters += "&fechaDesde=" + document.getElementById("fechaDesde").value;
	parameters += "&fechaHasta=" + document.getElementById("fechaHasta").value;
	parameters += "&query=" + document.getElementById("query").value;
	
	if(document.getElementById("justErrors").checked == true){
		parameters += "&justErrors=" + document.getElementById("justErrors").value;
	}
	
	callAjax("ajax/getSystemLogPage.php",
			parameters,
			"ajaxPageResult",
			null);
}

/**
 * Llamada Ajax para obtener registros por pagina del log del transacciones del sistema
 * @param pageNumber
 */
function logBitacoraAjax(pageNumber){
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=logBitacoraAjax";
	parameters += "&usuario=" + document.getElementById("usuario").value;
	parameters += "&fechaDesde=" + document.getElementById("fechaDesde").value;
	parameters += "&fechaHasta=" + document.getElementById("fechaHasta").value;
	parameters += "&operacion=" + document.getElementById("operacion").value;
	
	callAjax("ajax/getBitacoraLogPage.php",
			parameters,
			"ajaxPageResult",
			null);
}

/**
 * Se buscan de manera directa y completa todos los envios de un tipo determinado.
 * 
 */
function searchEnviosAjaxSimple(statusEnvio){
	var parameters = "statusEnvio=" + statusEnvio;
	var urlToCall = "ajax/";
	
	//vemos el tipo de envio que se esta buscando para saber cual pagina llamar
	if(statusEnvio == 1){
		//notificados
		urlToCall += "getEnviosNotificados.php";
	} else if(statusEnvio == 2){
		//pagos confirmados
		urlToCall += "getEnviosPagosConfirmados.php";
	} else if(statusEnvio == 3){
		//pagos no encontrados
		urlToCall += "getEnviosPagosNoEncontrados.php";
	} else if(statusEnvio == 4){
		//presupuestado
		urlToCall += "getEnviosPresupuestados.php";
	} else if(statusEnvio == 5){
		//facturado
		urlToCall += "getEnviosFacturados.php";
	} else if(statusEnvio == 6){
		//enviado
		urlToCall += "getEnviosEnviados.php";
	}
	
	callAjax(urlToCall,
			parameters,
			"ajaxPageResult",
			null);
}

/**
 * 
 * @param pageNumber
 */
function searchEnviosAjax(pageNumber){
	//para permitir la busqueda, debe estar seleccionado al menos un criterio
	
	if(document.getElementById("statusEnvio").value == -1
			&& document.getElementById("seudonimoML").value.trim() == ""
			&& document.getElementById("boucher").value.trim() == ""
			&& document.getElementById("fechaDesde").value.trim() == ""
			&& document.getElementById("fechaHasta").value.trim() == ""
			&& document.getElementById("ciRif").value.trim() == ""){
		alert("Para poder realizar la operación, debe seleccionar al menos un criterio de búsqueda");
		return;
	}
	
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchEnviosAjax";
	//indicamos el status de los envios que queremos visualizar
	parameters += "&statusEnvio=" + document.getElementById("statusEnvio").value;
	parameters += "&seudonimoML=" + document.getElementById("seudonimoML").value;
	parameters += "&ciRif=" + document.getElementById("ciRif").value;
	parameters += "&boucher=" + document.getElementById("boucher").value;
	parameters += "&fechaDesde=" + document.getElementById("fechaDesde").value;
	parameters += "&fechaHasta=" + document.getElementById("fechaHasta").value;
	parameters += "&ciRif=" + document.getElementById("ciRif").value;
	if(document.getElementById("fromBusquedaAvanzada") != null){
		parameters += "&fromBusquedaAvanzada=";
	}
	
	callAjax("ajax/getEnviosListPage.php",
			parameters,
			"ajaxPageResult",
			null);
}

/**
 * Actualizamos el status y los comentarios(opcional) de un 
 * determinado envio.
 * 
 */
function actualizarEnvio(idButtonToHide, statusActual){
	var valid = true;
	
	var newComment = document.getElementById("newComment").value.trim();

	var parameters = "idEnvio=" + document.getElementById("idEnvio").value;
	parameters += "&newStatus=" + document.getElementById("newStatus").value;
	parameters += "&newComment=" + newComment;

	if(document.getElementById("codFactura") != null){
		//tengo habilitado el campo de codigo factura,
		//reviso su valor
		//apagamos el span de error por si estaba prendido
		document.getElementById("spanCodFactura").style.display = "none";
		var tmp = document.getElementById("codFactura").value.trim();
		
		if(tmp == ""){
			document.getElementById("spanCodFactura").style.display = "inline";
			valid = false;
		}else{
			parameters += "&codFactura=" + tmp;
		}
	}
	
	if(document.getElementById("ciaEnvio") != null){
		//tengo habilitado el campo de compania de envio,
		//reviso su valor
		//apagamos el span de error por si estaba prendido
		document.getElementById("spanCiaEnvio").style.display = "none";
		var tmp = document.getElementById("ciaEnvio").value.trim();
		
		if(tmp == "-1"){
			document.getElementById("spanCiaEnvio").style.display = "inline";
			valid = false;
		}else{
			parameters += "&ciaEnvio=" + tmp;
		}
	}
	
	if(document.getElementById("codEnvio") != null){
		//tengo habilitado el campo de codigo de envio
		//reviso su valor
		
		//apagamos el span de error por si estaba prendido
		document.getElementById("spanCodEnvio").style.display = "none";
		var tmp = document.getElementById("codEnvio").value.trim();
		
		if(tmp == ""){
			document.getElementById("spanCodEnvio").style.display = "inline";
			valid = false;
		}else{
			parameters += "&codEnvio=" + tmp;
		}
	}
	
	if(document.getElementById("newStatus") != null && document.getElementById("newStatus").value == "7"){
		//cuando el estatus nuevo es 7 (envio errado) el comentario es obligatorio
		document.getElementById("mandatoryComentario").style.display = "none";
		
		if(document.getElementById("newComment") != null && document.getElementById("newComment").value.trim() == ""){
			document.getElementById("mandatoryComentario").style.display = "inline";
			document.getElementById("newComment").focus();
			valid = false;
		}
	}
	
	if(valid){
		document.getElementById(idButtonToHide).style.display = "none";
		
		callAjax("ajax/updateEnvio.php",
				parameters,
				null,
				"searchEnviosByType.php?type="+statusActual);
	}
}

/**
 * Funcion para invocar directamente el proceso de comentar un envio
 */
function comentarEnvio(){
	var newComment = document.getElementById("newComment").value.trim();
	
	var parameters = "idEnvio=" + document.getElementById("idEnvio").value;
	parameters += "&newComment=" + newComment;
	
	document.getElementById("guardar").style.display="none";
	
	callAjax("ajax/updateComentariosEnvio.php",
			parameters,
			null,
			null);
}

/**
 * 
 * @param urlToOpen
 */
function openImagePopUp(urlToOpen){
	var w = 500;
	var h = 300;
	var title = "Detalle de comprobante de pago";
	
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	
	return window.open(urlToOpen, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left); 
}

