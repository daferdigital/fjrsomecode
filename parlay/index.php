<?Php include("procesos/sesiones.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Parley:.</title>

<link rel="stylesheet" type="text/css" href="css/estilos_parley.css"/>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
<link rel="stylesheet" type="text/css" href="css/estilos_tablas_jquery.css"/>

<script src="js/jquery-1.8.min.js" type="text/javascript" language="javascript"></script>
<script src="js/jquery-idletimer.js" type="text/javascript" language="javascript"></script>        
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.numeric.js"></script>
<script type="text/javascript" src="js/jquery.tablehover.js"></script>
<!-- <script src="js/jquery.min.js"></script> -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->

<!--Para menu-->
<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">
		
		<script type="text/javascript" src="js/hoverIntent.js"></script>
		<script type="text/javascript" src="js/superfish.js"></script>
		<script type="text/javascript">

		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

		</script>
<!--Termina Para menu-->        
<script src="js/funciones.js" language="javascript"></script>
<script language="javascript">
	/*$(document).ready(function() {
					$("#contenido_parley").html(
					 $.ajax({
					  url: "logros_beisbol.php",
					  contentType:"application/x-www-form-urlencoded",
					  async: false
					 }).responseText 
					);
	});*/
	$(document).ready(function(){
	   $(".ajax_contenido").click(function(evento){
		  // alert(this.href);
		   evento.preventDefault();
		   	  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
			 // $('#contenido_padre').load("logros.php");return false;
		   $('#contenido_padre').load(this.href, function(response, status, xhr){
			   if (status == "error") {
					  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
				 }
				$("#carga_load").css("display", "none");
				$("#carga").css("display", "none");
			});
	   });	   
	})
</script>
</head>

<body>
<!-- Inicio de funcion para cerrar sesion por inactividad -->
<script type="text/javascript">
    
    (function($){
      
        var timeout = 900000;

        $(document).bind("idle.idleTimer", function(){
            location.href='index.php?salir=logout'
        });
        
        $.idleTimer(timeout);

    })(jQuery);
</script>
<!-- Fin de funcion para cerrar sesion por inactividad -->
<div id="global">
<div id="header"></div>
<div id="general">
<?php 	
	if(!$_SESSION["login_user"]){
	if($_SESSION['veces']<4){
//echo "hola"; exit;
?>
<table align="center" width="100%" bgcolor="#ebebeb" cellpadding="5">
  
  <tr>
    <td height="91"><form action="validar.php" method="post">	      
          <div class="titulo"><b>Gestor de entrada </b></div>
	      <table  align="center" width="300px" height="" style="background: url(imagenes/fondo_logueo.jpg) left top repeat-x; ">
	        <tr>
	          <td colspan="2" height="368px" valign="top">
              	<table width="100%" style=" margin-top:100px;"><tr>
	          <th><span class="Estilo3">Usuario</span></th>
	          <td><input type="text" id="a" name="usuario" size="20" autocomplete="off"></td>
            </tr>
	        <tr>
	          <th><span class="Estilo3">Clave</span></th>
	          <td><input type="password" id="b" name="clave" size="20" autocomplete="off"></td>
            </tr>
            <tr>
	          <td align=center colspan="2"><input type="image" name="enviar" width="60px" value="Enviar" src="imagenes/btn_entrar.png" /></td>
            </tr>
            <?php if($_SESSION['veces']){?>
            	<tr>
	          <td colspan="2" class="advertencia">
	            <h5 align="center">Error En Usuario o Clave Te queda <?php echo 4-$_SESSION['veces'];?> intento</h5></td>
            </tr>
            	<tr>
            	  <td colspan="2" class="advertencia">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td colspan="2" class="advertencia">&nbsp;</td>
          	  </tr>
            	<tr>
            	  <td colspan="2" class="advertencia">&nbsp;</td>
          	  </tr>
            <?php }?>
            </table>
              </td>
            </tr>
	        
	        
	        
	        
	        
	        
        </table>
	      <br>
    </form>
</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
</table>
<?php }else{?>
<div align="center" style="color: #F00"><h4>Acceso denegado, debe esperar al menos 15 minutos para volver a ingresar</h4>
</div>
<?php }}else{
		if($_SESSION['menu']!='no'):
		 include("menu.php");
	 	endif;

?>
	<?Php if($_SESSION['menu']=='no'):?>
    <div style="text-align:">
    	<h2><strong>IMPORTANTE:</strong> Se ha detectado que intenta acceder al sistema desde otro navegador u otra computadora, se agradece utilizar la computadora o navegador que ha venido utilizando hasta entonces, de no poder acceder favor contactar con el administrador!!!</h2>
    </div>
    <?Php endif;?>
	<div id="contenido_padre">	

    </div>
    
    <script language="javascript">
		$('#contenido_padre').load("como_apostar.php");
	</script>
<?Php }?>    
</div>
<div id="carga" class="carga" style="filter:alpha(opacity=70);-moz-opacity:.70;opacity:.70;"></div>
<div id="carga_load" class="carga_load">Cargando formulario...</div>
<div id="carga_load3" class="carga_load3">Procesando su solicitud...</div>
<div id="mensaje_resultado" class="mensaje_resultado">Datos procesados con &eacute;xito...</div>
<div id="carga_load2" class="carga_load2">Generando listado...</div>
<div id="footer"></div>
</div>
<?Php //print_r($_SESSION);?>
</body>
</html>