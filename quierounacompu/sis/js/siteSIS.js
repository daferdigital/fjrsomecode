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
 * @param idAnswerContainer
 */
function callAjax(url, parameters, idAnswerContainer){
	var ajaxObject =  createXMLHTTPRequest();

	document.getElementById(idAnswerContainer).style.display="inline";
	document.getElementById(idAnswerContainer).innerHTML = "<img src=\"images/loading.gif\"/>";
	ajaxObject.onreadystatechange=function() {
		if (ajaxObject.readyState==4 && ajaxObject.status==200) {
			document.getElementById(idAnswerContainer).innerHTML = ajaxObject.responseText;
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
			"ajaxAnswerContainer");
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
			"ajaxAnswerContainer");
}