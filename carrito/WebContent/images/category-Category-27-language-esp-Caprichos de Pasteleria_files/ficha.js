var div_cnt_ant = null;
var pestana_ant = null;
var pestana_acc_ant = null;
var myLightbox = null;
//var numThumbs = 0;

var ficha_page = {
	
	nThumbs: 0,
	thumbAct: 0,
	
    init: function() {
        ficha_page.init_event_handlers();
        ficha_page.mostrar_pestanas();
    },

    /*
    * init_event_handlers, función que asigna manejadores para los eventos de usuario en los diferentes elementos
    */
    init_event_handlers: function() {

        // Desasignamos cualquier event asignado
        Event.unloadCache();
		
        if ( $('ford_ord') ) {
            Event.observe($('ford_ord'), 'change', ficha_page.ford_change_handler.bindAsEventListener($('ford_ord')));
        }

        if ( $('fcp_pag') ) {
            Event.observe($('fcp_pag'), 'change', ficha_page.fcp_change_handler.bindAsEventListener($('fcp_pag')));
        }
								
        for (var i=0, list=document.getElementsByTagName('a'), m=list.length, numThumbs=0; i < m; i++) {
            var tag_id = list[i].id;
			var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));
			
			if ( elem_prefix == 'ctrl' ) {
				var elem_infix = tag_id.substring(tag_id.indexOf('_')+1,tag_id.lastIndexOf('_'));
				switch(elem_infix) {
					case 'recomendar':
						Event.observe($(tag_id), 'click', ficha_page.ficha_control_recomendar_click_handler.bindAsEventListener($(tag_id)));
						break;
					case 'imprimircarac':
						Event.observe($(tag_id), 'click', ficha_page.ficha_control_imprimir_click_handler.bindAsEventListener($(tag_id)));
						break;
					case 'verrangos':
						Event.observe($(tag_id), 'click', ficha_page.rangp_control_verrangos.bindAsEventListener($(tag_id)));
						break;
					case 'thumb':
						Event.observe($(tag_id), 'click', ficha_page.thumb_control_click_handler.bindAsEventListener($(tag_id)));
						break;
				}
			} else if ( elem_prefix == 'fpest' ) {
				Event.observe($(tag_id), 'click', ficha_page.pest_ficha_click_handler.bindAsEventListener($(tag_id)));
			} else if ( elem_prefix == 'accpest' ) {
				Event.observe($(tag_id), 'click', ficha_page.pest_acctipo_click_handler.bindAsEventListener($(tag_id)));
			} else if ( elem_prefix == 'ctrlpag' ) {
				Event.observe($(tag_id), 'click', ficha_page.paginaart_click_handler.bindAsEventListener($(tag_id)));
			} else if ( elem_prefix == 'ctrlof' ) {
                Event.observe($(tag_id), 'mousemove', ficha_page.minifitxa_mousemove_handler.bindAsEventListener($(tag_id)));
				Event.observe($(tag_id), 'mouseover', ficha_page.minifitxa_mouseover_handler.bindAsEventListener($(tag_id)));
				Event.observe($(tag_id), 'mouseout', ficha_page.minifitxa_mouseout_handler.bindAsEventListener($(tag_id)));
			}
			
			if ( String(list[i].getAttribute('rel')).toLowerCase().match('lightbox') ) {
				ficha_page.nThumbs++;	
			}
        }
		
		if ( $('ctrl_thumb_ant') ) {
			$('ctrl_thumb_ant').style.display = 'none';
		}
		
		if ( $('ctrl_thumb_seg') && ficha_page.nThumbs < 6 ) {
			$('ctrl_thumb_seg').style.display = 'none';
		}		
    },
	
    minifitxa_mouseover_handler: function(e) { ficha_page.muestra_minifitxa(this.id); Event.stop; },
    
    minifitxa_mousemove_handler: function(e) { var mcoords = ficha_page.getMouseCoords(e); ficha_page.mou_minifitxa(this.id, mcoords[0], mcoords[1]); },
    
    minifitxa_mouseout_handler: function(e) { ficha_page.oculta_minifitxa(this.id); Event.stop; },
    
    getMouseCoords: function(e) {
        var mouse_x = 0;
        var mouse_y = 0;
        
        if ( !e ) var e = window.event;

        if (e.pageX || e.pageY) 	{
            mouse_x = e.pageX;
            mouse_y = e.pageY;
        }
        else if (e.clientX || e.clientY) 	{
            mouse_x = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            mouse_y = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        
        return [mouse_x, mouse_y];
    },

    muestra_minifitxa: function(tag_id) {
        var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));
        var elem_sufix = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
        var target_id = elem_prefix + '_detalles_' + elem_sufix;
              
		for(var i=0, list=document.getElementsByClassName('mini_fitxa'), m=list.length; i < m; i++) {
			var tag_id = list[i].id;
            
            if ( tag_id != target_id ) {
                ficha_page.oculta_minifitxa(tag_id);
            }
        }
        
        Effect.Appear(target_id,{duration: 0.3});
    },
    
    oculta_minifitxa: function(tag_id) {
        var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));
        var elem_sufix = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
        var target_id = elem_prefix + '_detalles_' + elem_sufix;
    
        Effect.Fade(target_id, {duration: 0.1});
    },

    mou_minifitxa: function(tag_id, mx, my) {
        var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));
        var elem_sufix = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
        var target_id = elem_prefix + '_detalles_' + elem_sufix;

        $(target_id).style.top = my + 'px';
        $(target_id).style.left = mx-250 + 'px';
    },

    ford_change_handler: function(e) { if ( $('fOrdenar') ) $('fOrdenar').submit(); },

    fcp_change_handler: function(e) { if ( $('fCambioPagina') ) $('fCambioPagina').submit(); },
	
	paginaart_click_handler: function(e) {
		var tag_id = this.id;
		
		if ( $('fcp_pag') && $('fcp_numpags') ) {
			var pag_act = parseInt($('fcp_pag').value);
			var num_pags = parseInt($('fcp_numpags').value);
			
			switch (tag_id) {
				case 'ctrlpag_ant':
					if ( pag_act > 1 ) pag_act--;
					break;
				case 'ctrlpag_seg':
					if ( pag_act < num_pags ) pag_act++;
					break;
			}
			
			$('fcp_pag').value = pag_act;
			
			if ( $('fCambioPagina') ) {
				$('fCambioPagina').submit();
			}
		}
	},	

    pest_ficha_click_handler: function(e) {
        var tag_id = this.id;		
		var odiv_id = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);

		ficha_page.ver_pestana(odiv_id);
		
		if ( odiv_id == 'acceso' ) {
			var articulo = '';
			var tipoacc = '';
			for (var i=0, list=document.getElementsByTagName('a'), m=list.length; i < m; i++) {
				var tag_id = list[i].id;
				var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));				
				if ( elem_prefix == 'accpest' ) {
					articulo = '+' + tag_id.substring(tag_id.indexOf('_')+1,tag_id.lastIndexOf('_'));
					tipoacc = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
					break;
				}
			}
			if ( articulo != '' && tipoacc != '' ) {
				ficha_page.lista_acctipo(articulo, tipoacc);
			}
		}
    },
		
	pest_acctipo_click_handler: function(e) {
		var tag_id = this.id;
		
		var articulo = '+' + tag_id.substring(tag_id.indexOf('_')+1,tag_id.lastIndexOf('_'));
		var tipoacc = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
		
		ficha_page.lista_acctipo(articulo, tipoacc);
	},
	
	thumb_control_click_handler: function(e) {
		var tag_id = this.id;
		var elem_suffix = tag_id.substr(tag_id.lastIndexOf('_')+1,tag_id.length);
		
		if ( $('thumbBoxInside') ) {
			switch(elem_suffix) {
				case 'ant':					
					if ( ficha_page.thumbAct > 0 ) {
                        Effect.Fade('thumbBoxInside', {from: 1.0, to: 0.4, duration: 0.2, queue: 'end'});
						new Effect.Move('thumbBoxInside', { x: 108, y: 0, transition: Effect.Transitions.sinoidal, queue: 'end' });	
                        Effect.Appear('thumbBoxInside', {from: 0.4, to: 1.0, duration: 0.2, queue: 'end'});
						ficha_page.thumbAct--;
					}
					break;
				case 'seg':
					if ( (ficha_page.nThumbs-ficha_page.thumbAct) > 5 ) {
                        Effect.Fade('thumbBoxInside', {from: 1.0, to: 0.4, duration: 0.2, queue: 'end'});
						new Effect.Move('thumbBoxInside', { x: -108, y: 0, transition: Effect.Transitions.sinoidal, queue: 'end' });
                        Effect.Appear('thumbBoxInside', {from: 0.4, to: 1.0, duration: 0.2, queue: 'end'});
						ficha_page.thumbAct++;
					}	
					break;
			}
			
			if ( $('ctrl_thumb_ant') ) {
				if ( ficha_page.thumbAct <= 0 ) {
					$('ctrl_thumb_ant').style.display = 'none';
				} else {
					$('ctrl_thumb_ant').style.display = 'block';
				}
			}
			
			if ( $('ctrl_thumb_seg') ) {
				if ( (ficha_page.nThumbs-ficha_page.thumbAct) <= 5 ) {
					$('ctrl_thumb_seg').style.display = 'none';
				} else {
					$('ctrl_thumb_seg').style.display = 'block';
				}
			}
		}
	},
	
    ver_pestana: function(ide) {
	    var div_cnt = $(ide);
		var pestana = $('fpest_' + ide);

    	if ( div_cnt_ant ) {
	    	div_cnt_ant.style.display = 'none';
	    }

	    if ( div_cnt ) {
    		div_cnt.style.display = 'block';
		    div_cnt.style.color = '#666666';
		    div_cnt_ant = div_cnt;
	    }

    	if ( pestana_ant ) {
		    pestana_ant.style.color = '#FFFFFF';
		    pestana_ant.style.background = '#8d8d8d url(/img/bgpestana.gif) no-repeat right';
	    }

	    if ( pestana ) {
    		pestana.style.color = '#000000';
		    pestana.style.background = '#edeeee url(/img/bgpestanaon.gif) no-repeat right';
		    pestana_ant = pestana;
	    }
	},
    
    mostrar_pestanas: function() {
		if ( $('fpest_acceso') ) {
			var qs = window.top.location.search.substring(1);
			var param_array = qs.split('&');
			
			if ( param_array.length > 1 && param_array[1] == 'm=acc' ) {

				ficha_page.ver_pestana('acceso');

				var articulo = '';
				var tipoacc = '';
				for (var i=0, list=document.getElementsByTagName('a'), m=list.length; i < m; i++) {
					var tag_id = list[i].id;
					var elem_prefix = tag_id.substring(0,tag_id.indexOf('_'));				
					if ( elem_prefix == 'accpest' ) {
						articulo = '+' + tag_id.substring(tag_id.indexOf('_')+1,tag_id.lastIndexOf('_'));
						tipoacc = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
						break;
					}
				}
				if ( articulo != '' && tipoacc != '' ) {
					ficha_page.lista_acctipo(articulo, tipoacc);
				}

				
			} else {
				if ( $('fpest_caract') ) {
					ficha_page.ver_pestana('caract');
				} else {
					if ( $('fpest_especi') ) {
						ficha_page.ver_pestana('especi');
					}
				}				
			}
		} else {
			if ( $('fpest_caract') ) {
				ficha_page.ver_pestana('caract');
			} else {
				if ( $('fpest_especi') ) {
					ficha_page.ver_pestana('especi');
				} else {
					if ( $('fpest_thumbs') ) {
						ficha_page.ver_pestana('thumbs');
					}
				}
			}
		}
    },
		
	abreVentanaUrl: function(url, w, h) {
		var opts = 'width=' + w + ',height=' + h + ',scrollbars=0,top=0,left=0,menubar=0';
		var wnd = window.open(url, '', opts);
	},
	
	ficha_control_recomendar_click_handler: function(e) { ficha_page.recomendar_articulo(this.id); },
	
	ficha_control_imprimir_click_handler: function(e) { ficha_page.imprimir_ficha_articulo(this.id); },
		
	recomendar_articulo: function(tag_id) {
		var carticulo = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
		var url = 'recomendar_articulo.php?codigo=%2B' + escape(carticulo);
		
		ficha_page.abreVentanaUrl(url, 400, 350);
	},
	
	imprimir_ficha_articulo: function(tag_id) {
		var carticulo = tag_id.substring(tag_id.lastIndexOf('_')+1,tag_id.length);
		var url = 'imprimir_articulo.php?codigo=%2B' + escape(carticulo);
		
		ficha_page.abreVentanaUrl(url, 700, 500);
	},
	
	lista_acctipo: function(cart, ctipo_acc) {
		var url = '/include/ajax_proc.php';
		var pars = 'm=dlacc&art=' + escape(cart) + '&tipo=' + escape(ctipo_acc);
		
		ficha_page.lista_acc_espere(true);
		var ajax_request = new Ajax.Request(
								url,
								{
									method: 'get',
									parameters: pars,
									onComplete: function(oreq) {
										var html_response = String(oreq.responseText);
																				
										if ( html_response != '' ) {
											if ( $('lacc_contenidos') ) {
												$('lacc_contenidos').innerHTML = html_response;
												
												ficha_page.marca_pestana_acc('accpest_' + cart.substring(1,cart.length) + '_' + ctipo_acc);
											}
										}
										ficha_page.lista_acc_espere(false);
									},
									onFailure: function(oreq) {
										ficha_page.lista_acc_espere(false);
									}
								});
	},
	
	lista_acc_espere: function(mostrar) {
		if ( $('lacc_wload') ) {
			if ( mostrar ) 
				$('lacc_wload').style.display = 'block';
			else
				$('lacc_wload').style.display = 'none';
		}
	},
	
    marca_pestana_acc: function(ide) {
		var pestana = $(ide);

    	if ( pestana_acc_ant ) {
		    pestana_acc_ant.style.color = '#826c5b';
		    pestana_acc_ant.style.backgroundColor = '#fffdf3';
			pestana_acc_ant.style.borderBottom = '';
	    }

	    if ( pestana ) {
    		pestana.style.color = '#d9001d';
		    pestana.style.backgroundColor = '#ffe79a';
			pestana.style.borderBottom = '1px solid #826c5b';
		    pestana_acc_ant = pestana;
	    }
	},
	
	rangp_control_verrangos: function(e) {
        for (var i=0, list=document.getElementsByClassName('menulink'), m=list.length; i < m; i++) {
            var tag_id = list[i].id;
			var ctrl_tipo = tag_id.substring(0,tag_id.lastIndexOf('_'));
			if ( ctrl_tipo == 'cnt_rp' ) {
				$(tag_id).style.display = 'block';
			}
		}
		this.style.display = 'none';
	}	
};


function listGetAt(list, position, delimiter)
{
  if(delimiter == null) delimiter = ',';
  list = list.split(delimiter);
  if(list.length > position)
    return list[position];
  else
    return 'undefined';
}

function resizeImage(imagen, maxwidth, maxheight)
{ 

	if (imagen.width>maxwidth || imagen.height>maxheight)
	{ 
		var scale = Math.min((maxwidth/imagen.width), (maxheight/imagen.height), 1 ); 
		var new_width = Math.floor(scale*imagen.width); 
		var new_height = Math.floor(scale*imagen.height); 
		imagen.width = new_width; 
		imagen.height = new_height; 
	}
	 
}

function resizeAll()
{

var i=0;

var maxwidth=130;
var maxheight=130;

var imagen;
var images = document.getElementsByTagName('img');

for (i=0; i<images.length; i++)
{
	imagen=images[i];
	
	if(imagen && (imagen.id == 'resize' || imagen.className == 'arrastrable'))
	{
			resizeImage(imagen, listGetAt(imagen.name,0,','), listGetAt(imagen.name,1,','));
	}
}

}

window.onload = function() {
	
	ficha_page.init();

}