/**
 * colocamos aqui todos los contenedores posibles donde pueden estar los errores
 * para ocultar todos los elementos relacionados de una vez
 */
function hideErrors(mustRedirectToWelcomePage){
	$("#errorContainer").fadeOut(700);
	$("#ajaxMsgsValues").fadeOut(700);
	$("#ajaxMsgsContainer").fadeOut(700);
	
	if(mustRedirectToWelcomePage){
		window.location = "servlet?action=redirectToPage&paramPageToRedirect=/webpages/welcome.jsp";
	}
}

/**
 * Funcion javascript para hacer swaping entre imagenes (on/off)
 * @param imgElement
 * @param srcTo
 */
function swapImage(imgElement, srcTo){
	if(imgElement != null){
		imgElement.src = srcTo;
	}
}

/**
 * Verificamos si la tecla presionada es un ENTER
 * @param e
 * @returns {Boolean}
 */
function justAllowNumbers(e) { 
	var tecla = (document.all) ? e.keyCode : e.which; 
    
	//backspace = 8
	//enter = 13
	//numero cero = 48
	//numero nueve = 57
	
	if ((tecla == 8) || (tecla == 13) || ((tecla >= 48) && (tecla <= 57))){
		return true;
	} else {
		return false;
	}
}

function allowCharactersToNumberDouble(value, e){
	var tecla = (document.all) ? e.keyCode : e.which; 
    
	//backspace = 8
	//enter = 13
	//numero cero = 48
	//numero nueve = 57
	//punto = 46
	
	if ((tecla == 8) || (tecla == 46) || (tecla == 13) || ((tecla >= 48) && (tecla <= 57))){
		//es un caracter de los permitidos, vemos si es valida realmente su escritura.
		//si es un punto, solo podremos escribirlo despues de tener al menos un numero en el campo
		if(tecla == 46){
			if((value.length > 0) && (value.indexOf(".") == -1)){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	} else {
		return false;
	}
}

/**
 * Calculamos el total en dinero para la orden de compra.
 * 
 */
function setTotalOfCar(){
	var total = 0;
	var i = 0;
	var mustContinue = true;
	
	while(mustContinue){
		var cantidad = document.getElementById("cantidad_" + i);
		var precio = 0;
		var descuento = 0;
		
		if(cantidad != null){
			//tenemos cantidad para este indice, entonces obtenemos el precio y el descuento para el calculo
			//el precio nunca deberia ser nulo, el descuento si
			precio = document.getElementById("precio_" + i).value;
			
			descuento = document.getElementById("descuento_" + i);
			if(descuento == null){
				descuento = 0;
			}else {
				descuento = descuento.value; 
			}
			
			total += (cantidad.value * precio) - (precio * (descuento / 100));
		} else {
			mustContinue = false;
		}
		
		i++;
	}
	
	document.getElementById("totalPriceOrder").innerHTML = total;
}
