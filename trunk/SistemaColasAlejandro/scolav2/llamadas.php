<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM:.</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.6.4.min.js" type="text/javascript" language="javascript"></script>  
<script type="text/javascript" src="js/swfobject.js"></script>
<script src="js/jquery-1.2.6.pack.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-maximage.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
$(function(){
	jQuery('img.bgmaximage').maxImage({
		isBackground: true,
		overflow: 'auto'
 	});
});	
</script>

<style type="text/css">
	body, #terminal{
		margin-top:0px !important;
	}

	img.bgmaximage {position:fixed !important;}
</style> 

</head>

<body>
<img src="imagenes/fondo_llam.jpg" class="bgmaximage" />  
<!--<div style="width:auto; margin:0px auto; margin-bottom:5px;">
    	<img src="imagenes/header.jpg" width="800" border="0" />
        
</div>-->
	<?Php 
		mysql_query("set @atendidos=0,@total_valido=0,@estatus_tic='',@ultimo_atendido='00:00:00'");
		$sql_taquillas="
						select 
								*,
								if(atendido=1,@atendidos:=@atendidos+1,@atendidos) as atender, 
								if(@ultimo_atendido='00:00:00',@ultimo_atendido:=(select hora_atendido from vista_tickets_detalles_departamentos where atendido='1' and fecha=CURDATE() and idoperador_taquilla='".$_SESSION['datos']['idoperador_taquilla']."' order by hora_atendido desc limit 1),@ultimo_atendido) as uatendido,
								if(@total_valido=0,@total_valido:=(select count(*) from vista_tickets_detalles_departamentos where estatus=1 and anulado=0 and fecha=CURDATE() and atendido=0 and iddepartamento='".$_SESSION['datos']['iddepartamento']."'),@total_valido) as tvalido,
								if(estatus=1,@estatus_tic:='En espera',@estatus_tic:='Anulado') as estatus_ticket,
								if(anulado=1,@estatus_tic:='Anulado',@estatus_tic) as estatus_ticket,
								if(atendiendo=1,@estatus_tic:='Atendiendo',@estatus_tic) as estatus_ticket,
								if(atendido=1,@estatus_tic:='Atendido',@estatus_tic) as estatus_ticket								
						from 
								vista_tickets_detalles_departamentos 
						where 								
								fecha=CURDATE() and 
								atendiendo='1' 
						order by 								
								descripcion_departamento ";
		$query_taquillas=mysql_query($sql_taquillas) or die(mysql_error());
			$num_taquillas=mysql_num_rows($query_taquillas);
			if($num_taquillas>0){	
				ob_start();			
					?>
                    	<div class="actual" style="border-bottom: #900 2px solid; margin-bottom:10px;"><b>
                    	<label class="aviso_llamando">Ultimo número llamado: </label></b><label id="ullamado"></label></div>
                            <?Php $pares=0; $contador=1; $uatendido=0; $distint='';							
							?>
                           <b class="atendiendo">Atendiendo actualmente:</b>
						   
                            <marquee direction="up" scrolldelay="200" height="400">
								<?Php
									while($var_llamadas=mysql_fetch_assoc($query_taquillas)){
											if($distint!=$var_llamadas['descripcion_departamento']){
												$distint=$var_llamadas['descripcion_departamento'];
												echo "<div class='tit_llamada'><b>Dpto.: </b>".$var_llamadas['descripcion_departamento']."</div>";
											}
										?>
											<div class="actual1"><strong>Ticket Nº: </strong> <?php echo $var_llamadas['correlativo'];?> <b>Taquilla: </b><?php echo $var_llamadas['descripcion_taquilla'];?></div>
										<?Php
											if($var_llamadas['llamando']==1){
												$_SESSION['idticketactual']=$var_llamadas['idticket_detalle'];
												?>
                                                	<script language="javascript">
														jQuery('#ullamado').html('<?Php echo '<br><b class="etiqueta_num" style="text-decoration: blink;">Departamento: '.$var_llamadas['descripcion_departamento'].'</b><br><b class="num_actual">Ticket Nº: '.$var_llamadas['correlativo'].'<br>Taquilla: '.$var_llamadas['descripcion_taquilla']."</b>";?>');
													</script>
                                                <?Php
											}
									}
								?>
								</marquee>
                    <?Php
					$dinamico=ob_get_contents();
					ob_end_clean();
			}else{
				$dinamico='No se han llamado tickets para el día '.date("d/m/Y").'</div>';
			}

?>
                <div id="terminal" style="float:left;">
	                <div style="float:left; text-align:center;">
                        <p><img src="imagenes/satrim_logo.jpg" width="349" height="269" /></p>
<div id="straming" style="width:436px; margin-left:5px; height:323px;">
  
</div>
                </div>

<div id="contenido_dinamico" style="position:relative; width:850px; float:left; padding-left:50px;">
   	 <?Php echo $dinamico;?>
    </div>
                                
                <?Php 
					$sel_video="select descripcion from videos where estatus='1' order by idvideo desc limit 1";
					$query_video=mysql_query($sel_video);
					if(mysql_num_rows($query_video)>0){
						$var_video=mysql_fetch_assoc($query_video);
						mysql_free_result($query_video);
					?>                							
				  <script type="text/javascript">
                                    var disp = new SWFObject("swf/<?Php echo $var_video['descripcion'];?>", "display", "436", "323", "8", "#010F2C");
                                    disp.addParam("wmode", "transparent");
                                    disp.write("straming");
                                </script>
								<?Php
					}
							?>
                            
</div>                            


<div style=" position:fixed; bottom:0px; clear:both; background-color:#3E4095; font-size:38px; color:#ebebeb; font-weight:bold; padding:3px;">
		<marquee scrolldelay="100"><?Php 
				$sel_tip="select nota from tips where estatus='1' order by idtip desc";
				$query_tip=mysql_query($sel_tip);
						if(mysql_num_rows($query_tip)>0){
							while($var_tip=mysql_fetch_assoc($query_tip)){
								echo $var_tip['nota'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
						}?>
		</marquee></div>

<?php

			
//if($_SESSION['idticketactual']){
?>
		<script type="text/javascript">
			function refresh_pagina(idticket){
				$.ajax({
				  // la URL para la petición
				  url : 'verifica_actualizacion.php',
			  
				  // la información a enviar
				  // (también es posible utilizar una cadena de datos)
				  data : { id : idticket },
			  
				  // especifica si será una petición POST o GET
				  type : 'GET',
			  
				  // el tipo de información que se espera de respuesta
				  //dataType : 'json',
				 dataType : 'html',
			  
				  // código a ejecutar si la petición es satisfactoria;
				  // la respuesta es pasada como argumento a la función
				  success : function(json) {
					 /* $('<h1/>').text(json.title).appendTo('body');
					  $('<div class="content"/>')
						  .html(json.html).appendTo('body');*/
						  if(json)
						 	$('#contenido_dinamico').html(json);
				  },
			  
				  // código a ejecutar si la petición falla;
				  // son pasados como argumentos a la función
				  // el objeto de la petición en crudo y código de estatus de la petición
				  error : function(xhr, status) {
					  alert('Disculpe, ocurrio un problema');
				  },
			  
				  // codigo a ejecutar sin importar si la peticion fallo o no
				  complete : function(xhr, status) {
					 // alert('Petición realizada');
				  }
			  });
			}
			setInterval("refresh_pagina('<?Php echo $_SESSION['idticketactual'];?>')",1000);
		</script>
	<?Php
//}			
			
	?>
	
</body>
</html>