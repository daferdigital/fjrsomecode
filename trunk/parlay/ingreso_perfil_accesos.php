<style type="text/css">
table tr td{
	margin:0 auto;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#666666;
}
.titulo{
	font-weight:bold;
	color:#003901;
	text-decoration:underline;
	font-size:18px;
	margin-bottom:30px;
}

#general{
	margin:0px auto;
	
	width:1198px;
	background-color:#fff;
	padding:10px;
	/*border:#000 1px dashed;*/
	position:relative;
}
.tit_campos{
	font-weight:bold;
}
.campo_obligatorio{
	font-weight:bold;
}
.titulo_tablas{
	font-weight:bold;
	font-size:14px;
	color:#fafbfc;
	background-color:#003901;
}

.titulo_tablas_negro{
	font-weight:bold;
	font-size:14px;
	color:#fafbfc;
	background-color:#000;
}
.boton{
	font-size:10px;
	font-family:Verdana,Helvetica;
	font-weight:bold;
	color:white;
	background:#003901;
	border:0px;
	width: auto;
	padding:5px;
	cursor:pointer;
}
.boton:hover{
	background-color:#000;
}

.tr:nth-child(odd){ background: #fcfcfc !important;}
.tr:nth-child(even){ background: #dbdbdb !important;}

option:nth-child(odd){ background: #cccccc;}
option:nth-child(even){ background: #dbdbdb;}
.tr img{
	cursor:pointer;
}
.menu a{
	text-decoration:none;
	
	
	font-size:10px;
	font-family:Verdana,Helvetica;
	font-weight:bold;
	color:white;
	background:#003901;
	border:0px;
	width: auto;
	padding:5px;
	cursor:pointer;
	/*padding-left:15px;*/
}
.menu a:hover{
	color:#cccccc;
	background-color:#000;
}
.color_2colum{
	/*background-color: #93FF93;*/
}
.columna_sola{
	text-align:center;
	width:40px;
}
/*LOGROS*/
.logros_tabla select{
	width:200px;
}
.logros_tabla input[type=radio]{
	width:12px;
	cursor:pointer;
}
.logros_tabla .tit_campos{
	font-size:10px;
	text-align: center;
	font-weight:normal;
}
.logros_tabla td{
	//border-right:#000 1px solid;
}
.logros_tabla{
	border-bottom:#000 1px solid;
	border-left:#000 1px solid;
	border-right:#000 1px solid;
}
.logros_tabla .linesep{
	border-top:#000 1px solid;
}
.logros_tabla .linesep td{
	border-top:#000 1px solid;
}
.logros_tabla .bnone{
	border-top: 0px !important;
}
.logros_tabla .tr_top td{
	border-top:#000 1px solid;
}
.td_left{
	border-left:#000 1px solid;
}
.carga_load, .carga_load2, .carga_load3, .mensaje_resultado {
	position:fixed;
	/*background:#fff;*/
	color:#000;
	font-weight:bold;
	display:none;
	position: absolute;
	left: 50%;
	top: 50%;
	width: 200px;
	height: 100px;
	margin-top: -100px;
	margin-left: -150px;
	overflow: auto;
	background:#FFF url(../imagenes/loading1.gif) center no-repeat;
	vertical-align:middle;
	text-align:center;
	padding-top:60px;
	/*border: 1px solid red;*/
}
.carga{
	position:fixed;
	background:#000;
	color:#CCC;
	top:0px;
	left:0px;
	display:none;
	width:100%;
	height:100%;
}
#logrosd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_logros.jpg) right top no-repeat;
	padding-left:3px;
}
#combinacionesd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_combinaciones.jpg) right top no-repeat;
	padding-left:3px;
}
#resultadosd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_resultados.jpg) right top no-repeat;
	padding-left:3px;
}
#ventasd{
	height:30px;
	vertical-align:middle;
	background:#4C893B url(../imagenes/fondo_venta.jpg) right top no-repeat;
	padding-left:3px;
}
.navld{
	font-weight:bold;
	color:#FFF;
}

.borde_top_left{
	border-top:#000 1px solid; border-left:#000 1px solid;
}

.borde_rigth td{
	border-right:#9A9A9A 1px solid;
}

.borde_rigth_bottom td{
	border-right:#9A9A9A 1px solid;
	border-bottom:#9A9A9A 1px solid;
}

.borde_left{
	border-left:#9A9A9A 1px solid;
}

.borde_rigth_bottom_top td{
	border-right:#9A9A9A 1px solid;
	border-bottom:#9A9A9A 1px solid;
	border-top:#9A9A9A 1px solid;
}

.borde_bottom td{
	border-bottom:#000 1px solid;
}
.estatus_venta{
	font-weight:bold;
}
legend{
	font-weight:bold;
	font-style:italic;
}
input,select,textarea{
	color:#666666;
}
.texto_derecha{
	text-align:right;
}
.nencontrado{
	font-weight:bold;
	color:#900;
	font-size:14px;
}
.ventas_taquilla tr td{
	font-size:10px;
}
</style>
<?Php
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
<form method="post" name="accesos" action="">
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
$usuario_id=$perfil_administradores;
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