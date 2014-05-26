<?Php include("procesos/sesiones.php");
	if($_SESSION['perfil']!=3){
		header("location: index.php");
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM :.</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.6.4.min.js" type="text/javascript" language="javascript"></script> 
<style type="text/css">
	#terminal *{
		cursor:pointer;
	}
</style>
</head>

<body>
	<?Php 
		if($_GET['iot']){ //exit;
			mysql_query("set @tot_tickets=((select count(idticket_detalle) from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."')+1)");
			mysql_query("insert into tickets_detalles() values('','".$_GET['iot']."','',@tot_tickets,'".date('H:i:s')."','','0','0','0','0','0','1')")or die(mysql_error());
			$id_ticket=mysql_insert_id();
			$sel_imp="select *,count(idticket_detalle) as num_tickets,(select count(idticket_detalle) from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."' and estatus=1 and anulado=0 and atendido=0) as en_espera from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."' limit 1";
			$query_imp=mysql_query($sel_imp)or die(mysql_error());
			//exit;
			$var_imp=mysql_fetch_assoc($query_imp);
//			$handle = printer_open("HP Deskjet D1600 series (Copiar 1)");
$handle = printer_open("EPSON TM-T88V ReceiptE4");
$handle='';
if($handle){	
				/*echo "Imprimiendo...";*/
				//ob_start();
$datos_impresion="Fecha: ".date("d/m/Y")."
Hora: ".date("h:i:s A")."

Departamento : ".$var_imp['descripcion_departamento']."
Ticket No: ".$var_imp['num_tickets']."

En espera: ".(int)($var_imp['en_espera']-1)."

Serial ticket No: ".(string)(str_pad($id_ticket,11,'0',STR_PAD_LEFT))."

Vigente solo en la fecha indicada

***********************************
";
eval("\$datos_impresion=\"$datos_impresion\";");
mysql_free_result($query_imp);
				//$datos_impresion=ob_get_contents();
				//ob_end_clean();
				//printer_write($handle, "Texto a imprimir");
				printer_start_doc($handle, "Mi Documento");
				printer_start_page($handle);
				printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_LETTER); 
				
				
				printer_set_option($handle, PRINTER_MODE, "RAW");
				
				//printer_draw_line($handle, 1, 10, 1480, 10); 
				//printer_set_option($handle, PRINTER_MODE, "TEXT");
				//printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_CENTER);
				//printer_draw_text($handle, "Fecha: ".date("d/m/Y"), 10, 30);
				//printer_draw_text($handle, "INSTITUTO NACIONAL DE SAN MARCOS", 10, 30); 
				//printer_set_option($handle, PRINTER_BACKGROUND_COLOR, 'F4F4F4');
				//printer_logical_fontheight($handle, 15); 
				//printer_draw_text($handle, $datos_impresion, 0, 270);
				//printer_write($handle, sprintf($datos_impresion));
				printer_write($handle, $datos_impresion);
				printer_end_page($handle);
				printer_end_doc($handle);
				
				printer_close($handle);
			}
		}
		$sql_taquillas="select *,((numero_tickets)-(select count(*) from tickets_detalles where idticket_encabezado=vista_tickets_departamentos.idticket_encabezado and estatus='1' and anulado='0')) as tdisponible from vista_tickets_departamentos where estatus=1 and fecha=CURDATE() order by descripcion_departamento ";
		$query_taquillas=mysql_query($sql_taquillas);
			$num_taquillas=mysql_num_rows($query_taquillas);
			if($num_taquillas>0){				
					?>
                    	<div id="terminal">
                            <?Php $pares=0;
								while($var_taquillas=mysql_fetch_assoc($query_taquillas)){
									if($pares%2 ==0) $clas='mleft';else $clas='mleft';
									if($var_taquillas['descripcion']=='Operaciones Varias')
										$class_disp='taquilla_disp_ov';
									elseif($var_taquillas['descripcion']=='Discapacitados')
										$class_disp='taquilla_disp_d';
									else								
										$class_disp='taquilla_disp';
									
									?>
									  <div align="" id="<?Php echo $var_taquillas['idticket_encabezado'];?>" class=" todos_disponibles <?Php echo $class_disp;?> <?Php echo $clas;?>" <?Php if($var_taquillas['tdisponible']>0){?>onclick="javascript:imprime_ticket('<?Php echo $var_taquillas['idticket_encabezado'];?>');"<?Php }?>>
                                        	<?Php echo '<label class="subtit">'.$var_taquillas['descripcion_departamento'].'</label>';?>
                                        <div id="f_<?Php echo $var_taquillas['idticket_encabezado'];?>" class="flecha"></div>
                                            <div class="tit_disponibilidad">Quedan: </div>
                                            <div class="disponibilidad" id="dis_<?Php echo $var_taquillas['idticket_encabezado'];?>"><?Php echo $var_taquillas['tdisponible'];?></div>
                                        </div>
									<?Php
									$pares++;
								}
							?>
</div>
                    <?Php
			}else{
				?>
                	<div align="center" class="advertencia">No se han cargado taquillas para el día <?Php echo date("d/m/Y");?></div>
                <?Php
			}
	?>
	<script language="javascript">
		function imprime_ticket(ido){
			var valor_dis=$("#dis_"+ido).html();
			//alert(valor_dis);
			//return false;
				$.ajax({
				  // la URL para la petición
				  url : 'imprime_ticket.php',
			  
				  // la información a enviar
				  // (también es posible utilizar una cadena de datos)
				  data : { iot : ido , valor : valor_dis},
			  
				  // especifica si será una petición POST o GET
				  type : 'GET',
			  
				  // el tipo de información que se espera de respuesta
				  //dataType : 'json',
				 dataType : 'html',
			  
				  // código a ejecutar si la petición es satisfactoria;
				  // la respuesta es pasada como argumento a la función
				  success : function(json) {
					 /* $('<h1/>').text(json.title).appendTo('body');
					  $('<div class="content"/>')
						  .html(json.html).appendTo('body');*/
						  //alert(json);
						  if(json)
						 	$('#dis_'+ido).html(json);
				  },
			  
				  // código a ejecutar si la petición falla;
				  // son pasados como argumentos a la función
				  // el objeto de la petición en crudo y código de estatus de la petición
				  error : function(xhr, status) {
					  alert('Disculpe, existió un problema');
				  },
			  
				  // código a ejecutar sin importar si la petición falló o no
				  complete : function(xhr, status) {
					 // alert('Petición realizada');
				  }
			  });
			}
			
			jQuery('.todos_disponibles').hover(function(evento){
				jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha');
				jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha_hover');
			},function(){
				jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha_hover');
				jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha');
			});
			
	</script>
</body>
</html>