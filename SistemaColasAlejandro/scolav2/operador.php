<?Php 
	include_once("classes/DBUtil.php");
	include_once("includes/header.php");
?>
	<?Php
		if($_GET['habilitar']){
			mysql_query("update tickets_detalles set anulado=0 where anulado=1 and idticket_detalle='".$_GET['habilitar']."' limit 1");
			?>
				<script language="javascript">
					jQuery(document).ready(function(){
						jQuery('#mensaje_eventos').html('Ticket habilitado con éxito');
						jQuery('#mensaje_eventos').show('slow');
						setTimeout("jQuery('#mensaje_eventos').hide('slow');",5000);
					});
				</script>
			<?Php
		}
		if($_GET['anular']){
			mysql_query("update tickets_detalles set atendiendo=0, anulado=1, hora_atendido='".date('H:i:s')."' where idticket_detalle='".$_GET['anular']."' limit 1");
		}
		if($_GET['llamar']&&($_GET['llamar']!=$_SESSION['llamar'])){
			$_SESSION['llamar']=$_GET['llamar'];
			//BUSCO CUAL SE ESTA ATENDIENDO
				$sql_atndo="select idticket_detalle from vista_tickets_detalles_departamentos where atendiendo=1 and idoperador_taquilla='".$_SESSION['datos']['idoperador_taquilla']."' and fecha=CURDATE() limit 1";
				$query_atndo=mysql_query($sql_atndo);
					if(mysql_num_rows($query_atndo)>0){
						$var_atndo=mysql_fetch_assoc($query_atndo);
						mysql_query("update tickets_detalles set atendiendo=0,atendido=1,llamando=0,hora_atendido='".date('H:i:s')."' where idticket_detalle='".$var_atndo['idticket_detalle']."' limit 1");
						mysql_free_result($query_atndo);
					}
					
				$sql_disponibilidad="select idticket_detalle from vista_tickets_detalles_departamentos where fecha=CURDATE() and estatus=1 and anulado=0 and atendido=0 and fecha=CURDATE() and iddepartamento='".$_SESSION['datos']['iddepartamento']."' ";	
				$num_disponibilidad=mysql_num_rows(mysql_query($sql_disponibilidad));
					if($num_disponibilidad>0){
						mysql_query("update vista_tickets_detalles_departamentos set llamando=0 where fecha=CURDATE()");
						//mysql_query("update vista_tickets_detalles_departamentos set llamando=1,atendiendo=1 where  fecha=CURDATE() and estatus=1 and anulado=0 and atendido=0 and idoperador='".$_SESSION['datos']['idoperador']."' order by hora limit 1");
						$up="update vista_tickets_detalles_departamentos set llamando=1,atendiendo=1,idoperador_taquilla='".$_SESSION['datos']['idoperador_taquilla']."' where fecha = CURDATE() AND `iddepartamento` = '".$_SESSION['datos']['iddepartamento']."' and estatus=1 and anulado=0 and atendido=0 and atendiendo=0 LIMIT 1";
						//echo $up; exit;
						mysql_query($up);
					}else{
						//echo  "no";
					}
				
		}
	?>
<div id="mensaje_eventos" style="display:none;"></div>
    	<table align="left" width="300px">
        <tr><td align="right"><label class="subtit_form">Departamento: </label></td><td><?Php echo $_SESSION['datos']['descripcion_departamento'];?></td></tr>
        <tr><td align="right"><label class="subtit_form">Taquilla: </label></td><td><?Php echo $_SESSION['datos']['descripcion_taquilla'];?></td></tr>
        <tr><td align="right"><label class="subtit_form">Operador: </label></td><td><?Php echo $_SESSION['datos']['nombre'];?></td></tr>
        <tr><td align="right"><label class="subtit_form">Cedula: </label></td><td><?Php echo $_SESSION['datos']['cedula'];?></td></tr></table>
        <table width="500px">
        	<tr><td align="right">Si desea habilitar un ticket anulado presione <label onclick="javascript:jQuery('#hab_ta').show('slow');"><b>AQU&Iacute;</b></label></td></tr>
            <tr style="display:none;" id="hab_ta"><td align="right" bgcolor="#990000" style="color:#FFF;"><strong>Indique el N&deg; de serial: </strong><input type="text" name="ticket_anulado" value="" /><input type="button" value="Habilitar" onclick="javascript: if(jQuery('[name=\'ticket_anulado\']').val()){location.href='?habilitar='+jQuery('[name=\'ticket_anulado\']').val();}else{alert('Indique el serial del ticket');}" /></td></tr>
        </table>
<div style="width:800px; height:40px; position:relative; clear:both;">
        	
        	<div align="left" style="float:left; width:400px;">
            	<label class="subtit_form" style="color:#00F;">Atendiendo al ticket n&uacute;mero: </label><label id="anumero" class="anumero" style="color:#F00;">0
                </label>
                <!--<label class="subtit_form"><br />Ultimo ticket atendido: </label><label id="uatendido" class="anumero">0</label>-->
            </div>
            <div align="right" style="float:left; width:400px;">
             
              <input type="button" value="LLAMAR SIGUIENTE" border="0" style="cursor:pointer; background-color:#030; color:#CCC; font-weight:bold; padding:3PX; border:#000 2px solid;" onclick="javascript:location.href='?llamar=<?Php echo rand(1,9000);?>';" />
            </div>
        </div>
	<p>
	  <?Php 
		mysql_query("set @atendidos=0,@total_valido=0,@estatus_tic='',@ultimo_atendido='00:00:00'");
		$sql_taquillas="
						select 
								*,
								if(atendido=1,@atendidos:=@atendidos+1,@atendidos) as atender, 
								if(@ultimo_atendido='00:00:00',@ultimo_atendido:=(select hora_atendido from vista_tickets_detalles_departamentos where atendido='1' and fecha=CURDATE() and idoperador_taquilla='".$_SESSION['datos']['idoperador_taquilla']."' order by hora_atendido desc limit 1),@ultimo_atendido) as uatendido,
								if(@total_valido=0,@total_valido:=(select count(*) from vista_tickets_detalles_departamentos where estatus=1 and anulado=0 and fecha=CURDATE() and atendido=0 and iddepartamento='".$_SESSION['datos']['iddepartamento']."'),@total_valido) as tvalido,
								if(estatus=1,@estatus_tic:='En espera',@estatus_tic:='Anulado') as estatus_ticket,
								if(anulado=1,@estatus_tic:='Anulado',@estatus_tic) as estatus_ticket,
								if(atendiendo=1,@estatus_tic:='Atendiendo',@estatus_tic) as estatus_ticket,
								if(atendido=1,@estatus_tic:='Atendido',@estatus_tic) as estatus_ticket								
						from 
								vista_tickets_detalles_departamentos 
						where 								
								fecha=CURDATE() and 
								iddepartamento='".$_SESSION['datos']['iddepartamento']."' 
						order by 								
								atendiendo desc, atendido asc, idticket_detalle ASC";
		$query_taquillas=mysql_query($sql_taquillas) or die(mysql_error());
			$num_taquillas=mysql_num_rows($query_taquillas);
			if($num_taquillas>0){				
					?>
  </p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div id="terminal" >
        <?Php $pares=0; $contador=1; $uatendido=0;
							?>
			<table width="98%" border="1" class="tam_tabla" align="center" cellspacing="0" cellpadding="5" style=" border-collapse:collapse;">
                                	<tr class="tit_filas"><td width="10%">Nº</td><td width="17%">Hora</td><td width="27%">Operador</td><td width="25%">Estatus</td><td width="21%">Acciones</td></tr>
							<?Php
								while($var_taquillas=mysql_fetch_assoc($query_taquillas)){	
									
									?>
                                    	<tr class="tr"><td><?Php echo $var_taquillas['correlativo']; ///$contador; ?></td><td align="center"><?Php echo $var_taquillas['hora'].' / '.$var_taquillas['hora_atendido']; ?></td><td><?Php echo $var_taquillas['nombre']; ?>
                                    	<td align="center"><?Php echo $var_taquillas['estatus_ticket']; ?> | 
                                        <a href="transferir_ticket.php?serialt=<? echo $var_taquillas['idticket_detalle'];?>" target="_self">Transferir</a>
                                        </td><td align="center">
                                        <?Php //echo $var_taquillas['uatendido'];
											if($var_taquillas['atendiendo']==1 && $var_taquillas['idoperador_taquilla']==$_SESSION['datos']['idoperador_taquilla']){
										?>
											<script language="javascript">
												document.getElementById('anumero').innerHTML='<?Php echo $var_taquillas['correlativo'];//$contador;?>';
											</script>
                                            
                                          <input type="button" value="ANULAR NÚMERO" onclick="javascript:if(confirm('Presione aceptar si desea anular el ticket No: <?Php echo $var_taquillas['correlativo'];//$contador;?>')) location.href='?anular=<?Php echo $var_taquillas['idticket_detalle'];?>';" style="cursor:pointer; background-color:#900; color:#CCC; font-weight:bold; padding:3PX; border:#000 2px solid;" />
										<?Php
									}elseif($var_taquillas['hora_atendido']==$var_taquillas['uatendido'] && $var_taquillas['idoperador_taquilla']==$_SESSION['datos']['idoperador_taquilla']){
										$uatendido=$contador;
									}?>
                                        	
                                        </td></tr>
                                    <?Php
									$contador++;
									$tot=$var_taquillas['tvalido'];
								}
								?>
                                <script language="javascript">
									document.getElementById('uatendido').innerHTML='<?Php echo $uatendido;?>';
								</script>
                                <tr><td colspan="5" align="right"><label class="subtit_form">Por atender </label> <?Php echo $tot.' n&uacute;meros';?></td></tr>
      </table><?Php
							?>
  </div>
                    <?Php
			}else{
				?>
                	<div align="center" class="advertencia" style="clear:both">No se han cargado taquillas para el día <?Php echo date("d/m/Y");?></div>
                <?Php
			}
	?>
	
<!-- InstanceEndEditable --> </div>
<?php 
	include("includes/footer.php");
?>