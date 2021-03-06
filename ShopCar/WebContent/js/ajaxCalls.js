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
			// Si es as� creamos un control activeX apartir de un objeto ActiveXObject("Microsoft.XMLHTTP")
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
 * funcion para mostrar como una ventana, el resultado de una operacion ajax.
 * @param innerHTML
 */
function showMsgsAfterAjaxCall(innerHTML){
	//obtenemos el tama�o de la pantalla
	var screenW = screen.width;
	var screenH = screen.height;
	
	var container = document.getElementById("ajaxMsgsContainer");
	container.style.width = screenW + "px";
	container.style.height = screenH + "px";
	
	var innerDiv = document.getElementById("ajaxMsgsValues");
	innerDiv.innerHTML = innerHTML;
	
	var msgsContainer = document.getElementById("errorContainer");
	if(msgsContainer == null){
		msgsContainer = document.getElementById("msgsAjaxContainer");
	}
	innerDiv.style.height = msgsContainer.style.height + "px";
	innerDiv.style.left = ((screenW - 450) / 2) + "px";
	innerDiv.style.top = ((screenH - 110) / 2) + "px";
	
	//antes de mostrar los errores, debemos acomodarlos en el centro de la pantalla
	innerDiv.style.display = "block";
	container.style.display = "block";
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
		//acept�, debemos ir al listado de productos con este cliente
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
    	document.getElementById("numberOfElementsInShopCar").innerHTML = "<b>(" + newCount + ")</b>";
    }
}

/**
 * funcion a invocar para agregar productos en la orden de compra actual.
 * 
 * @param idProducto
 */
function addProductInShopCar(idProducto){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	$("#img_" + idProducto).effect("shake", { times:1 }, 200);
	
	//APPConstant.PARAM_ID_PRODUCTO
	var urlToCall = "servlet?action=addProductToShopCar&paramIdProducto=" + idProducto;
	//APPConstant.PARAM_CANTIDAD_PRODUCTO
	urlToCall += "&paramCantidadProducto=" + document.getElementById("cantidad_" + idProducto).value;
	
	var ajaxObject = getAjaxObj();
	
	ajaxObject.onreadystatechange=function(){
		if(ajaxObject.readyState == 4){
			if(ajaxObject.status == 200){
				//la llamada termino ok
				//inyectamos la respuesta si no hubo error obteniendola
				var textAjaxResponse = ajaxObject.responseText;
				var indexOf = textAjaxResponse.indexOf("errorContainer");
				
				if(indexOf > -1){
					//tengo un div, veo si es de la clase error
					showErrorAfterAjaxCall(textAjaxResponse);
				} else {
					document.getElementById("numberOfElementsInShopCar").innerHTML = textAjaxResponse;
				}
				
				document.getElementById("loadingCape").style.display = "none";
			} else {
				alert(mensajeErrorAjaxInvocacion);
			}
		}
	};
	
	//colocamos la capa de "cargando"
	document.getElementById("loadingCape").style.display = "block";
	
	ajaxObject.open("POST", urlToCall);
	ajaxObject.send(null);
}

/**
 * funcion a invocar para agregar productos en la orden de compra actual.
 * 
 * @param idProducto
 */
function doPreOrder(){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	//APPConstant.PARAM_ID_PRODUCTO
	var urlToCall = "servlet?action=storeShopCar";//&paramIdProducto=" + idProducto;
	
	var i = 0;
	var mustContinue = true;
	
	while(mustContinue){
		var idProduct = document.getElementById("idProducto_" + i);
		var cantidad = 0;
		var precio = 0;
		var descuento = 0;
		
		if(idProduct != null){
			//tenemos cantidad para este indice, entonces obtenemos el precio y el descuento para el calculo
			cantidad = document.getElementById("cantidad_" + i);
			
			//el precio nunca deberia ser nulo, el descuento si
			precio = document.getElementById("precio_" + i).value;
			
			descuento = document.getElementById("descuento_" + i);
			if(descuento == null){
				descuento = 0;
			}else {
				descuento = descuento.value; 
			}
			
			urlToCall += "&idProducto_" + i + "=" + idProduct.value;
			urlToCall += "&cantidad_" + i + "=" + cantidad.value;
			urlToCall += "&precio_" + i + "=" + precio;
			urlToCall += "&descuento_" + i + "=" + descuento;
		} else {
			mustContinue = false;
		}
		
		i++;
	}
	
	var ajaxObject = getAjaxObj();
	
	ajaxObject.onreadystatechange=function(){
		if(ajaxObject.readyState == 4){
			if(ajaxObject.status == 200){
				//la llamada termino ok
				//inyectamos la respuesta si no hubo error obteniendola
				//alert(ajaxObject.responseText);
				showMsgsAfterAjaxCall(ajaxObject.responseText);
				
				document.getElementById("loadingCape").style.display = "none";
			} else {
				alert(mensajeErrorAjaxInvocacion);
			}
		}
	};
	
	//colocamos la capa de "cargando"
	document.getElementById("loadingCape").style.display = "block";
	
	ajaxObject.open("POST", urlToCall);
	ajaxObject.send(null);
}

/**
 * funcion a invocar para agregar productos en la orden de compra actual.
 * 
 * @param idProducto
 */
function discardShopOrder(){
	//COMO ESTO ES JAVASCRIPT NO TENGO ACCESO A LAS CONSTANTES JAVA
	//TOCA CABLEAR
	
	//APPConstant.PARAM_ID_PRODUCTO
	var urlToCall = "servlet?action=discardShopOrder";
	
	var ajaxObject = getAjaxObj();
	
	ajaxObject.onreadystatechange=function(){
		if(ajaxObject.readyState == 4){
			if(ajaxObject.status == 200){
				//la llamada termino ok
				//inyectamos la respuesta si no hubo error obteniendola
				showMsgsAfterAjaxCall(ajaxObject.responseText);
				
				document.getElementById("loadingCape").style.display = "none";
			} else {
				alert(mensajeErrorAjaxInvocacion);
			}
		}
	};
	
	//colocamos la capa de "cargando"
	document.getElementById("loadingCape").style.display = "block";
	
	ajaxObject.open("POST", urlToCall);
	ajaxObject.send(null);
}
