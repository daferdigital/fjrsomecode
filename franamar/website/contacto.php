<?php include("includes/header.php");?>

<div class="fondoAzul">
      	<h1 class="blanca">Contacto</h1>
</div>

<br />

<table>
	<tr>
		<td> <img src="images/avionConCarga2.jpg" style="display: inline-block;"/> </td>
		<td>
			<form name="sendEmail" method="post" action="sendEmail.php">
			<table align="right" bgcolor="#FFFFFF">
				<tr>
					<td colspan="2" align="left">
						Env&iacute;e su solicitud, pregunta, o cualquier tipo de informaci&oacute;n que usted desee saber a trav&eacute;s de este formulario:
					</td>
				</tr>
				<tr>
					<td align="right" width="15%"> <strong>Email:</strong></td>
					<td align="left"> <strong>main_office@franamarlc.com.ve</strong></td>
				</tr>
				<tr>
					<td align="right" width="15%"> <strong>Nombre:</strong></td>
					<td align="left"> <input type="text" name="name" size="20"/> </td>
				</tr>
				<tr>
					<td align="right" width="15%"> <strong>Tu Correo:</strong></td>
					<td align="left"> <input type="text" name="email" size="20"/> </td>
				</tr>
				<tr>
					<td align="right" width="55%"> <strong>Asunto: </strong></td>
					<td align="left"> <input type="text" name="subject" size="20"/> </td>
				</tr>
				<tr>
					<td align="right" width="15%">
			        	<p> <strong>Mensaje:</strong>&nbsp;&nbsp;</p>
			        </td>
			        <td align="left">
			        	<font color="#000000">
			            	<textarea rows="6" name="message" cols="50"></textarea>
			            </font>
			        </td>
				</tr>
				<tr>
					<td align="right"><input type="submit" class="boton" value="Enviar"/> </td>
					<td align="center"> <input type="reset" class="boton" value="Limpiar"/> </td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>


<?php include 'includes/footer.php'; ?>