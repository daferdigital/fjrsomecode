<?Php include("procesos/sesiones.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.:Parley:.</title>
<link rel="stylesheet" type="text/css" href="css/estilos_parley.css"/>
<script src="js/jquery-1.6.4.min.js" language="javascript"></script>
<script src="js/funciones.js" language="javascript"></script>
<script language="Javascript">
function imprimir() {
print();
}
</script> 
</head>

<body style="font-size:18px;" onLoad="imprimir();">
<div id="general">
<div class="titulo">Logros del día</div>

	<?Php
$ancho=1060;
$soloimp='1';
if(!$_REQUEST['fecha'])	$_REQUEST['fecha']=date('Y-m-d');
list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']);
		//$selectlogros="select * from vista_logros where fecha='".$_REQUEST['fecha']."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$selectlogros="select *,date_format(CONCAT(fecha,' ',hora),'%r') as hora_f from vista_logros where fecha='".$_REQUEST['fecha']."' and estatus_logro='1' ORDER BY nombre_categoria,idliga,hora,nombre_categoria,idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$querylogros=mysql_query($selectlogros);
			if(mysql_num_rows($querylogros)>0){
				$equipoA='';$equipoB='';$bandera='';$categoria='';
					while($varlogros=mysql_fetch_assoc($querylogros)){
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,ganados,perdidos,efectividad,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,ganados,perdidos,efectividad,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
							//echo $idRosterB; exit;
							
							genera_encabezado('impresion',$categoria);//tr de datos
							$bandera='';
							$equipoA='';
							$equipoB='';
							$imagenA='';
							$imagenB=$idRosterA=$idRosterB=$pitcherA=$pitcherB='';
						}
						
						//GENERO ENCABEZADOS
						if($categoria!=$varlogros['idcategoria']){
							if($categoria!='') echo '</table>';
							$categoria=$varlogros['idcategoria'];
								genera_encabezado('encabezado',$varlogros['idcategoria'],$varlogros['nombre_categoria']);//tabla de encabezados
						}
						
						if($equipoA==''){
							$equipoA=$varlogros['nombre_equipo'];
							$refA=' <b>'.$varlogros['referencia'].'</b>';
							$hora=$varlogros['hora_f'];
							$imagenA=$varlogros['imagen_equipo'];
							$idRosterA=$varlogros['idroster'];
						}elseif($equipoA!=$varlogros['nombre_equipo']){
							$equipoB=$varlogros['nombre_equipo'];
							$refB=' <b>'.$varlogros['referencia'].'</b>';
							$imagenB=$varlogros['imagen_equipo'];
							$idRosterB=$varlogros['idroster'];
						}
							
						$array_datos[$varlogros['idcategoria_apuesta']]=array($varlogros['multiplicando'],$varlogros['pago']);
						/*print_r($array_datos[$varlogros['idcategoria_apuesta']]);
						exit;*/
					}
					if($color=='') $color="#ebebeb"; else $color='';
					//switch($categoria){}
					
					//obtengo datos de los pitchers
					$pitcherA=dame_datos("select nombre,ganados,perdidos,efectividad,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
					$pitcherB=dame_datos("select nombre,ganados,perdidos,efectividad,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
					//echo $idRosterB; exit;
					
					genera_encabezado('impresion',$categoria);//tr de datos
					echo '</table>';
			}else{
				?>
					<div align="center"><h2>No se han habilitado logros para hoy</h2></div>
				<?Php
			}
	?>
</div>

</body>
</html>