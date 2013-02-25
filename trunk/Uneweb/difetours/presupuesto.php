<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<form action="correoPresupuesto.php" method="post">
	<table>
		<tr>
			<td colspan="2">
				<?php echo $_POST["mailContent"];?>
				<input type="hidden" name="mailContent" value="<?php echo $_POST["mailContent"];?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Nombre y Apellido:
			</td>
			<td>
				<input type="text" name="nombre"/>
			</td>
		</tr>
		<tr>
			<td>
				Sexo:
			</td>
			<td>
				<input type="radio" name="sexo" value="Masculino" checked="checked"/> Masculino
				&nbsp;
				<input type="radio" name="sexo" value="Femenino"/> Femenino
			</td>
		</tr>
		<tr>
			<td>
				Nacionalidad
			</td>
			<td>
				<input type="text" name="nacionalidad"/>
			</td>
		</tr>
		<tr>
			<td>
				Idioma Materno
			</td>
			<td>
				<input type="text" name="idiomaMaterno"/>
			</td>
		</tr>
		<tr>
			<td>
				Direcci&oacute;n:
			</td>
			<td>
				<textarea rows="5" name="direccion"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				Ciudad
			</td>
			<td>
				<input type="text" name="ciudad"/>
			</td>
		</tr>
		<tr>
			<td>
				Pa&iacute;s
			</td>
			<td>
				<input type="text" name="pais"/>
			</td>
		</tr>
		<tr>
			<td>
				C&oacute;digo Postal
			</td>
			<td>
				<input type="text" name="codigoPostal"/>
			</td>
		</tr>
		<tr>
			<td>
				Tel&eacute;fonos
			</td>
			<td>
				<input type="text" name="telefonos"/>
			</td>
		</tr>
		<tr>
			<td>
				Email
			</td>
			<td>
				<input type="text" name="email"/>
			</td>
		</tr>
		<tr>
			<td>
				Contacto de Emergencia
			</td>
			<td>
				<input type="text" name="contactoEmergencia"/>
			</td>
		</tr>
		<tr>
			<td>
				Tlf del contacto de Emergencia
			</td>
			<td>
				<input type="text" name="tlfEmergencia"/>
			</td>
		</tr>
		<tr>
			<td>
				¿Tiene alguna condici&oacute;n m&eacute;dica (s) debemos tener en cuenta?
			</td>
			<td>
				<input type="radio" name="condicionMedica" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="condicionMedica" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				En caso afirmativo, por favor especifique:
			</td>
			<td>
				<textarea rows="5" name="detalleCondicionMedica"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				¿Toma medicaci&oacute;n diaria?
			</td>
			<td>
				<input type="radio" name="medicacionDiaria" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="medicacionDiaria" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				En caso afirmativo, por favor especifique:
			</td>
			<td>
				<textarea rows="5" name="detalleMedicacionDiaria"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				¿Tiene seguro m&eacute;dico?
			</td>
			<td>
				<input type="radio" name="seguroMedico" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="seguroMedico" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				En caso afirmativo, especificar la empresa:
			</td>
			<td>
				<textarea rows="5" name="detalleSeguroMedico"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				¿fuma?
			</td>
			<td>
				<input type="radio" name="fuma" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="fuma" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				¿Come?:
			</td>
			<td>
				<input type="checkbox" name="comida[]" value="Pescado"/> Pescado
				<input type="checkbox" name="comida[]" value="Carne Roja"/> Carne Roja
				<input type="checkbox" name="comida[]" value="Productos Lacteos"/> Productos L&aacute;cteos
				<input type="checkbox" name="comida[]" value="Huevos"/> Huevos
			</td>
		</tr>
		<tr>
			<td>
				Me siento c&oacute;modo con los ni&ntilde;os en el hogar entre las edades de:
			</td>
			<td>
				<input type="radio" name="otrosNinos" value="Mayores de 12"/> Mayores de 12 a&ntilde;os
				<input type="radio" name="otrosNinos" value="Menores de 13"/> Menores de 13 a&ntilde;os
				<input type="radio" name="otrosNinos" value="Ninguna"/> Sin ni&ntilde;os
				<input type="radio" name="otrosNinos" value="Cualquiera" checked="checked"/> Cualquiera
			</td>
		</tr>
		<tr>
			<td>
				¿Se siente c&oacute;modo con perros en el hogar?
			</td>
			<td>
				<input type="radio" name="perros" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="perros" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				¿Se siente c&oacute;modo con gatos en el hogar?
			</td>
			<td>
				<input type="radio" name="gatos" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="gatos" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				Por favor especificar cualquier otro tipo de animal doméstico con el que se sienta cómodo:
			</td>
			<td>
				<input type="text" name="otrosAnimales" />
			</td>
		</tr>
		<tr>
			<td>
				¿Se siente c&oacute;modo con cualquier otro estudiante en el hogar?
			</td>
			<td>
				<input type="radio" name="otroEstudiante" value="si" checked="checked"/> S&iacute;
				&nbsp;
				<input type="radio" name="otroEstudiante" value="no"/> No
			</td>
		</tr>
		<tr>
			<td>
				(Los otros estudiantes posiblemente hablen otros idiomas.)
				¿Qué idiomas hablas?:
			</td>
			<td>
				<input type="text" name="otrosIdiomas" />
			</td>
		</tr>
		<tr>
			<td>
				Intereses y Comentarios:
			</td>
			<td>
				<textarea rows="5" name="comentarios"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				¿Requiere Seguro de viaje?
			</td>
			<td>
				<input type="radio" name="seguroDeViaje" value="si"/> S&iacute;
				&nbsp;
				<input type="radio" name="seguroDeViaje" value="no" checked="checked"/> No
			</td>
		</tr>
		<tr>
			<td>
				¿Requiere boleto a&eacute;reo?
			</td>
			<td>
				<input type="radio" name="boletoAereo" value="si" checked="checked"/> S&iacute;
				&nbsp;
				<input type="radio" name="boletoAereo" value="no"/> No
			</td>
		</tr>
		<tr>
			<td>
				¿Requiere Carta para tr&aacute;mites Cadivi?
			</td>
			<td>
				<input type="radio" name="cadivi" value="si" checked="checked"/> S&iacute;
				&nbsp;
				<input type="radio" name="cadivi" value="no"/> No
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Enviar Presupuesto"/>
			</td>
		</tr>
	</table>
</form>
</body>
</html>