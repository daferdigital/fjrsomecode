<?php
session_start();
include("conexion.php");

//print_r($_POST['resultado']);
//echo '<br>';
foreach($_POST['resultado'] as $idlogro_equipo=>$valor){
	//echo 'idlogro_equipo: '.$idlogro_equipo.'<br>';
	/*
	$equipoA=($equipoA==''?$idlogro_equipo:$equipoA);
	$equipoB=($equipoA!='' && $equipoA!=$idlogro_equipo && $equipoB==''?$idlogro_equipo:$equipoB);
	*/
	foreach($valor as $idcategoria_resultado=>$val){
		//echo 'idresultado: '.$idcategoria_resultado.'->'.$val.'<br>';
		$existe=dame_datos("select idlogro_equipo from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipo."' and idcategoria_resultado='".$idcategoria_resultado."' limit 1");
		if($existe){
			mysql_debug_query("update logros_equipos_categorias_resultados set estatus='".$_POST['estatus_'.$idlogro_equipo]."',resultado='".$val."',idadministrador_modifica='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where idlogro_equipo='".$idlogro_equipo."' and idcategoria_resultado='".$idcategoria_resultado."' limit 1");
		} else{ 
			mysql_debug_query("insert into logros_equipos_categorias_resultados() values('','".$idlogro_equipo."','".$idcategoria_resultado."','".$val."','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','".$_POST['estatus_'.$idlogro_equipo]."')");
		}
	}
}
	
//CALCULO DE APUESTAS GANADORAS 
$imp=0;
foreach($_POST['resultado'] as $idlogro_equipo=>$valor){
	if($imp%2==0):
		echo "\n<br>idlogro_equipo_: $idlogro_equipo";
		$equipoA=(int)$idlogro_equipo;
		$equipoB=(int)$idlogro_equipo+1;
		//Seteo a estatus cero las apuestas acertadas previamente cargadas			
		mysql_debug_query("update vista_aciertos set estatus='0' where idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."'");
		//Seteo las jugadas suspendidas
		mysql_debug_query("update logros_equipos_categorias_apuestas set suspendido=0 where idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."'");
		
		echo "<br />Categoria: ".$_POST['resultado_categoria']."<br />";
		
		switch($_POST['resultado_categoria']){
			case 'beisbol':
				/*BEISBOL**********************************************************************************************************/
				$suspendido_2m = false;
				$suspendido_todo = false;
				
				if($_POST['resultado'][$equipoA][6]>0){
					//fue suspendido el juego en la segunda mitad
					$suspendido_2m = true;
				}else{
					$suspendido_2m = false;
				}
				
				if($_POST['resultado'][$equipoA][3]>0){
					//fue suspendido el juego en los primeros 5 inings
					$suspendido_todo = true;
					$suspendido_2m = true;
				}else{
					$suspendido_todo = false;
					//if(!$suspendido_2m) $suspendido_2m=0;
				}
				
				//debo registrar los supuestos aciertos
				//para que los logros puedan ser revisados
				$_SESSION['suspendido'] =0;
				genera_aciertos('23',$equipoA); // A ganar JuegoCompleto - A
				genera_aciertos('25',$equipoB); // A ganar JuegoCompleto - B
				genera_aciertos('27',$equipoA); //RunLine JuegoCompleto - A
				genera_aciertos('28',$equipoB); //RunLine JuegoCompleto - B
				genera_aciertos('29',$equipoA); // Runline MJ - A
				genera_aciertos('30',$equipoB); // Runline MJ - B
				genera_aciertos('31',$equipoA); //Bajas JuegoCompleto - A
				genera_aciertos('32',$equipoA); //Altas JuegoCompleto - A
				genera_aciertos('37',$equipoA); // Anota1ero - A
				genera_aciertos('38',$equipoB); // Anota1ero - B
				genera_aciertos('39',$equipoA); // si primer - A
				genera_aciertos('40',$equipoA); // no primer - A
				genera_aciertos('47',$equipoA); //SuperRunline - A
				genera_aciertos('48',$equipoB); //SuperRunline - B
				genera_aciertos('71',$equipoA); //Logro Bajas CHE - A
				genera_aciertos('72',$equipoA); //Logro Altas CHE - A
				genera_aciertos('73',$equipoA); //RunLineAlternativo JuegoCompleto - A
				genera_aciertos('74',$equipoB); //RunLineAlternativo JuegoCompleto - B
				genera_aciertos('75',$equipoA); // RunlineAlternativo MJ - A
				genera_aciertos('76',$equipoB); // RunlineAlternativo MJ - B
				genera_aciertos('77',$equipoA); //logroalta 6to - A
				genera_aciertos('78',$equipoA); //logrobaja 6to - A
				genera_aciertos('80',$equipoA); //A Ganar 2da Mitad - A
				genera_aciertos('81',$equipoB); //A Ganar 2da Mitad - B
				
				//por la nueva modalidad, registramos los aciertos de cada tipo de apuesta
				//en beisbol, para luego en base al suspendido de resultados
				//colocar el valor real de suspension en el logro
				echo "<br />suspendido_2m = ".$suspendido_2m."<br />";
				echo "<br />suspendido_todo = ".$suspendido_todo."<br />";
				/*********JUEGOS COMPLETOS*************************************************************/
				
				$todo=0;
				if($suspendido_todo || $suspendido_2m){
					$_SESSION['suspendido']=1;
				}
				echo 'Suspendido -> '.$_SESSION['suspendido'].' <- <br>';
				
				//actualizo por si hubo algun tipo de suspension en el logro
				if($_SESSION['suspendido'] > 0){
					$todo=1;
					//sea suspendido a primera o segunda mitad
					//las apuestas a final se suspenden siempre
					genera_aciertos('27',$equipoA); //RunLine JuegoCompleto - A
					genera_aciertos('28',$equipoB); //RunLine JuegoCompleto - B
					genera_aciertos('31',$equipoA); //Bajas JuegoCompleto - A
					genera_aciertos('32',$equipoA); //Altas JuegoCompleto - A
					genera_aciertos('47',$equipoA); //SuperRunline - A
					genera_aciertos('48',$equipoB); //SuperRunline - B
					genera_aciertos('71',$equipoA); //Logro Bajas CHE - A
					genera_aciertos('72',$equipoA); //Logro Altas CHE - A
					genera_aciertos('73',$equipoA); //RunLineAlternativo JuegoCompleto - A
					genera_aciertos('74',$equipoB); //RunLineAlternativo JuegoCompleto - B
					genera_aciertos('77',$equipoA); //logroalta 6to - A
					genera_aciertos('78',$equipoA); //logrobaja 6to - A
					genera_aciertos('80',$equipoA); //A Ganar 2da Mitad - A
					genera_aciertos('81',$equipoB); //A Ganar 2da Mitad - B
					
					if($suspendido_todo){
						//fue suspendida la primera mitad del juego, por lo tanto se considera completo suspendido
						genera_aciertos('23',$equipoA); // A ganar JuegoCompleto - A
						genera_aciertos('25',$equipoB); // A ganar JuegoCompleto - B
						genera_aciertos('24',$equipoA); // AGanar MedioJuego - A
						genera_aciertos('26',$equipoB); // AGanar MedioJuego - B
						genera_aciertos('29',$equipoA); // Runline MJ - A
						genera_aciertos('30',$equipoB); // Runline MJ - B
						genera_aciertos('33',$equipoA); // Altas MedioJuego - A
						genera_aciertos('34',$equipoA); // Bajas MedioJuego - A
						genera_aciertos('37',$equipoA); // Anota1ero - A
						genera_aciertos('38',$equipoB); // Anota1ero - B
						genera_aciertos('39',$equipoA); // si carrera primer inning - A
						genera_aciertos('40',$equipoA); // no carrera primer inning - A
						genera_aciertos('75',$equipoA); // RunlineAlternativo MJ - A
						genera_aciertos('76',$equipoB); // RunlineAlternativo MJ - B
					}
				}
				/*TERMINA BEISBOL*********************************************************************************************/
				break;
			case 'futbol':
				/*INICIA FUTBOL **********************************************************************************************/
				$suspendido_2m = false;
				$suspendido_todo = false;
				
				if($_POST['resultado'][$equipoA][14]>0){
					//fue suspendido el juego en la segunda mitad
					$suspendido_2m = true;
				}
				
				if($_POST['resultado'][$equipoA][13]>0){
					//fue suspendido el juego en los primeros 5 inings
					$suspendido_todo = true;
					$suspendido_2m = true;
				}
				
				$_SESSION['suspendido']=0;
				//INICIAMOS TODAS LAS APUESTAS COMO VALIDAS, PARA LUEGO PROCESARLAS
				genera_aciertos('16',$equipoA);//RUN_LINE_JUEGO_COMPLETO_A
				genera_aciertos('17',$equipoB);//RUN_LINE_JUEGO_COMPLETO_B
				genera_aciertos('19',$equipoA);//A_GANAR_JC_A
				genera_aciertos('21',$equipoB);//A_GANAR_JC_B
				genera_aciertos('20',$equipoA);//A_GANAR_MJ_A
				genera_aciertos('22',$equipoB);//A_GANAR_MJ_B
				genera_aciertos('41',$equipoA);//ALTA_JC_A
				genera_aciertos('42',$equipoA);//BAJA_JC_A
				genera_aciertos('43',$equipoA);//ALTA_MJ_A
				genera_aciertos('44',$equipoA);//BAJA_MJ_A
				genera_aciertos('49',$equipoA);//EMPATE_JC_A
				genera_aciertos('50',$equipoA);//EMPATE_MJ_A
				
				if($suspendido_todo || $suspendido_2m){
					$_SESSION['suspendido']=1;
					
					if($suspendido_todo){
						genera_aciertos('20',$equipoA);//A_GANAR_MJ_A
						genera_aciertos('22',$equipoB);//A_GANAR_MJ_B
						genera_aciertos('43',$equipoA);//ALTA_MJ_A
						genera_aciertos('44',$equipoA);//BAJA_MJ_A
						genera_aciertos('50',$equipoA);//EMPATE_MJ_A
					}
					
					genera_aciertos('16',$equipoA);//RUN_LINE_JUEGO_COMPLETO_A
					genera_aciertos('17',$equipoB);//RUN_LINE_JUEGO_COMPLETO_B
					genera_aciertos('19',$equipoA);//A_GANAR_JC_A
					genera_aciertos('21',$equipoB);//A_GANAR_JC_B
					genera_aciertos('41',$equipoA);//ALTA_JC_A
					genera_aciertos('42',$equipoA);//BAJA_JC_A
					genera_aciertos('49',$equipoA);//EMPATE_JC_A
				}
				
				/*TERMINA FUTBOL**************************************************************************************************/
				break;
			case 'basket':
				/*INICIA BASKET****************************************************************************************************************************/			
				$_SESSION[] ;
				
				$_SESSION['suspendido']=0;
				//INICIAMOS TODAS LAS APUESTAS COMO VALIDAS, PARA LUEGO PROCESARLAS
				genera_aciertos('56',$equipoA); // A GANAR JUEGO COMPLETO A
				genera_aciertos('58',$equipoB); // A GANAR JUEGO COMPLETO B
				genera_aciertos('57',$equipoA); // A GANAR MEDIO JUEGO A
				genera_aciertos('59',$equipoB); // A GANAR MEDIO JUEGO B
				genera_aciertos('60',$equipoA); // RUN LINE JUEGO COMPLETO A
				genera_aciertos('61',$equipoB); // RUN LINE JUEGO COMPLETO B
				genera_aciertos('62',$equipoA); // RUN LINE MEDIO JUEGO A
				genera_aciertos('63',$equipoB); // RUN LINE MEDIO JUEGO B
				genera_aciertos('64',$equipoA); // ALTA JUEGO COMPLETO A
				genera_aciertos('65',$equipoB); // BAJA JUEGO COMPLETO A
				genera_aciertos('66',$equipoA); // ALTA MEDIO JUEGO A
				genera_aciertos('67',$equipoB); // BAJA MEDIO JUEGO A
				genera_aciertos('82',$equipoA); // A GANAR 2DA MITAD A
				genera_aciertos('83',$equipoB); // A GANAR 2DA MITAD B
				genera_aciertos('84',$equipoA); // RUN LINE ALTERNATIVO A
				genera_aciertos('85',$equipoB); // RUN LINE ALTERNATIVO B
				genera_aciertos('86',$equipoA); // PRIMER TIEMPO A
				genera_aciertos('87',$equipoB); // PRIMER TIEMPO B
				genera_aciertos('88',$equipoA); // SEGUNDO TIEMPO A
				genera_aciertos('89',$equipoB); // SEGUNDO TIEMPO B
				genera_aciertos('90',$equipoA); // TERCER TIEMPO A
				genera_aciertos('91',$equipoB); // TERCER TIEMPO B
				genera_aciertos('92',$equipoA); // ALTAS 2H A
				genera_aciertos('93',$equipoB); // BAJAS 2H A
				/*TERMINA BASKET ************************************************************************************************/
				break;
			case 'futbolamericano':
				/*INICIA FUTBOL AMERICANO    ************************************************************************************/
						if($_POST['resultado'][$equipoA][32]>0){
							$suspendido_2m=1;
						}else{
							$suspendido_2m=0;
						}
						if($_POST['resultado'][$equipoA][31]>0){
							$suspendido_todo=1;
							$suspendido_2m=1;
						}else{
							$suspendido_todo=0;
							//$suspendido_2m=0;
						}						
						
		/***********JUEGO COMPLETO********************************************************************************/
					$_SESSION['suspendido']=0;
					if($suspendido_2m || $suspendido_todo) $_SESSION['suspendido']=1;
					//PARA JUEGOS C MONEY LINE
							if($_SESSION['suspendido']>0){
								genera_aciertos('100',$equipoA);
								genera_aciertos('111',$equipoB);
								genera_aciertos('95',$equipoA);
								genera_aciertos('96',$equipoB);
								genera_aciertos('102',$equipoA);
								genera_aciertos('103',$equipoA);
								genera_aciertos('106',$equipoA);
							}
							
							
						if($_POST['resultado'][$equipoA][33]==$_POST['resultado'][$equipoB][34]){
								$_SESSION['suspendido']=1;
								genera_aciertos('100',$equipoA);
								genera_aciertos('111',$equipoB);
								$_SESSION['suspendido']=0;
						}else{
							
							if($_POST['resultado'][$equipoA][33]>$_POST['resultado'][$equipoB][34]):
									genera_aciertos('100',$equipoA);
							elseif($_POST['resultado'][$equipoA][33]<$_POST['resultado'][$equipoB][34]):
									genera_aciertos('111',$equipoB);
							endif;
						}
						//TERMINA PARA JUEGOS C MONEY LINE						
						
						//PARA RUNLINE 1 1/2 JUEGO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='95' limit 1");
							//echo $multi['multiplicando'];
							
							/*$resta_carreras= (int) $_POST['resultado'][$equipoA][33]-$_POST['resultado'][$equipoB][34];
							if($resta_carreras<1){$resta_carreras*(-1);}

							$multi_aleRL=dame_datos("select * from logros_equipos_categorias_apuestas 
														WHERE idlogro_equipo='".$equipoA."' and idcategoria_apuesta='96' limit 1");
							*/
							$resultado_completo_A=$_POST['resultado'][$equipoA][33];
							$resultado_completo_B=$_POST['resultado'][$equipoB][34];
							

							$compara=(float)($resultado_completo_A+$multi['multiplicando']);
							
							if($compara==$resultado_completo_B){
										$_SESSION['suspendido']=1;
										genera_aciertos('95',$equipoA);
										genera_aciertos('96',$equipoB);
										$_SESSION['suspendido']=0;
							
							}else if($compara>$resultado_completo_B){
								genera_aciertos('95',$equipoA);															
							}else{
								genera_aciertos('96',$equipoB);
							}
							/*
							$resta_carreras= (int) $resultado_completo_A-$resultado_completo_B;
							
							$resta_carreras1=$resta_carreras.".0";
							
							if($resta_carreras1<1){$resta_carreras1=($resta_carreras1*(-1));}
								
								$multi_aleRL=dame_datos("select * from logros_equipos_categorias_apuestas 
														WHERE idlogro_equipo='".$equipoA."'
														AND idcategoria_apuesta='95' limit 1");
								
								$valor_comparacion=$multi_aleRL['multiplicando'];

								if($valor_comparacion<1){$valor_comparacion=($multi_aleRL['multiplicando']*(-1));}
								
							if($resta_carreras1==$valor_comparacion){
										$_SESSION['suspendido']=1;
										genera_aciertos('95',$equipoA);
										genera_aciertos('96',$equipoB);
										$_SESSION['suspendido']=0;
							}else{							

								
									if($multi['multiplicando']>0): //es decir 1.5
										$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
									else: //es decir -1.5
										$resultado_completo_B= (float) ($resultado_completo_B+($multi['multiplicando']*(-1)));
											
									endif;
										echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
											if($resultado_completo_A > $resultado_completo_B):											
													genera_aciertos('95',$equipoA);											
											else:											
													genera_aciertos('96',$equipoB);											
											endif;
							
							
							}*/
							
						//TERMINA PARA RUNLINE 1 1/2 JUEGO						
						
						//PARA ALTAS Y BAJAS JUEGO COMPLETO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='102' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras= (int) $_POST['resultado'][$equipoA][33]+$_POST['resultado'][$equipoB][34];
							
							
							$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='109' limit 1");
							echo "\nJC $equipoA $equipoB -> Suma $suma_carreras - pago {$multi_ale['pago']} - multi {$multi['multiplicando']}\n";
							
							//$multi_ale
							if($suma_carreras==$multi_ale['pago']){
										$_SESSION['suspendido']=1;
										genera_aciertos('103',$equipoA);
										genera_aciertos('102',$equipoA);
										$_SESSION['suspendido']=0;
							}else{
								
								
								//////ojo cambie los signos mayor que y menor, los inverti hay que cotejar
								if($multi_ale['pago']>$suma_carreras): //if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
									genera_aciertos('103',$equipoA);
								elseif($multi_ale['pago']<$suma_carreras): //elseif($multi['multiplicando']<$suma_carreras): //ganan las altas
									genera_aciertos('102',$equipoA);
								else:
									if($_SESSION['suspendido']==0):
										$_SESSION['suspendido']=1;
										genera_aciertos('103',$equipoA);
										genera_aciertos('102',$equipoA);
										$_SESSION['suspendido']=0;
									endif;
								endif;
							}
								
								
								
						//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
						//PARA EMPATE JUEGO COMPLETO
							if($_POST['resultado'][$equipoA][33]==$_POST['resultado'][$equipoB][34]){
								genera_aciertos('106',$equipoA);
							}
						//TERMINA PARA EMPATE JUEGO COMPLETO
			/***********TERMINA JUEGO COMPLETO*******************************************************************/
				
			/***********MEDIO JUEGO******************************************************************************/
			echo " \n es medio juego?  $equipoA $equipoB \n";
					$_SESSION['suspendido']=0;
					if($suspendido_todo) $_SESSION['suspendido']=1;
						//PARA MEDIOS JUEGOS MONEY LINE
							if($_SESSION['suspendido']>0){
								echo " \nsuspendido $equipoA $equipoB\n";
									genera_aciertos('99',$equipoA);
									genera_aciertos('101',$equipoB);
									genera_aciertos('104',$equipoA);
									genera_aciertos('105',$equipoA);
									genera_aciertos('107',$equipoA);									
							}
							/*
							if($_POST['resultado'][$equipoA][29]>$_POST['resultado'][$equipoB][30]):
									genera_aciertos('101',$equipoB);
								echo " \n resultado MJ  $equipoA $equipoB -> {$_POST['resultado'][$equipoA][29]}>{$_POST['resultado'][$equipoB][30]}\n";
							elseif($_POST['resultado'][$equipoA][29]<$_POST['resultado'][$equipoB][30]):
								echo " \n resultado MJ  $equipoA $equipoB -> {$_POST['resultado'][$equipoA][29]}<{$_POST['resultado'][$equipoB][30]}\n";
								//gana apuesta 26 {
									genera_aciertos('99',$equipoA);
								//gana apuesta 26 }
								
							endif;*/
							
							
							if($_POST['resultado'][$equipoA][29]>$_POST['resultado'][$equipoB][30]):
									genera_aciertos('101',$equipoA);
							elseif($_POST['resultado'][$equipoA][29]<$_POST['resultado'][$equipoB][30]):
									genera_aciertos('99',$equipoB);
							endif;
							
						//TERMINA PARA MEDIOS JUEGOS MONEY LINE	
						
						//PARA ALTAS Y BAJAS MEDIO JUEGO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='104' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras_m= (int) $_POST['resultado'][$equipoA][29]+$_POST['resultado'][$equipoB][30];
							
							$multi_aleMJ=dame_datos("select pago from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='110' limit 1");
							
							echo "\nMJ $equipoA $equipoB -> Suma $suma_carreras_m - pago {$multi_aleMJ['pago']} - multi {$multi['multiplicando']}\n";
							//$multi_ale
							if($suma_carreras_m==$multi_aleMJ['pago']){
										echo " \n resultado  $equipoA $equipoB -> multi_aleMJ? no se pero dio esto: {$multi_aleMJ['pago']}\n";
										$_SESSION['suspendido']=1;
										genera_aciertos('105',$equipoA);
										genera_aciertos('104',$equipoA);
										$_SESSION['suspendido']=0;	
							}else{
							
								if($multi_aleMJ['pago']>$suma_carreras_m): //if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
									genera_aciertos('105',$equipoA);
								elseif($multi_aleMJ['pago']<$suma_carreras_m)://elseif($multi['multiplicando']<$suma_carreras_m): //ganan las altas
									genera_aciertos('104',$equipoA);
								else:
									if($_SESSION['suspendido']==0):
										$_SESSION['suspendido']=1;
										genera_aciertos('105',$equipoA);
										genera_aciertos('104',$equipoA);
										$_SESSION['suspendido']=0;
									endif;
								endif;
							
							
							
							/*
							
								if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas		
									echo " \n resultado  $equipoA $equipoB -> Gana bajas {$multi['multiplicando']}>$suma_carreras_m\n";
															
									genera_aciertos('104',$equipoA);
								elseif($multi['multiplicando']<$suma_carreras_m): //ganan las altas		
									echo " \n resultado  $equipoA $equipoB -> Gana altas {$multi['multiplicando']}<$suma_carreras_m\n";							
									genera_aciertos('105',$equipoA);	
								else:
									if($_SESSION['suspendido']==0):
										echo " \n resultado  $equipoA $equipoB -> NO se que es esto_ {$multi['multiplicando']}<$suma_carreras_m\n";
										$_SESSION['suspendido']=1;
										genera_aciertos('105',$equipoA);
										genera_aciertos('104',$equipoA);
										$_SESSION['suspendido']=0;										
									endif;
								endif;	*/
							}
						//TERMINA PARA ALTAS Y BAJAS MEDIO JUEGO
						
						//PARA EMPATE MEDIO JUEGO
							if($_POST['resultado'][$equipoA][29]==$_POST['resultado'][$equipoB][30]){
								echo " \n empate MJ  $equipoA $equipoB -> {$_POST['resultado'][$equipoA][29]}<{$_POST['resultado'][$equipoB][30]}\n";
								genera_aciertos('107',$equipoA);
							}
						//TERMINA PARA EMPATE MEDIO JUEGO
						
					/***********TERMINA MEDIO JUEGO*************************************************************/		
/*TERMINA FUTBOL AMERICANO******************************************************************************************/
				
				break;
				}
			//		if($_POST['resultado_categoria']=='beisbol'){}
		
		//CALCULO TICKETS GANADORES
		setea_tickets($equipoA,$equipoB);
		else:
		
			echo "\n<br>IMPAR: idlogro_equipo_: $idlogro_equipo";
		
		endif; //END DEL CONTROLADOR DE PARES
		$imp++;
	}
	//FUNCION QUE CALCULA LOS TICKETS GANADORES
	calcula_ticket_ganador($_REQUEST['fecha_res']);
?>