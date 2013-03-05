<?php session_start();
	include("conexion.php");
	
		list($dia,$mes,$ano)=explode("/",$_POST['fecha']);
		
		$idleA=$_POST['idlogro_equipoA'];
		$idleB=$_POST['idlogro_equipoB'];
		//print_r($_POST);
		//exit;
			
		
		//inserto datos de apuestas equipo A
			$arraids=explode(",",$_POST['cadenaidsA']);
			for($i=0;$i<count($arraids);$i++){
				
				$idlogro_equipo_categoria_apuesta=dame_datos("select idlogro_equipo_categoria_apuesta from vista_logros where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' limit 1");
				//print_r($idlogro_equipo_categoria_apuesta); exit;
				$existe=dame_datos("select idlogro_equipo from logros_equipos_categorias_apuestas_banqueros where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' and idbanquero='".$_SESSION['datos']['idbanquero']."' limit 1");
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
						$mult=($_POST['idapuesta68']>0?$_POST['idapuesta68']:1); //el 52 corresponde al id de puntos para  juego completo
				}elseif($arraids[$i]==65){ //Baja JC Basket
						$mult=($_POST['idapuesta68']>0?$_POST['idapuesta68']:1); //el 52 corresponde al id de puntos para  juego completo
				}elseif($arraids[$i]==66){ //Alta MJ Basket
						$mult=($_POST['idapuesta69']>0?$_POST['idapuesta69']:1); //el 53 corresponde al id de puntos para medio juego completo
				}elseif($arraids[$i]==67){ //Baja MJ Basket
						$mult=($_POST['idapuesta69']>0?$_POST['idapuesta69']:1); //el 53 corresponde al id de puntos para medio juego completo
				}elseif($arraids[$i]==92){ //Alta 2M Basket
						$mult=($_POST['idapuesta94']>0?$_POST['idapuesta94']:1); //el 53 corresponde al id de goles para medio juego completo
				}elseif($arraids[$i]==93){ //Baja 2M Basket
						$mult=($_POST['idapuesta94']>0?$_POST['idapuesta94']:1); //el 53 corresponde al id de goles para medio juego completo
				}
				if($existe){
					$cadena="update logros_equipos_categorias_apuestas_banqueros set idlogro_equipo_categoria_apuesta='".$idlogro_equipo_categoria_apuesta['idlogro_equipo_categoria_apuesta']."',multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleA."' and idcategoria_apuesta='".$arraids[$i]."' and idbanquero='".$_SESSION['datos']['idbanquero']."' limit 1";
				}else{
					$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$idlogro_equipo_categoria_apuesta['idlogro_equipo_categoria_apuesta']."' ,'".$idleA."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$_SESSION['datos']['idbanquero']."','1')";
				}
				mysql_query($cadena)or die (mysql_error().$cadena);
			}
			
		//inserto datos de apuestas equipo B
			$arraids=explode(",",$_POST['cadenaidsB']);
			for($i=0;$i<count($arraids);$i++){
				
				$idlogro_equipo_categoria_apuesta=dame_datos("select idlogro_equipo_categoria_apuesta from vista_logros where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."' limit 1");
				
				$existe=dame_datos("select idlogro_equipo from logros_equipos_categorias_apuestas_banqueros where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."' and idbanquero='".$_SESSION['datos']['idbanquero']."' limit 1");
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
					$cadena="update logros_equipos_categorias_apuestas_banqueros set idlogro_equipo_categoria_apuesta='".$idlogro_equipo_categoria_apuesta['idlogro_equipo_categoria_apuesta']."',multiplicando='".$mult."',pago='".$_POST['idapuesta'.$arraids[$i]]."' where idlogro_equipo='".$idleB."' and idcategoria_apuesta='".$arraids[$i]."' and idbanquero='".$_SESSION['datos']['idbanquero']."' limit 1";
				}else{
					$cadena="insert into logros_equipos_categorias_apuestas_banqueros() values('','".$idlogro_equipo_categoria_apuesta['idlogro_equipo_categoria_apuesta']."','".$idleB."','".$arraids[$i]."','".$mult."','".$_POST['idapuesta'.$arraids[$i]]."','".$_SESSION['datos']['idbanquero']."','1')";
				}
				mysql_query($cadena)or die (mysql_error().$cadena);
			}	
			
?>