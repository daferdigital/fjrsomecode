$(document).ready(function(){
    $("#loadajax").fadeOut(0);
	$("#overlay").css({opacity: .3});
});   
jQuery.extend(jQuery.validator.messages, {
		required: "Este campo es requerido.",
		remote: "Este campo es invalido.",
		email: "El formato del E-Mail es invalido.",
		url: "El formato del URL es invalido.",
		date: "Indroduzca una fecha valida.",
		dateISO: "Indroduzca una fecha valida (ISO).",
		number: "Solo indroduzca numeros.",
		digits: "Solo introduzca digitos.",
		creditcard: "Tarjeta de Credito Invalida.",
		equalTo: "Estos campos no son iguales.",
		maxlength: jQuery.validator.format("No debe introducir mas de {0} caracteres."),
		minlength: jQuery.validator.format("No debe introducir menos de {0} caracteres."),
		rangelength: jQuery.validator.format("La cantidad de caracteres debe ser entre {0} y {1}."),
		range: jQuery.validator.format("Debe introducir un valor entre {0} y {1}."),
		max: jQuery.validator.format("Debe introducir un valor menor o igual a {0}."),
		min: jQuery.validator.format("Debe introducir un valor mayor o igual a {0}.")
});

 jQuery(function($){
   $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''};
   $.datepicker.setDefaults($.datepicker.regional['es']);
});

var validacion = {};

function ajaxLoading(){
    $("#loadajax").fadeIn(500);
	$("#overlay").css({opacity: .3});
    $("#overlay").fadeIn(500);
    $(".wrap").animate({opacity: .3}, 500, "linear"); 
    /*$("button").each(function(index) {
        $(this).attr('disabled', 'disabled');
    });*/
} 
function ajaxLoadingOut(){
    $(".wrap").animate({opacity: 1}, 500, "linear");
	$("#overlay").css({opacity: .3});
    $("#overlay").fadeOut(500);
    $("#loadajax").fadeOut(500);  
   /* $("button").each(function(index) {
        $(this).attr('disabled', '');
    });*/
	$("#div_listar tr:odd").css("background-color","#cccccc");
	if($.browser.msie){
		$('option:disabled').each(function(){
			 var texto = $(this).text();
			 $(this).replaceWith("<optgroup label='"+texto+"'>"+texto+"</optgroup>")
		});
	}
	$( "input,select" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	$("button").button();
} 

/////////////////////////////////////////////////////////////

function form_delete(id,nombre,file){
	if(confirm("Esta usted seguro que desea eliminar el registro '"+nombre+"'?")) 
		$.ajax({ url: file+'.php?t=delete&id='+id, success: function(data)
		{
			if (data != "")
				alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
			else
				{
				alert("El registro fue eliminado correctamente");
				fn_listar(file);
			}
		}
	});
}
function form_active(file){
	ajaxLoading();
	$.ajax({ url: file+'.php?t=active', data: null, type: 'get', success: function(data)
		{
			if (data != "")
				alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
			else
				{
				alert("Activado Correctamente");
				fn_listar(file);
			}                
			ajaxLoadingOut();
		}
	});
}
function form_desactive(file){
	ajaxLoading();
	$.ajax({ url: file+'.php?t=desactive', data: null, type: 'get', success: function(data)
		{
			if (data != "")
				alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
			else
				{
				alert("Desactivado Correctamente");
				fn_listar(file);
			}                
			ajaxLoadingOut();
		}
	});
}
function form_add(file){
	ajaxLoading();
	$("#div_oculto").load(file+".php?t=add", function(){
		$('#div_oculto').dialog({
				resizable: false,
				height:"auto",
				width:700,
				modal: true,
				autoOpen: true
		});
		ajaxLoadingOut();
		$("#form_"+file).validate(); 
		onLoadForm();
	});
}
function form_update(id,file){
	ajaxLoading();         
	$("#div_oculto").load(file+".php?t=update&id="+id, function(){
		$('#div_oculto').dialog({
				resizable: false,
				height:"auto",
				width:700,
				modal: true,
				autoOpen: true
		});
		ajaxLoadingOut();
		$("#form_"+file).validate(); 
		onLoadForm();
	});
}  
function order_up(id,file){
	ajaxLoading();
	$("#div_oculto").load(file+".php?t=order&s=up&id="+id+"&nC="+Math.random(), function(){
		fn_listar(file)
	});  
}
function order_down(id,file){
	ajaxLoading();
	$("#div_oculto").load(file+".php?t=order&s=down&id="+id+"&nC="+Math.random(), function(){
		fn_listar(file)
	}); 
}
var indice=0;
var arg_ant="";
function fn_listar(file,arg){
	ajaxLoading();
	if (!(typeof arg === "undefined" /* || arg=="" */))
	{
		arg_ant=arg;
	}
	$("#div_listar").load(file+".php?t=list&ind="+indice+"&nC="+Math.random()+"&"+arg_ant,ajaxLoadingOut);    
};  
function fn_listar_pg(ind,file,arg){
	ajaxLoading();
	indice=ind;
	if (!(typeof arg === "undefined" /* || arg=="" */))
	{
		arg_ant=arg;
	}
	$("#div_listar").load(file+".php?t=list&ind="+ind+"&nC="+Math.random()+"&"+arg_ant,ajaxLoadingOut);    
};
function fn_cerrar(){
	$('#div_oculto').dialog('close');
};       

function json_encode(arr) {
    var parts = [];
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');

    for(var key in arr) {
    	var value = arr[key];
        if(typeof value == "object") { //Custom handling for arrays
            if(is_list) parts.push(array2json(value)); /* :RECURSION: */
            else parts[key] = array2json(value); /* :RECURSION: */
        } else {
            var str = "";
            if(!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if(typeof value == "number") str += value; //Numbers
            else if(value === false) str += 'false'; //The booleans
            else if(value === true) str += 'true';
            else str += '"' + value + '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

            parts.push(str);
        }
    }
    var json = parts.join(",");
    
    if(is_list) return '[' + json + ']';//Return numerical JSON
    return '{' + json + '}';//Return associative JSON
}

(function( $, undefined ) {
  if ($.ui && $.ui.dialog) {
    $.ui.dialog.overlay.events = $.map('focus,keydown,keypress'.split(','), function(event) { return event + '.dialog-overlay'; }).join(' ');
  }
}(jQuery));
