<?php                      
define("E_USER_EXIST",1);       
define("E_MAIL_EXIST",2); 
define("E_SQL_ERROR",3); 
define("E_FORMAT_INVALID",4); 
define("E_USER_NOT_EXIST",5);
define("E_USER_ADMIN_NOT_DELETE",6);  
define("OK",1000);                                      
define("PATH",str_replace('//','/',dirname(__FILE__)));
define("URI",$_SERVER["REQUEST_URI"]);  
define("ITEMS_PAGE",20);
define("ITEMS_PAGE2",20);               


function dError($err)
{
    switch($err){
       case E_USER_EXIST:               return "User already registered"; 
       case E_MAIL_EXIST:               return "E-Mail already registered";    
       case E_FORMAT_INVALID:           return "The variables are invalid";  
       case E_SQL_ERROR:                return "Error Database";    
       case E_USER_NOT_EXIST:           return "The user does not exist"; 
       case E_USER_ADMIN_NOT_DELETE:    return "The super administrator can not be eliminated"; 
       
       default:                         return "Unknown error";
    }
}
function isError($err){
    if(is_bool($err)) return !$err;
    if($err==OK) return false; 
    return true;   
}


define("SOLTERO",1);    
define("DIVORSIADO",2);    
define("CASADO",3);    
define("VIUDO",4);  
$estado_civil[SOLTERO] = "Soltero/a";
$estado_civil[DIVORSIADO] = "Divorsiado/a";
$estado_civil[CASADO] = "Casado/a";
$estado_civil[VIUDO] = "Viudo/a";


define("TRABAJA_SI",1);    
define("TRABAJA_NO",2);    
define("TRABAJA_PENSIONADO",3);    
$trabajo[TRABAJA_SI] = "Si";
$trabajo[TRABAJA_NO] = "No";
$trabajo[TRABAJA_PENSIONADO] = "Pensionado";



define("VIVIENDA_PROPIA",1);    
define("VIVIENDA_ALQUILADA",2);    
define("VIVIENDA_FAOV",3);      
define("VIVIENDA_CRD",4);    
define("VIVIENDA_CASA",5);    
define("VIVIENDA_QUINTA",6);    
define("VIVIENDA_APTO",7);    
define("VIVIENDA_RANCHO",8);    
define("VIVIENDA_ANEXO",9);    
define("VIVIENDA_HAB", 10);    
define("VIVIENDA_OTRO",11);    
$vivienda[VIVIENDA_PROPIA] = "Propia";
$vivienda[VIVIENDA_ALQUILADA] = "Alquilada";
$vivienda[VIVIENDA_FAOV] = "FAOV";
$vivienda[VIVIENDA_CRD] = "Credito Personal";
$vivienda[VIVIENDA_CASA] = "Casa";
$vivienda[VIVIENDA_QUINTA] = "Quinta";
$vivienda[VIVIENDA_APTO] = "Apartamento";
$vivienda[VIVIENDA_RANCHO] = "Rancho";
$vivienda[VIVIENDA_ANEXO] = "Anexo";
$vivienda[VIVIENDA_HAB] = "Habitacion";
$vivienda[VIVIENDA_OTRO] = "Otro";


define("SALUD_NORMAL", 1);   
define("SALUD_ENFERMO", 2);    
define("SALUD_DISC", 3);     
$salud[SALUD_NORMAL] = "Normal";
$salud[SALUD_ENFERMO] = "Enfermo/a";
$salud[SALUD_DISC] = "Discapacitado/a";




?>