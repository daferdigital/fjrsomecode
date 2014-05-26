<?Php include("procesos/sesiones.php");
	if($_SESSION['perfil']!=1){
		header("location: index.php");
	}


if($_GET["agregar"]=='1'){
	$sql_taquillas=mysql_query("SELECT * FROM taquillas where iddepartamento='".$_GET["ido"]."' ");
	$valor_taquilla=mysql_num_rows($sql_taquillas);
	$valor_taquilla_new=$valor_taquilla+1;
	$sql_insert=mysql_query("INSERT INTO taquillas (`iddepartamento` , `descripcion` , `estatus`) 
														VALUES ('".$_GET["ido"]."', '$valor_taquilla_new', '1')");
				
	$lee_reg=mysql_query("SELECT * FROM taquillas where iddepartamento='".$_GET["ido"]."' and descripcion='$valor_taquilla_new' ");
	if ($row=mysql_fetch_array($lee_reg)) {
		do { 
			$idtaquilla1=$row["idtaquilla"];
			$sql_insert=mysql_query("INSERT INTO operadores_taquillas (`idoperador` , `idtaquilla` , `estatus`) 
												VALUES ('0', '$idtaquilla1', '1')");
		} while ($row=mysql_fetch_array($lee_reg));
	}
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
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script> 
<script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
	.mostrar_imprimir{
		display:none;
	}
</style>
<script>
function verificar (){
     if(confirm ('Desea Agregar una nueva Taquilla?')){
         return true;
     }else{
         return false;
     }
 }
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<div style="width:800px; margin:0 auto; margin-bottom:15px;">
<img src="imagenes/header.jpg" width="800" border="0" />
<?Php 
	include("cerrar_sesion.php");
?>
<!-- InstanceBeginEditable name="contenido" -->

<div id="titulo">Departamentos</div>
<br />
<div id="mensaje_eventos" style="display:none;"></div>
<br />
<?Php
if($_GET['desv']){
	mysql_query("UPDATE operadores_taquillas SET idoperador=0 WHERE idtaquilla='".$_GET['desv']."' limit 1");
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
if($_GET['desactivar']){
	mysql_query("UPDATE departamentos SET estatus=0 WHERE iddepartamento='".$_GET['desactivar']."' limit 1");
	?>
    	<script language="javascript">
			jQuery(document).ready(function(){
				jQuery('#mensaje_eventos').html('OperaciÃ³n ejecutada con Ã©xito');
				jQuery('#mensaje_eventos').show('slow');
				setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
			});
		</script>
    <?Php
}

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
if(!$_GET['ido'] && !$_GET['new']):
	$selgeneral="select *,if(estatus=1,'Activo','Inactivo') as des_estatus from departamentos";
	$querygeneral=mysql_query($selgeneral);
		if(mysql_num_rows($querygeneral)>0){
			ob_start();
					?> 
                    <div class="mostrar_imprimir"><strong>Fecha de impresi&oacute;n:</strong> <?Php echo date('d/m/Y');?> <strong>Hora:</strong> <?Php echo date('h:i:s A');?> <strong>Usuario:</strong> <?Php echo $_SESSION['nombre_usuario'];?></div>
                    <div class="" align="center"><h4>Listado de departamentos <?php echo ($_GET['estatuse']!=''?'filtrando por estatus <b>'.$estatus_sel[$_GET['estatuse']].'</b>':''); echo ($_GET['estatuse'] && $_GET['eventose']?' Y ':''); echo ($_GET['eventose']!=''?'filtrando por eventos <b>'.$eventos_sel[$_GET['eventose']].'</b>':'');?></h4></div>
			<table width="100%" align="center" class="listado" cellpadding="5" cellspacing="0">
				<tr class="tit_filas"><td>ID</td><td>DESCRIPCIÃ“N</td><td>N&Uacute;MERO DE TICKETS</td><td>ESTATUS</td><td id="acciones_b" width="15%"></td></tr>
			<?Php
			while($vargeneral=mysql_fetch_assoc($querygeneral)){
				?>
					<tr class="tr"><td><?Php echo $vargeneral['iddepartamento'];?></td><td><?Php echo $vargeneral['descripcion'];?></td><td><?Php echo $vargeneral['tickets_disponibles'];?></td><td><?Php echo $vargeneral['des_estatus'];?></td><td id="acciones_b"><a href="?ido=<?Php echo $vargeneral['iddepartamento'];?>">Edit</a> | <a href="javascript: if(confirm('Presione aceptar si desea desactivar a este operador')){location.href='?desactivar=<?Php echo $vargeneral['iddepartamento'];?>';}">Elim</a></td></tr>
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
		$datos=dame_datos("select * from departamentos where iddepartamento='".$_GET['ido']."' limit 1");
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
	
		<form name="form1" id="form1" method="post" action="procesos/guardar_departamento.php">
        	<fieldset><legend>Datos del departamento</legend>
            	<table width="70%">
                	
                    <tr><td align="right"><label class="tit_campo">DescripciÃ³n: </label></td><td><input type="text" name="descripcion" value="<?Php echo $datos['descripcion'];?>" class="required" /></td></tr>                    
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
                    
                </table>
            </fieldset>
            
            <fieldset><legend>Datos de taquillas</legend>
            	<?Php 
					$query_taq=mysql_query("select * from vista_taquillas_operadores where iddepartamento='".$_GET['ido']."' order by idtaquilla");
					if(mysql_num_rows($query_taq)>0){
						?><table width="100%" id="adicionales">
							<tr class="tit_filas">
							  <td>TAQUILLA</td><td>OPERADOR</td><td>SELECCIONAR OPERADOR</td></tr>
						<?Php $cont=0;
						while($var_taq=mysql_fetch_assoc($query_taq)){
							?>
                            	<tr><td><input type="hidden" name="taquilla[<?Php echo $cont;?>]" value="<?Php echo $var_taq['idtaquilla'];?>" /><input type="text" name="desc_taq[<?Php echo $cont;?>]" value="<?Php echo $var_taq['descripcion_taquilla'];?>" /></td><td><?Php if($var_taq['nombre']){echo $var_taq['nombre'];?> <a href="javascript:if(confirm('Presione aceptar si desea desvincular este usuario de la taquilla')){location.href='?desv=<?php echo $var_taq['idtaquilla'];?>&ido=<?php echo $_GET['ido'];?>';}">quitar</a><?Php }?></td><td><?Php echo genera_select("select idoperador,nombre from operadores where idoperador not in(select idoperador from operadores_taquillas where estatus=1)",'name="operador['.$cont.']"  id="operador_'.$cont.'" onchange="javascript:comparar_seleccion(this.value,this.id,document.form1);"');?></td></tr>
                            <?Php
							$cont++;
						}
						?></table><?Php
					}else{
						?><table width="80%" id="adicionales">
							<tr class="tit_filas"><td>TAQUILLA</td><td>SELECCIONAR OPERADOR</td></tr>
						<?Php
						for($u=0;$u<5;$u++){
						?>
                        	<tr><td><input type="text" name="desc_taq[<?Php echo $u;?>]" value="<?Php echo (int)$u+1;?>" /></td><td><?Php echo genera_select("select idoperador,nombre from operadores where idoperador not in(select idoperador from operadores_taquillas where estatus=1)",'name="operador['.$u.']" id="operador_'.$u.'" onchange="javascript:comparar_seleccion(this.value,this.id,document.form1);"');?></td></tr>
						<?Php
						}
						?></table><?Php
					}
				?>
                
            </fieldset><br />

            <div>
                	<table align="center"><tr><td colspan="2" align="center">
                    <a onClick="return verificar();" href="?ido=<? echo $_GET["ido"];?>&agregar=1" class="boton" >AGREGAR TAQUILLA</a>
                	  &nbsp;
                	  <input type="submit" class="boton" value="GUARDAR" />&nbsp;&nbsp;<input type="button" class="boton" value="LISTADO" onclick="javascript:location.href='add_departamentos.php';" /></td></tr>
                    <tr><td colspan="2" align=""><b>Nota: </b>todos los campos son obligatorios</td></tr></table>
                </div>
            <input type="hidden" name="ido" value="<?Php echo $datos['iddepartamento'];?>" />
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