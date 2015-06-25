// JavaScript Document
	var sexo=clave_actual=form_usuarios=form_resultados=''; 
	var nenviar=permitir_vender=form_cookie=''; 
	var comentario=''; 
	var cadena_hiden=''; 
	var categoria_sel=''; 
	var liga_sel=''; 
	var nolistado=''; 
	var noreset=''; 
	var control_ventas='';
	var disp_usuario='';
	var permitir_imprimir='';
	var mostrarmens='';//variable para mostrar mensajeria dentro de form, de un resultado a una peticion ajax
	var detalle_del_ticket='';//variable que se carga para verificar ticket
	function validar(formulario,archivo_guarda){
		//alert(categoria_sel);
		permitir_vender='';
		var form=formulario;
		var cadena_guardar='';//carga los inputs y sus valores
			if(comentario==''){ //comentario='Debe llenar los campos marcados con asteriscos';		
				for(i=0;i<form.elements.length;i++){
					//alert($(form.elements[i]).attr("noobli"));
					if(form.elements[i].type!='hidden' && form.elements[i].type!='button' && $(form.elements[i]).attr("readonly")!='readonly' && $(form.elements[i]).attr("noobli")!='noobli' && form.elements[i].id!='no_obligatorio' && form.elements[i].id!='cedula_representante'  && form.elements[i].type!='radio' && form.elements[i].type!='submit' && form.elements[i].type!='checkbox'/* && form.elements[i].type!='select-one'*/){
						if(form.elements[i].value==''){
							alert('Debe llenar los campos marcados con asteriscos '+form.elements[i].name); form.elements[i].focus(); return false;
						}
					}
				}
			}else{
				for(i=0;i<form.elements.length;i++){
					if($(form.elements[i]).attr("required")=='required' ){
						if(form.elements[i].value==''){
							alert(comentario); form.elements[i].focus(); return false;
						}
						if($(form.elements[i]).attr("name")=='hora'){
							if(!ValidaHora( $(form.elements[i]).val() )){ form.elements[i].focus();return false;}
						}
					}
					/*if(cadena_guardar!='') cadena_guardar+='&';
						cadena_guardar+=$(form.elements[i]).attr("name")+'='+$(form.elements[i]).val();*/
				}
			}
			
			if(control_ventas){
				if(jQuery('#num_apuestas').val()==0){
					alert('Para generar la venta seleccione al menos una apuesta');
					return false; 
				}
				
				/*SI ES POR DERECHO*/
				if(jQuery('#num_apuestas').val()>0){
				/*CONDICIONES DE TAQUILLAS*/
					$.ajax({
						data: "napuestas="+jQuery('#num_apuestas').val()+"&monto_pagar="+jQuery('#monto_pagar').val()+"&monto_apuesta="+jQuery('#monto_apuesta').val(),
						type: "POST",
						dataType: "json",
						async: false,
						url: "cumple_parley.php",
						success: function(data){
						   //restults(data);
						   //alert(data.napuestas);omaticamente
						   if(data.vender_ticket=='nosesion'){
							   permitir_vender='no';
							   alert('Se cerró la sesion, vuelva a ingresar');							   
							   location.href='index.php';
							   return false;
						   }else{
							   if(data.vender_ticket=='no'){
								   permitir_vender='no';
								   alert(data.mensaje);
								   return false;
							   }
						   }
						  
						 },
						   error:function(a,b,c){
							   alert(c+' el archivo: cumple_parley');							  
						   }
				   });
					
				}
				
			}
			
			//VERIFICO SI SE ENCUENTRAN LOS DATOS SUMINISTRADOS
			//PARA PAGAR TICKET
				if(detalle_del_ticket!=''){
					$('#detalle_del_ticket').html('');
					permitir_vender='no';
					detalle_del_ticket='';
					$.ajax({
						data: "ct="+jQuery('#codigo_ticket').val()+"&cc="+jQuery('#codigo_cliente').val(),
						type: "POST",
						dataType: "json",
						async: false,
						url: "verifica_datos_ticket.php",
						success: function(data){
						   //restults(data);
						   //alert(data.napuestas);omaticamente
						   if(data.vender_ticket=='nosesion'){
							   permitir_vender='no';
							   alert('Se cerró la sesion, vuelva a ingresar');							   
							   location.href='index.php';
							   return false;
						   }else{
							   if(data.ticket_conseguido){
								   //permitir_vender='no';
								   $('#detalle_del_ticket').html(data.estatus_ticket);
								   $('#detalle_del_ticket').show('slow');
								   if(data.nestatus_ticket=='ganador'){
										$('#bot_cons').hide('slow');   
								   }
								   //alert(data.ticket_conseguido);
								   return false;
							   }
						   }
						  
						 },
						   error:function(a,b,c){
							   alert(c+' el archivo: verifica_datos_ticket');
							   return false;
						   }
				   });
				}
			
			if(permitir_vender=='no'){permitir_vender=''; return false;}
			
			if(jQuery("#usuario").val()!='')
			usuario_disponible(jQuery("#usuario").val());
			if(disp_usuario){
				alert('Nombre de usuario no disponible, indique otro');
				jQuery("#usuario").focus(); return false;
			}
			
			//Para cambio de clave en cambio_clave.php		
			//alert(jQuery("#cactual_").val());	
			if(jQuery("#cactual_").val()){
				//alert(clave_actual);
				if(jQuery("#cactual_").val()==clave_actual){
					if(jQuery("#cnueva_").val()!=jQuery("#rcnueva_").val()){
						alert("La clave nueva no coincide, intente de nuevo!!!");
						return false;
					}
				}else{
					alert("La clave actual no coincide, intente de nuevo!!!");
					return false;
				}
			}
			
			//alert(cadena_guardar);
			cadena_guardar = $("form").serialize();
			//alert(cadena_guardar); return false;
			//alert(cadena_guardar);
			//console.log(cadena_guardar);
			
			//alert(cadena_guardar); 
			//form.submit();
			
			//return false;
			if(cadena_hiden) deshacer(cadena_hiden);
			if(mostrarmens==''){
				$("#carga").css("display", "inline");
				$("#carga_load3").css("display", "inline");
			}
			$.ajax({
			   type: "POST",
			   async: true,
			   url: "procesos/guardar_"+archivo_guarda,
			   data: cadena_guardar,
			   success: function(msg){				  
				 //alert( "Operacion efectuada con exito: " + msg );
				 //alert( "Operacion efectuada con exito "+$("#fecha").val()+' / '+$("#scategorias").val());
				 //alert( "Operacion efectuada con exito");
				
				 /*$("#listado").html(
					$.ajax({
					  url: "procesos/listar_"+archivo_guarda+"?fecha="+$("#fecha").val()+"&categoria="+$("#scategorias").val(),
					  contentType:"application/x-www-form-urlencoded",
					  async: false
					 }).responseText
				 );*/
				 
				 if(form_cookie!=''){
					 form_cookie='';
					 
					$('#contenido_padre').load('activar_cookie.php', function(response, status, xhr){
						
					   if (status == "error") {
							  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
						 }
						$("#carga_load3").css("display", "none");
						$("#carga").css("display", "none");
					});
					return false;	 
				 }
				 
				 if(form_resultados!=''){					 
					 $("#contenido_parley").load("resultados/resultados_"+form_resultados+"?liga="+liga_sel+"&categoria="+categoria_sel+"&fecha="+$("#fecha_ld").val(), function(response, status, xhr){
						  if (status == "error") {
							  alert('Pagina para la categoria '+form_resultados+' no encontrada, o se esta presentando problemas de conexión... intente de nuevo!!!');					  
						  }
							 $("#carga_load3").css("display", "none");
							 $("#carga").css("display", "none");
						  
					  });
					  form_resultados='';
					  return false;
				 }
				 
				 if(form_usuarios!=''){
					 form_usuarios='';
					 $("#carga_load3").css("display", "none");
						$("#carga").css("display", "none");
					 $('#contenido_padre').load('ingreso_usuarios.php', function(response, status, xhr){
					   if (status == "error") {
							  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
						 }
						
					});
					return false;
				 }else{
					 if(nolistado==''){
						 $("#listado").html("");
						 $("#carga_load2").css("display", "inline");
						  $("#carga_load3").css("display", "none");
						  $("#listado").load("procesos/listar_"+archivo_guarda+"?fecha="+$("#fecha").val()+"&categoria="+categoria_sel+"&liga="+liga_sel, function(){
							 $("#carga_load2").css("display", "none");
							 $("#carga").css("display", "none");
						  });
					 }else{
						 if(mostrarmens==''){
							 $("#carga_load3").css("display", "none");
							 $("#mensaje_resultado").css("display", "inline");
							 setTimeout('$("#mensaje_resultado").css("display", "none");$("#carga").css("display", "none");',3000);
						 }else{
							 mostrarmens='';
							 jQuery('#mensajerias').html(msg);
							 jQuery('#mensajerias').show('slow');
							 setTimeout("jQuery('#mensajerias').hide('slow');",10000);
						 }
					 }
				 }
				 if(permitir_imprimir=='si'){
					 //variable imprimir_html se encuentra dentro del archivo ventas_beisbol.php
					 	window.open(imprimir_html,"parley","menubar=1,resizable=1,width=530,height=400"); 					 
				 }
				 if(noreset==''){
					 resetEquipoForm();
				 	 form.reset();
				 }
				 	
				  comentario='';
				  nolistado='';
				  noreset='';
				  if(control_ventas=='si'){
					machos=0;hembras=0;
				  	control_ventas='';
				  }
				  jQuery('.blanquear').hide('slow');//utilizado en ventas				 
				  jQuery('#mpagar').html('0');//utilizado en ventas
				  jQuery('#monto_indicado').html('0');//utilizado en ventas
			   },
			   error:function(a,b,c){
				   alert("AjaxError [" + a.responseText + "/" + b + "/" + c + "] llamando al archivo: " + archivo_guarda);
				   $("#carga").css("display", "none");
				   $("#carga_load3").css("display", "none");
				   if(noreset==''){
				       form.reset();
				   }
			   }
			 });
			 
			//form.submit();
	}
	
	function usuario_disponible(idu){
		if(jQuery("#usuario").val()!=jQuery("#usuario_actual").val()){
			jQuery("#aviso_disp").hide('slow');
			$.ajax({
			data: "usuario="+idu,
			type: "GET",
			dataType: "json",
			async: false,
			url: "datos.php",
			success: function(data){
			   //restults(data);
			   //alert(data.usuario);
			   if(data.usuario=='no'){
				   jQuery("#aviso_disp").html('Nombre de usuario <b>no disponible</b>');	
				   disp_usuario=data.usuario;  		   
			   }else{
				   jQuery("#aviso_disp").html('Nombre de usuario <b>disponible</b>');
				   disp_usuario='';	   
			   }
			   jQuery("#aviso_disp").show('slow');
			   setTimeout('jQuery("#aviso_disp").html("");jQuery("#aviso_disp").hide("slow");',10000);
			 }
		   });
		}
	}
	
	//Actualizo listado de logros, se llama desde ventas_beisbol.php
	function si_actualizar_logro(){
			//alert('llamando');
					$.ajax({
						data: "nlogros="+total_juegos,
						type: "POST",
						dataType: "json",
						async: false,
						url: "procesos/numero_logros.php",
						success: function(data){
						   //restults(data);
						   //alert(data.napuestas);omaticamente
						   if(data.actualizar=='nosesion'){							   
							   alert('Se cerró la sesion, vuelva a ingresar');							   
							   location.href='index.php';
							   return false;
						   }else{
							   if(data.actualizar=='si'){
								    $("#carga_load").css("display", "inline");
									  $("#carga").css("display", "inline");
										$('#contenido_padre').load('ventas.php', function(response, status, xhr){
										   if (status == "error") {
												  alert('Pagina ventas no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');
												  location.href='index.php';
												  return false;
											 }
											$("#carga_load").css("display", "none");
											$("#carga").css("display", "none");
										}
									);
							   }
						   }
						  
						 },
						   error:function(a,b,c){
							   //alert(c+' el archivo: numero_logros');
							   alert('Pagina numero_logros no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');
							   location.href='index.php';
							   return false;
						   }
				   });				
	}
	
	function resetEquipoForm(){
		console.log("Reseteando form de equipos");
		var field = document.getElementById("imageHidden");
		if(field != null){
			field.value = "";
			document.getElementById("imagenEquipo").src = "";
			document.getElementById("imagenActual").style.display = "none";
			document.getElementById("files").innerHTML = "";
		}
	}
	
	function refreshImageEquipoIngreso(){
		var field = document.getElementById("imageHidden");
		if(field != null && field.value != ""){
			//tengo una imagen, la muestro entonces'
			document.getElementById("imagenEquipo").src = "imagenes/img_equipos/" + field.value;
			document.getElementById("imagenActual").style.display = "";
		} else {
			document.getElementById("imagenEquipo").src = "";
			document.getElementById("imagenActual").style.display = "none";
		}
	}
	
	function editar_datos(ids,valores){
		
		//alert(ids+' / '+valores); return false;
		ids=ids.split(",");
		valores=valores.split(",");
			for(i=0;i<ids.length;i++){
				//alert(ids[i]+' / '+valores[i]);
				$("#"+ids[i]).val(valores[i]);
			}
	}
	function editar_datos_apuestas(ids,valores,complemento){
		//alert(ids+' / '+valores);
		//alert(ids+' / '+valores); return false;
		ids=ids.split(",");
		valores=valores.split(",");
			for(i=0;i<ids.length;i++){
				//alert(ids[i]+' / '+valores[i]);
				$("#"+complemento+ids[i]).val(valores[i]);
			}
	}
	function editar_datos_radio(ids,valores,complemento){
		var mosca;
		var cad_arrray=Array();
		ids=ids.split(",");
		//alert(ids+' / '+valores); return false;
		valores=valores.split(",");
			
		
			var test=document.logros;
			for(i=0;i<test.length;i++){
				if(test.elements[i].type=='radio'){
					for(j=0;j<ids.length;j++){
						if(test.elements[i].name=="m"+ids[j]){
							if(test.elements[i].value==valores[j]){
								test.elements[i].checked=true;
							}else{
								//esto se aplica para futbol y basket, ya que el valor de los runline varia
								//if(test.elements[i].value<0)
								//alert(test.elements[i].value);
								if(test.elements[i].value<0 && valores[j]<0){
									jQuery("#vm"+ids[j]).val(parseFloat(valores[j]*(-1)));									
									mosca=jQuery("[name='m"+ids[j]+"']");										
										for(sd=0;sd<mosca.length;sd++){
											
											if(mosca[sd].value=='-2'){								
												jQuery("#"+mosca[sd].id).attr('checked',true);												
											}											
										}
								}else{
									//alert(valores[j]);
									if(test.elements[i].value>0 && valores[j]>0){
										jQuery("#vm"+ids[j]).val(valores[j]);
										mosca=jQuery("[name='m"+ids[j]+"']");
										//alert(mosca.length);
										for(sd=0;sd<mosca.length;sd++){
											
											if(mosca[sd].value=='2'){									
												jQuery("#"+mosca[sd].id).attr('checked',true);
												
											}
											//alert('aqui');
										}
										//jQuery("#m"+ids[j]).(function(){if(this.value=='2'){this.checked=true;}});
										//alert('exito');
									}
								}
							}
						}
						
						//alert(test.elements[i].name);
					}
				}
			}
			
	}
	function deshacer(ids){
		ids=ids.split(","); //ids representa los campos a los cuales se les quiere setear sus valores a vacio
		for(i=0;i<ids.length;i++){
			$("#"+ids[i]).val('');
		}
		$(":checkbox").attr("checked",false);
		$(":radio").attr("checked",false);
		//$("form > *").val("");	
		if(control_ventas==''){$('[name=\'guardar\']').val('Guardar');}
	}
	
	function tildar(complemento,ids){ //usada tambien en combinaciones ojo
		ids=ids.split(","); //ids representa los campos a los cuales se les quiere setear sus valores a vacio
		for(i=0;i<ids.length;i++){
			$("#"+complemento+ids[i]).attr('checked',true);
		}
	}
	
	function ver_datos(form){
		for(i=0;i<form.elements.length;i++){
			alert($(form.elements[i]).attr("class"));
		}
	}
	
	function dinamico_select(iddestino,filtro,arreglo,atributos){	
		//alert(filtro);	
		arreglo=arreglo.split("|");
		var arreglo_campos='',bandera='',cadena=''; comple='';
			for(i=0;i<arreglo.length;i++){
				arreglo_campos='';
				arreglo_campos=arreglo[i].split("_");
					if(arreglo_campos[0]==filtro){
						bandera=true;						
						if(arreglo_campos[3]) comple='(efec. '+arreglo_campos[3]+')';
						cadena+='<option value="'+arreglo_campos[1]+'">'+arreglo_campos[2]+' '+comple+'</option>';
					}
			} 
			//alert(atributos);
			$("#"+iddestino).html("<select "+atributos+"><option value=''>Seleccione</option>"+cadena+"</select>");	
			//document.getElementById(iddestino).innerHTML='<select '+atributos+'><option value="">Seleccione</option>'+cadena+'</select>';
			
	}
	
	$(document).ready(function(){
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '&#x3c;Ant',
			nextText: 'Sig&#x3e;',
			currentText: 'Hoy',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
			'Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
			dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
	
		$.datepicker.setDefaults($.datepicker.regional['es']);
	});    

        $(document).ready(function() {
           $("#fecha_ld").datepicker();
		   $('#tabletwo').tableHover({colClass: 'hover'});	  
        });
	
	function ValidaHora( hora )
	{
			//var er_fh = /^(1|01|2|02|3|03|4|04|5|05|6|06|7|07|8|08|9|09|10|11|12)\:([0-5]0|[0-5][1-9])\ (AM|PM)$/
			var er_fh = /^(1|01|2|02|3|03|4|04|5|05|6|06|7|07|8|08|9|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|0|00)\:([0-5]0|[0-5][1-9])\:([0-5]0|[0-5][1-9])$/
			
			if( hora == "" )
			{
					alert("Introduzca la hora.")
					return false
			}
			if ( !(er_fh.test( hora )) ) 
			{ 
					alert("El dato en el campo hora no es valido.");
					return false
			}
			
			/*alert("¡Campo de hora correcto!")*/
			return true
	}

function redondeo2decimales(numero)
{
	var original=parseFloat(numero);
	var result=Math.round(original*100)/100 ;
	return result;
}

function reset_html(ids){
	ids=ids.split(",");
		for(i=0;i<ids.length;i++){
			jQuery("#"+ids[i]).html('');
		}		
}