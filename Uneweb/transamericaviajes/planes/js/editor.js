var idCounter = 0;

/**
 * 
 * @param elementId
 */
function eliminarElemento(elementId){
	var element = document.getElementById(elementId);
	
	element.parentNode.removeChild(element);
}

/**
 * 
 */
function addDayInfoContainer(dayTitle, dayActivities, dayImgName){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("daysInfo");
	//var nextId = "dayInfoTable_" + document.getElementsByName("dayInfoTable").length;
	var nextId = "dayInfoTable_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  '<table border="1" name="dayInfoTable" >'
		+ '    <tr>'
		+ '        <td>'
		+ '            T&iacute;tulo del d&iacute;a: <input type="text" name="dayTitle[]" value="' + dayTitle + '"/> <br />'
		+ '            Actividades del d&iacute;a: <textarea rows="6" cols="50" name="dayDesc[]">' + dayActivities + '</textarea> <br />'
		+ '        </td>'
		+ '        <td>'
		+ '            Im&aacute;gen relacionada (m&aacute;ximo 220x165): <br/>'
		+ '            <input type="hidden" name="dayPrevImage[]" value="' + dayImgName + '"/>'
		+ '            <input type="file" name="dayImage[]" />'
		+ '        </td>'
		+ '    </tr>'
		+ '    <tr>'
		+ '        <td colspan="2" align="center">'
		+ '            <input type="button" value="Eliminar este dia" onclick="javascript:eliminarElemento(' + nextIdParam + ')"/>'
		+ '        </td>'
		+ '    </tr>'
		+ '</table> <br/>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}

/**
 * 
 */
function addTextFieldSeccion2(optionValue){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("seccion2Info");
	//var nextId = "opcionSeccion2_" + document.getElementsByName("opcionSeccion2[]").length;
	var nextId = "opcionSeccion2[]_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  'Texto de la opci&oacute;n: <input type="text" name="opcionSeccion2[]" value="' + optionValue + '"/> &nbsp;'
		+ '<input type="button" value="Eliminar" onclick="eliminarElemento(' + nextIdParam + ')"><br/>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}

/**
 * 
 */
function addTextFieldSeccion3(optionValue){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("seccion3Info");
	//var nextId = "opcionSeccion3_" + document.getElementsByName("opcionSeccion3[]").length;
	var nextId = "opcionSeccion3[]_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  'Texto de la opci&oacute;n: <input type="text" name="opcionSeccion3[]" value="' + optionValue + '"/> &nbsp;'
		+ '<input type="button" value="Eliminar" onclick="eliminarElemento(' + nextIdParam + ')"><br/>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}

/**
 * 
 */
function addGastoSeccion3(optionValue){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("seccion3Gasto");
	//var nextId = "gastoSeccion3_" + document.getElementsByName("gastoSeccion3[]").length;
	var nextId = "gastoSeccion3[]_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  'Texto del gasto: <input type="text" name="gastoSeccion3[]" value="' + optionValue + '"/> &nbsp;'
		+ '<input type="button" value="Eliminar" onclick="eliminarElemento(' + nextIdParam + ')"><br/>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}

/**
 * 
 */
function addFileSeccion4(pictureName){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("seccion4Info");
	//var nextId = "fileSeccion4_" + document.getElementsByName("fileSeccion4[]").length;
	var nextId = "fileSeccion4[]_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  'Foto (m&aacute;ximo 618x300): <input type="file" name="fileSeccion4[]" /> &nbsp;'
		+ '<input type="hidden" name="hiddenFileSeccion4[]" value="' + pictureName + '"/>'
		+ '<input type="button" value="Eliminar" onclick="eliminarElemento(' + nextIdParam + ')"><br/>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}

/**
 * 
 */
function addRowSeccion5(ciudadValue, hotelValue, categoriaValue){
	//obtenemos el nodo padre donde colocaremos el container para el nuevo dia
	var nodoPadre = document.getElementById("seccion5Info");
	//var nextId = "seccion5Row_" + document.getElementsByName("seccion5Row").length;
	var nextId = "seccion5Row_" + (idCounter ++);
	var nextIdParam = "'" + nextId + "'";
	var newNodo = document.createElement('div');
	newNodo.id = nextId;
	
	var htmlContainerText = 
		  '<table class="table table-bordered table-striped" name="seccion5Row">'
		+ '    <tr>'
		+ '        <td width="200px">'
		+ '            <input type="text" name="text1[]" value="' + ciudadValue + '"/>'
		+ '        </td>'
		+ '        <td width="200px">'
		+ '            <input type="text" name="text2[]" value="' + hotelValue + '"/>'
		+ '        </td>'
		+ '        <td width="200px">'
		+ '            <input type="text" name="text3[]" value="' + categoriaValue + '"/>'
		+ '        </td>'
		+ '        <td width="200px">'
		+ '            <input type="button" value="Eliminar esta fila" onclick="javascript:eliminarElemento(' + nextIdParam + ')"/>'
		+ '        </td>'
		+ '    </tr>'
		+ '</table>';
	
	newNodo.innerHTML = htmlContainerText;
	nodoPadre.appendChild(newNodo);
}
