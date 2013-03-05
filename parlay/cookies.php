<?php 
//observad la "/" que sirve para llamar directamente al nombre de dominio 
//y no a una subcarpeta. Si no lo pusiéramos la cookie se llamaría: 
//midominio.com.midominio.com.  
//el "0" sirve para indicar si es 1 solo se envia la cookie por HTTPS, si es 0 por HTTP y HTTPS 
	setcookie("micookie5", "vAlTaQui".rand(10,999), time()+10000, "/", "", 0); 
	
	echo ' epa '.$_COOKIE['micookie5'].' epa';
?>
<?Php 
	/*$fecha=mktime(0,0,0,1,1,2013);
	setcookie('micookie2',session_id(),$fecha,' ',' ',0);
       /*Ahora visualizamos los campos
	echo $micookie2;
	echo $http_cookie_vars['micookie2'].' valor: '.session_id();
	*/
?>