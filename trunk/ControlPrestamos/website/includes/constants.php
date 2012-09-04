<?php 
    $pos = stripos(substr($_SERVER['REQUEST_URI'], 1), '/');
    //valor para desarrollo
    $ROOT_SITE_URL = 'http://'.$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['REQUEST_URI'], 0, $pos + 1).'/website';
    //valor para prod
    //$ROOT_SITE_URL = 'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['REQUEST_URI'], 0, $pos + 1);
    define('ROOT_SITE_URL', $ROOT_SITE_URL);
    
    //listado de errores del sistema
    $_ERRORES["E-0001"] = "El usuario indicado no existe";
    $_ERRORES["E-0002"] = "La clave indicada no corresponde al usuario";
    $_ERRORES["E-0003"] = "Debe indicar un usuario y clave para ingresar al sistema";
    $_ERRORES["E-0004"] = "Para accesar a las opciones del sistema debe primero ingresar con su cuenta";
    $_ERRORES["E-0005"] = "Su sesion ha expirado, por favor ingrese de nuevo";
?>
