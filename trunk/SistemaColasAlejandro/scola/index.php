<?Php include("procesos/sesiones.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>.: SATRIM :.</title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.6.4.min.js" type="text/javascript" language="javascript"></script> 
<script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/funciones.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->


<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<style type="text/css">
	*{
		color:#000 !important;
	}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<div style="width:800px; margin:0 auto; margin-bottom:15px;">
<img src="imagenes/header.jpg" width="800" border="0" />
<?Php 
	include("cerrar_sesion.php");
?>
<!-- InstanceBeginEditable name="contenido" -->
<?php 	
	if(!$_SESSION["login_user"]){
	if($_SESSION['veces']<5){
//echo "hola"; exit;
?>
<table align="center" width="98%" bgcolor="#ebebeb" style="background:#ebebeb;" cellpadding="5">
  
  <tr>
    <td height="91" style=" padding-right:100px"><form action="validar.php" method="POST">	      
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
	          <td align=center colspan="2"><input type="submit" name="enviar" width="60px" value="Enviar" /></td>
            </tr>
            <?php if($_SESSION['veces']){?>
            	<tr>
	          <td colspan="2" class="advertencia">
	            <h5 align="center">Error En Usuario o Clave Te queda <?php echo 4-$_SESSION['veces'];?> intento</h5></td>
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
	if($_SESSION['perfil']==3):
	?>
		<script language="javascript">
			location.href='terminal.php';
		</script>
	<?php
	elseif($_SESSION['perfil']==2):
	?>
		<script language="javascript">
			location.href='operador.php';
		</script>
	<?php
	else:
		?><div style="background-color:#FFF; border:#cccccc 2px solid; height:300px;">
			<?php include('menu.php');?>
           </div> 
		<?Php
	endif;
}?>
<!-- InstanceEndEditable --> </div>

</body>
<!-- InstanceEnd --></html>