<?Php @session_start(); /*echo $_SESSION['datos']['cmmt'];*/?>
<style type="text/css">
    #calculadora { width: 400px; top:10px; right:10px; background: #DCDCDC url(imagenes/fondo_calculadora.jpg) left top repeat-x; cursor:move; position:fixed; border:#000 1px solid; border-bottom:#000 4px solid; }
	#anularpagar { width: 400px; top:10px; left:10px; background: #DCDCDC url(imagenes/fondo_calculadora.jpg) left top repeat-x; cursor:move; position:fixed; border:#000 1px solid; border-bottom:#000 4px solid; display:none; }
	#items_calculadora{ padding:5px;}
  </style>
  <script>
  var idapuestas='';
  var cmlp='<?Php echo $_SESSION['datos']['cmlp'];?>'; //cmlp: Cantidad Maxima de combinaciones permitidas
  var pmachos='<?Php echo $_SESSION['datos']['cmmt'];?>'; //CONTROLA MACHOS PERMITIDOS
  var phembras='<?Php echo $_SESSION['datos']['cmht'];?>'; //CONTROLA HEMBRAS PERMITIDAS
  var 	machos=hembras=total_juegos=0,
  		descapuestas='',
		paraitemapuestas=0,
		logro_apuestas_='',
		parasetear='',
		imprimir_html='<?Php echo 'impresiones/imprimir_'.session_id().'.html';?>';
		permitir_imprimir='si';
  //la variable "paraitemapuestas" me permitirá controlar los tr ocultos de la calculadora
  //la variable para setear carga un array de los id html que se blanquearan al momento de setear el formulario
  $(document).ready(function() {
    $("#calculadora").draggable();
	$("#anularpagar").draggable();
  });
  </script>
<?Php include_once("procesos/conexion.php"); //sleep(2);
	/*Al insertar o al modificar logros les indico a las taquillas que deben actualizar*/
	mysql_query("update taquillas set actualizar='0' where actualizar='1' and idtaquilla='".$_SESSION['datos']['idtaquilla']."' limit 1");
//$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1'",'4','_','|');

//echo $array_lanzadores.'<hr>';
$_REQUEST['fecha']=date('Y-m-d');
//$_GET['fecha']='23/11/2011';
//print_r($_SESSION);
//echo "squi";
$_REQUEST['liga']=1;
$banquero=$_SESSION['datos']['idbanquero'];
list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']);
?>

<div class="titulo">Logros del día</div>
<form name="form1" method="post" action="procesos/guardar_ventas_beisbol.php">
<div>
<strong>Monto de la apuesta:</strong> <input type="text" name="monto_apuesta" id="monto_apuesta" class="numeric" onkeyup="javascript: calcular_monto_pagar();" required size="5" maxlength="6" value="" style="text-align: right;" />
<strong>N&uacute;mero de apuestas:</strong><input type="text" name="num_apuestas" readonly="readonly" id="num_apuestas" value="0" style="text-align:right;" size="2" maxlength="2" />
<strong>Monto a pagar:</strong><input type="text" name="monto_pagar" readonly="readonly" id="monto_pagar" value="0" style="text-align:right;" size="6" maxlength="10" />
</div><br />

	<?Php
	$cuenta_juego=$total_juegos=0;
	$valores_disponibles_apuestas='';
		//$selectlogros="select * from vista_logros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		//$selectlogros="select * from vista_logros_banqueros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' and idbanquero='".$banquero."' ORDER BY idlogro,idlogro_equipo,que_equipo ASC, nombre_tipo_apuesta ASC";
		$selectlogros="select *,date_format(CONCAT(fecha,' ',hora),'%r') as hora_f from vista_logros_banqueros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idbanquero='".$banquero."' and estatus_categoria_apuesta='1' and hora>='".date('H:i:00')."' and estatus_logro='1' ORDER BY nombre_categoria,idliga,hora,idlogro,idlogro_equipo,que_equipo ASC, nombre_tipo_apuesta ASC";
		
		//echo $selectlogros; exit;
		$querylogros=mysql_query($selectlogros)or die(mysql_error());
		$num_reg=mysql_num_rows($querylogros);
			if($num_reg>0){
				$equipoA='';$equipoB='';$bandera=''; $categoria=$apuestas_permitidas_todas=$apuestas_permitidas='';
					while($varlogros=mysql_fetch_assoc($querylogros)){
						
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							$cuenta_juego++;
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
							//echo $idRosterB; exit;
							genera_encabezado('ventas',$categoria);//tr de datos
							
							
							$bandera='';
							$equipoA='';
							$equipoB='';
							$imagenA='';
							$imagenB=$idRosterA=$idRosterB=$pitcherA=$pitcherB='';
							
						}
						
						//GENERO ENCABEZADOS
						if($categoria!=$varlogros['idcategoria']){
							
							if($categoria!=''){ 
								
								genera_encabezado('total_juegos',$categoria);//tr de totales
								echo '</table>';
								$cuenta_juego=0;
							}
							$categoria=$varlogros['idcategoria'];
							
							//switch($varlogros['idcategoria']){}
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
							
						$array_datos[$varlogros['idcategoria_apuesta']]=array($varlogros['multiplicando'],$varlogros['pago'],$varlogros['idlogro_equipo_categoria_apuesta_banquero']);
						//print_r($varlogros);exit;
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
						genera_encabezado('items_ventas',$varlogros['idcategoria'],$deporte='');
						$valores_disponibles_apuestas.=ob_get_contents();
						ob_end_clean();
						/*TERMINA: TR para la calculadora*/
						//echo $varlogros['idlogro_equipo_categoria_apuesta'].'<br>';
						/*print_r($array_datos[$varlogros['idcategoria_apuesta']]);
						exit;*/
					}
					if($color=='') $color="#ebebeb"; else $color='';
					$cuenta_juego++;
					
                    //switch($categoria){}
					//obtengo datos de los pitchers
					$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
					$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
					//echo $idRosterB; exit;
					genera_encabezado('ventas',$categoria);//tr de datos
					genera_encabezado('total_juegos',$categoria);//tr de totales
                    echo '</table>';
					?>
					<br />
					<div align="center"><input type="button" name="guardar" value="Vender ticket" class="boton" onclick="javascript: control_ventas='si'; comentario='Indique el monto de la apuesta'; nolistado='no'; validar(document.form1,'ventas_beisbol.php'); combinacion_indicada.splice(0,combinacion_indicada.length);" /> <input type="reset" value="Reset" class="boton" onclick="javascript:jQuery('.blanquear').hide('slow'); reset_html(parasetear); machos=hembras=0; combinacion_indicada.splice(0,combinacion_indicada.length);" /></div>
					<?Php
					//echo $total_juegos;
			}else{
			?>
            	<div align="center" class="nencontrado">No se encontraron logros para la fecha</div>
            <?Php
			}
			
	//COMBINACIONES PERMITIDAS		
	$apuestas_permitidas=dameids("select idcategoria_apuesta from categorias_apuestas_combinaciones where estatus='1' group by idcategoria_apuesta");
	
	$apuestas_permitidas_todas=dameids("select concat(idcategoria_apuesta,'_',idcategoria_apuesta_combinar) from categorias_apuestas_combinaciones where estatus='1'");
	
	$apuestas_permitidas_todas.=','.$apuestas_permitidas;
	?>
<script language="javascript">
	var combinaciones_permitidas='<?Php echo $apuestas_permitidas_todas;?>';
	var combinacion_indicada=new Array();
	var permitida_c='no';
	//alert(combinaciones_permitidas);
	function comb_permitida(combinacion){		
		//alert(combinacion);
		var comb,sep,sep2;
		var pcp=combinaciones_permitidas.split(",");//Para combinaciones permitidas
		permitida_c='no';
		sep2=combinacion.split("_");
		combinacion_indicada.push(combinacion);
		//alert(combinacion_indicada);
			for(d=0;d<combinacion_indicada.length;d++){
				sep=combinacion_indicada[d].split("_");
					if(sep[0]==sep2[0]){
						if(comb) comb+='_'+sep[1]; else comb=sep[1];
					}
			}
			
			for(d=0;d<pcp.length;d++){
				if(pcp[d]==comb){
					permitida_c='si';
				}
			}			
	}
	
	function quitar_combinacion(combinacion){
		var idx=combinacion_indicada.indexOf(combinacion);
		combinacion_indicada.splice(idx,1);
		//alert(combinacion+' - '+combinacion_indicada);
	}
	
	total_juegos='<?Php echo $total_juegos;?>';
	//alert(total_juegos);
</script>

<!--//CALCULADORA-->
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
<div align="center"><input type="button" name="guardar" value="Vender ticket" class="boton" onclick="javascript: control_ventas='si'; comentario='Indique el monto de la apuesta'; nolistado='no'; validar(document.form1,'ventas_beisbol.php'); combinacion_indicada.splice(0,combinacion_indicada.length);" /> <input type="reset" value="Reset" class="boton" onclick="javascript:jQuery('.blanquear').hide('slow'); reset_html(parasetear); machos=hembras=0; combinacion_indicada.splice(0,combinacion_indicada.length);" /></div><br />

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
		//alert($(this).attr('pago'));
		if($(this).attr('checked')=='checked'){
			
			//VERIFICO COMBINACION
			comb_permitida($(this).attr('combinacion'));
			if(permitida_c=='no'){
				quitar_combinacion($(this).attr('combinacion'));
				alert("La Combinación no está permitida");
				$(this).attr('checked',false);				
				return false;
			}
			
			
			//Verifico la cantidad de apuestas
			if($('#num_apuestas').val()==cmlp){
				alert("Cantidad Máxima de combinaciones alcanzada el cual es de "+cmlp);
				$(this).attr('checked',false);
				return false;
			}
			
			//Controlo machos y hembras
			if($(this).attr('pago')>0){ /*alert('hembra');*/ hembras++; }else{ /*alert('macho');*/ machos++;}
				if(hembras>phembras){
					alert("Máximo de hembras permitido alcanzado");
					$(this).attr('checked',false);
					hembras--; return false;
				} //alert(machos+' > '+pmachos);
					if(machos>pmachos){
						alert("Máximo de machos permitido alcanzado");
						$(this).attr('checked',false);
						machos--; return false;
					}
				
			$('#num_apuestas').val(parseInt($('#num_apuestas').val())+1);
			$("#apuestaitem_"+$(this).val()).show('slow');
			//alert($(this).val());
		}else{
			
			//Quitar combinacion
			quitar_combinacion($(this).attr('combinacion'));
			
			if($(this).attr('pago')>0) hembras--; else machos--;
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
	
	function ocultar_apuesta(id,valor_pago){
		if(valor_pago>0){hembras--;}else{machos--;}
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
		
		for(mi=0;mi<jQuery(":checked").length;mi++){
			//alert(jQuery(":checked")[i].value);
			for(mj=0;mj<sep_idapuestas.length;mj++){
				if(sep_idapuestas[mj]==jQuery(":checked")[mi].value){
					if(sep_logro_apuestas_[mj]>0)
						acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[mj])/100);
					else
						acum=acum*parseFloat(1+100/(parseFloat(sep_logro_apuestas_[mj])*-1));	
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
	
	//console.error('Error');
	
	function anular_ticket(codigo){
		//alert('entro');
		$.ajax({
			   type: "POST",
			   url: "procesos/guardar_anular_ticket.php",
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
				   alert('Error al anular el ticket '+c);
				   location.href='';
				   return false;
				   /*$("#carga").css("display", "none");
					$("#carga_load3").css("display", "none");	*/				
			   }
			 });
			 
	}
	//Actualizo listado de logros
	setInterval('si_actualizar_logro();',240000);
</script>
<? mysql_close($conexion);?>