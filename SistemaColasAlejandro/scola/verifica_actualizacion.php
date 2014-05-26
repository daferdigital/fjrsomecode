<?Php session_start();
	include("procesos/conexion.php");
?>
<?Php 
	//echo $_GET['id'].'este';
	//if($_GET['id']){
		$sql_ll="select idticket_detalle from vista_tickets_detalles_departamentos where llamando='1' and fecha=CURDATE() limit 1";
		$query_ll=mysql_query($sql_ll);
		if(mysql_num_rows($query_ll)>0){
		//echo $_SESSION['idticketactual'];
		$sql_a="select idticket_detalle from tickets_detalles where llamando='1' and idticket_detalle='".$_SESSION['idticketactual']."' limit 1";
		$query_a=mysql_query($sql_a);
		if(mysql_num_rows($query_a)==0){
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
										atendiendo='1' 
								order by 								
										descripcion_departamento ";
				$query_taquillas=mysql_query($sql_taquillas) or die(mysql_error());
					$num_taquillas=mysql_num_rows($query_taquillas);
					if($num_taquillas>0){				
							?>								
									<div class="actual" style="border-bottom: #900 2px solid; margin-bottom:10px;"><b><label class="aviso_llamando">Ultimo n&uacute;mero llamado: </label></b><label id="ullamado"></label></div>
									<?Php $pares=0; $contador=1; $uatendido=0; $distint='';							
									?>
								   <b class="atendiendo">Atendiendo actualmente:</b>
								   
									<marquee direction="up" scrolldelay="200" height="400">
										<?Php $cambio=''; $otroid='';
											while($var_llamadas=mysql_fetch_assoc($query_taquillas)){
													if($distint!=$var_llamadas['descripcion_departamento']){
														$distint=$var_llamadas['descripcion_departamento'];
														echo "<div class='tit_llamada'><b>Dpto.: </b>".$var_llamadas['descripcion_departamento']."</div>";
													}
												?>
													<div class="actual1"><strong>Ticket N&ordm;: </strong> <?php echo $var_llamadas['correlativo'];?> <b>Taquilla: </b><?php echo $var_llamadas['descripcion_taquilla'];?></div>
												<?Php
													if($var_llamadas['llamando']==1){ $cambio=true;
														$_SESSION['idticketactual']=$var_llamadas['idticket_detalle'];
														?>
															<script language="javascript">
																jQuery('#ullamado').html('<?Php echo '<br><b class="etiqueta_num">Departamento: '.$var_llamadas['descripcion_departamento'].'</b><br><b class="num_actual">Ticket N&ordm;: '.$var_llamadas['correlativo'].'<br>Taquilla: '.$var_llamadas['descripcion_taquilla']."</b>";?>');
															</script>
														<?Php
													}
											}
											
										?>
										</marquee>
										<?Php
									
				}	
			}
			}
		//}	
?>