<?php 
session_start();
$multiplicandosPermitidos = array();
//ids de apuestas
$multiplicandosPermitidos["9"] = "ALTA_JC_A";
$multiplicandosPermitidos["10"] = "BAJA_JC_A";
$multiplicandosPermitidos["11"] = "ALTA_MJ_A";
$multiplicandosPermitidos["12"] = "BAJA_MJ_A";
$multiplicandosPermitidos["17"] = "RL_JC_A";
$multiplicandosPermitidos["18"] = "RL_JC_B";
$multiplicandosPermitidos["19"] = "RL_MJ_A";
$multiplicandosPermitidos["20"] = "RL_MJ_B";
$multiplicandosPermitidos["21"] = "SRL_A";
$multiplicandosPermitidos["22"] = "SRL_B";
$multiplicandosPermitidos["28"] = "ALTAS_CHE_A";
$multiplicandosPermitidos["29"] = "BAJAS_CHE_A";
$multiplicandosPermitidos["30"] = "RL_ALT_JC_A";
$multiplicandosPermitidos["31"] = "RL_ALT_JC_B";
$multiplicandosPermitidos["32"] = "RL_ALT_MJ_A";
$multiplicandosPermitidos["33"] = "RL_ALT_MJ_B";
$multiplicandosPermitidos["34"] = "ALTAS_6TO_A";
$multiplicandosPermitidos["35"] = "BAJAS_6TO_A";
$multiplicandosPermitidos["39"] = "RL_ALT_BASKET_A";
$multiplicandosPermitidos["40"] = "RL_ALT_BASKET_B";
?>
<!--
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
		font-family:Arial, Helvetica, sans-serif;
		font-size:11px;
	}
	/*table tr td table{
		width:960px;
	}*/
	
</style>
</head>

<body style="font-size:14px;">
--><?Php
	include("conexion.php");	
		if($_POST['apuesta'] && $_SESSION['vender']=='si'){	
			//$datos_ventas=dame_datos("select count(idventa) as numventas from ventas where fecha='".$_POST['fecha']."' and idtaquilla='".$_SESSION['datos']['idtaquilla']."'");
			//$datos_ventas=dame_datos("select count(idventa) as numventas from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."'");
			/*$datos_ventas=dame_datos("select count(idventa) as numventas from ventas");
			
			if($datos_ventas){*/
				//$codigo_ticket=str_pad((int)($datos_ventas['numventas']+1),5,'0',STR_PAD_LEFT);
				/*$codigo_ticket=(int)($datos_ventas['numventas']+1);
			}else{
				$codigo_ticket=1;
			}*/
			
			/**
			* validamos que los eventos respectivos no hayan empezado, antes de procesar la propia venta del ticket
			**/
			$apuestaEnTiempo = true;
			foreach($_POST['apuesta'] as $valor){
				$query = "SELECT l.fecha, l.hora "
						."FROM logros l, logros_equipos le, logros_equipos_categorias_apuestas_banqueros lecab "
						."WHERE le.idlogro_equipo = lecab.idlogro_equipo "
						."AND l.idlogro = le.idlogro "
						."AND lecab.idlogro_equipo_categoria_apuesta_banquero = ".$valor;
				//$selectResults = DBUtil::executeSelect($query);
				$selectResults = mysql_query($query);
				$selectResults = mysql_fetch_array($selectResults);
				
				echo date_default_timezone_get()."<br />";
				$minutosToAdjust = 5;
				$sysdate = (int) (time() + (60 * $minutosToAdjust));
				if($sysdate > strtotime($selectResults["fecha"]." ".$selectResults["hora"])){
					//este logro (evento) (apuesta) esta relacionada con un evento cuya hora de inicio
					//es menor a la fecha del sistema, lo que quiere decir que dicho evento ya inicio
					//detenemos la creacion de la venta en este punto
					/*
					BitacoraDAO::registrarComentario("La fecha de inicio del evento [".$valor."] "
							."es [".($selectResults["fecha"]." ".$selectResults["hora"])."]"
							."y la hora actual + ".$minutosToAdjust." minutoses  [".date("Y-m-d H:i:s", $sysdate)
							."] lo que quiere decir que ya inicio. Finalizamos este proceso");
					*/
					//die("No esta permitido apostar en juegos ya iniciados, suspendemos este intento de insert");
					$apuestaEnTiempo = false;
				} else {
					/*
					BitacoraDAO::registrarComentario("Evento [".$valor."] inicia "
							."[".($selectResults["fecha"]." ".$selectResults["hora"])."] mas tarde de la hora actual "
							."[".date("Y-m-d h:i:s")."]");
					*/
				}
			}
			
			//siempre despues de usar alguna de mis clases
			//debo restituir la conexion global en conexion.php
			//prepareConnection();
			
			$codigo_ticket=1;
			$hora_venta=date('H:i:s');
			mysql_query("set 
							@taq=date_format(convert_tz('".$_POST['fecha'].' '.$hora_venta."','+00:00','+00:05'),'%H:%i:%s'),
							@int=date_format(convert_tz('".$_POST['fecha'].' '.$hora_venta."','+00:00','+00:10'),'%H:%i:%s'),
							@ban=date_format(convert_tz('".$_POST['fecha'].' '.$hora_venta."','+00:00','+10:00'),'%H:%i:%s')
						");
			$cadena=sprintf("insert into ventas() values('','".$_SESSION['datos']['idtaquilla']."','".$_POST['fecha']."',DATE_ADD('".$_POST['fecha']."', INTERVAL ".Constants::$PRORROGA_VENTA." DAY),'".$hora_venta."',@taq,@int,@ban,'%s','%s','0','0','0','0','0','0','0','0','0','".rand(10000000,99999999)."','".$codigo_ticket."','0','%s','','','','1')",mysql_escape_string($_POST['monto_apuesta']),mysql_escape_string($_POST['monto_pagar']),mysql_escape_string($_POST['num_apuestas']));
			mysql_query($cadena)or die(mysql_error());			
			$uid=mysql_insert_id();
			mysql_query("update ventas set codigo_ticket='".$uid."' where idventa='".$uid."' limit 1");
			
			foreach($_POST['apuesta'] as $valor){
				echo $valor.'<br>';
				$valor_real_ticket=dame_datos("select multiplicando,pago from logros_equipos_categorias_apuestas_banqueros where idlogro_equipo_categoria_apuesta_banquero='".$valor."' limit 1");
				mysql_query("insert into ventas_detalles() values('','".$uid."','".$valor."','".$valor_real_ticket['multiplicando']."','".$valor_real_ticket['pago']."','1','2')");
			}
			//genero archivo de impresion
			$select_imp="select * from vista_ventas_detalles where idventa='".$uid."' order by hora_juego";
			$query_imp=mysql_query($select_imp);
				if(mysql_num_rows($query_imp)>0){
					ob_start();
					?>
						<table width="500" cellspacing="0">
                        <tr><td colspan="4" align="center">
                        CENTRO DE APUESTAS<br />
						<div style="text-transform:capitalize;">
						<?Php echo $_SESSION['datos']['nombre'];?>
                        </div>
                        </td></tr>
                        <tr><td colspan="4" align="center">FECHA: <?Php echo date("d/m/Y")."   ";?> HORA <?Php echo date('h:i:s A');?></td></tr>
						  
					<?Php $cont=0; $apuesta=0;
					while($var_imp=mysql_fetch_assoc($query_imp)){
						if($cont==0){
							?>
                            	  <tr>
                                    <td colspan="4" align="left">TICKET: <?Php echo str_pad($var_imp['codigo_ticket'],8,'0',STR_PAD_LEFT);?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" class="td_bottom" align="left">SERIAL COBRO: <?Php echo str_pad($var_imp['codigo_cliente'],8,'0',STR_PAD_LEFT);?></td>
                                  </tr>
                                  <tr>
                                    <td align="left" class="td_bottom">DEPORTE</td><td class="td_bottom">EQUIPO</td><td class="td_bottom">LOGRO</td><td align="right" class="td_bottom">MONTO</td>
                                  </tr>
                                  <tr>
                                    <td align="left" colspan="3">INVERSI&Oacute;N INICIAL:</td>
                                    <td align="right"><?Php $ap2=$var_imp['apuesta']; echo $apuesta=number_format($var_imp['apuesta'],2);?></td>
                                  </tr>
                            <?Php
							$acum=$var_imp['apuesta'];
						}
						?>
                        	<tr><td colspan="4"><?Php echo substr($var_imp['nombre_categoria'],0,4);?>&nbsp;&nbsp;&nbsp;<?Php echo $var_imp['nombre_equipo'] .' ('.$var_imp['descripcion_apuesta'].')';?></td></tr>
                        	<!--<tr>
                        	  <td colspan="4">** ESPERANDO RESULTADOS **</td>                        	  
                      	  </tr>-->
                        	<tr>
                              <td><?Php echo $var_imp['hora_juego'];?></td>
                        	  <td colspan="2" align="center">
							  <?Php
								/*
							  	if($var_imp["idcategoria_apuesta"]==102 || $var_imp["idcategoria_apuesta"]==103){
									$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$var_imp['idlogro_equipo']."' and idcategoria_apuesta='109' limit 1");
									$var_imp['multiplicando']=$multi_ale['pago'];
								}
								if($var_imp["idcategoria_apuesta"]==104 || $var_imp["idcategoria_apuesta"]==105){
									$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$var_imp['idlogro_equipo']."' and idcategoria_apuesta='110' limit 1");
									$var_imp['multiplicando']=$multi_ale['pago'];
								}
								$var_imp['multiplicando']=str_replace(".0","",$var_imp['multiplicando']);echo ($var_imp['multiplicando']!='1'?$var_imp['multiplicando'].' / ':'').$var_imp['pago'];
								*/
								$var_imp['multiplicando']=str_replace(".0","",$var_imp['multiplicando']);
								echo (isset($multiplicandosPermitidos[$var_imp["idapuesta"]]) ? $var_imp['multiplicando'].' / ' : '').$var_imp['pago'];
							  ?>
							  </td>
                              <td align="right"><?Php
							  		if($var_imp['pago']>0){
										//acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[j])/100);
										$acum=(float)($acum*((float)(1+(float)($var_imp['pago']/100))));
									}elseif($var_imp['pago']<0){
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
                    	<td colspan="2" class="td_top">INVERSI&Oacute;N BsF</td><td class="td_top">:</td><td align="right" class="td_top"><?Php echo $apuesta;?></td>
                    </tr>
                    <tr>
                      <td colspan="2">TOTAL DE GANANCIA BsF</td>
                      <td>:</td>
                      <td align="right"><?Php echo number_format((float)($acum-str_replace(',','',$ap2)),2);?></td>
                    </tr>
                    <tr>
                      <td colspan="2">TOTAL A COBRAR</td>
                      <td>:</td>
                      <td align="right"><?Php echo number_format($acum,2);?></td>
                    </tr>
                    <tr>
                      <td colspan="4"><div style="text-transform:uppercase;"><br />
                        <br />
                        <div style="text-transform:uppercase;">Revise su jugada<br />
                          Sin ticket no se paga<br />
                          Acepto las reglas de juego<br />
                          La jugada sera valida sin importar el pitcher abridor.<br />
                          EL FUTBOL TERMINA CON EL PITAZO FINAL
                          DEL 2DO TIEMPO<br />
                          El ticket caduca a los <?php echo Constants::$PRORROGA_VENTA?> dias<br />
                          Error en horario o transcripci&oacute;n de logro anula la jugada </div>
                      </div>
                    <br /><div align="center" style="font-size:14px;">WWW.GRANAPUESTA.COM</div></td>
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
		//calculo la cantidad de jugadas por logro 1,2,3,4,5,6,7,8,9,10 para una determinada taquilla
		jugadas_cantidad();
		
?>
<!--</body></html>-->
