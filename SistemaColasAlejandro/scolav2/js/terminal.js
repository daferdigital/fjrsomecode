//Actualizado al 19 de Agosto de 2013
var ajaxImageName = "ajax.gif";

$(document).ready(function(){
	//tomamos todos los elementos de clase actionDpto
	//para gestionar su click de tipo desplegar/colapsar
	$(".actionDpto > img").css("cursor", "pointer");
	$(".actionDpto > img").click(function(){
		var idDpto = $(this).attr("id");
		if($(this).attr("src").match("desplegar.png$")){
			$("#detailDpto_" + idDpto).show();
			$("#title_" + idDpto).attr("class", "dptoTitleOpen");
			$(this).attr("src", "imagenes/colapsar.png");
		} else {
			$("#detailDpto_" + idDpto).hide();
			$("#title_" + idDpto).attr("class", "dptoTitleClosed");
			$(this).attr("src", "imagenes/desplegar.png");
		}
	});
});

/**
 * 
 * @param idDpto
 */
function refreshSubDptoInfo(idDpto){
	$.ajax({
		url : 'ajax/disponibilidadSubDptos.php',
		data : {id : idDpto},
		type : 'POST',
		dataType : 'html',
		success : function(response) {
			if(response){
				$('#detailDpto_' + idDpto).html(response);
			}
		},
		error : function(xhr, status) {
			alert('Disculpe, No pudo obtenerse la informacion');
			$('#detailDpto_' + idDpto).hide();
			$('#detailDpto_' + idDpto).html("");
		}
	});
}

/**
 * 
 * @param idDpto
 * @param idSubDpto
 */
function printTicket(idDpto, idSubDpto, isEmergency){
	//invocamos via ajax el proceso de generar el ticket
	var ticketHTML = null;
	
	$.ajax({
		url : 'ajax/createTicket.php',
		data : {id : idSubDpto, emergencia : isEmergency},
		type : 'POST',
		//async : false,
		dataType : 'html',
		success : function(response) {
			if(response){
				ticketHTML = response;
				
				if(ticketHTML != null && ticketHTML.trim() != ""){
					//el ticket fue generado, debemos disparar la impresion del mismo
					//debido a que el ticket
					//$("#pivoteImpresion").attr("src", "tickets/ticket_" + ticketHTML + ".pdf");
					$("#pivoteImpresion").attr("src", "ajax/showTicket.php?id=" + ticketHTML);
					refreshSubDptoInfo(idDpto);
					
					$("#pivoteImpresion").load(function() {
						var iFrame = document.getElementById("pivoteImpresion");
						iFrame.focus();// focus on contentWindow is needed on some ie versions
						//iFrame.contentWindow.print();
					});
					
					/*
					$("#pivoteImpresion").contents().find('body').html("");
					$("#pivoteImpresion").contents().find('body').append(ticketHTML);
					$("#pivoteImpresion").get(0).contentWindow.print();
					*/
					/*
					var iFrame = document.getElementById("pivoteImpresion");
					iFrame.focus();// focus on contentWindow is needed on some ie versions
					iFrame.style.display = "";
					iFrame.contentWindow.print();
					iFrame.style.display = "none";
					*/
				} else {
					alert("Disculpe no pudo ser generado el ticket");
				}
			}
		},
		error : function(xhr, status) {
			alert('Disculpe, No pudo realizarse el proceso de impresión');
		}
	});
}