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
include_once("procesos/conexion.php");

//$accion1=$_POST["accion"];
$id_programa=$_GET["id"];
$accion1=$_GET["accionL"];

if($accion1=='ED'){	
	$sql=mysql_query("select * from perfil_programas where id_perfil_programa=$id_programa");
  	if ($row=mysql_fetch_array($sql)){
		do { 
			$idprograma=$row["id_perfil_programa"];
			$perfil_padre=$row["id_perfil_padre"];
			$programa_nom=$row["nombre_programa"];
			$archivo_nom=$row["programa_archivo"];
			$orden=$row["orden"];			
		}while($row=mysql_fetch_array($sql));
	}
	
	}else if($accion1=='ELM'){
		$sql=mysql_query("delete from perfil_programas where id_perfil_programa=$id_programa");
	}else{}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../include/templete.css" rel="stylesheet" type="text/css" />
<style>
.etiqueta_campo {
	font-weight: bold;
	padding-right:5px;
}
</style>
<script type="text/javascript">
function verificar(){
	if(confirm('Esta Seguro que desea Eliminar el usuario Seleccionado?')){
			return true;
		}else{
			return false;
		}
}
</script>
</head>

<body>
<form method="post" name="ingresoe" action="ingreso_perfil_programas_datos.php" onSubmit="return validar(this)">
<input name="id_perfil_programa" type="hidden" size="30" value="<? echo $idprograma; ?>" />
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="426">&nbsp;</td>
    <td width="393">&nbsp;</td>
    <td width="73">&nbsp;</td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">M&oacute;dulo Padre</div></td>
    <td><select size="1" name="modulo_padre">
      <? $result1 = mysql_query("Select * from perfil_padre order by perfil_padre", $conexion);
					$num_rows1 = mysql_num_rows($result1);
					if ($num_rows1 != 0){?>
      <option selected="selected" value="">Seleccione</option>
      <? for($i=1;$i<=$num_rows1;$i++){
						$j=$i-1;
						$id=mysql_result($result1, $j, "id_perfil_padre");						
						$perfil=mysql_result($result1, $j, "perfil_padre");?>
                        
                        
      <option value="<? echo $id;?>" <? if ($id==$perfil_padre){echo "selected='selected'";}?>><? echo $perfil;?></option>
      <? }}?>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">Nombre del programa</div></td>
    <td><input type="text" name="nombre_programa" size="30" value="<? echo $programa_nom; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">Archivo del Programa</div></td>
    <td><input type="text" name="archivo" size="30" value="<? echo $archivo_nom; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">Orden</div></td>
    <td><input type="text" name="orden" value="<? echo $orden; ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    <div align="center">
      <input type="submit" name="accion" class="boton" <? if($accion1=='ED'){echo "value='Editar'";}else{ echo "value='Agregar'";} ?>/>
		<a class="boton ajax_contenido" style="text-decoration:none;" href="">Limpiar Campos</a>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


<table width="900" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="152" bgcolor="#CCCCCC"><strong>Modulo Padre</strong></td>
    <td width="214" bgcolor="#CCCCCC"><strong>Nombre del programa</strong></td>
    <td width="212" bgcolor="#CCCCCC"><strong>Nombre del Archivo</strong></td>
    <td width="154" bgcolor="#CCCCCC"><div align="center"><strong>Orden</strong></div></td>
    <td width="156" bgcolor="#CCCCCC"><div align="center"><strong>Acci&oacute;n</strong></div></td>
  </tr>
<?  
		$sql1="SELECT pp.*, pp.orden AS orden_programa, ppa.* FROM perfil_programas pp
			   		LEFT JOIN perfil_padre ppa ON (pp.id_perfil_padre=ppa.id_perfil_padre)
					ORDER BY perfil_padre";
		$sql=mysql_query($sql1,$conexion);
		
  	if ($row=mysql_fetch_array($sql)){
		do { ?>
  <tr>
    <td class="etiqueta_lista"><? echo $row["perfil_padre"];?></td>
    <td class="etiqueta_lista"><? echo $row["nombre_programa"];?></td>
    <td class="etiqueta_lista"><? echo $row["programa_archivo"];?></td>
    <td class="etiqueta_lista"><div align="center"><? echo $row["orden_programa"];?></div></td>
    <td><div align="center">
    <a href="?id=<? echo $row["id_perfil_programa"];?>&accionL=ED">
    	<img src="imagenes/img/edita.jpg" width="23" height="23" alt="Editar" border="0" /></a>
    <a onClick="return verificar();" href="?id=<? echo $row["id_perfil_programa"];?>&accionL=ELM"><img src="imagenes/img/elim.jpg" width="23" height="23"  border="0" alt="Eliminar" />
    </a></div></td>
        
  </tr>
<?
		}while($row=mysql_fetch_array($sql));
	}
mysql_close();
?>  

</table>
</form>
</body>
</html>