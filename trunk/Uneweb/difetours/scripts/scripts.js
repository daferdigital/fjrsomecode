$(function()

{

	// Activacion de Acordeon Panel

	$('#list1a').accordion();

	

	// Activacion de SlideShow

	 $('.slideshow').cycle({

		fx: 'fade'


	});
	 
	 
 
	 /*
 * jQuery Nivo Slider v1.9
 * http://nivo.dev7studios.com
 *
 * Copyright 2010, Gilbert Pellegrom
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * April 2010 - controlNavThumbs option added by Jamie Thompson (http://jamiethompson.co.uk)
 * March 2010 - manualAdvance option added by HelloPablo (http://hellopablo.co.uk)
 */

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(9($){$.1h.1i=9(1T){b 4=$.2b({},$.1h.1i.21,1T);K g.F(9(){b 3={e:0,n:\'\',T:0,u:\'\',H:l,1f:l,1O:l};b 5=$(g);5.1Q(\'7:3\',3);5.f(\'2h\',\'2i\');5.w(\'1X\');5.x(\'1X\');5.1c(\'1i\');b d=5.2f();d.F(9(){b o=$(g);6(!o.J(\'D\')){6(o.J(\'a\')){o.1c(\'7-2e\')}o=o.1n(\'D:1m\')}b 13=o.w();6(13==0)13=o.t(\'w\');b 18=o.x();6(18==0)18=o.t(\'x\');6(13>5.w()){5.w(13)}6(18>5.x()){5.x(18)}o.f(\'S\',\'1z\');3.T++});6(4.16>0){6(4.16>=3.T)4.16=3.T-1;3.e=4.16}6($(d[3.e]).J(\'D\')){3.n=$(d[3.e])}k{3.n=$(d[3.e]).1n(\'D:1m\')}6($(d[3.e]).J(\'a\')){$(d[3.e]).f(\'S\',\'1v\')}5.f(\'Y\',\'W(\'+3.n.t(\'M\')+\') Q-R\');23(b i=0;i<4.h;i++){b E=1d.2a(5.w()/4.h);6(i==4.h-1){5.P($(\'<A B="7-c"></A>\').f({29:(E*i)+\'12\',w:(5.w()-(E*i))+\'12\'}))}k{5.P($(\'<A B="7-c"></A>\').f({29:(E*i)+\'12\',w:E+\'12\'}))}}5.P($(\'<A B="7-L"><p></p></A>\').f({S:\'1z\',y:4.20}));6(3.n.t(\'1a\')!=\'\'){$(\'.7-L p\',5).1B(3.n.t(\'1a\'));$(\'.7-L\',5).1y(4.q)}b j=0;6(!4.1g){j=1o(9(){C(5,d,4,l)},4.1j)}6(4.V){5.P(\'<A B="7-V"><a B="7-25">2d</a><a B="7-27">2k</a></A>\');6(4.1N){$(\'.7-V\',5).24();5.1W(9(){$(\'.7-V\',5).2c()},9(){$(\'.7-V\',5).24()})}$(\'a.7-25\',5).1s(\'1u\',9(){6(3.H)K l;X(j);j=\'\';3.e-=2;C(5,d,4,\'1r\')});$(\'a.7-27\',5).1s(\'1u\',9(){6(3.H)K l;X(j);j=\'\';C(5,d,4,\'1q\')})}6(4.G){b 1l=$(\'<A B="7-G"></A>\');5.P(1l);23(b i=0;i<d.22;i++){6(4.1L){b o=d.1w(i);6(!o.J(\'D\')){o=o.1n(\'D:1m\')}1l.P(\'<a B="7-1t" 1x="\'+i+\'"><D M="\'+o.t(\'M\').2g(4.1R,4.1S)+\'"></a>\')}k{1l.P(\'<a B="7-1t" 1x="\'+i+\'">\'+i+\'</a>\')}}$(\'.7-G a:1w(\'+3.e+\')\',5).1c(\'1b\');$(\'.7-G a\',5).1s(\'1u\',9(){6(3.H)K l;6($(g).2j(\'1b\'))K l;X(j);j=\'\';5.f(\'Y\',\'W(\'+3.n.t(\'M\')+\') Q-R\');3.e=$(g).t(\'1x\')-1;C(5,d,4,\'1t\')})}6(4.1Z){$(2m).2z(9(1A){6(1A.1V==\'2w\'){6(3.H)K l;X(j);j=\'\';3.e-=2;C(5,d,4,\'1r\')}6(1A.1V==\'2y\'){6(3.H)K l;X(j);j=\'\';C(5,d,4,\'1q\')}})}6(4.1U){5.1W(9(){3.1f=N;X(j);j=\'\'},9(){3.1f=l;6(j==\'\'&&!4.1g){j=1o(9(){C(5,d,4,l)},4.1j)}})}5.2A(\'7:U\',9(){3.H=l;$(d).F(9(){6($(g).J(\'a\')){$(g).f(\'S\',\'1z\')}});6($(d[3.e]).J(\'a\')){$(d[3.e]).f(\'S\',\'1v\')}6(j==\'\'&&!3.1f&&!4.1g){j=1o(9(){C(5,d,4,l)},4.1j)}4.1M.1p(g)})});9 C(5,d,4,14){b 3=5.1Q(\'7:3\');6((!3||3.1O)&&!14)K l;4.1K.1p(g);6(!14){5.f(\'Y\',\'W(\'+3.n.t(\'M\')+\') Q-R\')}k{6(14==\'1r\'){5.f(\'Y\',\'W(\'+3.n.t(\'M\')+\') Q-R\')}6(14==\'1q\'){5.f(\'Y\',\'W(\'+3.n.t(\'M\')+\') Q-R\')}}3.e++;6(3.e==3.T){3.e=0;4.1P.1p(g)}6(3.e<0)3.e=(3.T-1);6($(d[3.e]).J(\'D\')){3.n=$(d[3.e])}k{3.n=$(d[3.e]).1n(\'D:1m\')}6(4.G){$(\'.7-G a\',5).2B(\'1b\');$(\'.7-G a:1w(\'+3.e+\')\',5).1c(\'1b\')}6(3.n.t(\'1a\')!=\'\'){6($(\'.7-L\',5).f(\'S\')==\'1v\'){$(\'.7-L p\',5).28(4.q,9(){$(g).1B(3.n.t(\'1a\'));$(g).1y(4.q)})}k{$(\'.7-L p\',5).1B(3.n.t(\'1a\'))}$(\'.7-L\',5).1y(4.q)}k{$(\'.7-L\',5).28(4.q)}b i=0;$(\'.7-c\',5).F(9(){b E=1d.2a(5.w()/4.h);$(g).f({x:\'O\',y:\'0\',Y:\'W(\'+3.n.t(\'M\')+\') Q-R -\'+((E+(i*E))-E)+\'12 0%\'});i++});6(4.m==\'1G\'){b 1J=2x 2u("1H","10","1I","19","1C","Z","1D","1k");3.u=1J[1d.2l(1d.1G()*(1J.22+1))];6(3.u==2n)3.u=\'1k\'}3.H=N;6(4.m==\'2v\'||4.m==\'1H\'||3.u==\'1H\'||4.m==\'10\'||3.u==\'10\'){b r=0;b i=0;b h=$(\'.7-c\',5);6(4.m==\'10\'||3.u==\'10\')h=$(\'.7-c\',5).17();h.F(9(){b c=$(g);c.f(\'1E\',\'O\');6(i==4.h-1){I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q,\'\',9(){5.11(\'7:U\')})},(s+r))}k{I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q)},(s+r))}r+=1e;i++})}k 6(4.m==\'2p\'||4.m==\'1I\'||3.u==\'1I\'||4.m==\'19\'||3.u==\'19\'){b r=0;b i=0;b h=$(\'.7-c\',5);6(4.m==\'19\'||3.u==\'19\')h=$(\'.7-c\',5).17();h.F(9(){b c=$(g);c.f(\'26\',\'O\');6(i==4.h-1){I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q,\'\',9(){5.11(\'7:U\')})},(s+r))}k{I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q)},(s+r))}r+=1e;i++})}k 6(4.m==\'1C\'||4.m==\'2q\'||3.u==\'1C\'||4.m==\'Z\'||3.u==\'Z\'){b r=0;b i=0;b v=0;b h=$(\'.7-c\',5);6(4.m==\'Z\'||3.u==\'Z\')h=$(\'.7-c\',5).17();h.F(9(){b c=$(g);6(i==0){c.f(\'1E\',\'O\');i++}k{c.f(\'26\',\'O\');i=0}6(v==4.h-1){I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q,\'\',9(){5.11(\'7:U\')})},(s+r))}k{I(9(){c.z({x:\'s%\',y:\'1.0\'},4.q)},(s+r))}r+=1e;v++})}k 6(4.m==\'1D\'||3.u==\'1D\'){b r=0;b i=0;$(\'.7-c\',5).F(9(){b c=$(g);b 1F=c.w();c.f({1E:\'O\',x:\'s%\',w:\'O\'});6(i==4.h-1){I(9(){c.z({w:1F,y:\'1.0\'},4.q,\'\',9(){5.11(\'7:U\')})},(s+r))}k{I(9(){c.z({w:1F,y:\'1.0\'},4.q)},(s+r))}r+=1e;i++})}k 6(4.m==\'1k\'||3.u==\'1k\'){b i=0;$(\'.7-c\',5).F(9(){$(g).f(\'x\',\'s%\');6(i==4.h-1){$(g).z({y:\'1.0\'},(4.q*2),\'\',9(){5.11(\'7:U\')})}k{$(g).z({y:\'1.0\'},(4.q*2))}i++})}}};$.1h.1i.21={m:\'1G\',h:15,q:2t,1j:2s,16:0,V:N,1N:N,G:N,1L:l,1R:\'.1Y\',1S:\'2r.1Y\',1Z:N,1U:N,1g:l,20:0.8,1K:9(){},1M:9(){},1P:9(){}};$.1h.17=[].17})(2o);',62,162,'|||vars|settings|slider|if|nivo||function||var|slice|kids|currentSlide|css|this|slices||timer|else|false|effect|currentImage|child||animSpeed|timeBuff|100|attr|randAnim||width|height|opacity|animate|div|class|nivoRun|img|sliceWidth|each|controlNav|running|setTimeout|is|return|caption|src|true|0px|append|no|repeat|display|totalSlides|animFinished|directionNav|url|clearInterval|background|sliceUpDownLeft|sliceDownLeft|trigger|px|childWidth|nudge||startSlide|reverse|childHeight|sliceUpLeft|title|active|addClass|Math|50|paused|manualAdvance|fn|nivoSlider|pauseTime|fade|nivoControl|first|find|setInterval|call|next|prev|live|control|click|block|eq|rel|fadeIn|none|event|html|sliceUpDown|fold|top|origWidth|random|sliceDownRight|sliceUpRight|anims|beforeChange|controlNavThumbs|afterChange|directionNavHide|stop|slideshowEnd|data|controlNavThumbsSearch|controlNavThumbsReplace|options|pauseOnHover|keyCode|hover|1px|jpg|keyboardNav|captionOpacity|defaults|length|for|hide|prevNav|bottom|nextNav|fadeOut|left|round|extend|show|Prev|imageLink|children|replace|position|relative|hasClass|Next|floor|window|undefined|jQuery|sliceUp|sliceUpDownRight|_thumb|3000|500|Array|sliceDown|37|new|39|keypress|bind|removeClass'.split('|'),0,{}))
	 
	 
	 
	 
	 
	 
	 
$('body').find('div#base_c').nivoSlider({
        effect:'sliceUpDown', //Specify sets like: 'fold,fade,sliceDown'
        slices:15,
        animSpeed:700, //Slide transition speed
        pauseTime:7000,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:false, //Next & Prev
        directionNavHide:true, //Only show on hover
        controlNav:true, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, //Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance:false, //Force manual transitions
        captionOpacity:0.8, //Universal caption opacity
        beforeChange: function(){},
        afterChange: function(){},
        slideshowEnd: function(){}, //Triggers after all slides have been shown
        lastSlide: function(){}, //Triggers when last slide is shown
        afterLoad: function(){} //Triggers when slider has loaded
    });
	 /*

	// Control de Panel Tab

	$('body div#base div#tabs div#botones div, body div#base div#tabs div#controles span').live('click',function()

	{
		
//		alert(this.id);

		// Verificacion de ID y seleccion de ID Indice DIV contenido a aplicar efecto.

		var pre_id = this.id;

		var id_boton = pre_id.split('-');

		

		// Colocacion de Fondo a Boton

		$('body div#base div#tabs div#botones div').css({'background-image':'none'});
		

		$('body div#base div#tabs div#botones').children('div#b-'+id_boton[1]+'').css({'background-image':'url(img/fondo_control.png)'});														 

		// Aplicacion de efectos a DIVs Contenidos.

		var base = 'body div#base div#tabs div#base_c ';


		

		if($.browser.msie)

		{

			$(''+base+'div#c1,'+base+'div#c2,'+base+'div#c3,'+base+'div#c4,'+base+'div#c5,'+base+'div#c6').hide();	
			$(''+base+'a#esquina_1,'+base+'a#esquina_2,'+base+'a#esquina_3,'+base+'a#esquina_4,'+base+'a#esquina_5,'+base+'a#esquina_6').hide();	

			// Flecha Derecha
			var flecha_derecha = parseInt(id_boton[1]) + 1;
			
			if(flecha_derecha === 7)
			{
				flecha_derecha = 1;
			}
			$('body div#base div#tabs div#controles span.d').attr('id','b-'+flecha_derecha+'');
			
			// Flecha Derecha
			var flecha_izquierda = parseInt(id_boton[1]) - 1;
			
			if(flecha_izquierda === 0)
			{
				flecha_izquierda = 6;
			}
			$('body div#base div#tabs div#controles span.i').attr('id','b-'+flecha_izquierda+'');


			$('body div#base div#tabs div#base_c div#c'+id_boton[1]+'').show();	
			$('body div#base div#tabs div#base_c a#esquina_'+id_boton[1]+'').show();	

		}

		else

		{

			$(''+base+'div#c1,'+base+'div#c2,'+base+'div#c3,'+base+'div#c4,'+base+'div#c5,'+base+'div#c6').fadeOut();
			$(''+base+'a#esquina_1,'+base+'a#esquina_2,'+base+'a#esquina_3,'+base+'a#esquina_4,'+base+'a#esquina_5,'+base+'a#esquina_6').fadeOut();	



			// Flecha Derecha
			var flecha_derecha = parseInt(id_boton[1]) + 1;
			
			if(flecha_derecha === 7)
			{
				flecha_derecha = 1;
			}
			$('body div#base div#tabs div#controles span.d').attr('id','b-'+flecha_derecha+'');
			
			// Flecha Derecha
			var flecha_izquierda = parseInt(id_boton[1]) - 1;
			
			if(flecha_izquierda === 0)
			{
				flecha_izquierda = 6;
			}
			$('body div#base div#tabs div#controles span.i').attr('id','b-'+flecha_izquierda+'');
			

			$('body div#base div#tabs div#base_c div#c'+id_boton[1]+'').fadeIn();	
			$('body div#base div#tabs div#base_c a#esquina_'+id_boton[1]+'').fadeIn();
			


		}

		

		

		

	return false;

	});



*/
	



});
