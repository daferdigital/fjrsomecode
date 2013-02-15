<script>
	var index = 0;

	function eliminarElemento(elementId){
		var element = document.getElementById(elementId);
		element.parentNode.removeChild(element);
	}

	function agregarPrecioXSemana(){
		var divConceptos = document.getElementById("conceptosPrincipales");

		divConceptos.innerHTML += '<table id="concepto' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar concepto" onclick="javascript:eliminarElemento(\'concepto'+ index +'\');" />'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]"/>'
			+ '        </td>'
			+ '    </tr>'
			+ '</table>';
		
		index ++;
	}

	function agregarConceptoFijo(){
		var divConceptos = document.getElementById("conceptosFijos");

		divConceptos.innerHTML += '<table id="conceptoFijo' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar" onclick="javascript:eliminarElemento(\'conceptoFijo'+ index +'\');" />'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="conceptoFijo' + index +'[]"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="conceptoFijo' + index +'[]"/>'
			+ '        </td>'
			+ '</table>';
		
		index ++;
	}
</script>

<form action="guardarInfoFormulario.php" method="post">
	<div align="center">
		<table>
			<tr>
				<td width="142">
					&nbsp;
				</td>
				<td width="142">
					Cantidad M&iacute;nima de Semanas
				</td>
				<td width="142">
					Cantidad M&aacute;xima de Semanas
				</td>
				<td width="142">
					Medio Tiempo PM
					<br />13 lecciones
					<br />L-J: 1pm-4pm
				</td>
				<td width="142">
					Medio Tiempo AM
					<br />17 lecciones
					<br />L-V: 9am-12pm
				</td>
				<td width="142">
					Semi intensivo
					<br />24 lecciones
					<br />L-J: 9am-2:30pm
					<br />V: 9am-12pm
				</td>
				<td width="142">
					Intensivo
					<br />30 lecciones
					<br />L-J: 9am-4pm
					<br />V: 9am-12pm
				</td>
			</tr>
		</table>
	</div>
	
	<div id="conceptosPrincipales" align="center">
	</div>
	
	<div align="center">
		<input type="button" value="Agregar Precios por semana" onclick="javascript:agregarPrecioXSemana();">
		<br />
		<br />
	</div>
	
	<div id="conceptosFijos" align="center">
	</div>
	
	<div id="conceptosFijos" align="center">
		<input type="button" value="Agregar Concepto Fijo" onclick="javascript:agregarConceptoFijo();">
		<br />
		<br />
	</div>
	
	<div align="center">
		<fieldset>
			<legend>legend alineado al centro</legend>
			Este es un ejemplo de un "fieldset"	 con el legend alineado al centro
		</fieldset>
		<br /><br />
		<input type="submit" value="Guardar informacion">
	</div>
</form>
