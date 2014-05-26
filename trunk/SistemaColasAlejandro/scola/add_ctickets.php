<?Php include("procesos/sesiones.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sistema de cola</title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.6.4.min.js" type="text/javascript" language="javascript"></script> 
<script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/funciones.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
	.mostrar_imprimir{
		display:none;
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
<div id="titulo">Cantidad de tickets disponibles por departamento</div>
<div id="mensaje_eventos" style="display:none;"></div>
<br />
<form name="form1" id="form1" method="post" action="procesos/guardar_ctickets.php">
<?php

if($_GET['exito']){
	?>
    	<script language="javascript">
			jQuery(document).ready(function(){
				jQuery('#mensaje_eventos').html('Proceso ejecutado con éxito');
				jQuery('#mensaje_eventos').show('slow');
				setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
			});
		</script>
    <?Php
}


$selgeneral="select *,if(estatus=1,'Activo','Inactivo') as des_estatus,(select count(idtaquilla) from vista_taquillas_operadores where iddepartamento=vista_tickets_departamentos.iddepartamento and cedula <> '') as taq_disp from vista_tickets_departamentos where fecha=CURDATE()";
	$querygeneral=mysql_query($selgeneral);
		if(mysql_num_rows($querygeneral)>0){
			ob_start();
					?> 
                    <div class="mostrar_imprimir"><strong>Fecha de impresi&oacute;n:</strong> <?Php echo date('d/m/Y');?> <strong>Hora:</strong> <?Php echo date('h:i:s A');?> <strong>Usuario:</strong> <?Php echo $_SESSION['nombre_usuario'];?></div>
                    <div class="" align="center">
                      <h4>Listado de departamentos <?php echo ($_GET['estatuse']!=''?'filtrando por estatus <b>'.$estatus_sel[$_GET['estatuse']].'</b>':''); echo ($_GET['estatuse'] && $_GET['eventose']?' Y ':''); echo ($_GET['eventose']!=''?'filtrando por eventos <b>'.$eventos_sel[$_GET['eventose']].'</b>':'');?></h4></div>
			<table width="100%" align="center" class="listado" cellpadding="5" cellspacing="0">
				<tr class="tit_filas"><td>ID</td><td>DECRIPCIÓN</td><td>TAQUILLA HABILITADAS</td><td>NUMERO TICKETS</td>
				</tr>
			<?Php
			while($vargeneral=mysql_fetch_assoc($querygeneral)){
				?>
					<tr class="tr"><td><?Php echo $vargeneral['iddepartamento'];?></td><td><?Php echo $vargeneral['descripcion_departamento'];?></td><td align="center"><?Php echo $vargeneral['taq_disp'];?></td><td align="center"><input type="text" name="ntickets[<?Php echo $vargeneral['idticket_encabezado'];?>]" value="<?Php echo $vargeneral['numero_tickets'];?>" class="required solo_numero" maxlength="4" size="4" /></td></tr>
				<?Php
			}
			?></table>
			<?Php	
						$listado=ob_get_contents();
						ob_end_clean();
						echo $listado;
						/*GENERO IMPRESION*/
							$plantilla=fopen('impresiones/plantilla.html','r');
							$lectura=fread($plantilla,filesize('impresiones/plantilla.html'));
							fclose($plantilla);
							
							$lectura=str_replace("<%CONSULTA%>",$listado,$lectura);
							
							$arch=fopen('impresiones/imprimir_'.session_id().'.html','w');
							fwrite($arch,$lectura);
							fclose($arch);
							
							ob_start();
								?>&nbsp;&nbsp;<input type="button" value="IMPRIMIR" class="boton" onclick="window.open('impresiones/imprimir_<?php echo session_id();?>.html');" /><?Php
							$imp=ob_get_contents();
							ob_end_clean();	
							
		}
?><br />
<div align="center"><input type="submit" value="GUARDAR CAMBIOS" class="boton" />&nbsp;&nbsp;<input type="button" class="boton" onclick="javascript:location.href='index.php';" value="MENU" /></div>
<script language="javascript">
	jQuery(document).ready(function(){
		jQuery('input').attr('autocomplete','off');
		jQuery("#form1").validate();
		
		jQuery('.solo_numero').numeric();
	});
</script>
</form>
<!-- InstanceEndEditable --> </div>

</body>
<!-- InstanceEnd --></html>