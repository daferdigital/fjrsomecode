<?php 
session_start();
	include("conexion.php");
	$_POST=convertArrayKeysToUtf82($_POST);
	
	$num_ticket=$_REQUEST["num_ticket"];
	$estatus1=$_REQUEST["estatus"];
	$monto=$_REQUEST["monto"];
	
		if($_REQUEST['clave']=='.Villa01'){
			

			if($estatus1=='2'){///ganador
				$cadena=sprintf("UPDATE `vista_ventas` SET `ganador` = '1', `perdedor` = '0', `monto_real_pagar` = '$monto', `recalculado` = '0' 
									WHERE `vista_ventas`.`idventa` IN ('$num_ticket')");
				
			}else if($estatus1=='3'){///perdedor
				$cadena=sprintf("UPDATE `vista_ventas` SET `ganador` = '0', `perdedor` = '1', `monto_real_pagar` = '0', `recalculado` = '0' 
									WHERE `vista_ventas`.`idventa` IN ('$num_ticket')");
				
			}else if($estatus1=='4'){///Recalculado
				$cadena=sprintf("UPDATE `vista_ventas` SET `ganador` = '1', `perdedor` = '0', anulado='0',  `monto_real_pagar` = '$monto',
									`recalculado` = '1' WHERE `vista_ventas`.`idventa` IN ('$num_ticket')");
				
			}else if($estatus1=='5'){///Reembolzar
				$cadena=sprintf("UPDATE `vista_ventas` SET `ganador` = '0', reembolsar=1, `ganador` = '0', `perdedor` = '1', `monto_real_pagar` = '0', `recalculado` = '0'  
									WHERE `vista_ventas`.`idventa` IN ('$num_ticket')");
				
			}	


			mysql_query($cadena);
	///		mysql_query($cadena2);			?>
			<center>
                El Ticket:<strong> $num_ticket</strong> ha sido cambiado de forma exitosa<br />
                <a href="ingreso_arregla.php">Arreglar otro ticket</a>
            </center>
			<?
		}else{?><center>
			Clave de autorización incorrecta<br /><a href="Javascript:history.back();">Regresar</a></center>	<?
		}
		

?>
