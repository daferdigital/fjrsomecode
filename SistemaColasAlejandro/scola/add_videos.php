<?Php include("procesos/sesiones.php");
	if($_SESSION['perfil']!=1){
		header("location: index.php");
	}
?>
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
<script type="text/javascript" src="js/swfobject.js"></script>
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
<div id="titulo">Videos</div>

<br />
<div id="mensaje_eventos" style="display:none;"></div>
<br />
<?Php

if($_GET['desactivar']){
	mysql_query("UPDATE videos SET estatus=0 WHERE idvideo='".$_GET['desactivar']."' limit 1");
	?>
    	<script language="javascript">
			jQuery(document).ready(function(){
				jQuery('#mensaje_eventos').html('Operación ejecutada con éxito');
				jQuery('#mensaje_eventos').show('slow');
				setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
			});
		</script>
    <?Php
}

if($_GET['exito']=='no'){
	?>
    	<script language="javascript">
			jQuery(document).ready(function(){
				jQuery('#mensaje_eventos').html('No se pudo cargar el video, compruebe que el mismo este en formato swf y que el nombre no contenga caracteres especiales...');
				jQuery('#mensaje_eventos').show('slow');
				setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
			});
		</script>
    <?Php
}elseif($_GET['exito']){
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
if(!$_GET['ido'] && !$_GET['new']):
	$selgeneral="select *,if(estatus=1,'Activo','Inactivo') as des_estatus from vista_videos";
	$querygeneral=mysql_query($selgeneral);
		if(mysql_num_rows($querygeneral)>0){
			ob_start();
					?> 
                    <div class="mostrar_imprimir"><strong>Fecha de impresi&oacute;n:</strong> <?Php echo date('d/m/Y');?> <strong>Hora:</strong> <?Php echo date('h:i:s A');?> <strong>Usuario:</strong> <?Php echo $_SESSION['nombre_usuario'];?></div>
                    <div class="" align="center">
                      <h4>Listado de videos <?php echo ($_GET['estatuse']!=''?'filtrando por estatus <b>'.$estatus_sel[$_GET['estatuse']].'</b>':''); echo ($_GET['estatuse'] && $_GET['eventose']?' Y ':''); echo ($_GET['eventose']!=''?'filtrando por eventos <b>'.$eventos_sel[$_GET['eventose']].'</b>':'');?></h4></div>
			<table width="100%" align="center" class="listado" cellpadding="5" cellspacing="0">
				<tr class="tit_filas"><td>ID</td><td>FECHA</td><td>HORA</td><td>NOMBRE VIDEO</td>
				<td>SUBIDO POR:</td><td>ESTATUS</td><td id="acciones_b"></td></tr>
			<?Php
			while($vargeneral=mysql_fetch_assoc($querygeneral)){
				?>
					<tr class="tr"><td><?Php echo $vargeneral['idvideo'];?></td><td><?Php echo $vargeneral['fecha'];?></td><td><?Php echo $vargeneral['hora'];?></td><td><?Php echo $vargeneral['descripcion'];?></td><td><?Php echo $vargeneral['usuario'];?></td><td><?Php echo $vargeneral['des_estatus'];?></td><td id="acciones_b"><a href="?ido=<?Php echo $vargeneral['idvideo'];?>">Edit</a> | <a href="javascript: if(confirm('Presione aceptar si desea desactivar a este tip')){location.href='?desactivar=<?Php echo $vargeneral['idvideo'];?>';}">Elim</a></td></tr>
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

<div align="center"><input type="button" class="boton" value="AGREGAR NUEVO" onclick="javascript: location.href='?new=<?Php echo rand(1,999);?>';" /><?Php echo $imp;?>&nbsp;&nbsp;<input type="button" class="boton" value="MENU" onclick="javascript:location.href='index.php';" /></div>
<?Php 

elseif($_GET['ido'] || $_GET['new']):
	if($_GET['ido']){
		$datos=dame_datos("select * from videos where idvideo='".$_GET['ido']."' limit 1");
			if(!$datos){
				?>
					<script language="javascript">
						alert('No se encontraron resultados');
						location.href='history.back()';
					</script>
				<?Php
				exit;
			}
	}
	?>
	
		<form name="form1" id="form1" method="post" enctype="multipart/form-data" action="procesos/guardar_video.php">
        	<fieldset><legend>Datos</legend>
            	<table width="70%">           
                	<?Php if($datos['fecha']):?>     	
                    	<tr><td align="right"><label class="tit_campo">Fecha: </label></td><td><?Php echo $datos['fecha'];?></td></tr>
                        <tr><td align="right"><label class="tit_campo">Hora: </label></td><td><?Php echo $datos['hora'];?></td></tr>
                    <?php endif;?>
                    <tr><td align="right"><label class="tit_campo">Video: </label></td><td><input type="file" name="video" class="<?Php echo ($datos['descripcion']==''?'required':'');?> remote" /></td></tr>
                    <?Php
						if($datos['descripcion']):
							?>
                            	<tr><td colspan="2" id="straming">ee</td></tr>
                                								
      <script type="text/javascript">
					var disp = new SWFObject("swf/<?Php echo $datos['descripcion'];?>", "display", "540", "400", "8", "#010F2C");
					disp.addParam("wmode", "transparent");
					disp.write("straming");
				</script>
                            <?Php
						endif;
					?>
                    <tr><td align="right"><label class="tit_campo">Estatus: </label></td>
                    <td>
                    <select name="estatus">
                    <?Php $array_estatus=array(1=>'Activo',0=>'Desactivado');
						foreach($array_estatus as $key=>$valor){
							?>
                            	<option  <?Php echo ($datos['estatus']==$key?'selected="selected"':'');?> value="<?Php echo $key;?>"><?Php echo $valor;?></option>
							<?Php
						}
					?>
                    </select>
                    </td></tr>
                    <tr><td colspan="2" align="center"><input type="submit" class="boton" value="GUARDAR" />&nbsp;&nbsp;<input type="button" class="boton" value="LISTADO" onclick="javascript:location.href='add_videos.php';" /></td></tr>
                    <tr><td colspan="2" align=""><b>Nota: </b>todos los campos son obligatorios</td></tr>
                </table>
            </fieldset>
            <input type="hidden" name="ido" value="<?Php echo $datos['idvideo'];?>" />
        </form>


        
	<?Php
endif;?>
<script language="javascript">
	jQuery(document).ready(function(){
		jQuery('input').attr('autocomplete','off');
		jQuery("#form1").validate();
		
		jQuery('.solo_numero').numeric();
	});
</script>
<!-- InstanceEndEditable --> </div>

</body>
<!-- InstanceEnd --></html>