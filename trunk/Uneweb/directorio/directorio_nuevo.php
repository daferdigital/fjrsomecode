<?php
include('conexion.php');

if(isset($_POST['enviar']) && !empty($_POST['enviar'])){
		$nombre = addslashes(trim($_POST['nombre']));
		$rif = addslashes(trim($_POST['rif']));
		$tipo = addslashes(trim($_POST['tipoTmp']));
		$familia = addslashes(trim($_POST['familia']));
		$direccion = addslashes(trim($_POST['direccion']));
		$telefono = addslashes(trim($_POST['telefono']));
		$correo = addslashes(trim($_POST['correo']));
		$estado = addslashes(trim($_POST['estado']));
		$ciudad = addslashes(trim($_POST['ciudad']));
		$municipio = addslashes(trim($_POST['municipio']));
		$website = addslashes(trim($_POST['website']));
		$terminos = addslashes(trim($_POST['terminos']));
		$estatus = addslashes(trim($_POST['estatus']));
		
		if(isset($_GET['m']) && !empty($_GET['m']) && $_GET['m']=='1') {
			$guardar = mysql_query('UPDATE directorio SET nombre="'.$nombre.'",rif="'.$rif.'",tipo="'.$tipo.'",familia="'.$familia.'",direccion="'.$direccion.'",telefono="'.$telefono.'",correo="'.$correo.'",estado="'.$estado.'",ciudad="'.$ciudad.'",municipio="'.$municipio.'",website="'.$website.'",terminos="'.$terminos.'",estatus="'.$estatus.'" WHERE id = '.addslashes(trim($_GET['id'])).'') or die(mysql_error());
		} else {
			$guardar = mysql_query('INSERT INTO directorio(nombre,rif,tipo,familia,direccion,telefono,correo,estado,ciudad,municipio,website,terminos,estatus) VALUES("'.$nombre.'","'.$rif.'","'.$tipo.'","'.$familia.'","'.$direccion.'","'.$telefono.'","'.$correo.'","'.$estado.'","'.$ciudad.'","'.$municipio.'","'.$website.'","'.$terminos.'","2")');
		}
		
		if($guardar == true) {
			echo '<script language="javascript">alert("Su registro ha sido exitoso.");location.href="directorio_nuevo.php";</script>';
		}
}

if(isset($_GET['e']) && !empty($_GET['e'])) {
	$id=addslashes(trim($_GET['e']));
	$eliminar = mysql_query('DELETE FROM directorio WHERE id ='.$id.'');
	if($eliminar == true) {
		echo '<script language="javascript">alert("Su registro ha sido eliminado.");location.href="directorio_nuevo.php";</script>';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inscripci&oacute;n en Directorio</title>
<style type="text/css">
<!--
.txt1{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
}
.txt2{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
-->
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- script para manejo de estados y ciudades -->
<script type="text/javascript">
	<?php include ("scripts/ubicaciones.php");?>
</script>
</head>

<body>

<?php 
	if(isset($_REQUEST['nuevoOficio'])){
		//fue enviado un nuevo oficio, validamos para crearlo si es necesario
		$value = trim($_REQUEST['nuevoOficioTxt']);
		if($value == ""){
			echo "<script type=\"text/javascript\">alert('El nuevo oficio no puede ser vacio');</script>";
		} else {
			$query = "INSERT INTO oficios(nombre) VALUES('".$value."')";
			$consulta = mysql_query($query);
			if(mysql_error()){
				echo "<script type=\"text/javascript\">alert('El oficio indicado no pudo ser creado');</script>";
			}else{
				echo "<script type=\"text/javascript\">alert('El nuevo oficio fue creado y esta disponible');</script>";
			}
		}
	}
?>
<form action="directorio_nuevo.php<?php	if(isset($_GET['m']) && !empty($_GET['m']) && $_GET['m']=='1'){ echo '?id='.$_GET['id'].'&m=1';}?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1" onsubmit="prepareOficios(document.getElementById('tipo'))">
	<table width="790" border="0" align="center" cellpadding="0" cellspacing="5">
	    <tr>
	      	<td height="35" colspan="2" align="center" bgcolor="#dddddd" style="border:1px solid #999;">
	      		<strong>::: AGREGAR OFICIO :::</strong>
	      	</td>
	    </tr>
	    <tr>
	    	<td class="txt1" align="right">::: Nombre del oficio</td>
	      	<td>
	      		<input type="text" name="nuevoOficioTxt" id="nuevoOficioTxt" value=""/>
	      	</td>
	    </tr>
	    <tr>
	      	<td colspan="2" align="center">
	      		<input type="submit" name="nuevoOficio" id="nuevoOficio" value="Crear nuevo oficio"/>
	      	</td>
	    </tr>
	</table>
</form>
   <div><?php   //include "menu.htm";?></div>
<?php
if(isset($_GET['m']) && !empty($_GET['m']) && $_GET['m']=='1'){
	// Consulto
	include('conexion.php');
	$consulto = mysql_query('SELECT * FROM directorio WHERE id = '.addslashes(trim($_GET['id'])).' LIMIT 1');
	$r = mysql_fetch_array($consulto);
}
?>

<form action="directorio_nuevo.php<?php	if(isset($_GET['m']) && !empty($_GET['m']) && $_GET['m']=='1'){ echo '?id='.$_GET['id'].'&m=1';}?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1" onsubmit="prepareOficios(document.getElementById('tipo'))">
  <table width="790" border="0" align="center" cellpadding="0" cellspacing="5">
    <tr>
      <td colspan="3" align="left"></td>
    </tr>
    <tr>
      <td height="35" colspan="3" align="center" bgcolor="#dddddd" style="border:1px solid #999;"><strong>::: AGREGAR :::</strong></td>
    </tr>
    <tr>
      <td width="126">&nbsp;</td>
      <td width="241" class="txt1">::: Nombre y Apellido</td>
      <td width="333"><span id="sprytextfield1">
        <label>
          <input type="text" name="nombre" id="nombre" <?php if(isset($r)){echo 'value="'.$r['nombre'].'"';}?> />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: C&eacute;dula de Identidad</td>
      <td><label>
        <input type="text" name="rif" id="rif" <?php if(isset($r)){echo 'value="'.$r['rif'].'"';}?> />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Oficio</td>
      <td>
      	<input  type="hidden" name="tipoTmp" id="tipoTmp"/>
        <select name="tipo" id="tipo" multiple size="5">
        <?php
        	if(isset($r)) {
        		$arrayOficios = explode("|", $r['tipo']);
        		while($var = each($arrayOficios)){
        			$arrayOficios[$var[1]] = $var[1];
        		}
        	}
        	
        	$query = "SELECT id, nombre FROM oficios ORDER BY LOWER(nombre)";
         	$consulta = mysql_query($query);
         	
         	while(list($id, $nombre) = mysql_fetch_array($consulta)){
        ?>
         		<option value="<?php echo $nombre; ?>" 
         			<?php
         				if(isset($r)){
         					if(isset($arrayOficios[$nombre])){
         						echo "selected";
         					}
         				}
         			?>
         		>
         			<?php echo $nombre; ?>
         		</option>
        <?php 
        	}
        ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Productos</td>
      <td><label>
        <input type="text" name="familia" id="familia" <?php if(isset($r)){echo 'value="'.$r['familia'].'"';}?> />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Direcci&oacute;n</td>
      <td><span id="sprytextfield4">
        <label>
          <input type="text" name="direccion" id="direccion" <?php if(isset($r)){echo 'value="'.$r['direccion'].'"';}?> />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Tel&eacute;fonos/Fax</td>
      <td><span id="sprytextfield5">
        <label>
          <input type="text" name="telefono" id="telefono" <?php if(isset($r)){echo 'value="'.$r['telefono'].'"';}?> />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Correo (E-Mails)</td>
      <td><span id="sprytextfield6">
        <label>
          <input type="text" name="correo" id="correo" <?php if(isset($r)){echo 'value="'.$r['correo'].'"';}?> />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Estado</td>
      <td><span id="spryselect1">
        <select name="estado" id="estado" onchange="cargarCiudades(this.form.estado.value, this.form.ciudad)">
            <option value="-1" <?php if(!isset($_GET['m'])){echo 'selected';}?>>Seleccione:</option>
            <?php 
   		      	$query = "SELECT id, nombre FROM ubicaciones WHERE tipo_ubicacion = 1 ORDER BY LOWER(nombre)";
   		      	$consulta = mysql_query($query);
   		      	while(list($edoId, $edoNombre) = mysql_fetch_array($consulta)){
   		    ?>
					<option value="<?php echo $edoNombre;?>" <?php if(isset($r) && $r['estado'] == $edoNombre){echo 'selected';}?>><?php echo $edoNombre;?></option>
   		    <?php 
   		      	}
	      	?>
        </select>

      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Ciudad</td>
      <td><span id="sprytextfield8">
        <select name="ciudad" id="ciudad">
        </select>
        <?php 
        	if(isset($r['ciudad'])){
            	echo "<script type=\"text/javascript\">cargarCiudades(document.getElementById('estado').value, document.getElementById('ciudad'));</script>";
        	}
        ?>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Municipio</td>
      <td><input type="text" name="municipio" id="municipio" <?php if(isset($r)){echo 'value="'.$r['municipio'].'"';}?> /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: WebSite<font color="red">&nbsp;</font></td>
      <td><span id="sprytextfield2">
        <label>
          <input name="website" type="text" id="website" maxlength="150" <?php if(isset($r)){echo 'value="'.$r['website'].'"';}?> />
        </label>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: Terminos y condiciones</td>
      <td height="19"><input name="terminos" type="text" id="terminos" maxlength="150" <?php if(isset($r)){echo 'value="'.$r['terminos'].'"';}?> /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">::: estatus</td>
      <td height="19"><input name="estatus" type="text" id="estatus" maxlength="150" <?php if(isset($r)){echo 'value="'.$r['estatus'].'"';}?> /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="txt1">&nbsp;</td>
      <td height="45">
	
    <?php
	if(isset($_GET['m']) && !empty($_GET['m']) && $_GET['m']=='1')
	{
 ?>         
        <input name="enviar" type="submit" class="txt1" id="enviar" value="::: MODIFICAR" />
        <?php
	}
	else
	{
	?>
	    <input name="enviar" type="submit" class="txt1" id="enviar" value="::: ENVIAR" />
     <?php
	}?>
      </td>
    </tr>
    <tr>
      <td height="35" colspan="3" align="center" bgcolor="#dddddd" style="border:1px solid #999;"><strong>::: MODIFICAR / BORRAR:::</strong></td>
    </tr>
    <td colspan="3" valign="top">
    
    
    <?php
	@$pagina = $_GET['pagina'];
	$registros = 16;
	if (!$pagina)
	{
		$inicio = 0; $pagina = 1; 
	} 
	else 
	{ 
	
		$inicio = ($pagina - 1) * $registros; 
	
	}
	include('conexion.php');
	$cuantos = mysql_query('SELECT id FROM directorio');
	$q = mysql_num_rows($cuantos);
	$total_paginas = ceil($q / $registros);
	$resultados = mysql_query('SELECT * FROM directorio ORDER BY nombre ASC LIMIT '.$inicio.', '.$registros.'');
	$letra ='';
	$cont_1=0;
	$limit = $registros;
    while($r=mysql_fetch_array($resultados))
	{
		$letra_a = substr(strtoupper($r['nombre']),0,1);
		if($letra != $letra_a)
		{
			$letra = $letra_a;
			?>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td height="30" align="center" valign="middle" bgcolor="26c7fe" class="txt_9" style="border:1px solid #3098ef; color:#000;"><span style="font-size:17px;"><strong><?php echo $letra; ?></strong></span></td>
			</tr>
			</table>
			<?php
		}
    ?>
    
    <table width="390" border="0" cellspacing="3" cellpadding="0" style="background-color:#FFFFFF; <?php if($cont_1 != $limit){echo 'float:left;';}?>">
	<tr>
	<td height="30" colspan="2" class="txt1" style="background-color:#DDDDDD; border:1px solid #CCCCCC; color:#243e77; text-transform:uppercase; padding:6px;"><strong><?php echo $r['nombre']; 
	if($cont_1 == $limit)
	{
		echo '<input type="hidden" name="ultimo" id="ultimo" value="2" />';
	}
	?><br />
	</strong></td>
	</tr>
	<tr>
	  <td height="19" class="txt1">Categor&iacute;a:</td>
	  <td height="19" class="txt2"><strong><span style="font-size:11px; color:#000;"><?php echo $r['tipo']; ?></span></strong></td>
	  </tr>
	<tr>
	  <td height="19" class="txt1">Productos:</td>
	  <td height="19" class="txt2"><strong><span style="font-size:11px; color:#000;"><?php echo $r['familia']; ?></span></strong></td>
	  </tr>
	<tr>
	  <td height="19" class="txt1">Tel&eacute;fonos:</td>
	  <td height="19" class="txt2"><span class="txt1" style="background-color:#DDDDDD; border:1px solid #CCCCCC; color:#243e77; text-transform:uppercase; padding:6px;"><strong><span style="font-size:11px; color:#000;"><?php echo $r['telefono']; ?></span></strong></span></td>
	  </tr>
	<tr>
	  <td width="30%" height="19" class="txt1"><strong> Estado / Ciudad:</strong></td>
	  <td width="70%" height="19" class="txt2"><?php echo $r['estado']; ?> / <?php echo @$r['ciudad']; ?></td>
	  </tr>
	<tr>
	<td height="19" class="txt1"><strong> Direcci&oacute;n:</strong></td>
	<td height="19" class="txt2"><?php echo $r['direccion']; ?></td>
	</tr>
	<tr>
	<td height="19" class="txt1"><strong>E-Mail:</strong></td>
	<td height="19" class="txt2"><?php echo $r['correo']; ?></td>
	</tr>
    	<tr>
	<td height="19" class="txt1"><strong><u>P&aacute;gina web:</u></strong></td>
	<td class="txt2" style="line-height:17px;"><a href="http://<?php echo $r['website']; ?>"><?php echo $r['website']; ?></a></td>
	</tr>
	<tr>
	  <td class="mi_texto">&nbsp;</td>
	  <td align="right" class="txt2"><a href="directorio_nuevo.php?id=<?php echo $r['id']; ?>&m=1">Modificar</a> | <a href="directorio_nuevo.php?e=<?php echo $r['id']; ?>">Eliminar</a></td>
	  </tr>
	</table>
    <?php
	$cont_1++;
	}
	?>
    
    
    
    </td>
  </table>
  <?php
  if(($pagina - 1) > 0) { echo "<a href='".$_SERVER['PHP_SELF']."?b=11&mira=164&pagina=".($pagina-1)."'><strong><</strong></a> "; }
	  for ($i=1; $i<=$total_paginas; $i++)
	  {
		  if($pagina == $i)
		  { 
		  	echo " <span><b>".$pagina."</b></span> "; 
		  } 
		  else 
		  { 
		  	echo " <a href='".$_SERVER['PHP_SELF']."?b=11&mira=164&pagina=$i'>$i</a> "; 
		  }
	  }
	  if(($pagina + 1)<=$total_paginas) { echo " <a href='".$_SERVER['PHP_SELF']."?b=11&mira=164&pagina=".($pagina+1)."'><strong>></strong></a>"; }
	  ?>        
    <br />
    
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
//-->
</script>
</body>
</html>
<?php mysql_close();?>