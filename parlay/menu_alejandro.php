
<!--div align="right" class="menu"><a href="como_apostar.php" class="ajax_contenido">Como apostar?</a> <a href="ingreso_tipo_apuestas.php" class="ajax_contenido">Tipos de apuestas</a> <a href="ingreso_apuestas.php" class="ajax_contenido">Apuestas</a> <a href="ingreso_categorias.php" class="ajax_contenido">Categorias</a> <a href="ingreso_ligas.php" class="ajax_contenido">Ligas</a> <a href="ingreso_equipos.php" class="ajax_contenido">Equipos</a> <a href="ingreso_lanzadores.php" class="ajax_contenido">Lanzadores</a> <a href="ingreso_banqueros.php" class="ajax_contenido">Banqueros</a> <a href="ingreso_intermediarios.php" class="ajax_contenido">Intermediarios</a> <a href="ingreso_taquillas.php" class="ajax_contenido">Taquillas</a> <a href="logros.php" class="ajax_contenido">Logros</a>  <a href="?salir=logout" class="" style="background-color:#900 !important;">Salir del sistema</a> <hr /></div-->

<? 
include_once("procesos/conexion.php");
//echo $tipo_usuario=

/*echo $_SESSION["tipo"];
echo $_SESSION["perfil"];
echo $_SESSION['nombre_tabla']='usuario';
echo $_SESSION["login_user"];
*/

$perfil_usuario=$_SESSION['perfil'];

 $sql="SELECT pa.*, pp.id_perfil_programa, pp.id_perfil_padre, p.*, ppa.*, pa.id_perfil_programa AS idacceso FROM `perfil_accesos` pa
		LEFT JOIN perfil_programas pp ON (pa.id_perfil_programa=pp.id_perfil_programa)
		LEFT JOIN perfiles p ON (pa.id_perfil=p.idperfil)
		LEFT JOIN perfil_padre ppa ON (pp.id_perfil_padre=ppa.id_perfil_padre)
		WHERE pa.id_perfil='$perfil_usuario'
		GROUP BY ppa.perfil_padre";

$sql_query=mysql_query($sql,$conexion);

?>

<div style="position:absolute; top:-38px; right:0px;">
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
					WHERE pa.id_perfil='$perfil_usuario' and ppa.id_perfil_padre='$id_sub' ";
					
			$sub = mysql_query($sub1,$conexion);?>	
            	<? /*<a><? echo $row["subcategoria"]; ?></a><?*/
	               if ($row=mysql_fetch_array($sub)){
						do { ?>                    
			            <li> 	
						<a href="<? echo $row["programa_archivo"]; ?>" class="ajax_contenido"><? echo $row["nombre_programa"]; ?></a>
						</li>
					<? }while ($row=mysql_fetch_array($sub));
				   }?>
		   </ul></li><?
		   }while ($row1=mysql_fetch_array($sql_query));
}?>


			<li class="current">
				<a href="como_apostar.php" class="ajax_contenido">Como apostar?</a>
			</li>	



            <?Php 
			 if($_SESSION['perfil']==1 && $_SESSION['datos']['tipo']==1){?>
			<li class="current">
				<a>Apuestas</a>
				<ul>
					<li>
						<a href="ingreso_tipo_apuestas.php" class="ajax_contenido">Tipos de apuestas</a>
					</li>
                    <li>
						<a href="ingreso_apuestas.php" class="ajax_contenido">Apuestas</a>
					</li>					
				</ul>
			</li>
           
			<li class="current">
				<a>Deportes</a>
                <ul>
					<li>
						<a href="ingreso_categorias.php" class="ajax_contenido">Categorias</a>
					</li>
                    <li>
						<a href="ingreso_ligas.php" class="ajax_contenido">Ligas</a>
					</li>
                    <li>
						<a href="ingreso_equipos.php" class="ajax_contenido">Equipos</a>
					</li>
                    <li>
						<a href="ingreso_lanzadores.php" class="ajax_contenido">Lanzadores</a>
					</li>				
				</ul>
			</li>
            
            <li class="current">
				<a href="ingreso_usuarios.php" class="ajax_contenido">Usuarios</a>                
			</li>
            
            <?Php }?>	
            <?Php if($_SESSION['perfil']<=3 && $_SESSION['datos']['tipo']!=2){?>
            <li class="current">
				<a>Banqueros2</a>
                <ul>
					<?Php if($_SESSION['perfil']==1){?><li><a href="ingreso_banqueros.php" class="ajax_contenido">Banqueros</a></li><?Php }?>	
                    <?Php if($_SESSION['perfil']<=2){?><li><a href="ingreso_intermediarios.php" class="ajax_contenido">Intermediarios</a></li><?Php }?>	
                    <?Php if(($_SESSION['perfil']<3)||($_SESSION['perfil']==3 && $_SESSION['datos']['mt']==1)){?><li><a href="ingreso_taquillas.php" class="ajax_contenido">Taquillas</a></li><?Php }?>	                    				
				</ul>
			</li>
            <?Php }?>	
            <?Php if($_SESSION['perfil']<=2){?>
            <li class="current">
				<a>Logros</a>
                <ul>
                	<?Php if($_SESSION['perfil']==1){?>	<li><a href="logros.php" class="ajax_contenido">Generales</a></li><?Php }?>
                    <?Php if($_SESSION['perfil']==2 && $_SESSION['datos']['ml']==1){?> <li><a href="logros_banqueros.php" class="ajax_contenido">Logros banquero</a></li><?Php }?>
                </ul>
			</li>
            <?Php }?>	
           <?Php if($_SESSION['perfil']==4){?>
             <li>
				<a href="ventas.php" class="ajax_contenido">Ventas</a>
			</li>	
            <?Php }?>
            <?Php if($_SESSION['perfil']<=4){?>
             <li>
				<a href="imprimir_todos_logros.php" target="_blank" class="">Logros del día</a>
			</li>
            <?Php }?>
            <?Php if($_SESSION['perfil']==1 && $_SESSION['datos']['tipo']==1){?>	
			<li>
				<a href="resultados.php" class="ajax_contenido">Resultados</a>
			</li>
            <?Php }?>
            <?Php if($_SESSION['perfil']<=4){?>
            <li>
				<a href="tickets_ganadores.php" class="ajax_contenido">Tickets</a>
			</li>
            <li>
				<a>Reportes</a>
                 <ul>
                	<li><a href="reportes.php" class="ajax_contenido">Ganancias y perdidas</a></li>                    
                </ul>
			</li>
             <li>
				<a>Mantenimiento</a>
                <ul>
                	<li><a href="cambio_clave.php" class="ajax_contenido">Cambio clave</a></li>                    
                </ul>
			</li>
            <?Php }?>
			<li style="background-color:#900 !important;">
				<a href="?salir=logout">Salir del sistema</a>
			</li>	
		</ul>
</td></tr></table>
</div>