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
					mysql_debug_query("update logros_equipos_categorias_resultados set estatus='".$_POST['estatus_'.$idlogro_equipo]."',resultado='".$val."',idadministrador_modifica='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where idlogro_equipo='".$idlogro_equipo."' and idcategoria_resultado='".$idcategoria_resultado."' limit 1");
				else
					mysql_debug_query("insert into logros_equipos_categorias_resultados() values('','".$idlogro_equipo."','".$idcategoria_resultado."','".$val."','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','".$_POST['estatus_'.$idlogro_equipo]."')");
					
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
			
				switch($_POST['resultado_categoria']){
					case 'beisbol':
				/*BEISBOL**********************************************************************************************************/
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
						
						
						/*********JUEGOS COMPLETOS*************************************************************/
						$_SESSION['suspendido'] =0;
						$todo=0;
							if($suspendido_todo || $suspendido_2m) $_SESSION['suspendido']=1;
							echo 'Suspendido -> '.$_SESSION['suspendido'].' <- <br>';
							//PARA JUEGOS C MONEY LINE
								if($_SESSION['suspendido']>0){
										$todo=1;
										
										if($_POST['resultado'][$equipoA][3]>=1){
											genera_aciertos('23',$equipoA); // tenia este comentado
											genera_aciertos('25',$equipoB); // tenia este comentado
											genera_aciertos('39',$equipoA);
											genera_aciertos('40',$equipoA);
											genera_aciertos('29',$equipoA);///agregado Runline MJ
											genera_aciertos('30',$equipoB);///agregado Runline MJ											
											genera_aciertos('37',$equipoA);///agregado Anota1ero
											genera_aciertos('38',$equipoA);///agregado Anota1ero
										}
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
										genera_aciertos('47',$equipoA);///agregado superRunline
										genera_aciertos('48',$equipoB);///agregado superRunline									

																			
								}
								if($_POST['resultado'][$equipoA][4]>$_POST['resultado'][$equipoB][5]):
									if($_SESSION['suspendido']>0): $band='si';$_SESSION['suspendido']=0; else: $band=''; endif;
										genera_aciertos('23',$equipoA);
								elseif($_POST['resultado'][$equipoA][4]<$_POST['resultado'][$equipoB][5]):
									if($_SESSION['suspendido']>0): $band='si';$_SESSION['suspendido']=0; else: $band=''; endif;
										genera_aciertos('25',$equipoB);								
								endif;
								if($band=='si'): $_SESSION['suspendido']=1; $band=''; endif;
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
									elseif($multi['multiplicando']<$suma_carreras): //ganan las altas									
										genera_aciertos('31',$equipoA);
									else:
										if($_SESSION['suspendido']==0):
											$_SESSION['suspendido']=1;
											genera_aciertos('32',$equipoA);
											genera_aciertos('31',$equipoA);
											$_SESSION['suspendido']=0;
										endif;
									endif;									
							//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
							
							//PARA ALTAS Y BAJAS 2M
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='77' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras= (int) $_POST['resultado'][$equipoA][9]+$_POST['resultado'][$equipoB][10];
								
									if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
										genera_aciertos('78',$equipoA);
									elseif($multi['multiplicando']<$suma_carreras): //ganan las altas									
										genera_aciertos('77',$equipoA);
									else:
										if($_SESSION['suspendido']==0):
											$_SESSION['suspendido']=1;
											genera_aciertos('78',$equipoA);
											genera_aciertos('77',$equipoA);
											$_SESSION['suspendido']=0;
										endif;
									endif;									
							//TERMINA PARA ALTAS Y BAJAS 2M
							
							//PARA ALTAS Y BAJAS DEL CHE JUEGO COMPLETO
								$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='71' limit 1");
								//echo $multi['multiplicando'];
								$suma_carreras= (int) $_POST['resultado'][$equipoA][4]+$_POST['resultado'][$equipoB][5]+$_POST['resultado'][$equipoA][11]+$_POST['resultado'][$equipoB][12]+$_POST['resultado'][$equipoA][13]+$_POST['resultado'][$equipoB][14];
								
									if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
										genera_aciertos('72',$equipoA);
									elseif($multi['multiplicando']<$suma_carreras): //ganan las altas									
										genera_aciertos('71',$equipoA);	
									else:
										if($_SESSION['suspendido']==0):
											$_SESSION['suspendido']=1;
											genera_aciertos('72',$equipoA);
											genera_aciertos('71',$equipoA);
											$_SESSION['suspendido']=0;
										endif;	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS DEL CHE JUEGO COMPLETO
							
						/*********TERMINA JUEGOS COMPLETOS*******************************************************************************************************************/
						
						/*********MEDIOS JUEGOS*******************************************************************************************************************/
						$_SESSION['suspendido']=0;
							if($suspendido_todo) $_SESSION['suspendido']=1;
							
							
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
							//PARA MEDIOS JUEGOS MONEY LINE
								if($_POST['resultado'][$equipoA][1]>$_POST['resultado'][$equipoB][2]):
										genera_aciertos('24',$equipoA);
								elseif($_POST['resultado'][$equipoA][1]<$_POST['resultado'][$equipoB][2]):
									//gana apuesta 26 {
										genera_aciertos('26',$equipoB);
									//gana apuesta 26 }
								else:
									if($_SESSION['suspendido']==0):
											$_SESSION['suspendido']=1;
											genera_aciertos('24',$equipoA);
											genera_aciertos('26',$equipoB);
											$_SESSION['suspendido']=0;
									endif;	
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
									elseif($multi['multiplicando']<$suma_carreras_m): //ganan las altas									
										genera_aciertos('33',$equipoA);	
									else:
										if($_SESSION['suspendido']==0):
											$_SESSION['suspendido']=1;
											genera_aciertos('34',$equipoA);
											genera_aciertos('33',$equipoA);
											$_SESSION['suspendido']=0;
										endif;	
									endif;									
							//TERMINA PARA ALTAS Y BAJAS MEDIO JUEGO
						
						/*********TERMINA MEDIOS JUEGOS*******************************************************************************************************************/						
						
						//PARA CARRERAS EN PRIMER INNING
								if($_POST['resultado'][$equipoA][7]==1){ //SI HUBO CARRERA
									$_SESSION['suspendido']=0;//es valida la apuesta
										if($_POST['resultado'][$equipoA][3]!=1){
											genera_aciertos('39',$equipoA);
										}
								}else if($_POST['resultado'][$equipoA][7]==0){ //NO HUBO CARRERA
									$_SESSION['suspendido']=0;//es valida la apuesta
										if($_POST['resultado'][$equipoA][3]!=1){
											genera_aciertos('40',$equipoA);	
										}
								}//endif;									
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
									$resultado_completo_B= (float) ($resultado_completo_B+($multi['multiplicando']*(-1)));
										
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
								elseif($multi['multiplicando']<$suma_carreras): //ganan las altas
									genera_aciertos('41',$equipoA);
								else:
									if($_SESSION['suspendido']==0):
										$_SESSION['suspendido']=1;
										genera_aciertos('42',$equipoA);
										genera_aciertos('41',$equipoA);
										$_SESSION['suspendido']=0;
									endif;
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
								elseif($multi['multiplicando']<$suma_carreras_m): //ganan las altas									
									genera_aciertos('43',$equipoA);	
								else:
									if($_SESSION['suspendido']==0):
										$_SESSION['suspendido']=1;
										genera_aciertos('44',$equipoA);
										genera_aciertos('43',$equipoA);
										$_SESSION['suspendido']=0;										
									endif;
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
						if($_POST['resultado'][$equipoA][19]==$_POST['resultado'][$equipoB][20]){
										$_SESSION['suspendido']=1;
										genera_aciertos('56',$equipoA);
										genera_aciertos('58',$equipoB);
										$_SESSION['suspendido']=0;
						}else{
								if($_POST['resultado'][$equipoA][19]>$_POST['resultado'][$equipoB][20]):
										genera_aciertos('56',$equipoA);
								elseif($_POST['resultado'][$equipoA][19]<$_POST['resultado'][$equipoB][20]):
										genera_aciertos('58',$equipoB);								
								endif;
						}
						//TERMINA PARA JUEGOS C MONEY LINE						
						
						//PARA RUNLINE JC
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas 
											  WHERE idlogro_equipo='".$equipoA."' and idcategoria_apuesta='60' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][19];
							$resultado_completo_B=$_POST['resultado'][$equipoB][20];
							
							
							///ale prueba
							
							$compara=(float)($resultado_completo_A+$multi['multiplicando']);
							
							if($compara==$resultado_completo_B){
										$_SESSION['suspendido']=1;
										genera_aciertos('60',$equipoA);
										genera_aciertos('61',$equipoB);
										$_SESSION['suspendido']=0;
							
							}else if($compara>$resultado_completo_B){
								genera_aciertos('60',$equipoA);															
							}else{
								genera_aciertos('61',$equipoB);
							}						
						
						//TERMINA PARA RUNLINE JC
						
						//PARA RUNLINE 1H (1er. tiempo o primera mitad)
						$multi=dame_datos("select * from logros_equipos_categorias_apuestas 
										  WHERE idlogro_equipo='".$equipoA."' and idcategoria_apuesta='62' limit 1");
						//echo $multi['multiplicando'];
						$resultado_completo_A=$_POST['resultado'][$equipoA][17];
						$resultado_completo_B=$_POST['resultado'][$equipoB][18];
						
						
						$compara=(float)($resultado_completo_A+$multi['multiplicando']);
							
							if($compara==$resultado_completo_B){
										$_SESSION['suspendido']=1;
										genera_aciertos('62',$equipoA);
										genera_aciertos('63',$equipoB);
										$_SESSION['suspendido']=0;
							
							}else if($compara>$resultado_completo_B){
								genera_aciertos('62',$equipoA);															
							}else{
								genera_aciertos('63',$equipoB);
							}						
/*

							$valor_comparacion=$multi['multiplicando'];
							if($valor_comparacion<1){$valor_comparacion=($multi['multiplicando']*(-1));}
								
							if($resta_carreras1==$valor_comparacion){
										$_SESSION['suspendido']=1;
										genera_aciertos('62',$equipoA);
										genera_aciertos('63',$equipoB);
										$_SESSION['suspendido']=0;
							}else{				
							
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+($multi['multiplicando']*(-1)));
										
								endif;
									echo '<br>'.$resultado_completo_A.' <>'.$resultado_completo_B.'<br>';
										if($resultado_completo_A > $resultado_completo_B):											
												genera_aciertos('62',$equipoA);											
										else:											
												genera_aciertos('63',$equipoB);											
										endif;
							}*/
						//TERMINA PARA RUNLINE 1H
						
						//PARA RUNLINE 2H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='84' limit 1");
							//echo $multi['multiplicando'];
							$resultado_completo_A=$_POST['resultado'][$equipoA][21];
							$resultado_completo_B=$_POST['resultado'][$equipoB][22];
								if($multi['multiplicando']>0): //es decir 1.5
									$resultado_completo_A= (float) ($resultado_completo_A+$multi['multiplicando']);
								else: //es decir -1.5
									$resultado_completo_B= (float) ($resultado_completo_B+($multi['multiplicando']*(-1)));
										
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
						
							//$multi_ale
							if($suma_carreras==$multi['multiplicando']){
										$_SESSION['suspendido']=1;
										genera_aciertos('65',$equipoA);
										genera_aciertos('64',$equipoA);
										$_SESSION['suspendido']=0;
							}else{
								if($multi['multiplicando']>$suma_carreras): //ganan las bajas									
									genera_aciertos('65',$equipoA);
								else: //ganan las altas									
									genera_aciertos('64',$equipoA);
								endif;									
							}
						//TERMINA PARA ALTAS Y BAJAS JUEGO COMPLETO
						
						//PARA ALTAS Y BAJAS 1H
							$multi=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$equipoA."' and idcategoria_apuesta='66' limit 1");
							//echo $multi['multiplicando'];
							$suma_carreras_m= (int) $_POST['resultado'][$equipoA][17]+$_POST['resultado'][$equipoB][18];
							if($suma_carreras_m==$multi['multiplicando']){
										$_SESSION['suspendido']=1;
										genera_aciertos('67',$equipoA);
										genera_aciertos('66',$equipoA);
										$_SESSION['suspendido']=0;
							}else{
								if($multi['multiplicando']>$suma_carreras_m): //ganan las bajas									
									genera_aciertos('67',$equipoA);
								else: //ganan las altas									
									genera_aciertos('66',$equipoA);	
								endif;
							}
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
					
					case 'futbolamericano':
/*INICIA FUTBOL AMERICANO******************************************************************************************/
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