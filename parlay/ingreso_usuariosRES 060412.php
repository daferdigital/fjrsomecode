<?Php session_start();include_once("procesos/conexion.php");

$accion1=$_GET["accion"];
$idusuario1=$_GET["idu"];
$limpia1=$_POST["limpia"];
$agrega1=$_POST["B3"];

if($accion1=='ED'){	
	$sql=mysql_query("select * from usuario where idusuario=$idusuario1");
  	if ($row=mysql_fetch_array($sql)){
		do { 
			$nombre1=$row["nombre"];
			$telefono1=$row["telefono"];
			$direccion1=$row["direccion"];
			$email1=$row["email"];
			$clave1=$row["clave"];
			$usuario1=$row["usuario"];			
			$estatus1=$row["estatus"];
			$tipo1=$row["tipo"];			
		}while($row=mysql_fetch_array($sql));
	}
}
	else if($accion1=='ELM'){
		$sql=mysql_query("delete from usuario where idusuario=$idusuario1");
	}else{}
?>
<script language="javascript">
	cadena_hiden='idbanquero,usuario_actual';
	function verificar(){
		if(confirm('Esta Seguro que desea Eliminar el usuario Seleccionado?')){
				return true;
			}else{
				return false;
			}
	}
</script>
<style type="text/css">
<!--
.etiqueta_campo {
	font-weight: bold;
	padding-right:5px;
}

.etiqueta_lista{
	padding-left:5px;
	font-weight:bold;}
-->

.avisos{
	font-weight:bold;
	color:#F00;
	font-size:14px;
	text-align:center;
}
</style>
<div class="titulo">Registro / Edici&oacute;n de Usuarios</div>
<form method="post" name="ingresoe" action="procesos/guardar_usuarios.php" >
<div style="display:none;"><input type="hidden" name="id_usuario_insert" value="<? echo $idusuario1;?>" /></div>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><?
$usuario_insert=$_POST["id_usuario_insert"];
$nombreI=$_POST["nombres"];
$telefonoI=$_POST["telefono"];
$emailI=$_POST["email"];
$direccionI=$_POST["direccion"];
$usuarioI=$_POST["usuario"];
$claveI=$_POST["clave"];
$tipoI=$_POST["tipo"];
$idperfilI="1";
$estatusI=$_POST["estatus"];

if($agrega1=="Editar Usuario" and $usuario_insert>="1"){
////es update	

		$sql="UPDATE usuario SET nombre='$nombreI', telefono='$telefonoI', email='$emailI', direccion='$direccionI', usuario='$usuarioI',
			clave='$claveI', tipo='$tipoI', idperfil='$idperfilI', estatus='$estatusI' WHERE idusuario='$usuario_insert'";
			mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());?>
			<script>alert("Acaba de editar un usuario de forma exitosa");</script><?

}else if($usuarioI!='' and $agrega1=='Agregar Usuario'){

////es insert	
	$query_revisa="select * from usuario where usuario='$usuarioI'";
	$query_revisa1 = mysql_query($query_revisa,$conexion);
	
	if($row2=mysql_fetch_array($query_revisa1)){?>
	    <script>alert("El Usuario que intenta ingresar ya Existe");</script><? 
	} else {
		$sql="insert into usuario (`nombre`, `telefono`, `email`, `direccion`, `usuario`, `clave`, `tipo`, `idperfil`, `estatus`) 
		values ('$nombreI', '$telefonoI', '$emailI', '$direccionI', '$usuarioI', '$claveI', '$tipoI', '$idperfilI', '$estatusI')";
		mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());?>
	    <script>alert("Acaba de crear un usuario de forma exitosa");</script><?
	}

}else if($limpia1=='Limpiar Campos'){
			$nombre1='';
			$telefono1='';
			$direccion1='';
			$email1='';
			$clave1='';
			$usuario1='';			
			$estatus1='';
			$tipo1='';
			$usuario_insert='';
}else{}?>
    </td>
    </tr>
  <tr>
    <td width="134">&nbsp;</td>
    <td width="349">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="262">&nbsp;</td>
  </tr>
  <tr> 	 	 	
    <td class="etiqueta_campo"><div align="right">Nombre:</div></td>
    <td><input type="text" name="nombres" value="<? echo $nombre1;?>" /></td>
    <td class="etiqueta_campo"><div align="right">Usuario</div></td>
    <td><input type="text" name="usuario" value="<? echo $usuario1;?>" /></td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">Telefono:</div></td>
    <td><input type="text" name="telefono"  value="<? echo $telefono1;?>" /></td>
    <td class="etiqueta_campo"><div align="right">Clave</div></td>
    <td><input type="text" name="clave" value="<? echo $clave1;?>" /></td>
  </tr>
  <tr>
    <td class="etiqueta_campo"><div align="right">Email:</div></td>
    <td><input type="text" name="email" size="38" value="<? echo $email1;?>" /></td>
    <td class="etiqueta_campo"><div align="right">Tipo</div></td>
    <td><select name="tipo">
      <option value="" <? if ($tipo1<=0){echo "selected='selected' ";}?>></option>
      <option value="1" <? if ($tipo1==1){echo "selected='selected' ";}?>>Administrador General</option>
      <option value="2" <? if ($tipo1==2){echo "selected='selected' ";}?>>Asistente del Administrador</option>
    </select></td>
  </tr>
  <tr>
    <td valign="top" class="etiqueta_campo"><div align="right">Direccion:</div></td>
    <td><textarea cols="30" rows="2" name="direccion" ><? echo $direccion1;?></textarea></td>
    <td valign="top" class="etiqueta_campo"><div align="right">Estatus</div></td>
    <td valign="top"><select name="estatus">
      <option value="" <? if ($estatus1<=0){echo "selected='selected' ";}?>>Seleccione..</option>
      <option value="1" <? if ($estatus1==1){echo "selected='selected' ";}?>>Activo</option>
      <option value="0" <? if ($estatus1==0){echo "selected='selected' ";}?>>Desactivado</option>
    </select>
  
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><div align="center">
      <!--<input type="submit" class="boton" name="B3" <? if($accion1=='ED'){echo "value='Editar Usuario'";}else{ echo "value='Agregar Usuario'";} ?>/>-->
      <input name="B3" type="button" class="boton" onclick="javascript: form_usuarios='si'; validar(document.ingresoe,'usuarios.php');" <? if($accion1=='ED'){echo "value='Editar Usuario'";}else{ echo "value='Agregar Usuario'";} ?> />
      <a class="boton ajax_contenido" style="text-decoration:none;" href="ingreso_usuarios.php">Limpiar Campos</a>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<input name="B4" type="hidden" <? if($accion1=='ED'){echo "value='Editar Usuario'";}else{ echo "value='Agregar Usuario'";} ?> />
</form>
<table width="900" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="139" bgcolor="#CCCCCC"><strong>Usuario</strong></td>
    <td width="256" bgcolor="#CCCCCC"><strong>Nombre</strong></td>
    <td width="201" bgcolor="#CCCCCC"><div align="center"><strong>Perfil</strong></div></td>
    <td width="136" bgcolor="#CCCCCC"><div align="center"><strong>Estatus</strong></div></td>
    <td width="156" bgcolor="#CCCCCC"><div align="center"><strong>Acci&oacute;n</strong></div></td>
  </tr>
<?  
  $sql=mysql_query("select * from usuario order by idperfil");
  	if ($row=mysql_fetch_array($sql)){
		do { 
			
?>
  <tr>
    <td class="etiqueta_lista"><? echo $row["usuario"];?></td>
    <td class="etiqueta_lista"><? echo $row["nombre"];?></td>
    <td><div align="center"><? if($row["tipo"]=='1'){echo "Administrador General";}else if($row["tipo"]=='2'){echo "Asistente";}else{}?></div></td>
    <td><div align="center"><? if($row["estatus"]=='1'){echo "Activo";}else{echo "Desactivado";}?></div></td>
    <td><div align="center">
    <a class="ajax_contenido" href="ingreso_usuarios.php?idu=<? echo $row["idusuario"];?>&accion=ED">
    	<img src="imagenes/img/edita.jpg" width="23" height="23" alt="Editar" border="0" /></a><a class="ajax_contenido" href="ingreso_usuarios.php?idu=<? echo $row["idusuario"];?>&accion=ELM"><img src="imagenes/img/elim.jpg" width="23" height="23"  border="0" alt="Eliminar" />
    </a></div></td>
        
  </tr>
<?
		}while($row=mysql_fetch_array($sql));
	}
mysql_close();
?>  
</table>
<script language="javascript">
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