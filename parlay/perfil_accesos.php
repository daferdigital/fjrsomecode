<?
//include_once("../procesos/conexion.php");
include_once("procesos/conexion.php");

$btnAccion=$_POST["accion"];
$usuario1=$_POST["usuario"];
$perfil1=$_POST["perfil"];

switch($btnAccion){
    case 'Agregar':
	
	foreach($_POST['acceso'] as $id=>$valor){
	
		$sql="INSERT INTO perfil_accesos (id_perfil_programa, idusuario, id_perfil)VALUES('$id', '$usuario1', '$perfil1')";
		$resultado=mysql_query($sql, $conexion) or die ("problema con query");
	}
    case 'Editar':
	
	$sql_elim="DELETE FROM perfil_accesos where idusuario='$usuario1' and id_perfil='$perfil1'";
	$sql_elim2=mysql_query($sql_elim, $conexion) or die ("problema con query");

	foreach($_POST['acceso'] as $id=>$valor){	
		$sql="INSERT INTO perfil_accesos (id_perfil_programa, idusuario, id_perfil)VALUES('$id', '$usuario1', '$perfil1')";
		$resultado=mysql_query($sql, $conexion) or die ("problema con query");
	}
}
	
if (!empty($_POST["button"])){	
	if ($_POST["nivel1"]!="null"){$tab=",idperfil";
		$val=",".$_POST["nivel1"];}//,'".$id_categoria_macro."'
		//echo $val; 
		
	if ($_POST["nivel2"]!="null"){
		if (!empty($val)){ $tab.=",idperfil";}
				$val.=",".$_POST["nivel2"];}
}

$perfil_usuario=$_POST["nivel1"];///el perfil del usuario de la tabla perfiles
$perfil_administradores=$_POST["nivel2"]; ///con esto se si es de la tabla usuarios o normal

$sql="SELECT * FROM perfil_padre ORDER BY orden";
$sql_query=mysql_query($sql,$conexion);		

//		WHERE pa.id_perfil='$perfil_usuario'
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.programa_titulo {padding-left:5px; font-weight:bold; height:25px;}
.programa_nom {padding-left:20px;}
</style>
</head>

<body>
<form method="post" name="accesos" action="perfil_accesos.php">
<table width="600" border="1" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td height="40" colspan="2" bgcolor="#006600"><div align="right"><strong>Perfil 
               <select name="nivel1" id="nivel1" onchange="this.form.submit()">
                  <option value="null">- Seleccione -</option>
                  <? $sql_n1="select * from perfiles order by descripcion";
					$resultado=mysql_query($sql_n1);
						while($row = mysql_fetch_array($resultado)){?>
						<option value="<?=$row[0]?>" <?=$selected=($row[0]==$_POST["nivel1"])?"selected":"";?> >
						<?=$row[1]?>
                  </option>
                  		<? }?>
                </select>

              </strong></div></td>
            </tr>
<?
if($perfil_usuario=='1' or $perfil_usuario=='6'){
echo	$usuario_id=$perfil_administradores;
	?>
            <tr>
              <td height="40" colspan="2" bgcolor="#666666"><div align="right">
              

                <select name="nivel2" id="nivel2" onchange="this.form.submit()">
                  <option value="null">Seleccione..</option>
                  <? 
				  if ($perfil_usuario==1){$tipo_usr="1";}else{$tipo_usr="2";}
				  $sql_n2="select * from usuario WHERE tipo='$tipo_usr' ORDER BY usuario";
				  $resultado=mysql_query($sql_n2);
					  while($row = mysql_fetch_array($resultado)){?>
					  <option value="<?=$row[0]?>" <?=$selected=($row[0]==$_POST["nivel2"])?"selected":"";?>>
						<?=$row[1]?>
					  </option>
					  <? }?>
                </select>

              </div></td>
            </tr>
<? }else{
	$usuario_id="$perfil_usuario";
}	

	if ($row1=mysql_fetch_array($sql_query) and $perfil_usuario>='1'){?>
			<tr>
               <td width="357" height="40" bgcolor="#666666"><strong>Programa</strong></td>
               <td width="237" align="center" bgcolor="#666666"><strong>Conceder Acceso</strong></td>
			</tr>

        <? do { ?>
			<tr>
			    <td colspan='2' bgcolor="#CCCCCC"><div class="programa_titulo"><? echo $row1['perfil_padre'];?></div></td>
			</tr><?
			$id_sub=$row1["id_perfil_padre"];
			
			$sub1 = "select * from perfil_programas where id_perfil_padre=$id_sub order by orden";				
			$sub = mysql_query($sub1,$conexion);?>	
            	<? 
	               if ($row=mysql_fetch_array($sub)){
						do { 						
						$id_programa=$row["id_perfil_programa"];
						$sub2 = "select * FROM perfil_accesos 
								WHERE id_perfil_programa='$id_programa' and id_perfil='$perfil_usuario' and idusuario='$usuario_id'";						
						$sub2Q = mysql_query($sub2,$conexion);						
							if ($row2=mysql_fetch_array($sub2Q)){
								do { 
									$id_programa_acceso=$row2["id_perfil_programa"];
								}while ($row2=mysql_fetch_array($sub2Q));
				   			}
						?>                    
                          <tr>
                            <td><div class="programa_nom"><? echo $row["nombre_programa"]; ?></div></td>
                            <td align="center"><input name="acceso[<? echo $row[0];?>]" <? if($row[0]==$id_programa_acceso){echo "checked";}else{}?> type="checkbox" value="" />

							</td>
                          </tr>
					<? }while ($row=mysql_fetch_array($sub));
				   }
		   }while ($row1=mysql_fetch_array($sql_query));?>
            <tr>
               <td colspan="2" height="50" align="center">
               <input name="usuario" type="hidden" size="5" value="<? echo $usuario_id; ?>" />
               <input name="perfil"  type="hidden" size="5" value="<? echo $perfil_usuario; ?>" />
               <input type="submit" name="accion" <? if($id_programa_acceso>='1'){echo "value='Editar'";}else{ echo "value='Agregar'";} ?> />
               </td>
			</tr>
<? }
mysql_close();
?>            
</table>
</form>
</body>
</html>