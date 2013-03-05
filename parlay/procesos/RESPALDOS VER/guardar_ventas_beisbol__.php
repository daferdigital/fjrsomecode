<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>.: PARLEY :.</title>
<style type="text/css">
	#acciones_b{
		display:none;
	}
	body{
		font-size:11px;
	}
	/*table tr td table{
		width:960px;
	}*/
	
</style>
</head>

<body>
<?Php
	include("conexion.php");	
		if($_POST['apuesta'] && $_SESSION['vender']=='si'){	
			$datos_ventas=dame_datos("select count(idventa) as numventas from ventas where fecha='".$_POST['fecha']."' and idtaquilla='".$_SESSION['datos']['idtaquilla']."'");
			if($datos_ventas){
				//$codigo_ticket=str_pad((int)($datos_ventas['numventas']+1),5,'0',STR_PAD_LEFT);
				$codigo_ticket=(int)($datos_ventas['numventas']+1);
			}else{
				$codigo_ticket=1;
			}
			$cadena=sprintf("insert into ventas() values('','".$_SESSION['datos']['idtaquilla']."','".$_POST['fecha']."',DATE_ADD('".$_POST['fecha']."', INTERVAL 3 DAY),'".date('H:i:s')."','%s','%s','0','0','0','0','0','".rand(10000,99999)."','".$codigo_ticket."','0','%s','1')",mysql_escape_string($_POST['monto_apuesta']),mysql_escape_string($_POST['monto_pagar']),mysql_escape_string($_POST['num_apuestas']));
			mysql_query($cadena)or die(mysql_error());// exit;
			
			$uid=mysql_insert_id();			
			
			foreach($_POST['apuesta'] as $valor){
				echo $valor.'<br>';
				mysql_query("insert into ventas_detalles() values('','".$uid."','".$valor."','1')");
			}
			//genero archivo de impresion
			$select_imp="select * from vista_ventas_detalles where idventa='".$uid."' order by hora_juego";
			$query_imp=mysql_query($select_imp);
				if(mysql_num_rows($query_imp)>0){
					ob_start();
					?>
						<table width="198px;" cellspacing="0"><tr><td colspan="4" align="center">FECHA: <?Php echo date("d/m/Y");?> HORA <?Php echo date('h:i:s A');?></td></tr>
						  
					<?Php $cont=0; $apuesta=0;
					while($var_imp=mysql_fetch_assoc($query_imp)){
						if($cont==0){
							?>
                            	  <tr>
                                    <td colspan="4" align="left">TICKET: <?Php echo str_pad($var_imp['codigo_ticket'],5,'0',STR_PAD_LEFT);?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" class="td_bottom" align="left">SERIAL COBRO: <?Php echo str_pad($var_imp['codigo_cliente'],5,'0',STR_PAD_LEFT);?></td>
                                  </tr>
                                  <tr>
                                    <td align="left" class="td_bottom">DEPORTE</td><td class="td_bottom">EQUIPO</td><td class="td_bottom">LOGRO</td><td align="right" class="td_bottom">MONTO</td>
                                  </tr>
                                  <tr>
                                    <td align="left" colspan="3">INVERSIÓN INICIAL:</td>
                                    <td align="right"><?Php echo $apuesta=number_format($var_imp['apuesta'],2);?></td>
                                  </tr>
                            <?Php
							$acum=$var_imp['apuesta'];
						}
						?>
                        	<tr><td colspan="4"><?Php echo substr($var_imp['nombre_categoria'],0,4);?>&nbsp;&nbsp;&nbsp;<?Php echo $var_imp['nombre_equipo'] .' ('.$var_imp['nombre_tipo_apuesta'].')';?></td></tr>
                        	<!--<tr>
                        	  <td colspan="4">** ESPERANDO RESULTADOS **</td>                        	  
                      	  </tr>-->
                        	<tr>
                              <td><?Php echo $var_imp['hora_juego'];?></td>
                        	  <td colspan="2" align="center"><?Php echo ($var_imp['multiplicando']!='1'?$var_imp['multiplicando'].' / ':'').$var_imp['pago'];?></td>
                              <td align="right"><?Php
							  		if($var_imp['pago']>0){
										//acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[j])/100);
										$acum=(float)($acum*((float)(1+(float)($var_imp['pago']/100))));
									}else{
										//acum=acum*parseFloat(1+100/(parseFloat(sep_logro_apuestas_[j])*-1));
										$acum=(float)((float)($acum*((float)(1+((float)(100/((float)($var_imp['pago']*-1))))))));
									}
									echo number_format($acum,2);
							   ?></td>
                      	  </tr>
                        <?Php
						$cont++;
					}
					?>
                    <tr>
                    	<td colspan="2" class="td_top">INVERSIÓN BsF</td><td class="td_top">:</td><td align="right" class="td_top"><?Php echo $apuesta;?></td>
                    </tr>
                    <tr>
                      <td colspan="2">TOTAL DE GANANCIA BsF</td>
                      <td>:</td>
                      <td align="right"><?Php echo (float)number_format(($acum-$apuesta),2);?></td>
                    </tr>
                    <tr>
                      <td colspan="2">TOTAL A COBRAR</td>
                      <td>:</td>
                      <td align="right"><?Php echo number_format($acum,2);?></td>
                    </tr>
                    </table>
                    <?Php
					$parley=ob_get_contents();
					ob_end_clean();
					
					/*GENERO IMPRESION*/
					$plantilla=fopen('../impresiones/plantilla.html','r');
					$lectura=fread($plantilla,filesize('../impresiones/plantilla.html'));
					fclose($plantilla);
					
					$lectura=str_replace("<%CONSULTA%>",$parley,$lectura);
					
					$arch=fopen('../impresiones/imprimir_'.session_id().'.html','w');
					fwrite($arch,$lectura);
					fclose($arch);
					
				}
			
		}
?>
</body></html>