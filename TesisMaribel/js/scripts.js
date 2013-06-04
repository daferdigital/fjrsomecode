String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

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
	
	if(doSubmit){
		forma.submit();
	}
}