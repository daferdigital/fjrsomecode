<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("classes/SessionUtil.php");
include_once("includes/header.php");

if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: index.php");
} else if(SessionUtil::userReachInactivity()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_SESSION_EXPIRED;
	header("Location: index.php");
}

$seccionTitle = "Listado de SMS's";
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
BitacoraDAO::registrarComentario("Acceso a modulo de busqueda de ".$seccionTitle.": ".$userDTO->getNombreCompleto());
?>
<tr>
	<td colspan="2">
		
		<div class="seccionTitle">
			<?php echo $seccionTitle;?>
		</div>
		
		<div class="seccionDetail">
			<table>
		    	<tr>
		    		<td>
		    			Texto del mensaje
		    		</td>
		    		<td>
		    		    <input type="text" size="25" id="texto" name="texto" value=""/>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			N&uacute;mero del Remitente
		    		</td>
		    		<td>
		    			<input type="text" size="25" id="remitente" name="remitente" value=""/>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td class="title Estilo17">
		    			Desde:
		    		</td>
		    		<td>
		    			<input type="text" id="fechaDesde" name="fechaDesde" size="25" readonly="true"/>
					
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaDesde",        
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
		    		<td class="title Estilo17">
		    			Hasta:
		    		</td>
		    		<td>
		    			<input type="text" id="fechaHasta" name="fechaHasta" size="25" readonly="true"/>
					
						<script>
							new JsDatePick({
						        useMode:2,
						        target:"fechaHasta",        
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
		    		<td colspan="2" align="right">
		    			<input type="button" value="Buscar" onclick="javascript:searchSMSAjax(1);"/>
		    		</td>
		    	</tr>
		    </table>
		</div>
		
		<div style="width: 100%; margin-left: auto; margin-right: auto" id="ajaxPageResult">
			&nbsp;
		</div>
	</td>
</tr>
<?php include_once 'includes/footer.html';?>