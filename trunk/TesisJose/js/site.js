String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

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
		doSubmit = false;
	}
	
	if(forma.apellido.value.trim() == ""){
		document.getElementById("mandatoryApellido").style.display = "";
		doSubmit = false;
	}
	
	return doSubmit;
}