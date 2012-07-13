var mensajeErrorAjaxInvocacion="Disculpe, hubo un problema al ejecutar su solicitud.\nPor favor intente mas tarde.";
var askIfCreateAOrdertoClient="Esta Ud seguro de querer generar una orden de compra\npara: ";

/**
 * Dependiendo del navegador, creamos el objecto ajax que corresponda
 * 
 * @returns
 */
function getAjaxObj(){ 
	var ajaxObject; //Agregamos la variable llamada objeto
	
	//revisamos si no esta definido el objeto nativamente(navegadores tipo mozilla)
	if (typeof XMLHttpRequest == "undefined" ){ 
		//Ahora revisamos si el motor es mayor o igual a MSIE 5.0 (mayor que microsoft internet explorer 5.0)
		if(navigator.userAgent.indexOf("MSIE 5") >= 0) { 
			// Si es así creamos un control activeX apartir de un objeto ActiveXObject("Microsoft.XMLHTTP")
			ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			//si no , o si es menor a MSIE 5.0 creamos otro control activeX
			// apartir de un objeto ActiveXObject("Msxml2.XMLHTTP")
			ajaxObject = new ActiveXObject("Msxml2.XMLHTTP");
		}
	} else {
		// en cambio si el objeto estaba definido nativamente, solo lo instanciamos
		//Instancia del objeto XMLHttpRequest
		ajaxObject=new XMLHttpRequest();
	}
	
	// Y retornamos el objeto creado
	return ajaxObject;
}

/**
 * Verificamos si la tecla presionada es un ENTER
 * @param e
 * @returns {Boolean}
 */
function onclickIfKeyWasENTER(elementId, e) { 
	var tecla = (document.all) ? e.keyCode : e.which; 
    
    if (tecla == 10 || tecla == 13) {
    	if(document.getElementById(elementId) != null){
    		document.getElementById(elementId).click(); 
    	}
    } 
    
    return true;
}

/**
 * Se invoca via POST el url dado como parametro
 * y dependiendo de si hubo error o no, se muestra la informacion correspondiente.
 * 
 * @param urlToCall
 */
function makeAjaxCall(urlToCall){
	var ajaxObject = getAjaxObj();
	
	ajaxObject.onreadystatechange=function(){
		if(ajaxObject.readyState == 4){
			if(ajaxObject.status == 200){
				//la llamada termino ok
				//inyectamos la respuesta
				document.getElementById("pagingValues").innerHTML = ajaxObject.responseText;
			} else {
				alert(mensajeErrorAjaxInvocacion);
			}
			
			document.getElementById("ajaxExecution").style.display = "none";
			document.getElementById("pagingValues").style.display = "block";
		}
	};
	
	//colocamos la imagen de "cargando"
	document.getElementById("pagingValues").style.display = "none";
	document.getElementById("ajaxExecution").style.display = "inline-table";
	
	ajaxObject.open("POST", urlToCall);
	ajaxObject.send(null);
}

/**
 * 
 */
function getClientPageByAjax(pageToGet){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	//APPConstant.PAGING_PAGE_NUMBER
	var urlToCall = "servlet?action=getClientPageByAjax&pagingPageNumber=" + pageToGet;
	//APPConstant.PARAM_RIF_CLIENTE
	urlToCall += "&paramRifCliente=" + (document.getElementById("paramRifCliente") == null ? "" : document.getElementById("paramRifCliente").value);
	//APPConstant.PARAM_RAZON_SOCIAL_CLIENTE
	urlToCall += "&paramRazonSocialCliente=" + (document.getElementById("paramRazonSocialCliente") == null ? "" : document.getElementById("paramRazonSocialCliente").value);
	//APPConstant.PARAM_CONTACTO_CLIENTE
	urlToCall += "&paramContactoCliente=" + (document.getElementById("paramContactoCliente") == null ? "" : document.getElementById("paramContactoCliente").value);
	
	makeAjaxCall(urlToCall);
}

function getProductPageByAjax(pageToGet){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	//APPConstant.PAGING_PAGE_NUMBER
	var urlToCall = "servlet?action=getProductsPageByAjax&pagingPageNumber=" + pageToGet;
	
	//APPConstant.PARAM_ID_PRODUCTO
	urlToCall += "&paramIdProducto=" + (document.getElementById("paramIdProducto") == null ? "" : document.getElementById("paramIdProducto").value);
	//APPConstant.PARAM_DESC_PRODUCTO
	urlToCall += "&paramDescProducto=" + (document.getElementById("paramDescProducto") == null ? "" : document.getElementById("paramDescProducto").value);
	//APPConstant.PARAM_LINEA_PRODUCTO
	urlToCall += "&paramLineaProducto=" + (document.getElementById("paramLineaProducto") == null ? "" : document.getElementById("paramLineaProducto").value);
	//APPConstant.PARAM_MARCA_PRODUCTO
	urlToCall += "&paramMarcaProducto=" + (document.getElementById("paramMarcaProducto") == null ? "" : document.getElementById("paramMarcaProducto").value);
	
	makeAjaxCall(urlToCall);
}

/**
 * Se le pregunta al vendedor si esta seguro de querer crear una orden e compra para el cliente seleccionado.
 * 
 */
function showProductListIfAcceptClient(clienteId, clientName){
	var wasAccepted = confirm(askIfCreateAOrdertoClient + clientName + "?");
	
	if(wasAccepted){
		//aceptó, debemos ir al listado de productos con este cliente
		//PARAM_ID_CLIENTE
		window.location = 'servlet?action=selectProductsToCar&paramIdCliente=' + clienteId;
	}
}

/**
 * funcion para actualizar la cuenta de productos en el carrito actual
 * de los vendedores o clientes directos.
 */
function updateElementsShopCarCount(newCount){
	if(document.getElementById("numberOfElementsInShopCar") != null){
    	document.getElementById("numberOfElementsInShopCar").innerHTML = "(" + newCount + ")";
    }
}

function addProductInShopCar(idProducto){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	//APPConstant.PARAM_ID_PRODUCTO
	var urlToCall = "servlet?action=addProductToShopCar&paramIdProducto=" + idProducto;
	var ajaxObject = getAjaxObj();
	
	ajaxObject.onreadystatechange=function(){
		if(ajaxObject.readyState == 4){
			if(ajaxObject.status == 200){
				//la llamada termino ok
				//inyectamos la respuesta
				document.getElementById("numberOfElementsInShopCar").innerHTML = ajaxObject.responseText;
			} else {
				alert(mensajeErrorAjaxInvocacion);
			}
			
			document.getElementById("loadingCape").style.display = "none";
		}
	};
	
	//colocamos la capa de "cargando"
	document.getElementById("loadingCape").style.display = "block";
	
	ajaxObject.open("POST", urlToCall);
	ajaxObject.send(null);
}
