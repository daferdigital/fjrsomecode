<?php
include_once "includes/header.html";
?>
<tr id="tab1">
    	<td width="588" bgcolor="#B4D0F7">
    		<a href="pedido.htm"><img border="0" src="img/pedido.jpg" align="left" /></a>
    	</td >
    	<td width="412"  background="img/correo.jpg" bgcolor="#B4D0F7">
    		<form name="sendEmail" method="post" action="registrate.php">
                <table align="right" id="table1">
        			<tr>
                    	<td align="right" width="20%"> Correo:</td>
                    	<td align="left">
                    		<input type="text" name="email" size="30" placeholder="Escribe tu email" />
                    	</td>
                  	</tr>
                    <tr>
                    	<td align="center" colspan="2">
                    		<div align="center">
                            	<input type="submit" class="button_submit" value=""/>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
    	</td>
  	</tr>
  	<tr>
    	<td height="41" colspan="2">
    		<hr  color="#B4D0F7" size="5"/>
        	<iframe src="wow/jquery.html" width="1000" height="197" frameborder="0"></iframe>
    	</td>
  	</tr>
<tr>
    <td height="49" align="center" bgcolor="#123984" style="color:#FFF" id="vertical-bar">Sectores</td>
    <td height="49" align="center" bgcolor="#123984"style="color:#FFF" id="vertical-bar">Categorías</td>
  </tr>
  <tr >
    <td height="262" id="vertical-bar">
    		<ol >
				<li>Castillejo</li>
				<li>Las Rosas</li>
				<li>La Trinidad</li>
				<li>Parque Alto</li>
				<li>Colinas de Guatire</li>
  				<li>Villa Her&oacute;ica</li>
				<li>Villa del Este</li>
				<li>El Marqu&eacute;s</li>
				<li>Buenaventura Country Club</li>
                <li>Valler Arriba</li>
                <li>San Pedro</li>
                <li>La Vaquera</li>
                <li>Villa &Aacute;vila</li>
                <li>Club de Campo</li>
			</ol>
    </td>
    <td height="262" id="vertical-bar">
    	<ol>
    		<li>Comida</li>
			<li>Ferreter&iacute;a</li>
			<li>Ropa</li>
			<li>Autorespuestos</li>
			<li>Calzados</li>
  			<li>Art&iacute;culos para el hogar</li>
			<li>Enceres para bebes</li>
			<li>Farmacia</li>
			<li>Perfumer&iacute;a</li>
            <li>Enceres</li>
            <li>Documentos</li>
            <li>Equipos Tecnol&oacute;gicos</li>
            <li>Electrodom&eacute;sticos</li>
            <li>Accesorios</li>
	  	</ol>
    </td>
  </tr>
<?php
include_once "includes/footer.html";
?>