<?Php session_start();
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.:Parley:.</title>
<style type="text/css">
	#acciones_b{
		display:none;
	}
	body{
		font-family:Arial, Helvetica, sans-serif;
		font-size:11px;
	}
	/*table tr td table{
		width:960px;
	}*/
	
.encab {
	font-size: 14px;
}
.sub_text {
	color: #FFF;
}
</style>
</head>
<body>
<?Php
	include_once('procesos/conexion.php');
	//genero archivo de impresion
			$select_imp="select *,date_format(hora,'%r') as hora_j,date_format(fecha_venta,'%d/%m/%Y') as fecha_j,date_format(hora_juego,'%r') as hora_l from vista_ventas_detalles where idventa='".$_GET['idticket']."' $concat order by hora_juego";
			$query_imp=mysql_query($select_imp);
				if(mysql_num_rows($query_imp)>0){
					ob_start();
					?>
						<table width="500" cellspacing="0">
                        <tr>
                          <td colspan="4" align="center" bgcolor="#006600" style="color:#FFF; font-weight:bold;">
                        CENTRO DE APUESTAS..<br />
						<div style="text-transform:capitalize;">
						<?Php echo $_SESSION['datos']['nombre'];?>
                        </div>
                        </td></tr>						  
					<?Php $cont=0; $apuesta=0;
					while($var_imp=mysql_fetch_assoc($query_imp)){
						$recalculado=$var_imp['recalculado'];
						$mrecalculado=$var_imp['monto_real_pagar'];
						if($cont==0){
							?>
                            	<tr><td colspan="4" align="left" bgcolor="#CCCCCC"  class="encab"><strong>FECHA: <?Php echo $var_imp['fecha_j']."   ";?> HORA <?Php echo $var_imp['hora_j'];?></strong></td></tr>
                            	  <tr>
                                    <td align="left" class="encab"><strong>N&Uacute;MERO DE TICKET: </strong></td>
                                    <td colspan="2" align="left" class="encab"><strong><?Php echo str_pad($var_imp['codigo_ticket'],8,'0',STR_PAD_LEFT);?></strong></td>
                                    <td align="left">&nbsp;</td>
                                  </tr>
                                  <!--<tr>
                                    <td colspan="4" class="td_bottom" align="left">SERIAL COBRO: <?Php echo str_pad($var_imp['codigo_cliente'],8,'0',STR_PAD_LEFT);?></td>
                                  </tr>-->
                                  <tr>
                                    <td align="left" class="encab"><strong>MONTO APOSTADO:</strong></td>
                                    <td colspan="2" class="encab"><strong>
                                    <?Php $ap2=$var_imp['apuesta']; echo $apuesta=number_format($var_imp['apuesta'],2);?>
                                    </strong></td>
                                    <td align="right" class="td_bottom">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" class="td_bottom">&nbsp;</td>
                                  </tr>
                                  <tr class="sub_text">
                                    <td colspan="2" align="left" bgcolor="#003300" class="td_bottom"><div align="center"><strong>JUGADAS</strong></div></td>
                                    <td bgcolor="#003300" class="td_bottom"><div align="center"><strong>LOGRO</strong></div></td>
                                    <td align="right" bgcolor="#003300" class="td_bottom"><div align="center"><strong>MONTO</strong></div></td>
                                  </tr>
                            <?Php
							$acum=$var_imp['apuesta'];
						}
						?>
                        		<tr>
                        	  		<td height="25" width="100px;">
                        	  			<?Php echo $var_imp['hora_l'];?>
                        	  		</td>
                        	  		<td width="350px" align="left">
                        	  			<?Php echo substr($var_imp['nombre_liga'],0,4);?>
                        	  			&nbsp;
                        	  			<?Php echo $var_imp['nombre_equipo'] .' ('.$var_imp['descripcion_apuesta'].')';?>
                        	  			<?Php echo $var_imp['nombreEdoVentaDetalle'] == "" ? "" : " (".$var_imp['nombreEdoVentaDetalle'].")";?>
                        	  		</td>
                        	  		<td width="75px;">
	                        	  		<div align="center">
	                        	    		<?Php 
												if($var_imp["idcategoria_apuesta"]==102 || $var_imp["idcategoria_apuesta"]==103){
													$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$var_imp['idlogro_equipo']."' and idcategoria_apuesta='109' limit 1");
													$var_imp['multiplicando']=$multi_ale['pago'];
												}
												if($var_imp["idcategoria_apuesta"]==104 || $var_imp["idcategoria_apuesta"]==105){
													$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$var_imp['idlogro_equipo']."' and idcategoria_apuesta='110' limit 1");
													$var_imp['multiplicando']=$multi_ale['pago'];
												}
												$var_imp['multiplicando']=str_replace(".0","",$var_imp['multiplicando']);
												echo ($var_imp['multiplicando']!='' && $var_imp['multiplicando']!='1' ? $var_imp['multiplicando'].' / ' : '').$var_imp['pago'];
											?>
	                      	    		</div>
	                      	    	</td>
                        	  		<td width="75px;">
                        	  			<div align="right">
                        	    		<?Php
							  		if($var_imp['pago']>0){
										//acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[j])/100);
										$acum=(float)($acum*((float)(1+(float)($var_imp['pago']/100))));
									}elseif($var_imp['pago']<0){
										//acum=acum*parseFloat(1+100/(parseFloat(sep_logro_apuestas_[j])*-1));
										$acum=(float)((float)($acum*((float)(1+((float)(100/((float)($var_imp['pago']*-1))))))));
									}
									echo number_format($acum,2);
							   ?>
                      	    </div></td>
                        	</tr>
                        	<!--<tr>
                        	  <td colspan="4">** ESPERANDO RESULTADOS **</td>                        	  
                      	  </tr>-->
                       	  <?Php
						$cont++;
					}
					?>
                          <tr>
                            <td colspan="2" class="td_top">&nbsp;</td>
                            <td class="td_top">&nbsp;</td>
                            <td align="right" class="td_top">&nbsp;</td>
                          </tr>
                          <tr>
                    	<td colspan="2" class="td_top">INVERSI&Oacute;N BsF</td><td class="td_top">:</td>
                    	<td align="right" class="td_top"><?Php echo $apuesta;?></td>
                    </tr>
                    <tr>
                      <td colspan="2" bgcolor="#DFDFDF">TOTAL DE GANANCIA BsF</td>
                      <td bgcolor="#DFDFDF">:</td>
                      <td align="right" bgcolor="#DFDFDF"><?Php echo number_format((float)($acum-str_replace(',','',$ap2)),2);?></td>
                    </tr>
                    <tr>
                      <td colspan="2" bgcolor="#CCCCCC"><strong>TOTAL A COBRAR</strong></td>
                      <td bgcolor="#CCCCCC">:</td>
                      <td align="right" bgcolor="#CCCCCC"><strong><?Php echo number_format($acum,2);?></strong></td>
                    </tr>
                    <?Php if($recalculado):?>
                    	<tr>
                      <td colspan="2"><strong>MONTO RECALCULADO</strong></td>
                      <td>:</td>
                      <td align="right"><font color="#FF0000"><b><?Php echo number_format($mrecalculado,2);?></b></font></td>
                    </tr>
                    <?Php endif;?>
                    <tr>
                      <td colspan="4"><br /></td>
                      </tr>
                    </table>
                    <?Php
					$parley=ob_get_contents();
					ob_end_clean();
					
					echo $parley;
					/*GENERO IMPRESION*/
					
					/*$plantilla=fopen('../impresiones/plantilla.html','r');
					$lectura=fread($plantilla,filesize('../impresiones/plantilla.html'));
					fclose($plantilla);
					
					$lectura=str_replace("<%CONSULTA%>",$parley,$lectura);
					
					$arch=fopen('../impresiones/imprimir_'.session_id().'.html','w');
					fwrite($arch,$lectura);
					fclose($arch);
					*/
				}
?>
</body>
</html>