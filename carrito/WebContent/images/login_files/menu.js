function mainmenu(id){

	$("#"+id+" ul li").hover(function(){
    	$(this).find('div:first:hidden').css({visibility: "visible",display: "none","z-index":"9999"}).slideDown(10);
		
    	},function(){
        	$(this).find('div:first').slideUp(200);
    });

	
}