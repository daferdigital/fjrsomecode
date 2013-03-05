<?php session_start();
	include("conexion.php");
	//mysql_query("SET NAMES utf8");
	//$_POST=convertArrayKeysToUtf82($_POST);
		list($dia,$mes,$ano)=explode("/",$_POST['fecha']);
		
		if($_SESSION['datos']['condicion_esp']!='1')://si no es el asistente de logros
			if(!$_POST['idlogro']){
				//if($_SESSION['datos']['condicion_esp']==0):
					$cadena=sprintf("insert into logros() values('','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','%s','%s','%s')",mysql_escape_string($ano.'-'.$mes.'-'.$dia),mysql_escape_string($_POST['hora']),mysql_escape_string($_POST['estatus']));
				/*else:
					$cadena=sprintf("insert into logros(idlogro,idadministrador,idadministrador_actualiza,fecha,hora) values('','".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."','','%s','%s')",mysql_escape_string($ano.'-'.$mes.'-'.$dia),mysql_escape_string($_POST['hora']));
				endif;*/
				mysql_query($cadena)or die(mysql_error());// exit;
				
				//obtengo el id generado
				$idg=mysql_insert_id();
							
				/*$cadena=sprintf("insert into logros_detalles(idlogro_detalle,idlogro,lequipo1,lequipo2,jcv,mjv,jch,mjh,nueve,cinco,anotav,anotah,siprimer,noprimer,logroaljc,logrobajc,logroalmj,logrobamj,estatus) values('','".$idg."','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','1')",mysql_escape_string($_POST['lvisitante']),mysql_escape_string($_POST['lhome']),mysql_escape_string($_POST['jcv']),mysql_escape_string($_POST['mjv']),mysql_escape_string($_POST['jch']),mysql_escape_string($_POST['mjh']),mysql_escape_string($_POST['nueve']),mysql_escape_string($_POST['cinco']),mysql_escape_string($_POST['anotav']),mysql_escape_string($_POST['anotah']),mysql_escape_string($_POST['siprimer']),mysql_escape_string($_POST['noprimer']),mysql_escape_string($_POST['logroaljc']),mysql_escape_string($_POST['logrobajc']),mysql_escape_string($_POST['logroalmj']),mysql_escape_string($_POST['logrobamj']));
				mysql_query($cadena);
				*/
			}else{
				if($_SESSION['datos']['condicion_esp']==0):
					$cadena=sprintf("update logros set fecha='%s',hora='%s',estatus='%s',idadministrador_actualiza='%s' where idlogro='%s' limit 1",mysql_escape_string($ano.'-'.$mes.'-'.$dia),mysql_escape_string($_POST['hora']),mysql_escape_string($_POST['estatus']),mysql_escape_string($_SESSION['datos'][$_SESSION['nombre_idtabla']]),mysql_escape_string($_POST['idlogro']));
				else:
					$cadena=sprintf("update logros set fecha='%s',hora='%s',idadministrador_actualiza='%s' where idlogro='%s' limit 1",mysql_escape_string($ano.'-'.$mes.'-'.$dia),mysql_escape_string($_POST['hora']),mysql_escape_string($_SESSION['datos'][$_SESSION['nombre_idtabla']]),mysql_escape_string($_POST['idlogro']));
				endif;
				mysql_query($cadena);
				
				$idg=$_POST['idlogro'];
				
				/*$cadena=sprintf("update logros_detalles set lequipo1='%s',lequipo2='%s',jcv='%s',mjv='%s',jch='%s',mjh='%s',nueve='%s',cinco='%s',anotav='%s',anotah='%s',siprimer='%s',noprimer='%s',logroaljc='%s',logrobajc='%s',logroalmj='%s',logrobamj='%s' where idlogro='%s'",mysql_escape_string($_POST['lvisitante']),mysql_escape_string($_POST['lhome']),mysql_escape_string($_POST['jcv']),mysql_escape_string($_POST['mjv']),mysql_escape_string($_POST['jch']),mysql_escape_string($_POST['mjh']),mysql_escape_string($_POST['nueve']),mysql_escape_string($_POST['cinco']),mysql_escape_string($_POST['anotav']),mysql_escape_string($_POST['anotah']),mysql_escape_string($_POST['siprimer']),mysql_escape_string($_POST['noprimer']),mysql_escape_string($_POST['logroaljc']),mysql_escape_string($_POST['logrobajc']),mysql_escape_string($_POST['logroalmj']),mysql_escape_string($_POST['logrobamj']),mysql_escape_string($_POST['idlogro']));
				//echo $cadena;
				mysql_query($cadena)or die(mysql_error());*/
			}
			
			//inserto datos de equipos
			
			if($_POST['idlogro_equipoA']){
				$cadena=sprintf("update logros_equipos set idequipo='%s',idroster='%s',referencia='".$_POST['referenciaA']."' where idlogro_equipo='%s'",mysql_escape_string($_POST['visitante']),mysql_escape_string($_POST['lvisitante']),mysql_escape_string($_POST['idlogro_equipoA']));
				mysql_query($cadena);
				$cadena=sprintf("update logros_equipos set idequipo='%s',idroster='%s',referencia='".$_POST['referenciaB']."' where idlogro_equipo='%s'",mysql_escape_string($_POST['home']),mysql_escape_string($_POST['lhome']),mysql_escape_string($_POST['idlogro_equipoB']));
				mysql_query($cadena);
				$idleA=$_POST['idlogro_equipoA'];
				$idleB=$_POST['idlogro_equipoB'];
			}else{
				$cadena=sprintf("insert into logros_equipos() values('','".$idg."','%s','%s','".$_POST['referenciaA']."','1')",mysql_escape_string($_POST['visitante']),mysql_escape_string($_POST['lvisitante']));
				mysql_query($cadena);
				$idleA=mysql_insert_id();
				$cadena=sprintf("insert into logros_equipos() values('','".$idg."','%s','%s','".$_POST['referenciaB']."','1')",mysql_escape_string($_POST['home']),mysql_escape_string($_POST['lhome']));
				mysql_query($cadena);
				$idleB=mysql_insert_id();
			}
				
			
		else:
			$idg=$_POST['idlogro'];
			$idleA=$_POST['idlogro_equipoA'];
			$idleB=$_POST['idlogro_equipoB'];
		endif;
		
		
		//SELECCIONO LOS ID DE BANQUEROS
		$idbanqueros_e=dameids("select idbanquero from banqueros");
		$idbanqueros_e=explode(",",$idbanqueros_e);
		
		//mysql_query("delete from logros_equipos where idlogro='".$idg."'");
		
		
		//inserto datos de apuestas equipo A
			$arraids=explode(",",$_POST['cadenaidsA']);
			for($i=0;$i<count($arraids);$i++){
				
				$existe=dame_datos("select idlogro_equipo from logros_equipos_categorias_apuestas where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' limit 1");
				if($_POST['m'.$arraids[$i]]) $mult=$_POST['m'.$arraids[$i]]; else $mult=1;
				
				//PARA RUNLINE CON MULTIPLICANDOS VARIABLES
				if($_POST['m'.$arraids[$i]]<0) $sig='-'; else $sig='';
				switch($arraids[$i]){
					case '16': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '17': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '60': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '61': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '62': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '63': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '84': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '85': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					
				}
				
				if($arraids[$i]==77){ //Alta 6to
						$mult=($_POST['idapuesta79']>0?$_POST['idapuesta79']:1); //el 79 corresponde al id del valor para 6to
				}elseif($arraids[$i]==78){ //Alta 6to
						$mult=($_POST['idapuesta79']>0?$_POST['idapuesta79']:1); //el 79 corresponde al id del valor para 6to
				}elseif($arraids[$i]==71){ //Alta JC CHE
						$mult=($_POST['idapuesta70']>0?$_POST['idapuesta70']:1); //el 70 corresponde al id del valor para juego completo CHE
				}elseif($arraids[$i]==72){ //Alta JC CHE
						$mult=($_POST['idapuesta70']>0?$_POST['idapuesta70']:1); //el 70 corresponde al id del valor para juego completo CHE
				}elseif($arraids[$i]==31){ //Alta JC
						$mult=($_POST['idapuesta35']>0?$_POST['idapuesta35']:1); //el 35 corresponde al id de carreras para juego completo
				}elseif($arraids[$i]==32){ //Baja JC
						$mult=($_POST['idapuesta35']>0?$_POST['idapuesta35']:1); //el 35 corresponde al id de carreras para juego completo
				}elseif($arraids[$i]==33){ //Alta MJ
						$mult=($_POST['idapuesta36']>0?$_POST['idapuesta36']:1); //el 36 corresponde al id de carreras para medio juego completo
				}elseif($arraids[$i]==34){ //Baja MJ
						$mult=($_POST['idapuesta36']>0?$_POST['idapuesta36']:1); //el 36 corresponde al id de carreras para medio juego completo
				}elseif($arraids[$i]==41){ //Baja MJ
						$mult=($_POST['idapuesta52']>0?$_POST['idapuesta52']:1); //el 52 corresponde al id de goles para  juego completo
				}elseif($arraids[$i]==42){ //Baja MJ
						$mult=($_POST['idapuesta52']>0?$_POST['idapuesta52']:1); //el 52 corresponde al id de goles para  juego completo
				}elseif($arraids[$i]==43){ //Baja MJ
						$mult=($_POST['idapuesta53']>0?$_POST['idapuesta53']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==44){ //Baja MJ
						$mult=($_POST['idapuesta53']>0?$_POST['idapuesta53']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==64){ //Alta JC Basket
						$mult=($_POST['idapuesta68']>0?$_POST['idapuesta68']:1); //el 52 corresponde al id de goles para  juego completo
				}elseif($arraids[$i]==65){ //Baja JC Basket
						$mult=($_POST['idapuesta68']>0?$_POST['idapuesta68']:1); //el 52 corresponde al id de goles para  juego completo
				}elseif($arraids[$i]==66){ //Alta 1M Basket
						$mult=($_POST['idapuesta69']>0?$_POST['idapuesta69']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==67){ //Baja 1M Basket
						$mult=($_POST['idapuesta69']>0?$_POST['idapuesta69']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==92){ //Alta 2M Basket
						$mult=($_POST['idapuesta94']>0?$_POST['idapuesta94']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==93){ //Baja 2M Basket
						$mult=($_POST['idapuesta94']>0?$_POST['idapuesta94']:1); //el 53 corresponde al id de goles para medio juego completo
				}
				if($existe){
					$cadena="update logros_equipos_categorias_apuestas set multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' limit 1";
					mysql_query($cadena)or die (mysql_error());
					//foreach($idbanqueros_e as $idb_e){
						//$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$uidinsertado."','".$idleA."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$idb_e."','1')";
						//$cadena="update logros_equipos_categorias_apuestas_banqueros set multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' limit 1";
						$cadena="update logros_equipos_categorias_apuestas_banqueros set multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."'";						
						mysql_query($cadena)or die (mysql_error());
						
					//}
				}else{
					$cadena="insert into logros_equipos_categorias_apuestas() values('','".$idleA."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','0','1')";
					mysql_query($cadena)or die (mysql_error());
					$uidinsertado=mysql_insert_id();
					foreach($idbanqueros_e as $idb_e){
						$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$uidinsertado."','".$idleA."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$idb_e."','1')";
						mysql_query($cadena)or die (mysql_error());
					}
				}
				
			}
			
		//inserto datos de apuestas equipo B
			$arraids=explode(",",$_POST['cadenaidsB']);
			for($i=0;$i<count($arraids);$i++){
				
				$existe=dame_datos("select idlogro_equipo from logros_equipos_categorias_apuestas where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."' limit 1");
				if($_POST['m'.$arraids[$i]]) $mult=$_POST['m'.$arraids[$i]]; else $mult=1;
				
				if($_POST['m'.$arraids[$i]]<0) $sig='-'; else $sig='';
				switch($arraids[$i]){
					case '16': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '17': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '60': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '61': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '62': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '63': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '84': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
					case '85': $mult=($_POST['vm'.$arraids[$i]]!=''?$sig.$_POST['vm'.$arraids[$i]]:'1');
					break;
				}
				
				if($existe){
					$cadena="update logros_equipos_categorias_apuestas set multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."' limit 1";
					mysql_query($cadena)or die (mysql_error());
					//foreach($idbanqueros_e as $idb_e){
						//$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$uidinsertado."','".$idleB."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$idb_e."','1')";
						$cadena="update logros_equipos_categorias_apuestas_banqueros set multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."'";
						mysql_query($cadena)or die (mysql_error());
					//}
				}else{
					$cadena="insert into logros_equipos_categorias_apuestas() values('','".$idleB."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','0','1')";
					mysql_query($cadena)or die (mysql_error());
					$uidinsertado=mysql_insert_id();
					foreach($idbanqueros_e as $idb_e){
						$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$uidinsertado."','".$idleB."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$idb_e."','1')";
						mysql_query($cadena)or die (mysql_error());
					}
				}
				
			}	
			
?>