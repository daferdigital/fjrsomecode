//Actualizado al 19 de Agosto de 2013
var ajaxImageName = "ajax.gif";

String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

String.prototype.endsWith = function(sufijo){
	var lastIndex = this.lastIndexOf(sufijo);
	return (lastIndex != -1) && (lastIndex + sufijo.length == this.length);
}

/**
 * 
 * @param mail
 * @returns {Boolean}
 */
function isAValidMail(mail){
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(! re.test(mail.trim())){
		return false;
	}
	
	return true;
}

/**
 * 
 * @param radioElement
 * @returns {Boolean}
 */
function isRadioChecked(radioElement){
	var isChecked = false;
	
	for ( var i = 0; i < radioElement.length; i++) {
		if(radioElement[i].checked){
			isChecked = true;
		}
	}
	
	return isChecked;
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
			// Si es as� creamos un control activeX apartir de un objeto
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
		document.getElementById(idAnswerContainer).innerHTML = "<img src=\"imagenes/" + ajaxImageName + "\"/>";
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
	var cedula = newUserForm.cedula.value.trim();
	var correo = newUserForm.correo.value.trim();
	var login = newUserForm.login.value.trim();
	var clave = newUserForm.clave.value.trim();
	var tipoUsuario = newUserForm.tipoUsuario.value.trim();
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formApellido").style.display = "none";
	document.getElementById("formCorreo").style.display = "none";
	document.getElementById("formCedula").style.display = "none";
	document.getElementById("formLogin").style.display = "none";
	document.getElementById("formClave").style.display = "none";
	document.getElementById("formTipoUsuario").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(apellido == ""){
		doSubmit = false;
		document.getElementById("formApellido").style.display = "inline";
	}
	if(! isAValidMail(correo)){
		doSubmit = false;
		document.getElementById("formCorreo").style.display = "inline";
	}
	if(cedula == ""){
		doSubmit = false;
		document.getElementById("formCedula").style.display = "inline";
	}
	if(login == ""){
		doSubmit = false;
		document.getElementById("formLogin").style.display = "inline";
	}
	if(clave == ""){
		doSubmit = false;
		document.getElementById("formClave").style.display = "inline";
	}
	if(tipoUsuario == "0"){
		doSubmit = false;
		document.getElementById("formTipoUsuario").style.display = "inline";
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
 * 
 * @param newUnitForm
 */
function guardarUnidad(newUnitForm){
	var nombre = newUnitForm.nombre.value.trim();
	var descripcion = newUnitForm.descripcion.value.trim();
	
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formDescripcion").style.display = "none";
	
	var doSubmit = true;
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(descripcion == ""){
		doSubmit = false;
		document.getElementById("formDescripcion").style.display = "inline";
	}
	
	if (doSubmit) {
		newUnitForm.submit();
	}
}

/**
 * 
 * @param newSubUnitForm
 */
function guardarSubUnidad(newSubUnitForm){
	var idDpto = newSubUnitForm.idDpto.value.trim();
	var nombre = newSubUnitForm.nombre.value.trim();
	var cupoMaximo = newSubUnitForm.cupoMaximo.value.trim();
	var horaInicio = newSubUnitForm.horaInicio.value.trim();
	var horaFin = newSubUnitForm.horaFin.value.trim();
	var promedioAtencion = newSubUnitForm.promedioAtencion.value.trim();
	var previaCita = newSubUnitForm.previaCita.value.trim();
	
	document.getElementById("formIdDpto").style.display = "none";
	document.getElementById("formNombre").style.display = "none";
	document.getElementById("formCupoMaximo").style.display = "none";
	document.getElementById("formHoraInicio").style.display = "none";
	document.getElementById("formHoraFin").style.display = "none";
	document.getElementById("formPromedioAtencion").style.display = "none";
	document.getElementById("formPreviaCita").style.display = "none";
	
	var doSubmit = true;
	if(idDpto == "0"){
		doSubmit = false;
		document.getElementById("formIdDpto").style.display = "inline";
	}
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	if(cupoMaximo == ""){
		doSubmit = false;
		document.getElementById("formCupoMaximo").style.display = "inline";
	}
	if(horaInicio == ""){
		doSubmit = false;
		document.getElementById("formHoraInicio").style.display = "inline";
	}
	if(horaFin == ""){
		doSubmit = false;
		document.getElementById("formHoraFin").style.display = "inline";
	}
	if(promedioAtencion == ""){
		doSubmit = false;
		document.getElementById("formPromedioAtencion").style.display = "inline";
	}
	if(!isRadioChecked(newSubUnitForm.previaCita)){
		doSubmit = false;
		document.getElementById("formPreviaCita").style.display = "inline";
	}
	
	if (doSubmit) {
		newSubUnitForm.submit();
	}
}

/**
 * 
 * @param newTaquilla
 */
function guardarTaquilla(newTaquilla){
	var idSubDpto = newTaquilla.idSubDpto.value.trim();
	var idOperador = newTaquilla.idOperador.value.trim();
	var nombre = newTaquilla.nombre.value.trim();
	
	document.getElementById("formIdSubDpto").style.display = "none";
	document.getElementById("formIdOperador").style.display = "none";
	document.getElementById("formNombre").style.display = "none";
	
	var doSubmit = true;
	if(idSubDpto == "0"){
		doSubmit = false;
		document.getElementById("formIdSubDpto").style.display = "inline";
	}
	if(idOperador == "0"){
		doSubmit = false;
		document.getElementById("formIdOperador").style.display = "inline";
	}
	if(nombre == ""){
		doSubmit = false;
		document.getElementById("formNombre").style.display = "inline";
	}
	
	if (doSubmit) {
		newTaquilla.submit();
	}
}

/**
 * 
 * @param loginForm
 */
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

/**
 * 
 * @param idDpto
 */
function subDptoInfo(idDpto){
	var idElement = "detailDpto" + idDpto;
	var divElementInfo = document.getElementById(idElement);
	var imgArrowElement = document.getElementById("imgDpto" + idDpto);
	
	//verificamos la tarea a realizar
	if(imgArrowElement.src.endsWith("imagenes/arrowDown.png")){
		//debemos cargarlo con la info de los sub-dptos y mostrarlos
		imgArrowElement.src = "imagenes/arrowUp.png";
		//divElementInfo.innerHTML = "Informaci&oacute;n de los sub-departamentos: ";
		divElementInfo.innerHTML="<img src=\"imagenes/" + ajaxImageName + "\"/>";
		divElementInfo.style.display = "";
	} else {
		//divElementInfo.innerHTML = "";
		divElementInfo.style.display = "none";
		imgArrowElement.src = "imagenes/arrowDown.png";
	}
}


function imprime_ticket(ido){
	var valor_dis=$("#dis_"+ido).html();
	//alert(valor_dis);
	//return false;
		$.ajax({
		  // la URL para la petición
		  url : 'imprime_ticket.php',
	  
		  // la información a enviar
		  // (también es posible utilizar una cadena de datos)
		  data : { iot : ido , valor : valor_dis},
	  
		  // especifica si será una petición POST o GET
		  type : 'GET',
	  
		  // el tipo de información que se espera de respuesta
		  //dataType : 'json',
		 dataType : 'html',
	  
		  // código a ejecutar si la petición es satisfactoria;
		  // la respuesta es pasada como argumento a la función
		  success : function(json) {
			 /* $('<h1/>').text(json.title).appendTo('body');
			  $('<div class="content"/>')
				  .html(json.html).appendTo('body');*/
				  //alert(json);
				  if(json){
					  $('#dis_'+ido).html(json);
				  }
		  },
	  
		  // código a ejecutar si la petición falla;
		  // son pasados como argumentos a la función
		  // el objeto de la petición en crudo y código de estatus de la petición
		  error : function(xhr, status) {
			  alert('Disculpe, existia un problema');
		  },
	  
		  // código a ejecutar sin importar si la petición falló o no
		  complete : function(xhr, status) {
			 // alert('Petición realizada');
		  }
	  });
	}
	
	jQuery('.todos_disponibles').hover(function(evento){
		jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha');
		jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha_hover');
	},function(){
		jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha_hover');
		jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha');
	});
	
/**
 * Funcion para realizar la busqueda de usuarios segun criterios
 * via ajax.
 * 
 * @param pageNumber
 */
function searchUsuariosAjax(pageNumber){
	//para permitir la busqueda, debe estar seleccionado al menos un criterio
		
	var parameters = "pageNumber="+pageNumber;
	parameters += "&scriptFunction=searchUsuariosAjax";
	//indicamos los parametros
	parameters += "&tipoUsuario=" + document.getElementById("tipoUsuario").value;
	parameters += "&nombre=" + document.getElementById("nombre").value;
	parameters += "&apellido=" + document.getElementById("apellido").value;
	parameters += "&ci=" + document.getElementById("ci").value;
	
	callAjax("ajax/getUsuariosListPage.php",
			parameters,
			"ajaxPageResult",
			null);
}

function llamarTicket(idTaquilla){
	$.ajax({
		// la URL para la peticion
		url : 'ajax/llamarTicket.php',
		// (también es posible utilizar una cadena de datos)
		data : {taquilla : idTaquilla},
		// especifica si será una peticion POST o GET
		type : 'POST',
		// el tipo de información que se espera de respuesta
		//dataType : 'json',
		dataType : 'html',
		// código a ejecutar si la petición es satisfactoria;
		// la respuesta es pasada como argumento a la función
		success : function(response) {
			if(response){
				$('#anumero_'+idTaquilla).html(response);
			}
		},
		// codigo a ejecutar si la peticion falla;
		// son pasados como argumentos a la funcion
		// el objeto de la peticion en crudo y codigo de estatus de la peticion
		error : function(xhr, status) {
			alert('Disculpe, no pudo ejecutarse su solicitud. Intente de nuevo.');
		},
	});
}