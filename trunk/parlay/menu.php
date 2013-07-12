<? 
include_once("procesos/conexion.php");
///print_r($_SESSION);
//echo $_SESSION["idsesion"]." > ".$_SESSION['nombre_idtabla'];
//$_SESSION["autentificado"];
//echo $tipo_usuario=
?>
<table border="0">
	<tr>
    	<td>
    		<img src="imagenes/arrow-right.png" width="30px" border="0" />
    	</td>
        <td>
    		<strong>
    			Fecha:
    			<span id="fechaCompleta"></span>
    		</strong>
        	<!--<div id="reloj">-</div>-->
        </td>
    	<td>
    	<img src="imagenes/arrow-right.png" width="30px" border="0" /></td>
        <td><?Php echo "<b>Nombre: </b>".($_SESSION['datos']['nombre']!=''?$_SESSION['datos']['nombre']:$_SESSION['datos']['nombres']).' <b>Tipo:</b> '.$_SESSION["tipo"];?>
    	</td>
    </tr>
</table>

<script type="text/javascript">
	var currentDate = new Date(<?php echo date("Y");?>,
	    <?php echo ((int) date("n")-1);?>,
	    <?php echo date("j");?>,
	    <?php echo date("H");?>,
	    <?php echo date("i");?>,
	    <?php echo date("s");?>); 
	
	//var currentDate = new Date(<?php echo time()*1000;?>);
	//alert(currentDate.toLocaleString());
	//alert("<?php echo date_default_timezone_get();?>");
	
	function laHora(){
		var newDate = currentDate.getTime();
		newDate += 1000;
		
		currentDate = new Date(newDate);
		var h2 =  new Number(currentDate.getHours());
		var m2 =  new Number(currentDate.getMinutes());
		var s2 =  new Number(currentDate.getSeconds());
		
		if(currentDate.getHours() < 10){
			h2 = "0" + currentDate.getHours();
		}
		if(currentDate.getMinutes() < 10){
			m2 = "0" + currentDate.getMinutes();
		}
		if(currentDate.getSeconds() < 10){
			s2 = "0" + currentDate.getSeconds();
		}

		document.getElementById('fechaCompleta').innerHTML = currentDate.getFullYear() 
			+ "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getDate() + " " 
			+ h2 + ":" + m2 + ":" + s2;
	}

	setInterval('laHora()', 1000)
</script>

<hr>
<?Php 
$perfil_usuario=$_SESSION['perfil'];
/*
echo "perfil: ";

echo "<br>";
*/
//	echo $_SESSION["usuario_id"]; 
if($perfil_usuario=='1'){
///entonces es Adminitradores
	$usuario_name=$_SESSION["login_user"];
	$id_usuarioADM=$_SESSION["usuario_id"];
	
	$tipoUSR=$_SESSION["tipo_usr"];
	if($tipoUSR=='1'){//asistente 
		$tipoUSR1='1';
	}else if($tipoUSR=='2'){
		$tipoUSR1='6';
	}
	
	$fil1="pa.idusuario='$id_usuarioADM' and pa.id_perfil='$tipoUSR1'";
	///este es de los admin
}else{
	///banca / otros   
	$fil1="pa.id_perfil='$perfil_usuario' AND pa.idusuario = '$perfil_usuario' ";
}
	$sql="SELECT pa.*, pp.id_perfil_programa, pp.id_perfil_padre, p.*, ppa.*, pa.id_perfil_programa AS idacceso 
	FROM `perfil_accesos` pa
		LEFT JOIN perfil_programas pp ON (pa.id_perfil_programa=pp.id_perfil_programa)
		LEFT JOIN perfiles p ON (pa.id_perfil=p.idperfil)
		LEFT JOIN perfil_padre ppa ON (pp.id_perfil_padre=ppa.id_perfil_padre)
		WHERE $fil1
		GROUP BY ppa.perfil_padre
		ORDER BY ppa.orden";

$sql_query=mysql_query($sql,$conexion);

?>

<div style="position:absolute; top:-38px; left:0px;">
<table align="right"><tr><td>
<ul class="sf-menu">
<?
if ($row1=mysql_fetch_array($sql_query)){?>

        <? do { 
			echo "<li class='current'><a>".$row1["perfil_padre"]."</a><ul>";
			$id_sub=$row1["id_perfil_padre"];
			
			$sub1 = "SELECT pa.*, pp.*, p.*, ppa.*, pa.id_perfil_programa FROM `perfil_accesos` pa
					LEFT JOIN perfil_programas pp ON (pa.id_perfil_programa=pp.id_perfil_programa)
					LEFT JOIN perfiles p ON (pa.id_perfil=p.idperfil)
					LEFT JOIN perfil_padre ppa ON (pp.id_perfil_padre=ppa.id_perfil_padre)
					WHERE ppa.id_perfil_padre='$id_sub' and $fil1
					ORDER BY pp.orden";
					///pa.id_perfil='$perfil_usuario' and 
			$sub = mysql_query($sub1,$conexion);?>	
            	<? /*<a><? echo $row["subcategoria"]; ?></a><?*/
	               if ($row=mysql_fetch_array($sub)){
						do { ?>                    
			            <li> 	
						<a href="<? echo $row["programa_archivo"]; ?>" 
                       	<? if($row["apertura"]=='1'){echo "target='_blank'";}else{echo "class='ajax_contenido'";} ?>><? echo $row["nombre_programa"]; ?></a>
						</li>
					<? }while ($row=mysql_fetch_array($sub));
				   }?>
		   </ul></li><?
		   }while ($row1=mysql_fetch_array($sql_query));
}?>
		<li style="background-color:#900 !important;">
			<a target="_blank" href="./reglasGenerales.html">Reglas Generales</a>
		</li>
		<li style="background-color:#900 !important;">
			<a href="?salir=logout">Salir del sistema</a>
		</li>
	</ul>
</td></tr></table>
</div>