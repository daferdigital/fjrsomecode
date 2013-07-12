<?php 
include_once 'includes/header.html';
?>
	<tr align="center">
		<td>
			<p><strong>Datos para su pago</strong></p>
			Cta. cte. Banco Venezolano de Cr&eacute;dito
			<br />
			N&deg; 0104-0015-54-0150090253
			<br />
			INVERSIONES DELIVERY 4T C.A.
			<br />
			RIF:  J-401615163
		</td>
		<td background="img/datosfondo.jpg">
			<form name="sendEmail" method="post" action="sendEmail.php" onsubmit="return validarPedido();">
  			<table>
  				<tr>
                	<td colspan="2"><br />
		          		<p><strong>Datos Personales</strong></p>
		            </td>
                </tr>
                <tr>
			    	<td align="right" width="41%">Nombre:</td>
			    	<td width="59%" align="left"> <input type="text" name="name" size="30"/> </td>
				</tr>
				<tr>
			    	<td align="right" width="41%">C.I.:</td>
			    	<td align="left"> <input type="text" name="cedula" size="30"/> </td>
				</tr>
				<tr>
			    	<td align="right" width="41%">Sexo:</td>
			    	<td align="left">
			    		<input type="radio" name="sexo" value="F"/> F
			    		&nbsp;&nbsp;
			    		<input type="radio" name="sexo" value="M"/> M
			    	</td>
				</tr>
				<tr>
                   	<td colspan="2">
                   		<br />
          			  	<p><strong>Direcci&oacute;n del cliente</strong></p>
	                </td>
	            </tr>
				<tr>
		    		<td align="right" width="41%">Direcci&oacute;n:</td>
			    	<td align="left"> <textarea name="direccion"></textarea> </td>
		  			</tr>
					<tr>
			    		<td align="right" width="41%">Ciudad:</td>
			    		<td align="left"> <input type="text" name="ciudad" size="30"/> </td>
					</tr>
					<tr>
			    		<td align="right" width="41%">Zona:</td>
			    		<td align="left"> <input type="text" name="zona" size="30"/> </td>
					</tr>
                    <tr>
			    		<td align="right" width="41%">Punto de Referencia:</td>
			    		<td align="left"> <input type="text" name="referencia" size="30"/> </td>
					</tr>

                    <tr>
                    	<td colspan="2"><br />
		          			<p><strong>Informaci&oacute;n de Contacto</strong></p>
		                </td>
                    </tr>

					<tr>
			    		<td align="right" width="41%">N&uacute;mero Local:</td>
			    		<td align="left"> <input type="text" name="tlf_local" size="30"/> </td>
					</tr>
					<tr>
			    		<td align="right" width="41%">N&uacute;mero de Celular:</td>
			    		<td align="left"> <input type="text" name="tlf_celular" size="30"/> </td>
					</tr>
					<tr>
			    		<td align="right" width="41%">Correo electr&oacute;nico:</td>
			    		<td align="left"> <input type="text" name="email" size="30"/> </td>
					</tr>
					<tr>
                    	<td height="30" colspan="2"></td>
          			</tr>
					<tr>
			    		<td align="right" colspan="2">
			    			<input type="submit" class="button_submit" value=""/>
			    		</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
<?php include 'includes/footer.html'; ?>