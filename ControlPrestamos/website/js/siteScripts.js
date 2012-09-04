
function soloNumeros(evt, formulario){
	//asignamos el valor de la tecla a keynum
	if(window.event){
		// IE
		keynum = evt.keyCode;
	}else{
		keynum = evt.which;
	}
	
	//comprobamos si se encuentra en el rango
	//o si es un backspace (8)
	//TABULADOR(0) ENTER(13)
	//alert(keynum);
	
	if (keynum == 13) {
		//verificamos el formulario para enviarlo
		//alert(formulario.name);
		if (formulario.name == "loginForm") {
			wasWritedLoginAndPwd(formulario)
		}
	} else {
		if((keynum > 47 && keynum < 58) || (keynum == 8) || (keynum == 0)){
			return true;
		}else{
			return false;
		}
	}
}

function soloLetras(evt, formulario){
	//asignamos el valor de la tecla a keynum
	if(window.event){
		// IE
		keynum = evt.keyCode;
	}else{
		keynum = evt.which;
	}
	
	//comprobamos si se encuentra en el rango
	//o si es un backspace(8)
	// ñ (241) Ñ(249) TABULADOR(0) ENTER(13)
	//alert(keynum);
	
	//no validamos el enter aqui, porque se valido ya en la funcion de solo numeros
	if((keynum >= 97 && keynum <= 122) || (keynum >= 65 && keynum <= 90) || (keynum == 8)
			|| (keynum == 241) || (keynum == 249) || (keynum == 0)){
		return true;
	}else{
		return false;
	}
}

function letrasONumeros(evt, formulario){
	if (soloNumeros(evt, formulario) || soloLetras(evt, formulario)) {
		return true;	
	}
	
	return false;
}

function wasWritedLoginAndPwd(formulario){
	if(formulario.user.value == ''){
		alert("Disculpe debe indicar su usuario");
		formulario.user.focus();
		return false;
	} else if(formulario.password.value == ''){
		alert("Disculpe debe indicar su clave de ingreso");
		formulario.password.focus();
		return false;
	}
	
	formulario.submit();
}