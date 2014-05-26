// JavaScript Document
	var sexo=''; var nenviar=''; var comentario=''; var cadena_hiden=''; var com_pros=''; var disp_usuario='';
	var requeridos_pacientes=Array();
	function validar(formulario,archivo_guarda){
		//alert(productos); return false;
		comentario="Favor, es necesario indicar los campos marcados con asteriscos";
		if(com_pros=='') com_pros='Solicitud enviada con éxito, pronto no pondremos en contacto con usted';
		var form=formulario;
		var cadena_guardar='';//carga los inputs y sus valores			
				for(i=0;i<form.elements.length;i++){
					if(jQuery(form.elements[i]).attr("required")=='required' ){
						if(form.elements[i].value==''){
							alert(comentario); form.elements[i].focus(); return false;
						}
						if(jQuery(form.elements[i]).attr("formato_hora")=='formato_hora'){
							if(!ValidaHora( jQuery(form.elements[i]).val() )){ form.elements[i].focus();return false;}
						}						
					}
					/*if(cadena_guardar!='') cadena_guardar+='&';
						cadena_guardar+=jQuery(form.elements[i]).attr("name")+'='+jQuery(form.elements[i]).val();*/
				}
			
			
			if(jQuery("#clave").val()){
				if(jQuery("#clave").val()!=jQuery("#rclave").val()){
					alert("Las claves no coinciden, verifiquelas");
					jQuery("#clave").focus();
					return false;
				}
			}
			if(jQuery("#usuario").val()!='')
			
			usuario_disponible(jQuery("#usuario").val());
			if(disp_usuario){
				alert('Nombre de usuario no disponible, indique otro');
				jQuery("#usuario").focus(); return false;
			}
			
			//alert(cadena_guardar);
			cadena_guardar = jQuery("form").serialize();
			
			if(cadena_hiden) deshacer(cadena_hiden);
			//alert(cadena_guardar); 
			//form.submit();
			//alert(disp_usuario);
			//return false;
			$.ajax({
			   type: "POST",
			   url: "procesos/guardar_"+archivo_guarda,
			   data: cadena_guardar,
			   success: function(msg){
				 //alert( "Operacion efectuada con exito: " + msg );
				 //alert(com_pros);
				 window.scrollTo(0,0);
				 jQuery("#aviso").html("Operación efectuada exitosamente");
				 jQuery("#aviso").show('slow');
				 setTimeout('jQuery("#aviso").html("");jQuery("#aviso").hide("slow");',5000);
				 form.reset();
				 return true;
				 /*jQuery("#listado").html(
					$.ajax({
					  url: "procesos/listar_"+archivo_guarda,
					  contentType:"application/x-www-form-urlencoded",
					  async: false
					 }).responseText
				 );*/
			   },
			   error:function(objeto,nerror,aerror){
				   alert(aerror+' '+archivo_guarda+' epa');
			   }
			 });
			 
			//form.submit();
	}
	
	function usuario_disponible(idu){
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
		   jQuery("#aviso_disp").html('Nombre de usuario <b>no disponible</b>, indique otro nombre de usuario');	
		   disp_usuario=data.usuario;  		   
	   }else{
		   jQuery("#aviso_disp").html('Nombre de usuario <b>disponible</b>');
		   disp_usuario='';	   
	   }
	   jQuery("#aviso_disp").show('slow');
	   setTimeout('jQuery("#aviso_disp").html("");jQuery("#aviso_disp").hide("slow");',5000);
     }
   });
}
	
	function editar_datos(ids,valores){
		
		//alert(ids+' / '+valores); return false;
		ids=ids.split(",");
		valores=valores.split(",");
			for(i=0;i<ids.length;i++){
				//alert(ids[i]+' / '+valores[i]);
				jQuery("#"+ids[i]).val(valores[i]);
			}
	}
	function editar_datos_apuestas(ids,valores,complemento){
		//alert(ids+' / '+valores);
		//alert(ids+' / '+valores); return false;
		ids=ids.split(",");
		valores=valores.split(",");
			for(i=0;i<ids.length;i++){
				//alert(ids[i]+' / '+valores[i]);
				jQuery("#"+complemento+ids[i]).val(valores[i]);
			}
	}
	function editar_datos_radio(ids,valores,complemento){
		
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
							}
						}
					}
				}
			}
			
	}
	function deshacer(ids){
		ids=ids.split(","); //ids representa los campos a los cuales se les quiere setear sus valores a vacio
		for(i=0;i<ids.length;i++){
			jQuery("#"+ids[i]).val('');
		}
		jQuery(":checkbox").attr("checked",false);
		jQuery(":radio").attr("checked",false);
		jQuery(":text, :hidden ").val("");
		
		jQuery('[name=\'guardar\']').val('Guardar');	
	}
	
	function tildar(complemento,ids){
		ids=ids.split(","); //ids representa los campos a los cuales se les quiere setear sus valores a vacio
		for(i=0;i<ids.length;i++){
			jQuery("#"+complemento+ids[i]).attr('checked',true);
		}
	}
	
	function ver_datos(form){
		for(i=0;i<form.elements.length;i++){
			alert(jQuery(form.elements[i]).attr("class"));
		}
	}
	
	function blanquear_select(selets){
		selets=selets.split("_");
		for(i=0;i<selets.length;i++){
			$("#"+selets[i]).html("<option value=''>No Item</option>");
		}
	}
	
	function dinamico_select(iddestino,filtro,arreglo,atributos,otros_select){	
		//alert(filtro);	
		if(otros_select) blanquear_select(otros_select);
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
			//$("#"+iddestino).html("<select "+atributos+"><option value=''>Seleccione</option>"+cadena+"</select>");	
			if(cadena)
				$("#"+iddestino).html("<option value=''>Seleccione</option>"+cadena);
			else
				$("#"+iddestino).html("<option value=''>No Item</option>");	
			//document.getElementById(iddestino).innerHTML='<select '+atributos+'><option value="">Seleccione</option>'+cadena+'</select>';
			
	}
	
	/*jQuery(function($){
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
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    */

        /*jQuery(document).ready(function() {
           jQuery("#fecha").datepicker();
		     jQuery(".fecha").datepicker();
        });
	*/
	function ValidaHora( hora )
	{
			var er_fh = /^(1|01|2|02|3|03|4|04|5|05|6|06|7|07|8|08|9|09|10|11|12)\:([0-5]0|[0-5][1-9])\ (AM|PM)$/
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
	function calcular_edad(fecha,form){ 
	//alert(fecha);return false;
   	//calculo la fecha de hoy 
   	hoy=new Date() 
   	//alert(hoy) 

   	//calculo la fecha que recibo 
   	//La descompongo en un array 
   	var array_fecha = fecha.split("/") 
   	//si el array no tiene tres partes, la fecha es incorrecta 
   	if (array_fecha.length!=3) 
      	 return false 

   	//compruebo que los ano, mes, dia son correctos 
   	var ano 
   	ano = parseInt(array_fecha[2]); 
   	if (isNaN(ano)) 
      	 return false 

   	var mes 
   	mes = array_fecha[1]*1; 
   	if (isNaN(mes)) 
      	 return false 
	
   	var dia 
   	dia = array_fecha[0]*1;	
   	if (isNaN(dia)) 
      	 return false 


   	//si el año de la fecha que recibo solo tiene 2 cifras hay que cambiarlo a 4 
   	if (ano<=99) 
      	 ano +=1900 

   	//resto los años de las dos fechas 
   	edad=hoy.getFullYear()- ano; //-1 porque no se si ha cumplido años ya este año 
	//alert(hoy.getFullYear()+' '+ano);
   	//si resto los meses y me da menor que 0 entonces no ha cumplido años. Si da mayor si ha cumplido 	
   	if (hoy.getMonth()+ 1  - mes < 0){ //+ 1 porque los meses empiezan en 0 
      	 form.edads.value=edad-1; return false;
	}
	//alert(mes);
   	if (hoy.getMonth() + 1  - mes > 0) {
      	 form.edads.value=edad;  return false;
	}
   	//entonces es que eran iguales. miro los dias 
   	//si resto los dias y me da menor que 0 entonces no ha cumplido años. Si da mayor o igual si ha cumplido 
   	if (hoy.getUTCDate() - dia >= 0) {
      	 form.edads.value=edad; return false;
	}
   	form.edads.value=edad-1; 
} 

function hab_contactos(hacer){
	if(hacer=='muestra'){
		//for(i=0;i<jQuery("#contacto :text, #contacto textarea").length;i++){
			//jQuery("#contacto :text, #contacto textarea")[i].required='required';
		//}		
		jQuery("#contacto :text, #contacto textarea").attr("required",true);
		jQuery("#emailc").attr("required",false);
		jQuery('#contacto').show('slow');
	}else{
		//for(i=0;i<jQuery("#contacto :text, #contacto textarea").length;i++){
			//jQuery("#contacto :text, #contacto textarea")[i].value='';
			//jQuery("#contacto :text, #contacto textarea")[i].required='';
		//}		
		if(jQuery("#idc").val()==''){
			jQuery("#contacto :text, #contacto textarea").val("");
			jQuery("#contacto :text, #contacto textarea").attr("required",false);
			jQuery('#contacto').hide('slow');
		}
	}
	//alert(jQuery("#contacto :text, #contacto textarea")[0].required);
}
function hab_logueo(hacer){
	if(hacer=='muestra'){
		//for(i=0;i<jQuery("#contacto :text, #contacto textarea").length;i++){
			//jQuery("#contacto :text, #contacto textarea")[i].required='required';
		//}		
		//OCULTO DATOS PACIENTE
		requeridos_pacientes=jQuery("#paciente [required='required']");
		jQuery("#paciente [required='required']").attr('required',false);
		jQuery("#paciente input,#paciente textarea,#paciente select").val('');
		jQuery("#paciente [value='paciente']").attr('checked',true);
		
		jQuery("#paciente").hide('slow');
		hab_contactos('oculta');
		jQuery("#datos_logueo input").attr("required",true);		
		jQuery('#datos_logueo').show('slow');
		jQuery('#loguear').val("Loguear");
	}else{
		//for(i=0;i<jQuery("#contacto :text, #contacto textarea").length;i++){
			//jQuery("#contacto :text, #contacto textarea")[i].value='';
			//jQuery("#contacto :text, #contacto textarea")[i].required='';
		//}		
		//MUESTRO DATOS PACIENTE
		jQuery(requeridos_pacientes).attr('required',true);		
		jQuery("#paciente").show('slow');
		jQuery("#datos_logueo input").val("");
		jQuery("#datos_logueo input").attr("required",false);
		jQuery('#datos_logueo').hide('slow');
	}
	//alert(jQuery("#contacto :text, #contacto textarea")[0].required);
}
/*function restults(data) {
     jQuery("div.info").show();
     jQuery("div.info").append("ID: "+data.id+"<br>");
     jQuery("div.info").append("Nombre: "+data.nombre+"<br>");
     jQuery("div.info").append("Descripcion: "+data.descripcion+"<br>");
     jQuery("div.info").append("Categoria: "+data.idcategoria+"<br>");
 }
jQuery(document).ready(function(){
jQuery("#myid").click(function(){
  $.ajax({
    data: "id=2",
    type: "GET",
    dataType: "json",
    url: "datos.php",
    success: function(data){
       restults(data);
     }
   });
  });
});*/

jQuery(document).ready(function(){
	jQuery("#loguear").click(function(){
		//jQuery("#nologueado").hide('slow');
		if(jQuery("#usuariol").val()=='' || jQuery("#clavel").val()==''){alert('Indique usuario y clave!!!');return false;}
		$.ajax({
		data: "usuario="+jQuery("#usuariol").val()+"&clave="+jQuery("#clavel").val(),
		type: "GET",
		dataType: "json",
		url: "procesos/loguear.php",
		success: function(data){
		   //restults(data);
		   if(data.quien_logueo=='no'){
			   
			   jQuery("#aviso").html("Error en login y/o password, favor intente de nuevo");
			   jQuery("#aviso").show('slow');		
			    setTimeout('jQuery("#aviso").html("");jQuery("#aviso").hide("slow");',5000);  
		   }else{
			   jQuery("#aviso").html('');
			   jQuery("#aviso").hide('slow');
			   var datos_obtenidos='',idsob='';valob='';
			   datos_obtenidos=data.arreglo;
			   datos_obtenidos=datos_obtenidos.split("|");
			   idsob=datos_obtenidos[0].split("_v_");
			   valob=datos_obtenidos[1].split("_v_");
			   
			   jQuery("#datos_logueo input").attr("required",false);
			   jQuery("#datos_logueo").hide('slow');
			   
					jQuery("#pregunta_inicial").hide('slow');	
					jQuery("#nologueado input").attr("required",false);
					jQuery("#nologueado").hide('slow');	
			   
			  	if(data.quien_logueo=='contacto'){					
					
					jQuery("#paciente :radio")[1].disabled=true;					
					jQuery("#contacto_datos").html('');
					hab_contactos("muestra");				
					for(i=0;i<idsob.length;i++){
						//jQuery("#"+idsob[i]).val(valob[i]);
						jQuery("#contacto_datos").append('<b>'+idsob[i]+': </b> '+valob[i]+'<br>');
					}
					jQuery("#contacto_datos").append('<br><div id="listado_paciente">Cargando...</div><br>');
					jQuery("#idcontacto").val(data.idlogueado);
					jQuery('#listado_paciente').load("procesos/listar_pacientes.php?idc="+data.idlogueado, function(response, status, xhr){
					  /* if (status == "error") {
							  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
						 }*/
						/*jQuery("#carga_load").css("display", "none");
						jQuery("#carga").css("display", "none");*/
					});					
				}else{
					jQuery("#paciente_datos").html('');
					jQuery('#paciente').show('slow');	
					for(i=0;i<idsob.length;i++){
						//jQuery("#"+idsob[i]).val(valob[i]);
						jQuery("#paciente_datos").append('<b>'+idsob[i]+': </b> '+valob[i]+'<br>');
					}					
					jQuery("#idpaciente_log").val(data.idlogueado);
					//alert(data.idlogueado);
				}
		   }
		   
		 }
	   });
	});
	
	
	
});

	function si_esta_logueado(){
		$.ajax({
		data: "usuario=&clave=",
		type: "GET",
		dataType: "json",
		url: "procesos/loguear.php",
		success: function(data){
		   //restults(data);
		   if(data.quien_logueo=='no'){
			   
			   jQuery("#aviso").html("Error en login y/o password, favor intente de nuevo");
			   jQuery("#aviso").show('slow');		
			    setTimeout('jQuery("#aviso").html("");jQuery("#aviso").hide("slow");',5000);  
		   }else{
			   jQuery("#aviso").html('');
			   jQuery("#aviso").hide('slow');
			   var datos_obtenidos='',idsob='';valob='';
			   datos_obtenidos=data.arreglo;
			   datos_obtenidos=datos_obtenidos.split("|");
			   idsob=datos_obtenidos[0].split("_v_");
			   valob=datos_obtenidos[1].split("_v_");
			   
			   jQuery("#datos_logueo input").attr("required",false);
			   jQuery("#datos_logueo").hide('slow');
			   
					jQuery("#pregunta_inicial").hide('slow');	
					jQuery("#nologueado input").attr("required",false);
					jQuery("#nologueado").hide('slow');	
			   
			  	if(data.quien_logueo=='contacto'){					
					
					jQuery("#paciente :radio")[1].disabled=true;					
					jQuery("#contacto_datos").html('');
					hab_contactos("muestra");				
					for(i=0;i<idsob.length;i++){
						//jQuery("#"+idsob[i]).val(valob[i]);
						jQuery("#contacto_datos").append('<b>'+idsob[i]+': </b> '+valob[i]+'<br>');
					}
					jQuery("#contacto_datos").append('<br><div id="listado_paciente">Cargando...</div><br>');
					jQuery("#idcontacto").val(data.idlogueado);
					jQuery('#listado_paciente').load("procesos/listar_pacientes.php?idc="+data.idlogueado, function(response, status, xhr){
					  /* if (status == "error") {
							  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
						 }*/
						/*jQuery("#carga_load").css("display", "none");
						jQuery("#carga").css("display", "none");*/
					});					
				}else{
					jQuery("#paciente_datos").html('');
					jQuery('#paciente').show('slow');	
					for(i=0;i<idsob.length;i++){
						//jQuery("#"+idsob[i]).val(valob[i]);
						jQuery("#paciente_datos").append('<b>'+idsob[i]+': </b> '+valob[i]+'<br>');
					}					
					jQuery("#idpaciente_log").val(data.idlogueado);
					//alert(data.idlogueado);
				}
		   }
		   
		 }
	   });
	}

function campos_sol(idtabla,evento){
	switch(evento){
		case 'h':
			jQuery('#'+idtabla+' input,#'+idtabla+' textarea ').attr("disabled",false);
		break;
		case 'd':
			jQuery('#'+idtabla+' input,#'+idtabla+' textarea ').attr("disabled",true);
		break;
	}
}

function comparar_seleccion(valor,id,formulario){
	//alert(jQuery('#adicionales select').length);
	for(i=0;i<jQuery('#adicionales select').length;i++){
		if(valor!='' && (valor==jQuery('#adicionales select')[i].value) && id!=jQuery('#adicionales select')[i].id){
			alert('Operador ya seleccionado');
			jQuery('#'+id).val('');
		}
	}
}
