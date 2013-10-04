<?Php session_start();
	$fechas=getdate(mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
	
	if($_GET['fdesde']){
		$fecha_desde=$_GET['fdesde'];
		$fecha_hasta= $_GET['fhasta'];
	}else{
		$fecha_desde=date("d/m/Y");	
		$can_dias = 1;
		$fec_emision = date('m/d/Y');
		$fecha_hasta= date("d/m/Y"); ///, strtotime("$fec_emision + $can_dias day"));  
	}
	
	$solo_ganadores=$_GET["fil"];
	if($solo_ganadores=='G'){
		$fil1="AND (ganador='1' OR recalculado='1' OR reembolsar='1') ";
	}
	
	$estado_ticket=$_GET["estado"];
	if($estado_ticket=='1'){
		///Anulados
		echo $fil_ticket="and anulado='1'";
	}else if($estado_ticket=='2'){
		///Ganadores y Pagados
		$fil_ticket="and ganador='1'";			
	}else if($estado_ticket=='3'){
		///Perdedores
		$fil_ticket="and perdedor='1'";
	}else if($estado_ticket=='4'){
		///Vendidos
		$fil_ticket="and anulado='0' and ganador='0' and perdedor='0' and vencido='0'";
	}else if($estado_ticket=='5'){
		///Vencido
		$fil_ticket="and vencido='1'";
	}else if($estado_ticket=='6'){
		///recalculados
		$fil_ticket="and recalculado='1'";
	}else if($estado_ticket=='7'){
		///reembolsados
		$fil_ticket="and reembolsar='1'";
	}else{}
?>
<input name="fil" id="fil"  type="hidden" value="<?Php echo $solo_ganadores;?>" />
<div align="center"><strong>Desde:</strong> <input type="text" name="fdesde" id="fdesde" readonly="readonly" value="<?Php echo $fecha_desde;?>" class="fecha" style="cursor:pointer;" /> <strong>Hasta:</strong> <input type="text" name="fhasta" id="fhasta" readonly="readonly" value="<?Php echo $fecha_hasta;?>" class="fecha" style="cursor:pointer;" /> 

Tickets <select name="estado" id="estado">
 	<option value="0" selected="selected">Todos</option>
 	<option value="1" <? if($estado_ticket=='1')echo "selected='selected'";?>>Anulados</option>    
 	<option value="2" <? if($estado_ticket=='2')echo "selected='selected'";?>>Ganadores y Pagados</option>
 	<option value="3" <? if($estado_ticket=='3')echo "selected='selected'";?>>Perdedores</option>
 	<option value="4" <? if($estado_ticket=='4')echo "selected='selected'";?>>Vendidos</option>
 	<option value="5" <? if($estado_ticket=='5')echo "selected='selected'";?>>Vencido</option>
 	<option value="6" <? if($estado_ticket=='6')echo "selected='selected'";?>>Recalculados</option>
 	<option value="7" <? if($estado_ticket=='7')echo "selected='selected'";?>>Reembolsados</option>
</select>

 <input type="button" class="boton" id="carga_formulario" value="Buscar" /><br></div>
<div id="rep_dinamico">
<?Php
	include_once('procesos/conexion.php');
	//$sql_ventas="select *,date_format(fecha_venta,'%d/%m/%Y') as fecha_venta,date_format(fecha_prorroga,'%d/%m/%Y') as fecha_prorroga from vista_ventas_detalles where fecha_venta>=DATE_SUB(CURDATE(), INTERVAL 1 DAY) and estatus_ventas='1' group by idventa order by fecha_venta desc,idventa";
	$concat='';
	switch($_SESSION["perfil"]){
		case '2':
			$concat=" and idbanquero='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' ";
		break;
		case '3':
			$concat=" and idintermediario='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' ";
		break;
		case '4':
			$concat=" and idtaquilla='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' ";
		break;
	}
	$sql_ventas="select *,date_format(fecha_venta,'%d/%m/%Y') as fecha_venta,date_format(fecha_prorroga,'%d/%m/%Y') as fecha_prorroga from vista_ventas_detalles where fecha_venta>='".formato_sql($fecha_desde,'/')."' and fecha_venta<='".formato_sql($fecha_hasta,'/')."' and estatus_ventas='1' $fil1 $fil_ticket $concat group by idventa order by fecha_venta desc,idventa";
	//echo $sql_ventas.' / '.$_SESSION["perfil"];
	//print_r($_SESSION);
	$query_ventas=mysql_query($sql_ventas);
		if(mysql_num_rows($query_ventas)>0){ $contador=1;
			?>
				<table align="center" width="95%" cellspacing="0">
                	<tr align="center" class="titulo_tablas"><td>ID</td><td>TICKET</td><td>EMITIDO</td><td>EXPIRA</td><td>MONTO APUESTA</td><td>MONTO A PAGAR</td><td>MONTO PAGADO</td><td>ESTADO</td><td>TAQUILLA</td></tr>
                    
			<?Php
			while($var_sql=mysql_fetch_assoc($query_ventas)){
				if($color=='') $color="#ebebeb"; else $color='';				
			?>
            	<tr class=""><td colspan="9" style="height:3px;"></td></tr>
            	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                <td align="center" class="borde_left"><?Php echo $contador;?></td>
                <td align="center" style="font-weight:bold;">

                <a href="#" onclick="javascript: window.open('detalle_ticket.php?idticket=<?Php echo $var_sql['idventa'];?>', '', 'toolbar=,location=no,status=no,menubar=yes,scroll bars=yes, resizable=no,width=530,height=400'); return false" class="mainlevel" >
					<?Php echo str_pad($var_sql['codigo_ticket'],8,'0',STR_PAD_LEFT);/*echo 'T'.str_pad($var_sql['codigo_ticket'],8,'0',STR_PAD_LEFT).' - C'.$var_sql['codigo_cliente'];*/?>
                </a>
                </td><td><?Php echo $var_sql['fecha_venta'].' - '.$var_sql['hora'];?></td><td><?Php echo $var_sql['fecha_prorroga'];?></td><td align="right"><?Php echo $var_sql['apuesta'];?> BsF.</td><td align="right"><?Php echo $var_sql['total_ganar'];?> BsF.</td><td align="right"><?Php 
				
					if($var_sql['anulado']=='1'){echo "0.00";}else{echo $var_sql['monto_real_pagar'];} 
					
					////				echo $var_sql['monto_real_pagar'];?> 
					BsF.</td><td>
                	<?Php
						
						if($var_sql['reembolsado']):
							echo "<label class='reembolsar'>Reembolsado</label>";
						elseif($var_sql['reembolsar']):
							echo "<label class='reembolsar'>Reembolsar</label>";
						elseif($var_sql['recalculado']):
							echo "<label class='recalculado'>Recalculado</label>";
						elseif($var_sql['anulado']):
							echo "<label class='anulado'>Anulado</label>";
						elseif($var_sql['vencido']):
							echo "<label class='vencido'>Vencido</label>";
						elseif($var_sql['pagado']):
							echo "<label class='pagado'>Pagado</label>";
						elseif($var_sql['ganador']):
							echo "<label class='ganador'>Ganador</label>";
						elseif($var_sql['perdedor']):	
							echo "<label class='perdedor'>Perdedor</label>";
						else:
							echo "<label class='pendiente'>Vendido</label>";	
						endif;
					?>
                </td><td><?Php echo $var_sql['nombre_taquillla'];?></td></tr>
            <?Php
				$contador++;
			}
			?>
				</table>
			<?Php
		}else{?><div style="height:100px; vertical-align:middle; text-align:center; font-size:14px; font-weight:bold;">
        			<br><br>No hay resultados para la b&uacute;squeda seleccionada
                </div><?
}
?>
</div>
<script language="javascript">
	$(document).ready(function() {
           $(".fecha").datepicker();
		   $("#carga_formulario").click(function(evento){
			
			  evento.preventDefault();
			  //alert($("#scategorias").val());
			  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
			  //$("#rep_dinamico").load("procesos/rep_tickets.php?fdesde="+$("#fdesde").val()+"&fhasta="+$("#fhasta").val(), function(response, status, xhr){
				$("#contenido_padre").load("tickets_ganadores.php?fdesde="+$("#fdesde").val()+"&fhasta="+$("#fhasta").val()+"&fil="+$("#fil").val()+"&estado="+$("#estado").val(), function(response, status, xhr){
				  if (status == "error") {
					  alert('Pagina para la categoria no encontrada, o se esta presentando problemas de conexión... intente de nuevo!!!');					  
				  }
					 $("#carga_load").css("display", "none");
					 $("#carga").css("display", "none");
				  
			  });
			
	   });		   
    });
	
</script>