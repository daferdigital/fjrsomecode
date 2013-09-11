var ajaxImageName = "ajax.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

/**
 * 
 * @param urlToOpen
 */
function openPopUp(urlToOpen){
	var w = 750;
	var h = 600;
	var title = "Informaci&oacute;n en Formato PDF";
	
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2)-50;
	
	return window.open(urlToOpen, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left); 
}

/**
 * 
 * @param checkName
 */
function checkAll(checkName){
	var checkList = document.getElementsByName(checkName);
	
	for ( var i = 0; i < checkList.length; i++) {
		checkList[i].checked = true;
	}
}

/**
 * 
 */
function doDelete(tableName, checkName){
	var doDelete = confirm("Esta seguro que desea eliminar esos registros del sistema?");

	if(doDelete){
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
			alert("Debe seleccionar los registros que desea eliminar.");
			doDelete = false;
		}
		
		if(doDelete){
			//llamamos al ajax de borrar
			//y luego llamamos al ajax para recargar el listado manteniendo los filtros
			//por seguridad buscaremos siempre la pagina 1
			var params = "ids=" + ids;
			params += "&tableName=" + tableName;
			
			callAjax("ajax/doDelete.php", 
					params,
					null,
					null,
					false);
			
			if(tableName == "alumnos"){
				searchAlumnos(1);
			} else {
				searchSolicitudes(1);
			}
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

function validarAgregarSolicitudForm(forma){
	var doSubmit = true;
	
	document.getElementById("mandatoryFuncionario").style.display = "none";
	document.getElementById("mandatoryTipoSolicitud").style.display = "none";
	document.getElementById("mandatoryFechaSalida").style.display = "none";
	document.getElementById("mandatoryFechaLlegada").style.display = "none";
	document.getElementById("mandatoryFechaRango").style.display = "none";
	document.getElementById("mandatoryComentario").style.display = "none";
	
	//validamos los campos
	if(forma.funcionario.value.trim() == ""){
		document.getElementById("mandatoryFuncionario").style.display = "";
		forma.funcionario.focus();
		doSubmit = false;
	}
	
	if(forma.tipoSolicitud.value.trim() == ""){
		document.getElementById("mandatoryTipoSolicitud").style.display = "";
		forma.tipoSolicitud.focus();
		doSubmit = false;
	}
	
	if(forma.fechaSalida.value.trim() == ""){
		document.getElementById("mandatoryFechaSalida").style.display = "";
		doSubmit = false;
	}
	
	if(forma.fechaLlegada.value.trim() == ""){
		document.getElementById("mandatoryFechaLlegada").style.display = "";
		doSubmit = false;
	}
	
	//validamos que la fecha de llegada no sea menor a la de salida
	if(forma.fechaSalida.value.trim() != "" && forma.fechaLlegada.value.trim() != ""){
		var fechaSalidaArray = forma.fechaSalida.value.split("/");
		var fechaLlegadaArray = forma.fechaLlegada.value.split("/");
		
		var fechaSalida = new Date(fechaSalidaArray[2], fechaSalidaArray[1] -1, fechaSalidaArray[0]);
		var fechaLlegada = new Date(fechaLlegadaArray[2], fechaLlegadaArray[1] -1, fechaLlegadaArray[0]);
		
		if(fechaSalida > fechaLlegada){
			document.getElementById("mandatoryFechaRango").style.display = "";
		}
	}
	
	if(forma.comentario.value.trim() == ""){
		document.getElementById("mandatoryComentario").style.display = "";
		forma.comentario.focus();
		doSubmit = false;
	}
	
	return doSubmit;
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

function validarAgregarAlumnoForm(forma){
	var doSubmit = true;
	
	document.getElementById("mandatoryNombre").style.display = "none";
	document.getElementById("mandatoryApellido").style.display = "none";
	document.getElementById("mandatoryCedula").style.display = "none";
	document.getElementById("mandatoryLugarNacimiento").style.display = "none";
	document.getElementById("mandatoryDireccion").style.display = "none";
	document.getElementById("mandatoryFechaNacimiento").style.display = "none";
	
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
	
	if(forma.lugarNacimiento.value.trim() == ""){
		document.getElementById("mandatoryLugarNacimiento").style.display = "";
		forma.lugarNacimiento.focus();
		doSubmit = false;
	}
	
	/*
	if(forma.direccion.value.trim() == ""){
		document.getElementById("mandatoryDireccion").style.display = "";
		forma.direccion.focus();
		doSubmit = false;
	}
	*/
	
	if(forma.fechaNacimiento.value.trim() == ""){
		document.getElementById("mandatoryFechaNacimiento").style.display = "";
		$(window).scrollTop($('#mandatoryFechaNacimiento').offset().top);
		doSubmit = false;
	}
	
	return doSubmit;
}

/**
 * Validamos el formulario de perfil y en caso de ser valido, enviamos el formulario
 * @param perfilForm
 */
function guardarPerfil(perfilForm){
	var nombre = perfilForm.nombre.value.trim();
	var apellido = perfilForm.apellido.value.trim();
	
	//ajustamos el valor de la clave
	perfilForm.clave.value = perfilForm.clave.value.trim();
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formApellido").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(apellido == ""){
		doSubmit = false;
		document.getElementById("formApellido").style.display = "inline";
	}

	if (doSubmit) {
		perfilForm.submit();
	}
}

/**
 * Llamada Ajax para obtener el listado del personal del sistema
 * @param pageNumber
 */
function searchAlumnos(pageNumber){
	var cedula = document.getElementById("ci").value;
	if(cedula != ""){
		cedula += "-";
	}
	
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchAlumnos";
	parameters += "&nombre=" + document.getElementById("nombre").value;
	parameters += "&apellido=" + document.getElementById("apellido").value;
	parameters += "&cedula=" + cedula + document.getElementById("cedula").value.trim();
	parameters += "&activo=" + document.getElementById("activo").value;
	
	callAjax("ajax/getListarAlumnos.php",
			parameters,
			"ajaxPageResult",
			null);
}

/**
 * Llamada Ajax para obtener el listado del solicitudes de permisos del sistema
 * @param pageNumber
 */
function searchSolicitudes(pageNumber){
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchSolicitudes";
	parameters += "&funcionario=" + document.getElementById("funcionario").value;
	parameters += "&tipoSolicitud=" + document.getElementById("tipoSolicitud").value;
	parameters += "&fechaSalida=" + document.getElementById("fechaSalidaHidden").value.trim();
	parameters += "&fechaLlegada=" + document.getElementById("fechaLlegadaHidden").value;
	parameters += "&activo=" + document.getElementById("activo").value;
	
	callAjax("ajax/getListarSolicitudes.php",
			parameters,
			"ajaxPageResult",
			null);
}