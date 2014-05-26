<?Php
	include("procesos/conexion.php");
	
	if($_GET['iot'] && ($_GET['valor']>0)){ //exit;
			mysql_query("set @tot_tickets=((select count(idticket_detalle) from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."')+1)");
			mysql_query("insert into tickets_detalles() values('','".$_GET['iot']."','',@tot_tickets,'".date('H:i:s')."','','0','0','0','0','0','1')")or die(mysql_error());
			$id_ticket=mysql_insert_id();
			$sel_imp="select *,count(idticket_detalle) as num_tickets,(select count(idticket_detalle) from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."' and estatus=1 and anulado=0 and atendido=0) as en_espera from vista_tickets_detalles_departamentos where idticket_encabezado='".$_GET['iot']."' limit 1";
			$query_imp=mysql_query($sel_imp)or die(mysql_error());
			//exit;
			$var_imp=mysql_fetch_assoc($query_imp);
			//$handle = printer_open("HP Deskjet D1600 series (Copiar 1)");
			//documentado por estar en web 
			$handle = printer_open("EPSON TM-T88V ReceiptE4");
			//$handle = printer_open("\\\\TQTT02\\hp psc 1310 series");
			
			//$handle='';
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
				printer_start_doc($handle, "Mi Documento"); //documentar solo para hp
				printer_start_page($handle); //documentar solo para hp
				printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_LETTER); //documentar solo para hp
				
				
				printer_set_option($handle, PRINTER_MODE, "RAW");
				//printer_set_option($handle, PRINTER_MODE, "TEXT");
				
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
				printer_end_page($handle); //documentar solo para hp
				printer_end_doc($handle); //documentar solo para hp
				
				printer_close($handle);
			}
		
	
		$sql_taquillas="select *,((numero_tickets)-(select count(*) from tickets_detalles where idticket_encabezado=vista_tickets_departamentos.idticket_encabezado and estatus='1' and anulado='0')) as tdisponible from vista_tickets_departamentos where estatus=1 and fecha=CURDATE() and idticket_encabezado='".$_GET['iot']."' order by descripcion_departamento limit 1";
		$query_taquillas=mysql_query($sql_taquillas);
			$num_taquillas=mysql_num_rows($query_taquillas);
			if($num_taquillas>0){
				$var_taquillas=mysql_fetch_assoc($query_taquillas);
				echo $var_taquillas['tdisponible'];
			}
	}
?>