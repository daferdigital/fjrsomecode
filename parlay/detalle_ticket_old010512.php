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
                        <tr><td colspan="4" align="center">
                        CENTRO DE APUESTAS<br />
						<div style="text-transform:capitalize;">
						<?Php echo $_SESSION['datos']['nombre'];?>
                        </div>
                        </td></tr>						  
					<?Php $cont=0; $apuesta=0;
					while($var_imp=mysql_fetch_assoc($query_imp)){
						if($cont==0){
							?>
                            	<tr><td colspan="4" align="center">FECHA: <?Php echo $var_imp['fecha_j']."   ";?> HORA <?Php echo $var_imp['hora_j'];?></td></tr>
                            	  <tr>
                                    <td colspan="4" align="left">TICKET: <?Php echo str_pad($var_imp['codigo_ticket'],8,'0',STR_PAD_LEFT);?></td>
                                  </tr>
                                  <!--<tr>
                                    <td colspan="4" class="td_bottom" align="left">SERIAL COBRO: <?Php echo str_pad($var_imp['codigo_cliente'],8,'0',STR_PAD_LEFT);?></td>
                                  </tr>-->
                                  <tr>
                                    <td align="left" class="td_bottom">DEPORTE</td><td class="td_bottom">EQUIPO</td><td class="td_bottom">LOGRO</td><td align="right" class="td_bottom">MONTO</td>
                                  </tr>
                                  <tr>
                                    <td align="left" colspan="3">INVERSIÓN INICIAL:</td>
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
                              <td><?Php echo $var_imp['hora_l'];?></td>
                        	  <td colspan="2" align="center"><?Php $var_imp['multiplicando']=str_replace(".0","",$var_imp['multiplicando']);echo ($var_imp['multiplicando']!='1'?$var_imp['multiplicando'].' / ':'').$var_imp['pago'];?></td>
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
                    	<td colspan="2" class="td_top">INVERSIÓN BsF</td><td class="td_top">:</td><td align="right" class="td_top"><?Php echo $apuesta;?></td>
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
                        Revise su jugada<br />
                        Sin ticket no se paga<br />
                        Acepto las reglas de juego<br />
La jugada sera valida sin importar el pitcher abridor.<br />
                      El ticket caduca a los 3 dias</div>
                    <br /><div align="center" style="font-size:14px;">WWW.GRANAPUESTA.COM</div></td>
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