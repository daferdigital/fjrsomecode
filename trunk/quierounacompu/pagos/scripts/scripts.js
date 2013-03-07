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
	var newwindow = window.open(popUpURL,'name','height=200,width=150,toolbar=no,resizable=no');
	
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
 * 
 * @param payForm
 */
function validarFormularioDePago(payForm){
	var doSubmit = true;
	var seudonimo = payForm.seudonimo.value.trim();
	var nombre = payForm.nombre.value.trim();
	var cedula = payForm.cii.value.trim();
	var email = payForm.email.value.trim();
	var medioDePago = payForm.medio.value;
	var banco = payForm.banco.value;
	var descArticulo = payForm.articulo.value.trim();
	var voucher = payForm.bauche.value.trim();
	var fechaPago = payForm.fechaPago.value.trim();
	var montoPago = payForm.monto.value.trim();
	var ciaEnvio = payForm.envio.value;
	var destinatario = payForm.destinatario.value.trim();
	var dirDestino = payForm.dir1.value.trim();
	var ciudadDestino = payForm.ciudad.value.trim();
	var estadoDestino = payForm.estado.value.trim();
	var celularDestino = payForm.celular.value.trim();
	var tlfLocalDestino = payForm.fono.value.trim();
	var checkTerminosCondiciones = payForm.terminos.checked;
	
	document.getElementById("spanSeudonimo").style.display = "none";
	document.getElementById("spanNombre").style.display = "none";
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
	document.getElementById("spanDir1").style.display = "none";
	document.getElementById("spanCiudad").style.display = "none";
	document.getElementById("spanEstado").style.display = "none";
	document.getElementById("spanCelular").style.display = "none";
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
		document.getElementById("spanCelular").style.display = "inline";
		payForm.celular.focus();
		doSubmit = false;
	}
	if(checkTerminosCondiciones == false){
		document.getElementById("spanTerminos").style.display = "inline";
		payForm.terminos.focus();
		doSubmit = false;
	}
	
	if(doSubmit){
		var msg = 'Gracias por completar la información, en breve le será enviado un email con todos los datos para su archivo.\r'
			+ 'RECUERDE ESPERAR hasta que aparezca la pantalla de AGRADECIMIENTO POR SU PAGO';
		
		showAlert(msg);
		
		payForm.submit();
	}
}