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