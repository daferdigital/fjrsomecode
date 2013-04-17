var ajaxImageName = "ajax.gif";

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
	//8 backspace
	if((key >= 48 && key <= 57) || key == 8){
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
	
	//8 backspace
	//97-122 a-z
	//65-90 A-Z
	//241 ñ
	//209 Ñ
	//225-233-237-243-250 á é í ó ú
	if((key >= 97 && key <= 122) || (key >= 65 && key <= 90)
			|| (key == 241 || key == 209 || key == 32 || key == 225 || key == 233 || key == 237 || key == 243 || key == 250 || key == 8)){
		return true;
	} else {
		return false;
	}
}

/**
 * Colocamos el valor recibido como parametro, en el elemento indicado, si luego de modificar su valor el mismo
 * queda vacio.
 * 
 * @param valueToPut
 * @param elementToCheck
 */
function colocarSiVacio(valueToPut, elementToCheck){
	if(elementToCheck != null){
		if(elementToCheck.value == ""){
			elementToCheck.value = valueToPut;
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
function callAjax(url, parameters, idAnswerContainer){
	var ajaxObject =  createXMLHTTPRequest();

	if(idAnswerContainer != null){
		document.getElementById(idAnswerContainer).style.display="inline";
		document.getElementById(idAnswerContainer).innerHTML = "<img src=\"images/" + ajaxImageName + "\"/>";
	}
	
	ajaxObject.onreadystatechange=function() {
		if (ajaxObject.readyState==4 && ajaxObject.status==200) {
			if(idAnswerContainer != null){
				document.getElementById(idAnswerContainer).innerHTML = ajaxObject.responseText;
			} else {
				alert(ajaxObject.responseText);
			}
		}
	};
	
	ajaxObject.open("POST", url, true);
	//sin la linea siguiente no podemos enviar parametros via POST, solo seria por GET
	ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxObject.send(parameters);
}

/**
 * Obtenemos determinada pagina de productos, para una categoria dada
 * 
 * @param categoryId
 * @param pageNumber
 */
function getProductList(pageNumber){
	var parameters = "categoryId=" + document.getElementById("categoria").value;
	parameters += "&pageNumber=" + pageNumber;
	parameters += "&customAjaxPagingFunctionName=getProductList";
	
	if(document.getElementById("categoria").value == 0){
		document.getElementById("ajaxAnswer").innerHTML = "";
	} else {
		callAjax("showProducts.do",
				parameters,
				"ajaxAnswer");
	}
}

/**
 * Agregamos determinado producto a la cesta de compras
 * 
 * @param productId id del producto a agregar en la cesta
 */
function addToBasket(productId){
	var parameters = "productId=" + productId;
	
	if(document.getElementById("basketItemDetail") == null){
		alert("Acceso no permitido a la cesta de productos");
	} else {
		callAjax("addToBasket.do",
				parameters,
				"basketItemDetail");
	}
}

/**
 * Eliminamos determinado producto a la cesta de compras
 * 
 * @param productId id del producto a agregar en la cesta
 * @param pageComeFrom
 */
function deleteFromBasket(productId, pageComeFrom){
	var parameters = "productId=" + productId;
	parameters += "&pageComeFrom=" + pageComeFrom;
	
	if(document.getElementById("basketItemDetail") == null){
		alert("Acceso no permitido a la cesta de productos");
	} else {
		callAjax("deleteFromBasket.do",
				parameters,
				"basketItemDetail");
	}
}

/**
 * 
 * @param productId
 * @returns
 */
function showProductDetail(productId){
	var w = 500;
	var h = 300;
	var title = "Detalle de producto";
	var urlToOpen = "showProductDetail.do?productId=" + productId;
	
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	
	return window.open(urlToOpen, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left); 
}

/**
 * Validamos el formulario de preparacion de checkout de la cesta.
 * 
 * @returns {Boolean}
 */
function validateBasketCheckOut(){
	var productosMarcados = false;
	var cantidadesVacias = false;
	var msg = "";
	
	//array de inputs tipo checked
	var productos = Array.prototype.slice.call(document.getElementsByName("productosSeleccionados"));
	//array de las cantidades (en el mismo orden el los inputs)
	var cantidades = Array.prototype.slice.call(document.getElementsByName("cantidadesSeleccionadas"));
	
	for ( var i = 0; i < productos.length; i++) {
		productosMarcados = productosMarcados || productos[i].checked;
		if(productos[i].checked && cantidades[i].value == ""){
			cantidadesVacias = true;
		}
	}
	
	if(! productosMarcados){
		msg += "Disculpe, debe seleccionar algun producto para efectuar la pre orden.\n";
	}
	if(cantidadesVacias){
		msg += "Disculpe, no pueden ser vacias las cantidades en los productos que desea pre ordenar.\n";
	}
	
	if(msg == ""){
		//submit permitido
		//a efectos del form struts, enviamos toda la info'
		for ( var i = 0; i < productos.length; i++) {
			if(! productos[i].checked){
				productos[i].checked = true;
				cantidades[i].value = -1;
			}
		}
		
		return true;
	} else {
		alert(msg);
		return false;
	}
}

/**
 * Validamos el formulario previo al envio de la cesta para procesar la compra.
 * 
 * @returns {Boolean}
 */
function validateBeforeCompleteCheckOut(){
	var nroTarjetaCheque = document.getElementById("nroTarjetaCheque").value.trim();
	var msg = "";
	
	if(nroTarjetaCheque == ""){
		msg += "Disculpe, debe indicar el número de tarjeta o cheque.\n";
	}
	
	if(msg == ""){
		//submit permitido
		return true;
	} else {
		alert(msg);
		return false;
	}
}