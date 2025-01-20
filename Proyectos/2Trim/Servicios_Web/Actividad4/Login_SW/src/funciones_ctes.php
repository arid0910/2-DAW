<?php
define("INACTIVIDAD",5);
define("DIR_SERV","http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad1/servicios_rest/");
define("DIR_SERV_Login","http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad3/API_login");

 function consumir_servicios_REST($url,$metodo,$datos=null)
 {
     $llamada=curl_init();
     curl_setopt($llamada,CURLOPT_URL,$url);
     curl_setopt($llamada,CURLOPT_RETURNTRANSFER,true);
     curl_setopt($llamada,CURLOPT_CUSTOMREQUEST,$metodo);
     if(isset($datos))
         curl_setopt($llamada,CURLOPT_POSTFIELDS,http_build_query($datos));
     $respuesta=curl_exec($llamada);
     curl_close($llamada);
     return $respuesta;
 }

 function error_page($title, $body)
 {
    return '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
    </head>
    <body>'.$body.'</body>
    </html>';
 }

 

?>