<?php 
	include "../sis/classes/DBUtil.php";
	include "../sis/classes/EnvioDAO.php";
	include "../sis/classes/EnvioDTO.php";
	
	//obtenemos el envio presupuestado
	$envioDTO = EnvioDAO::getEnvioInfo($_GET["id"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>QUIEROUNACOMPU - FORMULARIO DE PAGO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/jsDatePick_ltr.css"/>
	<link rel="stylesheet" type="text/css" href="../sis/css/jquery-ui.css" />
	
	<script type="text/javascript" src="./scripts/scripts.js"></script>
	<script type="text/javascript" src="../scripts/jsDatePick.full.1.3.js"></script>
	<script type="text/javascript" src="../sis/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="../sis/js/jquery.bpopup-0.9.0.min.js"></script>
	<script type="text/javascript" src="../sis/js/jquery-ui.min.js"></script>
	
	<style type="text/css">
	<!--
		.Estilo17 {color: #333333;}
		.Estilo18 {font-size: 12px;}
		.Estilo20 {color: #FF0000;}
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
		.isMandatory {
			color: #FF0000;
			font-size: 12px;
		}
	-->
	</style>
</head>
<body>
<?php $columnas = 3;?>
<form name="pago" action="updatePayNotifNoEnc.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $_GET["id"];?>"/>
	<table class="tablaPrincipal" align="center" cellpadding="0" cellspacing="10" width="741">
  		<tr>
    		<td colspan="<?php echo $columnas;?>" align="center">
    			<table border="0" cellpadding="0" cellspacing="0" width="900">
      				<tr>
				        <td><img src="../img/spacer.gif" alt="" border="0" height="1" width="900"></td>
				        <td><img src="../img/spacer.gif" alt="" border="0" height="1" width="1"></td>
      				</tr>
      				<tr>
				        <td><img src="../img/headerquierounacompu.gif" height="295" width="900"></td>
				        <td><img src="../img/spacer.gif" alt="" border="0" height="295" width="1"></td>
      				</tr>
      				<tr>
				        <td><img src="../img/headerdepagos_r2_c1.jpg" alt="" name="headerdepagos_r2_c1" usemap="#headerdepagos_r2_c1Map" id="headerdepagos_r2_c1" border="0" height="51" width="900"></td>
				        <td><img src="../img/spacer.gif" alt="" border="0" height="51" width="1"></td>
      				</tr>
      				<tr>
				        <td><img src="../img/headerdepagos_r3_c1.jpg" name="headerdepagos_r3_c1" id="headerdepagos_r3_c1" alt="" border="0" height="54" width="900"></td>
				        <td><img src="../img/spacer.gif" alt="" border="0" height="54" width="1"></td>
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
    		<td colspan="<?php echo $columnas;?>" class="headline1 Estilo24" align="center" bgcolor="#2073C3" height="40">
    			Reportar pago de productos, mediante depósito o transferencia 
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline2 Estilo22" align="center" bgcolor="#CCCCCC">
    			Por favor para nosotros es importante que usted llene este formulario, para procesar su pedido correctamente
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline2" align="center" bgcolor="#CCCCCC">
    			Datos del pago para procesar su pedido
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>">&nbsp;</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline1 Estilo24" bgcolor="#2073C3" height="40">
    			Datos del Cliente
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Tus nombres y apellidos:
    		</td>
    		<td colspan="<?php echo $columnas - 1?>">
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="nombre" value="<?php echo $envioDTO->getNombreCompleto();?>"/>
    			<span class="isMandatory" id="spanNombre" style="display: none;">
    				<br/>
    				Disculpe el nombre completo es obligatorio.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17" width="307">
    			* Tu seud&oacute;nimo en MercadoLibre:
    		</td>
    		<td width="266" colspan="<?php echo $columnas - 1?>">
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="seudonimo" onkeypress="return textNoSpaces(event)" value="<?php echo $envioDTO->getSeudonimoML();?>"/>
    			<span class="isMandatory" id="spanSeudonimo" style="display: none;">
    				<br/>
    				Disculpe el seud&oacute;nimo de MercadoLibre es obligatorio.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* C&eacute;dula de identidad o RIF:
    			<br />
    			<span class="subtitle Estilo20">
    				Indispensable para poder procesar el pedido.
    			</span>
    		</td>
   	 		<td width="270px" colspan="<?php echo $columnas - 1;?>">
   	 			<?php $ciCliente = explode("-", $envioDTO->getCiRIF());?>
   	 			<select style="FONT-SIZE: 10pt" size="1" name="ci" onchange="setMaxLengthCI()">
			        <option value="V" <?php echo ($ciCliente[0] == "V" ? "selected" : "");?>>V</option>
			        <option value="E" <?php echo ($ciCliente[0] == "E" ? "selected" : "");?>>E</option>
			        <option value="J" <?php echo ($ciCliente[0] == "J" ? "selected" : "");?>>J</option>
			        <option value="G" <?php echo ($ciCliente[0] == "G" ? "selected" : "");?>>G</option>
      			</select>
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)"  maxlength="9" size="23" name="cii" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $ciCliente[1];?>"/>
    			<span class="isMandatory" id="spanCii" style="display: none;">
    				<br/>
    				Disculpe su C&eacute;dula es obligatoria.
    			</span>
    			<span class="isMandatory" id="spanCiiBadValue" style="display: none;">
    				<br/>
    				Disculpe su cedula o RIF tiene una longitud no adecuada.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			*  Correo electrónico:
    			<br />
    			<span class="Estilo20">El mismo de MercadoLibre</span>
    		</td>
    		<td>
    			<input style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="email" value="<?php echo $envioDTO->getCorreo();?>"/>
      			<br />
      			<span class="isMandatory" id="spanEmail" style="display: none;">
	    			<br/>
	    			Disculpe su Correo es obligatorio.
    			</span>
    			<span class="isMandatory" id="spanEmailFormat" style="display: none;">
	    			<br/>
	    			Disculpe el Correo no tiene un formato valido.
    			</span>
    		</td>
    		<td>
    			<p>
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
    			Celular:
    			<br />
    			<span class="Estilo18">
    				Nota: Debe indicar al menos un n&uacute;mero telef&oacute;nico, sea celular o fijo
    			</span>
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $celPhone = explode("-", $envioDTO->getTlfCliente());?>
    			<select id="codCelCliente" size="1" name="codCelCliente">
			        <option value="412" <?php echo ($celPhone[0] == "412" ? "selected" : "");?>>412</option>
			        <option value="414" <?php echo ($celPhone[0] == "414" ? "selected" : "");?>>414</option>
			        <option value="416" <?php echo ($celPhone[0] == "416" ? "selected" : "");?>>416</option>
			        <option value="424" <?php echo ($celPhone[0] == "424" ? "selected" : "");?>>424</option>
			        <option value="426" <?php echo ($celPhone[0] == "426" ? "selected" : "");?>>426</option>
      			</select>
      			<input style="BACKGROUND-COLOR: rgb(255,255,255)" maxlength="7" size="20" name="tlfCelularCliente" id="tlfCelularCliente" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $celPhone[1];?>"/>
      			<span class="isMandatory" id="spanCelularCliente" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar al menos un n&uacute;mero telef&oacute;nico, sea celular o fijo.
    			</span>
    			<span class="isMandatory" id="spanCelularClienteLength" style="display: none;">
	    			<br/>
	    			Disculpe la longitud de su n&uacute;mero celular debe ser de 7 digitos.
    			</span>
      		</td>
    	</tr>
  		<tr>
    		<td class="title Estilo17">
    			Tel&eacute;fono:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $localPhone = explode("-", $envioDTO->getTlfLocalCliente());?>
    			<select size="1" name="codLocalCliente">
			        <option value="212" <?php echo ($localPhone[0] == "212" ? "selected" : "");?>>212</option>
			        <option value="234" <?php echo ($localPhone[0] == "234" ? "selected" : "");?>>234</option>
			        <option value="235" <?php echo ($localPhone[0] == "235" ? "selected" : "");?>>235</option>
			        <option value="237" <?php echo ($localPhone[0] == "237" ? "selected" : "");?>>237</option>
			        <option value="238" <?php echo ($localPhone[0] == "238" ? "selected" : "");?>>238</option>
			        <option value="239" <?php echo ($localPhone[0] == "239" ? "selected" : "");?>>239</option>
			        <option value="240" <?php echo ($localPhone[0] == "240" ? "selected" : "");?>>240</option>
			        <option value="241" <?php echo ($localPhone[0] == "241" ? "selected" : "");?>>241</option>
			        <option value="242" <?php echo ($localPhone[0] == "242" ? "selected" : "");?>>242</option>
			        <option value="243" <?php echo ($localPhone[0] == "243" ? "selected" : "");?>>243</option>
			        <option value="244" <?php echo ($localPhone[0] == "244" ? "selected" : "");?>>244</option>
			        <option value="245" <?php echo ($localPhone[0] == "245" ? "selected" : "");?>>245</option>
			        <option value="246" <?php echo ($localPhone[0] == "246" ? "selected" : "");?>>246</option>
			        <option value="247" <?php echo ($localPhone[0] == "247" ? "selected" : "");?>>247</option>
			        <option value="248" <?php echo ($localPhone[0] == "248" ? "selected" : "");?>>248</option>
			        <option value="249" <?php echo ($localPhone[0] == "249" ? "selected" : "");?>>249</option>
			        <option value="251" <?php echo ($localPhone[0] == "251" ? "selected" : "");?>>251</option>
			        <option value="252" <?php echo ($localPhone[0] == "252" ? "selected" : "");?>>252</option>
			        <option value="253" <?php echo ($localPhone[0] == "253" ? "selected" : "");?>>253</option>
			        <option value="254" <?php echo ($localPhone[0] == "254" ? "selected" : "");?>>254</option>
			        <option value="255" <?php echo ($localPhone[0] == "255" ? "selected" : "");?>>255</option>
			        <option value="256" <?php echo ($localPhone[0] == "256" ? "selected" : "");?>>256</option>
			        <option value="257" <?php echo ($localPhone[0] == "257" ? "selected" : "");?>>257</option>
			        <option value="258" <?php echo ($localPhone[0] == "258" ? "selected" : "");?>>258</option>
			        <option value="259" <?php echo ($localPhone[0] == "259" ? "selected" : "");?>>259</option>
			        <option value="261" <?php echo ($localPhone[0] == "261" ? "selected" : "");?>>261</option>
			        <option value="262" <?php echo ($localPhone[0] == "262" ? "selected" : "");?>>262</option>
			        <option value="263" <?php echo ($localPhone[0] == "263" ? "selected" : "");?>>263</option>
			        <option value="264" <?php echo ($localPhone[0] == "264" ? "selected" : "");?>>264</option>
			        <option value="265" <?php echo ($localPhone[0] == "265" ? "selected" : "");?>>265</option>
			        <option value="266" <?php echo ($localPhone[0] == "266" ? "selected" : "");?>>266</option>
			        <option value="267" <?php echo ($localPhone[0] == "267" ? "selected" : "");?>>267</option>
			        <option value="268" <?php echo ($localPhone[0] == "268" ? "selected" : "");?>>268</option>
			        <option value="269" <?php echo ($localPhone[0] == "269" ? "selected" : "");?>>269</option>
			        <option value="271" <?php echo ($localPhone[0] == "271" ? "selected" : "");?>>271</option>
			        <option value="272" <?php echo ($localPhone[0] == "272" ? "selected" : "");?>>272</option>
			        <option value="273" <?php echo ($localPhone[0] == "273" ? "selected" : "");?>>273</option>
			        <option value="274" <?php echo ($localPhone[0] == "274" ? "selected" : "");?>>274</option>
			        <option value="275" <?php echo ($localPhone[0] == "275" ? "selected" : "");?>>275</option>
			        <option value="276" <?php echo ($localPhone[0] == "276" ? "selected" : "");?>>276</option>
			        <option value="277" <?php echo ($localPhone[0] == "277" ? "selected" : "");?>>277</option>
			        <option value="278" <?php echo ($localPhone[0] == "278" ? "selected" : "");?>>278</option>
			        <option value="279" <?php echo ($localPhone[0] == "279" ? "selected" : "");?>>279</option>
			        <option value="281" <?php echo ($localPhone[0] == "281" ? "selected" : "");?>>281</option>
			        <option value="282" <?php echo ($localPhone[0] == "282" ? "selected" : "");?>>282</option>
			        <option value="283" <?php echo ($localPhone[0] == "283" ? "selected" : "");?>>283</option>
			        <option value="284" <?php echo ($localPhone[0] == "284" ? "selected" : "");?>>284</option>
			        <option value="285" <?php echo ($localPhone[0] == "285" ? "selected" : "");?>>285</option>
			        <option value="286" <?php echo ($localPhone[0] == "286" ? "selected" : "");?>>286</option>
			        <option value="287" <?php echo ($localPhone[0] == "287" ? "selected" : "");?>>287</option>
			        <option value="288" <?php echo ($localPhone[0] == "288" ? "selected" : "");?>>288</option>
			        <option value="289" <?php echo ($localPhone[0] == "289" ? "selected" : "");?>>289</option>
			        <option value="291" <?php echo ($localPhone[0] == "291" ? "selected" : "");?>>291</option>
			        <option value="292" <?php echo ($localPhone[0] == "292" ? "selected" : "");?>>292</option>
			        <option value="293" <?php echo ($localPhone[0] == "293" ? "selected" : "");?>>293</option>
			        <option value="294" <?php echo ($localPhone[0] == "294" ? "selected" : "");?>>294</option>
			        <option value="295" <?php echo ($localPhone[0] == "295" ? "selected" : "");?>>295</option>
			        <option value="296" <?php echo ($localPhone[0] == "296" ? "selected" : "");?>>296</option>
      			</select>
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" maxlength="7" size="20" name="tlfLocalCliente" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $localPhone[1];?>"/>
    			<span class="isMandatory" id="spanLocalClienteLength" style="display: none;">
	    			<br/>
	    			Disculpe la longitud de su n&uacute;mero de tlf local debe ser de 7 digitos.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline1 Estilo24" bgcolor="#2073C3" height="40">
    			Datos del Pago
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Medio de Pago:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<select name="medio" size="1" class="Estilo11" style="FONT-SIZE: 10pt" id="medio" onchange="checkTipoPago(this.options[this.selectedIndex].value)">
    				<option value="-1">Seleccione su medio de pago</option>
			        <?php 
    					$query = "SELECT id, text "
    					."FROM medios_de_pago "
    					."WHERE active='1' "
    					."ORDER BY text";
    					
    					$results = DBUtil::executeSelect($query);
    					foreach ($results as $row){
    				?>
    					<option value="<?php echo $row["id"];?>" <?php echo ($envioDTO->getIdMedioPago() == $row["id"] ? "selected" : "");?>><?php echo $row["text"];?></option>
    				<?php
    					}
    				?>
      			</select>
      			<span class="isMandatory" id="spanMedio" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar su medio de pago.
    			</span>
      		</td>
  		</tr>
  		<tr id="bancoAllInfo" <?php echo ($envioDTO->getIdMedioPago() == 5 ? "style=\"display: none;\"": "");?>>
    		<td class="title Estilo17">Banco:</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<select name="banco" size="1" class="Estilo11" style="FONT-SIZE: 10pt" id="banco">
					<option value="-1" selected>Seleccione su banco</option>
			        <?php 
    					$query = "SELECT id, nombre "
    					."FROM bancos "
    					."WHERE active='1' "
    					."ORDER BY nombre";
    					
    					$results = DBUtil::executeSelect($query);
    					foreach ($results as $row){
    				?>
    					<option value="<?php echo $row["id"];?>" <?php echo ($envioDTO->getIdBanco() == $row["id"] ? "selected" : "");?>><?php echo $row["nombre"];?></option>
    				<?php
    					}
    				?>
        		</select>
        		<span class="isMandatory" id="spanBanco" style="display: none;">
	    			<br/>
	    			Disculpe debe indicarnos el banco desde el que realiz&oacute; el pago.
    			</span>
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
    		<td colspan="<?php echo $columnas -1;?>">
      			<input id="bauche" style="FONT-SIZE: 10pt; BACKGROUND-COLOR: rgb(255,255,255)" maxlength="30" size="30" name="bauche" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $envioDTO->getNumVoucher();?>"/>
      			<span class="isMandatory" id="spanBauche" style="display: none;">
	    			<br/>
	    			Disculpe el n&uacute;mero del bauche o transferencia es obligatorio.
    			</span>
    			<span class="isMandatory" id="spanBaucheBadValue" style="display: none;">
	    			<br/>
	    			Disculpe la longitud del numero de vauche es incorrecta.
    			</span> 
      		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Fecha del dep&oacute;sito o transferencia:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $fechaPago = explode("-", $envioDTO->getFechaPago())?>
    			<input type="text" id="fechaPago" name="fechaPago" size="25" readonly value="<?php echo $fechaPago[0]."/".$fechaPago[1]."/".$fechaPago[2];?>"/>
				<input type="hidden" id="fechaPagoHidden" name="fechaPagoHidden" value="<?php echo $fechaPago[2]."-".$fechaPago[1]."-".$fechaPago[0];?>"/>
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaPago",
				        targetHidden:"fechaPagoHidden",
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%d/%m/%Y",
				        dateFormatHidden:"%Y-%m-%d",
				        imgPath:"../img/"
				    });
				</script>
				<span class="isMandatory" id="spanFechaPago" style="display: none;">
	    			<br/>
	    			Disculpe debe indicarnos la fecha de su pago.
    			</span>
      		</td>
      	</tr>
      	<tr>
	      	<td class="title Estilo17">
	      		* Monto del dep&oacute;sito o transferencia:
	      	</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<input style="FONT-SIZE: 10pt; TEXT-DECORATION: none" size="30" name="monto" onkeypress="return textInputCurrency(event)" value="<?php echo $envioDTO->getMontoPago();?>"/> 
      			<span class="Estilo23">Bs F</span>
      			<span class="isMandatory" id="spanMonto" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar el monto del pago.
    			</span>
    			<span class="isMandatory" id="spanMontoBadValue" style="display: none;">
	    			<br/>
	    			Disculpe el formato requerido para el monto es un numero entero y opcionalmente 2 decimales.
	    			<br /> Por ejemplo: 2953,99
    			</span>
      		</td>
  		</tr>
  		<tr>
	      	<td class="title Estilo17">
	      		Foto o archivo del pago:
	      	</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<input type="file" name="archivoTransferencia" id="archivoTransferencia">
    			<span class="isMandatory" id="spanArchivoPago" style="display: none;">
	    			<br/>
	    			Disculpe, para transferencias desde otros bancos, se requiere el comprobante de manera digitalizada.
    			</span>
      		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline1 Estilo24" bgcolor="#2073C3" height="40">
    			Productos Comprados
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17" colspan="<?php echo $columnas;?>">
    			<div align="center" id="seccion5Info">
			    	<table id="tablaProductosComprados">
				   		<thead>
				   		<tr class="Estilo17">
				  			<th width="200px">Cantidad</th>
	                        <th width="200px">Producto</th>
	                        <th width="200px">Observaciones</th>
							<th width="200px"></th>
	                    </tr>
	                    </thead>
	                    <tr class="Estilo17">
	                    	<td width="200px" align="center">
	                    		<select id="cantidadTMP" name="cantidadTMP">
	                    		<?php
	                    			for($i = 1; $i < 100; $i++){
								?>
									<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php
									}
	                    		?>
	                    		</select>
	                    	</td>
	                    	<td width="200px">
	                    		<input type="text" id="productoTMP" name="productoTMP" value=""/>
	                    	</td>
	                    	<td width="200px">
	                    		<input type="text" id="observacionesTMP" name="observacionesTMP" value=""/>
	                    	</td>
	                    	<td width="200px">
	                    		<input type="button" name="addProduct" value="Agregar Producto" onclick="javascript:addFilaProductosComprados();"/>
	                    		<input type="button" name="cleanProducts" value="Deshacer" onclick="javascript:limpiarProductosComprados();"/>
	                    	</td>
	                    </tr>
	                    <tr>
	                    	<td colspan="<?php echo $columnas;?>">
	                    		<span class="isMandatory" id="spanArticulo" style="display: none;">
	                    			Disculpe, debe indicar el detalle de los productos que desea.
	                    		</span>
	                    	</td>
	                    </tr>
	                </table>
	                <br/>
	                <table id="detalleProductosComprados" class="Estilo17">
	                	<?php if($envioDTO->getDetalleCompra() == "") {?>
	                	<thead>
				   		<tr class="Estilo17">
				  			<th width="200px">Cantidad</th>
	                        <th width="200px">Producto</th>
	                        <th width="200px">Observaciones</th>
	                    </tr>
	                    </thead>
	                    <?php } else {
	                    	echo $envioDTO->getDetalleCompra();
	                    }
	                    ?>
	                </table>
				</div>
				
				<input type="hidden" name="articulo" id="articulo" value='<?php echo $envioDTO->getDetalleCompra();?>'/>
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="headline1 Estilo24" bgcolor="#2073C3" height="40">
    			Datos para el Env&iacute;o
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" class="title Estilo17 Estilo18">
    			<div align="center">
    				<span class="Estilo20">Nota Importante:</span> 
    				No nos hacemos responsables por los da&ntilde;os y/o p&eacute;rdidas que puedan sufrir los productos durante su traslado
    			</div>
    		</td>
    	</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Compa&ntilde;&iacute;a de env&iacute;o:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
      			<select name="envio" id="envio" class="Estilo11" id="envio" style="FONT-SIZE: 10pt" onchange="checkCiaEnvio();">
					<?php 
    					$query = "SELECT id, nombre "
    					."FROM empresa_envio "
    					."WHERE active='1' "
    					."ORDER BY nombre";
    					
    					$results = DBUtil::executeSelect($query);
    					foreach ($results as $row){
    				?>
    					<option value="<?php echo $row["id"];?>" <?php echo ($envioDTO->getIdEmpresaEnvio() == $row["id"] ? "selected" : "");?>><?php echo $row["nombre"];?></option>
    				<?php
    					}
    				?>
				</select>
				<span class="isMandatory" id="spanEnvio" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar con que compa&ntilde;ia desea realizar el env&iacute;o.
    			</span>
			</td>
		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Nombre y Apellido del destinatario:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="destinatario" value="<?php echo $envioDTO->getNombreDestinatario();?>" />
    			<span class="isMandatory" id="spanDestinatario" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar el nombre completo del destinatario.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* C.I. del destinatario:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $ciDest = explode("-", $envioDTO->getCedulaDestinatario());?>
   	 			<select style="FONT-SIZE: 10pt" size="1" name="ci" onchange="setMaxLengthCI()">
			        <option value="V" <?php echo ($ciDest[0] == "V" ? "selected" : "");?>>V</option>
			        <option value="E" <?php echo ($ciDest[0] == "E" ? "selected" : "");?>>E</option>
			        <option value="J" <?php echo ($ciDest[0] == "J" ? "selected" : "");?>>J</option>
			        <option value="G" <?php echo ($ciDest[0] == "G" ? "selected" : "");?>>G</option>
      			</select>
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="ciDestinatario" onkeypress="return textInputOnlyNumbers(event)" maxlength="9" value="<?php echo $ciDest[1];?>"/>
    			<span class="isMandatory" id="spanCIDestinatario" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar la cedula del destinatario.
    			</span>
    			<span class="isMandatory" id="spanCIDestinatarioBadValue" style="display: none;">
	    			<br/>
	    			Disculpe la longitud de la cedula debe ser de minimo 6 digitos y maximo 8 digitos.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Direcci&oacute;n <strong>exacta </strong> de destino
    			<br />
    			<span class="Estilo18">
    				Incluya nombre de Urb. o Barrio; Calle, Carrera o Av.; 
    				Nombre o numero de Casa o Edificio; Piso y n&uacute;mero de Apto u Oficina
    			</span>
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<textarea name="dir1" id="dir1" cols="45" rows="5"><?php echo $envioDTO->getDireccionDestino();?></textarea>
      			<span class="isMandatory" id="spanDir1" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar la direcci&oacute;n exacta del destino.
    			</span>
      		</td>
      	</tr>
  		<tr>
    		<td class="title Estilo17">
    			* Ciudad o Poblaci&oacute;n:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" size="30" name="ciudad" onkeypress="return textInputOnlyLetters(event)" value="<?php echo $envioDTO->getCiudadDestino();?>" />
    			<span class="isMandatory" id="spanCiudad" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar la Ciudad o Poblaci&oacute;n del env&iacute;o.
    			</span>
    		</td>
   		</tr>
   		<tr>
   			<td class="title Estilo17">
   				* Estado:
   			</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<select name="estado" size="1">
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Amazonas" ? "selected" : "");?>>Amazonas</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Anzoategui" ? "selected" : "");?>>Anzoategui</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Apure" ? "selected" : "");?>>Apure</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Aragua" ? "selected" : "");?>>Aragua</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Barinas" ? "selected" : "");?>>Barinas</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Bolivar" ? "selected" : "");?>>Bolivar</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Carabobo" ? "selected" : "");?>>Carabobo</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Cojedes" ? "selected" : "");?>>Cojedes</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Delta Amacuro" ? "selected" : "");?>>Delta Amacuro</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Distrito Capital" ? "selected" : "");?>>Distrito Capital</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Falcon" ? "selected" : "");?>>Falcon</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Guarico" ? "selected" : "");?>>Guarico</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Lara" ? "selected" : "");?>>Lara</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Merida" ? "selected" : "");?>>Merida</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Miranda" ? "selected" : "");?>>Miranda</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Monagas" ? "selected" : "");?>>Monagas</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Nueva Esparta" ? "selected" : "");?>>Nueva Esparta</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Portuguesa" ? "selected" : "");?>>Portuguesa</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Sucre" ? "selected" : "");?>>Sucre</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Tachira" ? "selected" : "");?>>Tachira</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Trujillo" ? "selected" : "");?>>Trujillo</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Vargas" ? "selected" : "");?>>Vargas</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Yaracuy" ? "selected" : "");?>>Yaracuy</option>
			        <option <?php echo ($envioDTO->getEstadoDestino() == "Zulia" ? "selected" : "");?>>Zulia</option>
      			</select>
      			<span class="isMandatory" id="spanEstado" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar la estado al cual ser&aacute; realizado del env&iacute;o.
    			</span>
      		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			Celular:
    			<br />
    			<span class="Estilo18">
    				Nota: Debe indicar al menos un n&uacute;mero telef&oacute;nico, sea celular o fijo
    			</span>
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $celPhone = explode("-", $envioDTO->getTlfCelularDestinatario());?>
    			<select id="codcel" size="1" name="codcel">
			        <option value="412" <?php echo ($celPhone[0] == "412" ? "selected" : "");?>>412</option>
			        <option value="414" <?php echo ($celPhone[0] == "414" ? "selected" : "");?>>414</option>
			        <option value="416" <?php echo ($celPhone[0] == "416" ? "selected" : "");?>>416</option>
			        <option value="424" <?php echo ($celPhone[0] == "424" ? "selected" : "");?>>424</option>
			        <option value="426" <?php echo ($celPhone[0] == "426" ? "selected" : "");?>>426</option>
      			</select>
      			<input style="BACKGROUND-COLOR: rgb(255,255,255)" maxlength="7" size="20" name="celular" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $celPhone[1];?>"/>
      			<span class="isMandatory" id="spanCelularDestinatario" style="display: none;">
	    			<br/>
	    			Disculpe debe indicar al menos un n&uacute;mero telef&oacute;nico, sea celular o fijo.
    			</span>
    			<span class="isMandatory" id="spanCelularDestinatarioLength" style="display: none;">
	    			<br/>
	    			Disculpe la longitud de su n&uacute;mero celular debe ser de 7 digitos.
    			</span>
      		</td>
    	</tr>
    	<tr>
    		<td class="title Estilo17">
    			Tel&eacute;fono:
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<?php $localPhone = explode("-", $envioDTO->getTlfLocalDestinatario());?>
    			<select size="1" name="codLocalDestinatario">
			        <option value="212" <?php echo ($localPhone[0] == "212" ? "selected" : "");?>>212</option>
			        <option value="234" <?php echo ($localPhone[0] == "234" ? "selected" : "");?>>234</option>
			        <option value="235" <?php echo ($localPhone[0] == "235" ? "selected" : "");?>>235</option>
			        <option value="237" <?php echo ($localPhone[0] == "237" ? "selected" : "");?>>237</option>
			        <option value="238" <?php echo ($localPhone[0] == "238" ? "selected" : "");?>>238</option>
			        <option value="239" <?php echo ($localPhone[0] == "239" ? "selected" : "");?>>239</option>
			        <option value="240" <?php echo ($localPhone[0] == "240" ? "selected" : "");?>>240</option>
			        <option value="241" <?php echo ($localPhone[0] == "241" ? "selected" : "");?>>241</option>
			        <option value="242" <?php echo ($localPhone[0] == "242" ? "selected" : "");?>>242</option>
			        <option value="243" <?php echo ($localPhone[0] == "243" ? "selected" : "");?>>243</option>
			        <option value="244" <?php echo ($localPhone[0] == "244" ? "selected" : "");?>>244</option>
			        <option value="245" <?php echo ($localPhone[0] == "245" ? "selected" : "");?>>245</option>
			        <option value="246" <?php echo ($localPhone[0] == "246" ? "selected" : "");?>>246</option>
			        <option value="247" <?php echo ($localPhone[0] == "247" ? "selected" : "");?>>247</option>
			        <option value="248" <?php echo ($localPhone[0] == "248" ? "selected" : "");?>>248</option>
			        <option value="249" <?php echo ($localPhone[0] == "249" ? "selected" : "");?>>249</option>
			        <option value="251" <?php echo ($localPhone[0] == "251" ? "selected" : "");?>>251</option>
			        <option value="252" <?php echo ($localPhone[0] == "252" ? "selected" : "");?>>252</option>
			        <option value="253" <?php echo ($localPhone[0] == "253" ? "selected" : "");?>>253</option>
			        <option value="254" <?php echo ($localPhone[0] == "254" ? "selected" : "");?>>254</option>
			        <option value="255" <?php echo ($localPhone[0] == "255" ? "selected" : "");?>>255</option>
			        <option value="256" <?php echo ($localPhone[0] == "256" ? "selected" : "");?>>256</option>
			        <option value="257" <?php echo ($localPhone[0] == "257" ? "selected" : "");?>>257</option>
			        <option value="258" <?php echo ($localPhone[0] == "258" ? "selected" : "");?>>258</option>
			        <option value="259" <?php echo ($localPhone[0] == "259" ? "selected" : "");?>>259</option>
			        <option value="261" <?php echo ($localPhone[0] == "261" ? "selected" : "");?>>261</option>
			        <option value="262" <?php echo ($localPhone[0] == "262" ? "selected" : "");?>>262</option>
			        <option value="263" <?php echo ($localPhone[0] == "263" ? "selected" : "");?>>263</option>
			        <option value="264" <?php echo ($localPhone[0] == "264" ? "selected" : "");?>>264</option>
			        <option value="265" <?php echo ($localPhone[0] == "265" ? "selected" : "");?>>265</option>
			        <option value="266" <?php echo ($localPhone[0] == "266" ? "selected" : "");?>>266</option>
			        <option value="267" <?php echo ($localPhone[0] == "267" ? "selected" : "");?>>267</option>
			        <option value="268" <?php echo ($localPhone[0] == "268" ? "selected" : "");?>>268</option>
			        <option value="269" <?php echo ($localPhone[0] == "269" ? "selected" : "");?>>269</option>
			        <option value="271" <?php echo ($localPhone[0] == "271" ? "selected" : "");?>>271</option>
			        <option value="272" <?php echo ($localPhone[0] == "272" ? "selected" : "");?>>272</option>
			        <option value="273" <?php echo ($localPhone[0] == "273" ? "selected" : "");?>>273</option>
			        <option value="274" <?php echo ($localPhone[0] == "274" ? "selected" : "");?>>274</option>
			        <option value="275" <?php echo ($localPhone[0] == "275" ? "selected" : "");?>>275</option>
			        <option value="276" <?php echo ($localPhone[0] == "276" ? "selected" : "");?>>276</option>
			        <option value="277" <?php echo ($localPhone[0] == "277" ? "selected" : "");?>>277</option>
			        <option value="278" <?php echo ($localPhone[0] == "278" ? "selected" : "");?>>278</option>
			        <option value="279" <?php echo ($localPhone[0] == "279" ? "selected" : "");?>>279</option>
			        <option value="281" <?php echo ($localPhone[0] == "281" ? "selected" : "");?>>281</option>
			        <option value="282" <?php echo ($localPhone[0] == "282" ? "selected" : "");?>>282</option>
			        <option value="283" <?php echo ($localPhone[0] == "283" ? "selected" : "");?>>283</option>
			        <option value="284" <?php echo ($localPhone[0] == "284" ? "selected" : "");?>>284</option>
			        <option value="285" <?php echo ($localPhone[0] == "285" ? "selected" : "");?>>285</option>
			        <option value="286" <?php echo ($localPhone[0] == "286" ? "selected" : "");?>>286</option>
			        <option value="287" <?php echo ($localPhone[0] == "287" ? "selected" : "");?>>287</option>
			        <option value="288" <?php echo ($localPhone[0] == "288" ? "selected" : "");?>>288</option>
			        <option value="289" <?php echo ($localPhone[0] == "289" ? "selected" : "");?>>289</option>
			        <option value="291" <?php echo ($localPhone[0] == "291" ? "selected" : "");?>>291</option>
			        <option value="292" <?php echo ($localPhone[0] == "292" ? "selected" : "");?>>292</option>
			        <option value="293" <?php echo ($localPhone[0] == "293" ? "selected" : "");?>>293</option>
			        <option value="294" <?php echo ($localPhone[0] == "294" ? "selected" : "");?>>294</option>
			        <option value="295" <?php echo ($localPhone[0] == "295" ? "selected" : "");?>>295</option>
			        <option value="296" <?php echo ($localPhone[0] == "296" ? "selected" : "");?>>296</option>
      			</select>
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" maxlength="7" size="20" name="tlfLocalDestinatario" onkeypress="return textInputOnlyNumbers(event)" value="<?php echo $localPhone[1];?>"/>
    			<span class="isMandatory" id="spanLocalDestinatarioLength" style="display: none;">
	    			<br/>
	    			Disculpe la longitud de su n&uacute;mero de tlf local debe ser de 7 digitos.
    			</span>
    		</td>
  		</tr>
  		<tr>
    		<td class="title Estilo17">
    			Observaciones:
    			<BR />
    			<span class="Estilo18">
    				Nombre de juego, colores, cantidades, etc.
    			</span>
    		</td>
    		<td colspan="<?php echo $columnas -1;?>">
    			<input style="BACKGROUND-COLOR: rgb(255,255,255)" size="45" name="obs" value="<?php echo $envioDTO->getObservacionesEnvio();?>"/>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="<?php echo $columnas;?>" class="subtitle" align="center">
    			Por favor no olvides llenar todos los campos obligatorios marcados con *
    		</td>
  		</tr>
  		<tr>
    		<td colspan="<?php echo $columnas;?>" align="center">
    			<input name="Enviar" id="Enviar" onclick="javascript:validarFormularioNotifNoEnc(this.form);" style="FONT-WEIGHT: bold; FONT-SIZE: 10pt;" value="Enviar datos del pago" type="button" >
    			<span id="ajaxLoading" style="display: none; float: right;">
                  	<img src="../sis/images/ajax.gif" alt="Cargando..." />
                </span>
    		</td>
  		</tr>
	</table>
</form>

<div id="popup2" style="left: 390px; position: absolute; top: 1283px; z-index: 9999; display: none; height: auto; width: auto;">
    <span class="popUpBoton b-close">
		<span>X</span>
	</span>
    <div id="bPopUpContent" class="content" style="height: auto; width: auto;"></div>
</div>
</body>
</html>