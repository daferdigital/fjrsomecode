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
					mysql_query("update logros_equipos_categorias_resultados set resultado='".$val."',idadministrador_modifica='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where idlogro_equipo='".$idlogro_equipo."' and idcategoria_resultado='".$idcategoria_resultado."' limit 1");
				else
					mysql_query("insert into logros_equipos_categorias_resultados() values('','".$idlogro_equipo."','".$idcategoria_resultado."','".$val."','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','1')");
					
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
			
					if($_POST['resultado_categoria']=='beisbol'){
						//PARA MEDIOS JUEGOS MONEY LINE
							if($_POST['resultado'][$equipoA][1]>$_POST['resultado'][$equipoB][2]):
									genera_aciertos('24',$equipoA);
							elseif($_POST['resultado'][$equipoA][1]<$_POST['resultado'][$equipoB][2]):
								//gana apuesta 26 {
									genera_aciertos('26',$equipoB);
								//gana apuesta 26 }
								
							endif;
						//TERMINA PARA MEDIOS JUEGOS MONEY LINE	
						
						//PARA JUEGOS C MONEY LINE
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
						
						//PARA ANOTA PRIMERO
								if($_POST['resultado'][$equipoA][8]==$equipoA): //Anota el A								
									genera_aciertos('37',$equipoA);
								else: //Anota el B									
									genera_aciertos('38',$equipoB);	
								endif;									
						//TERMINA PARA ANOTA PRIMERO
						
						//PARA CARRERAS EN PRIMER INNING
								if($_POST['resultado'][$equipoA][7]==1): //SI HUBO CARRERA
									genera_aciertos('39',$equipoA);
								else: //NO HUBO CARRERA							
									genera_aciertos('40',$equipoA);	
								endif;									
						//TERMINA PARA CARRERAS EN PRIMER INNING
						
			}
		
		//CALCULO TICKETS GANADORES
		setea_tickets($equipoA,$equipoB);
		
		endif; //END DEL CONTROLADOR DE PARES
		$imp++;
	}
	//FUNCION QUE CALCULA LOS TICKETS GANADORES
	calcula_ticket_ganador(date('Y-m-d'));
	
?>