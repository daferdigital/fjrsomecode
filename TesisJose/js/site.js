String.prototype.trim=function(){
	return this.replace(/^\s+|\s+$/g, '');
};

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