<?Php session_start();
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
				if($existe)
					mysql_query("update logros_equipos_categorias_resultados set estatus='".$_POST['estatus_'.$idlogro_equipo]."',resultado='".$val."',idadministrador_modifica='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where idlogro_equipo='".$idlogro_equipo."' and idcategoria_resultado='".$idcategoria_resultado."' limit 1");
				else
					mysql_query("insert into logros_equipos_categorias_resultados() values('','".$idlogro_equipo."','".$idcategoria_resultado."','".$val."','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','".$_POST['estatus_'.$idlogro_equipo]."')");
					
			}			
	}
	
	
	//VIENE LO RUDO POR ENRONY 04268341090
			//CALCULO DE APUESTAS GANADORAS
	$imp=0;
	foreach($_POST['resultado'] as $idlogro_equipo=>$valor){
		if($imp%2==0):
			echo 'idlogro_equipo_: '.$idlogro_equipo.'<br>';
			$equipoA=(int)$idlogro_equipo;
			$equipoB=(int)$idlogro_equipo+1;
			
			//Seteo a estatus cero las apuestas acertadas previamente cargadas			
			mysql_query("update vista_aciertos set estatus='0' where idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."'");
			//Seteo las jugadas suspendidas
			mysql_query("update logros_equipos_categorias_apuestas set suspendido=0 where idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."'");
			
				switch($_POST['resultado_categoria']){
					case 'beisbol':
				/*BEISBOL****************************************************************************************************************************/
						if($_POST['resultado'][$equipoA][6]>0){
							$suspendido_2m=1;
						}else{
							$suspendido_2m=0;
						}
						if($_POST['resultado'][$equipoA][3]>0){
							$suspendido_todo=1;
							$suspendido_2m=1;
						}else{
							$suspendido_todo=0;
							//if(!$suspendido_2m) $suspendido_2m=0;
						}					
						
						
						/*********JUEGOS COMPLETOS*******************************************************************************************************************/
						$_SESSION['suspendido'] =0;
							if($suspendido_todo || $suspendido_2m) $_SESSION['suspendido']=1;
							echo 'Suspendido -> '.$_SESSION['suspendido'].' <- <br>';
							//PARA JUEGOS C MONEY LINE
								if($_SESSION['suspendido']>0){
										genera_aciertos('23',$equipoA);
										genera_aciertos('25',$equipoB);
										genera_aciertos('80',$equipoA);
										genera_aciertos('81',$equipoB);
										genera_aciertos('77',$equipoA);
										genera_aciertos('78',$equipoA);
										genera_aciertos('27',$equipoA);
										genera_aciertos('28',$equipoB);
										genera_aciertos('73',$equipoA);
										genera_aciertos('74',$equipoB);
										genera_aciertos('32',$equipoA);
										genera_aciertos('31',$equipoA);
										genera_aciertos('72',$equipoA);
										genera_aciertos('71',$equipoA);
								}
								if($_POST['resultado'][$equipoA][4]>$_POST['resultado'][$equipoB][5]):
										genera_aciertos('23',$equipoA);
								elseif($_POST['resultado'][$equipoA][4]<$_POST['resultado'][$equipoB][5]):
										genera_aciertos('25',$equipoB);								
								endif;
							//TERMINA PARA JUEGOS C MONEY LINE
							
							//PARA 2M  MONEY LINE
								if($_POST['resultado'][$equipoA][9]>$_POST['resultado'][$equipoB][10]):								
										genera_aciertos('80',$equipoA);								
								elseif($_POST['resultado'][$equipoA][9]<$_POST['resultado'][$equipoB][10]):								
										genera_aciertos('81',$equipoB);
								endif;
							//TERMINA PARA 2M MONEY LINE
							
							//PARA RUNLINE 1 1/2 JUEGO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='27' limit 1");
								//echo $multi['multiplicando'];
								$resultado_completo_A=$_POST['resultado'][$equipoA][4];
								$resultado_completo_B=$_POST['resultado'][$equipoB][5];
									if($multi['multiplicando']>0): //es decir 1.5
										$resultado_completo_A= (float) ($resultado_completo_A+1.5);
									else: //es decir -1.5
										$resultado_completo_B= (float) ($resultado_completo_B+1.5);
											
									endif;
										echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
											if($resultado_completo_A > $resultado_completo_B):											
													genera_aciertos('27',$equipoA);											
											else:											
													genera_aciertos('28',$equipoB);											
											endif;
							//TERMINA PARA RUNLINE 1 1/2 JUEGO
							
							//PARA RUNLINE alternativo 1 1/2 JUEGO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='73' limit 1");
								//echo $multi['multiplicando'];
								$resultado_completo_A=$_POST['resultado'][$equipoA][4];
								$resultado_completo_B=$_POST['resultado'][$equipoB][5];
									if($multi['multiplicando']>0): //es decir 1.5
										$resultado_completo_A= (float) ($resultado_completo_A+1.5);
									else: //es decir -1.5
										$resultado_completo_B= (float) ($resultado_completo_B+1.5);										
									endif;
										echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
											if($resultado_completo_A > $resultado_completo_B):											
													genera_aciertos('73',$equipoA);												
											else:											
													genera_aciertos('74',$equipoB);												
											endif;
							//TERMINA PARA RUNLINE alternativo 1 1/2 JUEGO
							
							//PARA SUPER RUNLINE 2 1/2 JUEGO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='47' limit 1");
								//echo $multi['multiplicando'];
								$resultado_completo_A=$_POST['resultado'][$equipoA][4];
								$resultado_completo_B=$_POST['resultado'][$equipoB][5];
									if($multi['multiplicando']>0): //es decir 2.5
										$resultado_completo_A= (float) ($resultado_completo_A+2.5);
									else: //es decir -2.5
										$resultado_completo_B= (float) ($resultado_completo_B+2.5);
											
									endif;
										echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
											if($resultado_completo_A > $resultado_completo_B):											
													genera_aciertos('47',$equipoA);																							
											else:											
													genera_aciertos('48',$equipoB);											
											endif;
							//TERMINA PARA SUPER RUNLINE 2 1/2 JUEGO
							
							//PARA ALTAS Y BAJAS JUEGO COMPLETO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='31' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras= (int) $_POST['resultado'][$equipoA][4]+$_POST['resultado'][$equipoB][5];
								
									if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
										genera_aciertos('32',$equipoA);
									else: //ganan las altas									
										genera_aciertos('31',$equipoA);	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
							
							//PARA ALTAS Y BAJAS 2M
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='77' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras= (int) $_POST['resultado'][$equipoA][9]+$_POST['resultado'][$equipoB][10];
								
									if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
										genera_aciertos('78',$equipoA);
									else: //ganan las altas									
										genera_aciertos('77',$equipoA);	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS 2M
							
							//PARA ALTAS Y BAJAS DEL CHE JUEGO COMPLETO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='71' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras= (int) $_POST['resultado'][$equipoA][4]+$_POST['resultado'][$equipoB][5]+$_POST['resultado'][$equipoA][11]+$_POST['resultado'][$equipoB][12]+$_POST['resultado'][$equipoA][13]+$_POST['resultado'][$equipoB][14];
								
									if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
										genera_aciertos('72',$equipoA);
									else: //ganan las altas									
										genera_aciertos('71',$equipoA);	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS DEL CHE JUEGO COMPLETO
							
						/*********TERMINA JUEGOS COMPLETOS*******************************************************************************************************************/
						
						/*********MEDIOS JUEGOS*******************************************************************************************************************/
						$_SESSION['suspendido']=0;
							if($suspendido_todo) $_SESSION['suspendido']=1;
							//PARA MEDIOS JUEGOS MONEY LINE								
							
							if($_SESSION['suspendido']>0){
									genera_aciertos('24',$equipoA);
									genera_aciertos('26',$equipoB);
									genera_aciertos('33',$equipoA);
									genera_aciertos('34',$equipoA);
									if($_POST['resultado'][$equipoA][7]!=0 and $_POST['resultado'][$equipoA][7]!=1):
										genera_aciertos('39',$equipoA);
										genera_aciertos('40',$equipoA);
									endif;
									if(!$_POST['resultado'][$equipoA][8]):
										genera_aciertos('37',$equipoA);
										genera_aciertos('38',$equipoB);
									endif;
							}
								if($_POST['resultado'][$equipoA][1]>$_POST['resultado'][$equipoB][2]):
										genera_aciertos('24',$equipoA);
								elseif($_POST['resultado'][$equipoA][1]<$_POST['resultado'][$equipoB][2]):
									//gana apuesta 26 {
										genera_aciertos('26',$equipoB);
									//gana apuesta 26 }								
								endif;
							//TERMINA PARA MEDIOS JUEGOS MONEY LINE	
						
							//PARA RUNLINE 1/2 JUEGO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='29' limit 1");
								//echo $multi['multiplicando'];
								$resultado_mitad_A=$_POST['resultado'][$equipoA][1];
								$resultado_mitad_B=$_POST['resultado'][$equipoB][2];
									if($multi['multiplicando']>0): //es decir 0.5
										$resultado_mitad_A= (float) ($resultado_mitad_A+0.5);
									else: //es decir -0.5
										$resultado_mitad_B= (float) ($resultado_mitad_B+0.5);
											
									endif;
										echo '<br>'.$resultado_mitad_A.' <>'.$resultado_mitad_B.'<br>';
											if($resultado_mitad_A > $resultado_mitad_B):											
													genera_aciertos('29',$equipoA);											
											else:											
													genera_aciertos('30',$equipoB);											
											endif;
							//TERMINA PARA RUNLINE 1/2 JUEGO						
							
							//PARA ALTAS Y BAJAS MEDIO JUEGO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='33' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras_m= (int) $_POST['resultado'][$equipoA][1]+$_POST['resultado'][$equipoB][2];
								
									if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
										genera_aciertos('34',$equipoA);
									else: //ganan las altas									
										genera_aciertos('33',$equipoA);	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS MEDIO JUEGO
						
						/*********TERMINA MEDIOS JUEGOS*******************************************************************************************************************/						
						
						//PARA CARRERAS EN PRIMER INNING
								if($_POST['resultado'][$equipoA][7]==1): //SI HUBO CARRERA
									$_SESSION['suspendido']=0;//es valida la apuesta
									genera_aciertos('39',$equipoA);
								elseif($_POST['resultado'][$equipoA][7]==0): //NO HUBO CARRERA
									$_SESSION['suspendido']=0;//es valida la apuesta
									genera_aciertos('40',$equipoA);	
								endif;									
						//TERMINA PARA CARRERAS EN PRIMER INNING
						
						//PARA ANOTA PRIMERO
								if($_POST['resultado'][$equipoA][8]==$equipoA): //Anota el A
									$_SESSION['suspendido']=0;//es valida la apuesta
									genera_aciertos('37',$equipoA);
								elseif($_POST['resultado'][$equipoA][8]==$equipoB): //Anota el B									
									$_SESSION['suspendido']=0;//es valida la apuesta
									genera_aciertos('38',$equipoB);	
								endif;									
						//TERMINA PARA ANOTA PRIMERO
						
			/*TERMINA BEISBOL****************************************************************************************************************************/			
			
					break;
					
					case 'futbol':
			/*INICIA FUTBOL****************************************************************************************************************************/
						if($_POST['resultado'][$equipoA][14]>0){
							$suspendido_2m=1;
						}else{
							$suspendido_2m=0;
						}
						if($_POST['resultado'][$equipoA][13]>0){
							$suspendido_todo=1;
							$suspendido_2m=1;
						}else{
							$suspendido_todo=0;
							//$suspendido_2m=0;
						}						
						
				/***********JUEGO COMPLETO*******************************************************************************************************************/
					$_SESSION['suspendido']=0;
					if($suspendido_2m || $suspendido_todo) $_SESSION['suspendido']=1;
					//PARA JUEGOS C MONEY LINE
							if($_SESSION['suspendido']>0){
								genera_aciertos('19',$equipoA);
								genera_aciertos('21',$equipoB);
								genera_aciertos('16',$equipoA);
								genera_aciertos('17',$equipoB);
								genera_aciertos('41',$equipoA);
								genera_aciertos('42',$equipoA);
								genera_aciertos('49',$equipoA);
							}
							if($_POST['resultado'][$equipoA][15]>$_POST['resultado'][$equipoB][16]):
									genera_aciertos('19',$equipoA);
							elseif($_POST['resultado'][$equipoA][15]<$_POST['resultado'][$equipoB][16]):
									genera_aciertos('21',$equipoB);
							endif;
						//TERMINA PARA JUEGOS C MONEY LINE						
						
						//PARA RUNLINE 1 1/2 JUEGO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='16' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][15];
							$resultado_completo_B=$_POST['resultado'][$equipoB][16];
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+$multi['multiplicando']);
										
								endif;
									echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
										if($resultado_completo_A > $resultado_completo_B):											
												genera_aciertos('16',$equipoA);											
										else:											
												genera_aciertos('17',$equipoB);											
										endif;
						//TERMINA PARA RUNLINE 1 1/2 JUEGO						
						
						//PARA ALTAS Y BAJAS JUEGO COMPLETO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='41' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras= (int) $_POST['resultado'][$equipoA][15]+$_POST['resultado'][$equipoB][16];
							
								if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
									genera_aciertos('42',$equipoA);
								else: //ganan las altas									
									genera_aciertos('41',$equipoA);	
								endif;									
						//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
						//PARA EMPATE JUEGO COMPLETO
							if($_POST['resultado'][$equipoA][15]==$_POST['resultado'][$equipoB][16]){
								genera_aciertos('49',$equipoA);
							}
						//TERMINA PARA EMPATE JUEGO COMPLETO
				/***********TERMINA JUEGO COMPLETO*******************************************************************************************************************/
				
				/***********MEDIO JUEGO*******************************************************************************************************************/
					$_SESSION['suspendido']=0;
					if($suspendido_todo) $_SESSION['suspendido']=1;
						//PARA MEDIOS JUEGOS MONEY LINE
							if($_SESSION['suspendido']>0){
									genera_aciertos('20',$equipoA);
									genera_aciertos('22',$equipoB);
									genera_aciertos('43',$equipoA);
									genera_aciertos('44',$equipoA);
									genera_aciertos('50',$equipoA);									
							}
							if($_POST['resultado'][$equipoA][11]>$_POST['resultado'][$equipoB][12]):
									genera_aciertos('20',$equipoA);
							elseif($_POST['resultado'][$equipoA][11]<$_POST['resultado'][$equipoB][12]):
								//gana apuesta 26 {
									genera_aciertos('22',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA MEDIOS JUEGOS MONEY LINE	
						
						//PARA ALTAS Y BAJAS MEDIO JUEGO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='43' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras_m= (int) $_POST['resultado'][$equipoA][11]+$_POST['resultado'][$equipoB][12];
							
								if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
									genera_aciertos('44',$equipoA);
								else: //ganan las altas									
									genera_aciertos('43',$equipoA);	
								endif;									
						//TERMINA PARA ALTAS Y BAJAS MEDIO JUEGO
						
						//PARA EMPATE MEDIO JUEGO
							if($_POST['resultado'][$equipoA][11]==$_POST['resultado'][$equipoB][12]){
								genera_aciertos('50',$equipoA);
							}
						//TERMINA PARA EMPATE MEDIO JUEGO
						
					/***********TERMINA MEDIO JUEGO*******************************************************************************************************************/		
			/*TERMINA FUTBOL****************************************************************************************************************************/
					break;
					case 'basket':
			/*INICIA BASKET****************************************************************************************************************************/			
						//PARA 1H MONEY LINE
							if($_POST['resultado'][$equipoA][17]>$_POST['resultado'][$equipoB][18]):
									genera_aciertos('57',$equipoA);
							elseif($_POST['resultado'][$equipoA][17]<$_POST['resultado'][$equipoB][18]):
								//gana apuesta 26 {
									genera_aciertos('59',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA 1H MONEY LINE
						
						//PARA 2H MONEY LINE
							if($_POST['resultado'][$equipoA][21]>$_POST['resultado'][$equipoB][22]):
									genera_aciertos('82',$equipoA);
							elseif($_POST['resultado'][$equipoA][21]<$_POST['resultado'][$equipoB][22]):
								//gana apuesta 26 {
									genera_aciertos('83',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA 2H MONEY LINE
						
						//PARA 1T MONEY LINE
							if($_POST['resultado'][$equipoA][23]>$_POST['resultado'][$equipoB][24]):
									genera_aciertos('86',$equipoA);
							elseif($_POST['resultado'][$equipoA][23]<$_POST['resultado'][$equipoB][24]):
								//gana apuesta 26 {
									genera_aciertos('87',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA 1T MONEY LINE	
						
						//PARA 2T MONEY LINE
							if($_POST['resultado'][$equipoA][25]>$_POST['resultado'][$equipoB][26]):
									genera_aciertos('88',$equipoA);
							elseif($_POST['resultado'][$equipoA][25]<$_POST['resultado'][$equipoB][26]):
								//gana apuesta 26 {
									genera_aciertos('89',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA 2T MONEY LINE
						
						//PARA 3T MONEY LINE
							if($_POST['resultado'][$equipoA][27]>$_POST['resultado'][$equipoB][28]):
									genera_aciertos('90',$equipoA);
							elseif($_POST['resultado'][$equipoA][27]<$_POST['resultado'][$equipoB][28]):
								//gana apuesta 26 {
									genera_aciertos('91',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA 3T MONEY LINE
						
						//PARA JUEGOS C MONEY LINE
							if($_POST['resultado'][$equipoA][19]>$_POST['resultado'][$equipoB][20]):
									genera_aciertos('56',$equipoA);
							elseif($_POST['resultado'][$equipoA][19]<$_POST['resultado'][$equipoB][20]):
									genera_aciertos('58',$equipoB);								
							endif;
						//TERMINA PARA JUEGOS C MONEY LINE						
						
						//PARA RUNLINE JC
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='60' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][19];
							$resultado_completo_B=$_POST['resultado'][$equipoB][20];
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+$multi['multiplicando']);
										
								endif;
									echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
										if($resultado_completo_A > $resultado_completo_B):											
												genera_aciertos('60',$equipoA);											
										else:											
												genera_aciertos('61',$equipoB);											
										endif;
						//TERMINA PARA RUNLINE JC
						
						//PARA RUNLINE 1H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='62' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][17];
							$resultado_completo_B=$_POST['resultado'][$equipoB][18];
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+$multi['multiplicando']);
										
								endif;
									echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
										if($resultado_completo_A > $resultado_completo_B):											
												genera_aciertos('62',$equipoA);											
										else:											
												genera_aciertos('63',$equipoB);											
										endif;
						//TERMINA PARA RUNLINE 1H
						
						//PARA RUNLINE 2H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='84' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][21];
							$resultado_completo_B=$_POST['resultado'][$equipoB][22];
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+$multi['multiplicando']);
										
								endif;
									echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
										if($resultado_completo_A > $resultado_completo_B):											
												genera_aciertos('84',$equipoA);											
										else:											
												genera_aciertos('85',$equipoB);											
										endif;
						//TERMINA PARA RUNLINE 2H	
						
						//PARA ALTAS Y BAJAS JUEGO COMPLETO
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='64' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras= (int) $_POST['resultado'][$equipoA][19]+$_POST['resultado'][$equipoB][20];
							
								if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
									genera_aciertos('65',$equipoA);
								else: //ganan las altas									
									genera_aciertos('64',$equipoA);	
								endif;									
						//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
						
						//PARA ALTAS Y BAJAS 1H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='66' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras_m= (int) $_POST['resultado'][$equipoA][17]+$_POST['resultado'][$equipoB][18];
							
								if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
									genera_aciertos('67',$equipoA);
								else: //ganan las altas									
									genera_aciertos('66',$equipoA);	
								endif;									
						//TERMINA PARA ALTAS Y BAJAS 1H
						
						//PARA ALTAS Y BAJAS 2H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='92' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras_m= (int) $_POST['resultado'][$equipoA][21]+$_POST['resultado'][$equipoB][22];
							
								if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
									genera_aciertos('93',$equipoA);
								else: //ganan las altas									
									genera_aciertos('92',$equipoA);	
								endif;									
						//TERMINA PARA ALTAS Y BAJAS 2H
						
			/*TERMINA BASKET****************************************************************************************************************************/
					break;
				}
			//		if($_POST['resultado_categoria']=='beisbol'){}
		
		//CALCULO TICKETS GANADORES
		setea_tickets($equipoA,$equipoB);
		
		endif; //END DEL CONTROLADOR DE PARES
		$imp++;
	}
	//FUNCION QUE CALCULA LOS TICKETS GANADORES
	calcula_ticket_ganador($_REQUEST['fecha_res']);
?>