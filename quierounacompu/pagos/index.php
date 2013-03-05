<html>
<head>
	<title>QUIEROUNACOMPU - FORMULARIO DE PAGO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script language="javascript" type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="../css/jsDatePick_ltr.css" rel="stylesheet" type="text/css" />
	<script src="../scripts/jsDatePick.full.1.3.js" type="text/javascript"></script>
	<style type="text/css">
	<!--
		.Estilo17 {color: #333333}
		.Estilo18 {font-size: 12px}
		.Estilo20 {color: #FF0000}
		.Estilo21 {
			font-family: Verdana, Arial, Helvetica, sans-serif
		}
		.Estilo22 {font-size: 12px}
		.Estilo23 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; }
		body {
			background-color: #FFFFFF;
		}
		.Estilo24 {
			font-family: Arial, Helvetica, sans-serif;
			color: #FFFFFF;
			font-size: 14px;
		}
		.Estilo25 {
			font-size: 9;
			font-family: Arial, Helvetica, sans-serif;
		}
	-->
	</style>
</head>
<body>
	
<form name="pago" onsubmit="return B(this)" action="pago.php" method="post">
	<table class="tablaPrincipal" align="center" cellpadding="0" cellspacing="10" width="741">
  		<tr>
    		<td colspan="3" align="center">
    			<table border="0" cellpadding="0" cellspacing="0" width="900">
      				<tr>
				        <td><img src="img/spacer.gif" alt="" border="0" height="1" width="900"></td>
				        <td><img src="img/spacer.gif" alt="" border="0" height="1" width="1"></td>
      				</tr>
      				<tr>
				        <td><img src="headerquierounacompu.gif" height="295" width="900"></td>
				        <td><img src="img/spacer.gif" alt="" border="0" height="295" width="1"></td>
      				</tr>
      				<tr>
				        <td><img src="img/headerdepagos_r2_c1.jpg" alt="" name="headerdepagos_r2_c1" usemap="#headerdepagos_r2_c1Map" id="headerdepagos_r2_c1" border="0" height="51" width="900"></td>
				        <td><img src="img/spacer.gif" alt="" border="0" height="51" width="1"></td>
      				</tr>
      				<tr>
				        <td><img name="headerdepagos_r3_c1" src="img/headerdepagos_r3_c1.jpg" id="headerdepagos_r3_c1" alt="" border="0" height="54" width="900"></td>
				        <td><img src="img/spacer.gif" alt="" border="0" height="54" width="1"></td>
      				</tr>
    			</table>
    			
      			<map name="headerdepagos_r2_c1Map" id="headerdepagos_r2_c1Map">
	        		<area shape="rect" coords="169,10,272,39" href="http://listado.mercadolibre.com.ve/_CustId_75260285">
			        <area shape="rect" coords="298,13,417,38" href="http://listado.mercadolibre.com.ve/_CustId_7526028_OrderId_AUCTION*STOP_NoQCat__OtherFilterID_COMHOY">
			        <area shape="rect" coords="433,14,550,41" href="http://listado.mercadolibre.com.ve/_CustId_75260285_OrderId_MAS*OFERTADOS_AuctTypeID_AFP_DisplayType_G">
			        <area shape="rect" coords="578,8,683,42" href="http://listado.mercadolibre.com.ve/_CustId_75260285_OrderId_AUCTION*STOP_DisplayType_G_OtherFilterID_UNPESO">
			        <area shape="rect" coords="719,7,816,45" href="http://perfil.mercadolibre.com.ve/QUIEROUNACOMPU">
      			</map>
      		</td>
		</tr>
  		<tr>
    		<td colspan="3" class="headline1 Estilo24" align="center" bgcolor="#2073C3" height="40">
    			Reportar pago de productos, mediante depósito o transferencia 
    		</td>
  		</tr>
  		<tr>
    		<td colspan="3" class="headline2 Estilo22" align="center" bgcolor="#CCCCCC">
    			Por favor para nosotros es importante que usted llene este formulario, para procesar su pedido correctamente
    		</td>
  		</tr>
  		<tr>
    		<td colspan="3" class="headline2" align="center" bgcolor="#CCCCCC">
    			Datos del pago para procesar su pedido
    		</td>
  		</tr>
  		<tr>
    		<td colspan="3">&nbsp;</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17" width="307">
    			* Tu seudónimo en MercadoLibre:
    		</td>
    		<td width="266">
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" tabindex="1" size="30" name="seudonimo">
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Tus nombres y apellidos:
    		</td>
    		<td>
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" tabindex="2" size="30" name="nombre">
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Cédula de identidad o RIF:
    			<br />
    			<span class="subtitle Estilo20">
    				Indispensable para poder procesar el pedido.
    			</span>
    		</td>
   	 		<td>
   	 			<select style="FONT-SIZE: 10pt" tabindex="3" size="1" name="ci">
			        <option selected="">V</option>
			        <option>J</option>
			        <option>G</option>
			        <option>E</option>
			        <option>C</option>
      			</select>
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" tabindex="4" maxlength="9" size="23" name="cii" minlength="5">
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			*  Correo electrónico:
    		</td>
    		<td>
    			<p>
      				<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" tabindex="5" size="30" name="email">
      				<span class="Estilo20">El mismo de MercadoLibre</span>
      				<br />
      				<span class="Estilo18">
      					Es importante que el email sea escrito correctamente ya que te llegara una copia de los datos completados.
      					<br />
      					Tambi&eacute;n te enviaremos ofertas de nuestros productos.
      				</span>
      			</p>
      		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Medio de Pago:
    		</td>
    		<td>
    			<select name="medio" size="1" class="Estilo11" style="FONT-SIZE: 10pt" tabindex="6" id="medio">
			        <option selected="">Seleccione su medio</option>
			        <option>Dep&oacute;sito </option>
			        <option>Transferencia </option>
			        <option>Efectivo en tienda</option>
			        <option>Cheque Conformable en tienda</option>
			        <option>MercadoPago</option>
      			</select>
      		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">Banco:</td>
    		<td>
    			<select name="banco" size="1" class="Estilo11" style="FONT-SIZE: 10pt" tabindex="6" id="banco">
					<option>Seleccione su banco</option>
					<option>Banesco</option>
					<option>Mercantil</option>
					<option>Venezuela</option>
        		</select>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			<p>*Cantidad y Articulo(s) comprado(s) :</p>
    			<p class="Estilo18">
    				Indiquenos la cantidad y el articulo que usted compro, tome como guia el t&iacute;itulo del articulo en MercadoLibre 
    				<br />
    				Cantidad (Nro) Articulo 
    			</p>
         	</td>
    		<td>
    			<textarea name="articulo" id="articulo" cols="45" rows="5"></textarea>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* N&uacute;mero del dep&oacute;sito o transferencia:
    			<br />
    			<span class="Estilo20">
    				Copie el n&uacute;mero de trasferencia o baucher
    			</span>
    		</td>
    		<td>
      			<input id="bauche" style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" tabindex="7" maxlength="30" size="30" name="bauche"> 
      		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Fecha del dep&oacute;sito o transferencia:
    		</td>
    		<td>
    			<input type="text" id="fechaPago" name="fechaPago" size="25" readonly="true"/>
			
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaPago",        
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%Y-%m-%d",
				        imgPath:"../img/"
				    });
				</script>
      		</td>
  </tr>
  <tr>
    <td class="title Estilo17">* Monto del depósito o transferencia:</td>
    <td><input style="FONT-SIZE: 10pt; TEXT-DECORATION: none" tabindex="12" size="30" name="monto"> 
      <span class="Estilo23">Bs F</span></td>
    <td class="subtitle">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="headline2 Estilo17" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="headline2 Estilo17 Estilo21" align="center">Datos para el envío</td>
  </tr>
  <tr>
    <td colspan="3" class="title Estilo17 Estilo18"><div align="center"><span class="Estilo20">Nota Importante:</span> No nos hacemos responsables por los daños y/o pérdidas que puedan sufrir los productos durante su traslado</div></td>
    </tr>
  <tr>
    <td class="title Estilo17">* Compañía de Envío:</td>
    <td>
      <select name="envio" size="1" class="Estilo11" id="envio" style="FONT-SIZE: 10pt" tabindex="6" onchange="MM_popupMsg('Estimado cliente MRW no ASEGURA ningún tipo de producto, por lo que si selecciona esta empresa como método de envio recuerde que el envio va bajo RESPONSABILIDAD ABSOLUTA del COMPRADOR.\rGracias por su atención\r QUIEROUNACOMPU.COM')">
<option>GRUPO ZOOM</option>
<option>MRW</option>
</select> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="title Estilo17">* Nombre y Apellido del destinatario:</td>
    <td><input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="13" size="30" name="destinatario"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="title Estilo17">* Direccion <strong>exacta </strong>de destino </td>
    <td><input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="14" size="45" name="dir1">
      <input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="15" size="45" name="dir2"></td>
    <td class="subtitle">Incluya nombre de Urb. o Barrio; Calle, Carrera o Av.; Nombre o numero de Casa o Edificio; Piso y número de Apto u Oficina</td>
  </tr>
  <tr>
    <td class="title Estilo17">* Ciudad o Población:</td>
    <td><input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="16" size="30" name="ciudad"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="title Estilo17">* Estado:</td>
    <td><select name="estado" size="1" tabindex="17">
        <option selected="">Selecciona</option>
		<option>Amazonas</option>
        <option>Anzoategui</option>
        <option>Apure</option>
        <option>Aragua</option>
        <option>Barinas</option>
        <option>Bolivar</option>
        <option>Carabobo</option>
        <option>Cojedes</option>
        <option>Delta Amacuro</option>
        <option>Distrito Capital</option>
        <option>Falcon</option>
        <option>Guarico</option>
        <option>Lara</option>
        <option>Merida</option>
        <option>Miranda</option>
        <option>Monagas</option>
        <option>Nueva Esparta</option>
        <option>Portuguesa</option>
        <option>Sucre</option>
        <option>Tachira</option>
        <option>Trujillo</option>
        <option>Vargas</option>
        <option>Yaracuy</option>
        <option>Zulia</option>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="title Estilo17">Celular:</td>
    <td><select id="codcel" tabindex="18" size="1" name="codcel">
        <option selected="">codigo</option>
 		<option>412</option>
        <option>414</option>
        <option>416</option>
        <option>424</option>
      </select>
      <input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="19" maxlength="7" size="20" name="celular"></td>
    <td rowspan="2" class="subtitle">Debe indicar al menos un número telefónico, sea celular o fijo</td>
  </tr>
  <tr>
    <td class="title Estilo17">Teléfono:</td>
    <td><select tabindex="20" size="1" name="codfono">
        <option selected="">codigo</option>
		<option value="212">212</option>
        <option value="234">234</option>
        <option value="235">235</option>
        <option value="237">237</option>
        <option value="238">238</option>
        <option value="239">239</option>
        <option value="240">240</option>
        <option value="241">241</option>
        <option value="242">242</option>
        <option value="243">243</option>
        <option value="244">244</option>
        <option value="245">245</option>
        <option value="246">246</option>
        <option value="247">247</option>
        <option value="248">248</option>
        <option value="249">249</option>
        <option value="251">251</option>
        <option value="252">252</option>
        <option value="253">253</option>
        <option value="254">254</option>
        <option value="255">255</option>
        <option value="256">256</option>
        <option value="257">257</option>
        <option value="258">258</option>
        <option value="259">259</option>
        <option value="261">261</option>
        <option value="262">262</option>
        <option value="263">263</option>
        <option value="264">264</option>
        <option value="265">265</option>
        <option value="266">266</option>
        <option value="267">267</option>
        <option value="268">268</option>
        <option value="269">269</option>
        <option value="271">271</option>
        <option value="272">272</option>
        <option value="273">273</option>
        <option value="274">274</option>
        <option value="275">275</option>
        <option value="276">276</option>
        <option value="277">277</option>
        <option value="278">278</option>
        <option value="279">279</option>
        <option value="281">281</option>
        <option value="282">282</option>
        <option value="283">283</option>
        <option value="284">284</option>
        <option value="285">285</option>
        <option value="286">286</option>
        <option value="287">287</option>
        <option value="288">288</option>
        <option value="289">289</option>
        <option value="291">291</option>
        <option value="292">292</option>
        <option value="293">293</option>
        <option value="294">294</option>
        <option value="295">295</option>
        <option value="296">296</option>
      </select>
    <input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="21" maxlength="7" size="20" name="fono"></td>
  </tr>
  <tr>
    <td class="title Estilo17">Observaciones:</td>
    <td><input style="BACKGROUND-COLOR: rgb(255,255,255)" tabindex="22" size="45" name="obs"></td>
    <td class="subtitle">Nombre de juego, colores, cantidades, etc.</td>
  </tr>
  <tr>
    <td colspan="3" class="subtitle" align="center">Por favor no olvides llenar todos los campos obligatorios marcados con *</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input name="enviar" style="FONT-WEIGHT: bold; FONT-SIZE: 10pt" onclick="MM_popupMsg('Gracias por completar la información, en breve le sera enviado un email con todos los datos para su archivo.\rRECUERDE ESPERAR hasta que aparezca la pantalla de AGRADECIMIENTO POR SU PAGO')" value="Enviar datos del pago" type="submit"></td>
  </tr>
</tbody></table>
</form>






</body></html>