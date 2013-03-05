<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectequipos="select * from vista_equipos";
		$queryequipos=mysql_query($selectequipos);
			if(mysql_num_rows($queryequipos)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Equipo</td>
    <td>Liga</td><td>Deporte</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varequipos=mysql_fetch_assoc($queryequipos)){
					//$varequipos=convertArrayKeysToUtf8($varequipos);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varequipos['idequipo']; ?></td><td><?php echo $varequipos['nombre']; ?></td><td><?php echo $varequipos['nombre_liga']; ?></td><td><?php echo $varequipos['nombre_categoria']; ?></td><td><?php echo ($varequipos['estatus']>0?'Habilitado':'Deshabilitado'); ?></td><td align="right"><img src="imagenes/editar.png" title="Editar" width="16px" border="0" onclick="javascript:editar_datos('nombre,liga,idequipo,estatus','<?php echo $varequipos['nombre'].','.$varequipos['idliga'].','.$varequipos['idequipo'].','.$varequipos['estatus']; ?>');" /><?php echo ($varequipos['nombre_categoria']=='Béisbol'?'<a  class=\'ajax_contenido\' href=\'ingreso_lanzadores.php?idequipo='.$varequipos['idequipo'].'\'><img src="imagenes/pelota.png" title="Agregar / Editar lanzadores" style="padding-left:5px;" width="16" border="0"/></a>':''); ?></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro equipos</strong></div><?Php
			}
	?>
	<script language="javascript">
	$(document).ready(function(){
	   $(".ajax_contenido").click(function(evento){
		   evento.preventDefault();
		   	  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
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