function putWithAjax(url, contenedor, callback )/*THIS FUNCTION LOADS A PAGE INTO A DIV*/
{
	var xmlObj = createXMLRequest();
	

	xmlObj.onreadystatechange=function(){
			cargarpagina(xmlObj, contenedor, callback)
	}
	
	xmlObj.open('GET', url, true) // asignamos los métodos open y send
	xmlObj.send(null)

}


function cargarpagina(pagina_requerida, contenedor, callback){ /*THIS FUNCTION LOADS CONTENT INTO A DIV*/	

	if (pagina_requerida.readyState == 4 /*&& (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1)*/)
	{
		contenedor.innerHTML=pagina_requerida.responseText;
		if(callback) callback;
	}
}

function createXMLRequest(){

var pagina_requerida = false;

if (window.XMLHttpRequest) {// Si es Mozilla, Safari etc
	pagina_requerida = new XMLHttpRequest()
} 
else if (window.ActiveXObject)
{ // pero si es IE
	try {
	pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP")
	} 
	catch (e){ // en caso que sea una versión antigua
		try{
		pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP")
		}
		catch (e){}
		}
	}
else
{
	return false
}

return pagina_requerida;

}