<?Php @session_start();?>
<style type="text/css">
    #calculadora { width: 400px; top:10px; right:10px; background: #DCDCDC url(imagenes/fondo_calculadora.jpg) left top repeat-x; cursor:move; position:fixed; border:#000 1px solid; border-bottom:#000 4px solid; }
	#anularpagar { width: 400px; top:10px; left:10px; background: #DCDCDC url(imagenes/fondo_calculadora.jpg) left top repeat-x; cursor:move; position:fixed; border:#000 1px solid; border-bottom:#000 4px solid; display:none; }
	#items_calculadora{ padding:5px;}
  </style>
  <script>
  var idapuestas='';
  var descapuestas='',paraitemapuestas=0,logro_apuestas_='',parasetear='';
  //la variable "paraitemapuestas" me permitirá controlar los tr ocultos de la calculadora
  //la variable para setear carga un array de los id html que se blanquearan al momento de setear el formulario
  $(document).ready(function() {
    $("#calculadora").draggable();
	$("#anularpagar").draggable();
  });
  </script>
<?Php include_once("procesos/conexion.php"); sleep(2);
//$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1'",'4','_','|');

//echo $array_lanzadores.'<hr>';
$_GET['fecha']=date('d/m/Y');
//$_GET['fecha']='23/11/2011';
//print_r($_SESSION);
//echo "squi";
$_REQUEST['liga']=1;
$banquero=$_SESSION['datos']['idbanquero'];

?>

<div class="titulo">Logros del día</div>
<form name="form1" method="post" action="procesos/guardar_ventas_beisbol.php">
<div>
<strong>Monto de la apuesta:</strong> <input type="text" name="monto_apuesta" id="monto_apuesta" class="numeric" onkeyup="javascript: calcular_monto_pagar();" required size="5" maxlength="5" value="" style="text-align: right;" />
<strong>N&uacute;mero de apuestas:</strong><input type="text" name="num_apuestas" readonly="readonly" id="num_apuestas" value="0" style="text-align:right;" size="2" maxlength="2" />
<strong>Monto a pagar:</strong><input type="text" name="monto_pagar" readonly="readonly" id="monto_pagar" value="0" style="text-align:right;" size="6" maxlength="6" />
</div><br />
<table width="100%" cellspacing="0" cellpadding="3" class="">
	<tr class="titulo_tablas"><td colspan="10" align="center">Logros del Día <?Php list($dia,$mes,$ano)=explode("/",$_GET['fecha']); echo "$dia/$mes/$ano";?></td></tr>
	
	<tr class="titulo_tablas_negro" align="center"><td>Hora</td><td>Equipos</td>
	<td colspan="2">A Ganar</td><td colspan="2">Run line</td><td colspan="2">Alta o Baja</td><td>Si y No</td><td>Anota 1ro</td></tr>
    <tr class="titulo_tablas" align="center">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  
	  <td>9 inning</td>
	  <td>5 inning</td><td>9 inning</td>
	  <td>5 inning</td>
	  <td>9 inning</td>
	  <td>5 inning</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr><td colspan="10">&nbsp;</td></tr>
	<?Php
	$cuenta_juego=0;
	$valores_disponibles_apuestas='';
		//$selectlogros="select * from vista_logros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$selectlogros="select * from vista_logros_banqueros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' and idbanquero='".$banquero."' ORDER BY idlogro,idlogro_equipo,que_equipo ASC, nombre_tipo_apuesta ASC";
		
		//echo $selectlogros; exit;
		$querylogros=mysql_query($selectlogros)or die(mysql_error());
		$num_reg=mysql_num_rows($querylogros);
			if($num_reg>0){
				$equipoA='';$equipoB='';$bandera=''; 
					while($varlogros=mysql_fetch_assoc($querylogros)){
						
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							$cuenta_juego++;
							?>
								<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[23][2] ?>" /></td><td align="left"><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[24][2] ?>" /><?php echo $array_datos[24][1] ?></td><td align="center"><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[27][2].'" /> '.$array_datos[27][1]; ?></td><td align="center"><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[29][2].'" /> '.$array_datos[29][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[31][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[31][2].'" /> ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[32][2].'" /> ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[33][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[33][2].'" /> ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[34][2].'" /> ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'<input type="checkbox" name="apuesta[]" value="'.$array_datos[39][2].'" />(SI)<br>'.$array_datos[40][1].'<input type="checkbox" name="apuesta[]" value="'.$array_datos[40][2].'" />(NO)' ?></td><td align="right"><?php echo $array_datos[37][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[37][2]; ?>" /></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[25][2] ?>" /></td><td align="left"><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[26][2] ?>" /><?php echo $array_datos[26][1] ?></td><td align="center"><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[28][2].'" /> '.$array_datos[28][1]; ?></td><td align="center"><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[30][2].'" /> '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[38][2]; ?>" /></td></tr>
                                <tr><td colspan="10">&nbsp;</td></tr>
							<?Php
							$bandera='';
							$equipoA='';
							$equipoB='';
						}
						
						if($equipoA==''){
							$equipoA=$varlogros['nombre_equipo'].' <b>(Ref. '.$varlogros['referencia'].')</b>';
							$hora=$varlogros['hora'];
						}elseif($equipoA!=$varlogros['nombre_equipo']){
							$equipoB=$varlogros['nombre_equipo'].' <b>(Ref. '.$varlogros['referencia'].')</b>';
						}
							
						$array_datos[$varlogros['idcategoria_apuesta']]=array($varlogros['multiplicando'],$varlogros['pago'],$varlogros['idlogro_equipo_categoria_apuesta_banquero']);
						
						//para la calculadora
						?>
							<script language="javascript">
								if(idapuestas){
									idapuestas+=',';
									descapuestas+=',';
									logro_apuestas_+=',';
								}
								idapuestas+='<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>';
								descapuestas+='<?Php echo $varlogros['nombre_apuesta'];?>';
								logro_apuestas_+='<?Php echo $varlogros['pago'];?>';
							</script>
						<?Php
						/*INICIA: TR para la calculadora*/
						ob_start();
						$equipo_apuesta=$tp=$mult=$valor_logro='';
						switch($varlogros['idcategoria_apuesta']){
							case '24': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
							case '26': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
							case '23': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
							case '25': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
							case '27': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];
							break;
							case '28': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];
							break;
							case '29': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];
							break;
							case '30': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];
							break;
							case '31': $tp='A';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);
							break;
							case '32': $tp='B';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);
							break;
							case '33': $tp='A';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);
							break;
							case '34': $tp='B';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);
							break;
							case '39': $tp='Si';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;
							break;
							case '40': $tp='No';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;
							break;
							case '37': $tp='AP';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
							case '38': $tp='AP';$equipo_apuesta=$varlogros['nombre_equipo'];
							break;
						}
						$valor_logro=$varlogros['pago'];
						?><tr id="apuestaitem_<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>" style="display:none; background-color:#FFF;" class="blanquear borde_bottom"><td><?Php echo $tp;?></td><td align="right"><?Php echo $mult;?></td><td><?Php echo $equipo_apuesta;?></td><td align="right"><?Php echo $valor_logro;?></td><td width="10px" align="right"><a href="javascript:ocultar_apuesta('<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>')"><img src="imagenes/eliminar.png" width="10px" border="0" /></a></td></tr><?Php
						$valores_disponibles_apuestas.=ob_get_contents();
						ob_end_clean();
						/*TERMINA: TR para la calculadora*/
						//echo $varlogros['idlogro_equipo_categoria_apuesta'].'<br>';
						/*print_r($array_datos[$varlogros['idcategoria_apuesta']]);
						exit;*/
					}
					if($color=='') $color="#ebebeb"; else $color='';
					$cuenta_juego++;
					?>
                    <tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[23][2] ?>" /></td><td align="left"><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[24][2] ?>" /><?php echo $array_datos[24][1] ?></td><td align="center"><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[27][2].'" /> '.$array_datos[27][1]; ?></td><td align="center"><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[29][2].'" /> '.$array_datos[29][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[31][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[31][2].'" /> ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[32][2].'" /> ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[33][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[33][2].'" /> ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].' <input type="checkbox" name="apuesta[]" value="'.$array_datos[34][2].'" /> ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'<input type="checkbox" name="apuesta[]" value="'.$array_datos[39][2].'" />(SI)<br>'.$array_datos[40][1].'<input type="checkbox" name="apuesta[]" value="'.$array_datos[40][2].'" />(NO)' ?></td><td align="right"><?php echo $array_datos[37][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[37][2]; ?>" /></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[25][2] ?>" /></td><td align="left"><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[26][2] ?>" /><?php echo $array_datos[26][1] ?></td><td align="center"><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[28][2].'" /> '.$array_datos[28][1]; ?></td><td align="center"><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).' <input type="checkbox" name="apuesta[]" value="'.$array_datos[30][2].'" /> '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?><input type="checkbox" name="apuesta[]" value="<?php echo $array_datos[38][2]; ?>" /></td></tr>
                    <?Php
			}
	?>
    <tr><td colspan="10" align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego;?></td></tr>
</table><br />
<div align="center"><input type="button" name="guardar" value="Vender ticket" class="boton" onclick="javascript: control_ventas='si'; comentario='Indique el monto de la apuesta'; nolistado='no'; validar(document.form1,'ventas_beisbol.php');" /> <input type="reset" value="Reset" class="boton" onclick="javascript:jQuery('.blanquear').hide('slow'); reset_html(parasetear);" /></div>


<div id="calculadora"><img src="imagenes/header_calculadora.jpg" border="0" />
<div id="items_calculadora">
<b>Parley</b><br /><br />
<!--<strong>Ticket Nro.</strong> XXXXXX<br />
<strong>Serial Nro.</strong> XXXXXX<br />-->
<strong>Taquilla:</strong> <?Php echo $_SESSION['datos']['nombre'];?><br />
<!--Fecha <?Php echo date("d/m/Y");?><br />
Hora <?Php echo date("H:i:s");?><br /><br />-->
<strong>Monto de la apuesta Bs:</strong> <label id="monto_indicado">0</label><br /><br />
<div style=" overflow:auto;">
<table width="100%" cellspacing="0" cellpadding="4">
	<tr style="font-weight:bold; text-align:center; background-color: #000; color:#CCC;"><td title="Tipo de Apuesta" width="10px">TP</td><td width="25px"></td><td>Equipo</td><td width="10px">Logro</td><td width="10px"></td></tr>    
    <?Php
	echo $valores_disponibles_apuestas;
		
	?>
  <tr><td colspan="5" align="right"><strong>Monto a pagar:</strong> <label id="mpagar">0</label></td>
</table>
</div>
</div>
<div id="total_calculadora"></div>
</div>

<!-- ANULAR Y PAGAR TICKETS-->

<div id="anularpagar"><img src="imagenes/header_anular.jpg" border="0" /><div align="right" style="padding-right:2px; padding-top:2px;"><input type="button" class="boton" value="Cerrar" onclick="javascript:$('#anularpagar').hide('slow')" /></div>
<div id="items_calculadora">
<b>Parley</b><br /><strong><?Php echo date("d/m/Y");?></strong>
<br /><br />
<div id="estatus_anulado" style="color:#900;"></div>
<strong>Indique el codigo del ticket:</strong> <input type="text" id="cod_ticket" name="cod_ticket" class="numeric" value="" /><br />
<input type="button" value="Anular" class="boton" onclick="javascript: if($('#cod_ticket').val()==''){alert('Indique el codigo del ticket');}else{anular_ticket($('#cod_ticket').val());}" />

</div>
<div id="total_calculadora"></div>
</div>

<!--<p id="aqui">eee
</p>-->
<input type="hidden" name="fecha" value="<?Php echo $ano.'-'.$mes.'-'.$dia;?>" />
</form>
<script language="javascript">
var sep_idapuestas='',sep_logro_apuestas_='',acum=1;
	$(":checkbox").click(function(){		
		//alert($(this).val());
		if($(this).attr('checked')=='checked'){
			$('#num_apuestas').val(parseInt($('#num_apuestas').val())+1);
			$("#apuestaitem_"+$(this).val()).show('slow');
			//alert($(this).val());
		}else{
			$('#num_apuestas').val(parseInt($('#num_apuestas').val())-1);
			$("#apuestaitem_"+$(this).val()).hide('slow');
		}
		
		calcular_monto_pagar();
		
	});
	
	$(":checkbox").css('cursor','pointer');
	
	//variables para control de categoria y liga seleccionada
	categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
	liga_sel="<?php echo $_REQUEST['liga']; ?>";
	
	comentario='';
	nolistado='';
	function ver_obj(){
		for(i=0;i<jQuery("form :text,form select").length;i++){
			alert(jQuery("form :text,form select")[i].name);
		}
	}
	
	function ocultar_apuesta(id){
		$("#apuestaitem_"+id).hide('slow');
		$('[value="'+id+'"]').attr('checked',false);
		$('#num_apuestas').val(parseInt($('#num_apuestas').val())-1);
		calcular_monto_pagar();
			//if($('#num_apuestas').val()==0) $('#num_apuestas').val('');
	}
	
	function calcular_monto_pagar(){
		acum=1;
		jQuery("#monto_indicado").html(jQuery("#monto_apuesta").val()+' BsF.');
		//alert(jQuery(':checked').length);
		sep_idapuestas=idapuestas.split(",");
		sep_logro_apuestas_=logro_apuestas_.split(",");
		
		for(i=0;i<jQuery(":checked").length;i++){
			//alert(jQuery(":checked")[i].value);
			for(j=0;j<sep_idapuestas.length;j++){
				if(sep_idapuestas[j]==jQuery(":checked")[i].value){
					if(sep_logro_apuestas_[j]>0)
						acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[j])/100);
					else
						acum=acum*parseFloat(1+100/(parseFloat(sep_logro_apuestas_[j])*-1));	
					break;
				}
			}
		}
		if(jQuery("#monto_apuesta").val())
			acum=redondeo2decimales(parseFloat(parseFloat(jQuery("#monto_apuesta").val())*parseFloat(acum)));
		else
			acum=redondeo2decimales(parseFloat(acum));	
		//alert(acum);
		jQuery("#mpagar").html(acum+' BsF.');
		jQuery("#monto_pagar").val(acum);
	}
	
	parasetear='mpagar,monto_indicado';
	/*function posicion_control(){
		//$("div").bind("mousemove");
		$('div').mousemove(function(e){
			//muestra las coordenadas X e Y en un parrafo
			$('#aqui').html("X Axis : " + e.pageX + " | Y Axis " + e.pageY);
			$("div").unbind("mousemove");
		});
	}
	*/
	/*function posicion_control(){
		//$("div").bind("mousemove");
		$('div').mousemove(function(e){
			//muestra las coordenadas X e Y en un parrafo
			$('#aqui').html("X Axis : " + e.pageX + " | Y Axis " + e.pageY);
			$("div").unbind("mousemove");
		});
	}
	
	setInterval('posicion_control()',5000);*/
	//setInterval('$("div").mousemove(function(e){ $("#aqui").html("X Axis : " + e.pageX + " | Y Axis " + e.pageY);});$("div").unbind("mousemove");',5000);
	//alert(idapuestas+' \n '+descapuestas);
	
	$(".numeric").numeric();
	
	//pruebas enrony con jQuery xD
	//console.log('Desarrollado por enrony -> www.enrony.com :)');
	//console.error('Error');
	
	function anular_ticket(codigo){
		//alert('entro');
		$.ajax({
			   type: "POST",
			   url: "procesos/anular_ticket.php",
			   data: { codigo_ticket : codigo },
			   datatype:'html',
			   success: function(msg){
			   
				//alert(msg);
				$('#cod_ticket').val('');
				$('#estatus_anulado').html(msg);
				$('#estatus_anulado').show('slow');					 
					 setTimeout('$("#estatus_anulado").hide("slow");',5000);
			   },
			   error:function(a,b,c){
				   alert(c);
				   /*$("#carga").css("display", "none");
					$("#carga_load3").css("display", "none");	*/				
			   }
			 });
			 
	}
	
</script>
