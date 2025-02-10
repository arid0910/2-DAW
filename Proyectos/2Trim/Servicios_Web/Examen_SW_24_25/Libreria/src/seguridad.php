<?php

$headers[]="Authorization: Bearer ".$_SESSION["token"];
$url=DIR_SERV."/logueado";
$respuesta=consumir_servicios_JWT_REST($url,"GET",$headers);
$json_respuesta=json_decode($respuesta,true);
if(!$json_respuesta)
{
     session_destroy();
     die(error_page("Gestión Libros","<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>".$url."</strong></p>"));
}
if(isset($json_respuesta["error"]))
{
     session_destroy();
     die(error_page("Gestión Libros","<h1>Librería</h1><p>".$json_respuesta["error"]."</p>"));
}

if(isset($json_respuesta["no_auth"]))
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha expirado";
    header("Location:index.php");
    exit;
}
if(isset($json_respuesta["mensaje_baneo"]))
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}


$datos_usu_log=$json_respuesta["usuario"];
$_SESSION["token"]=$json_respuesta["token"];


if(time()-$_SESSION["ultm_accion"]>MINUTOS*60)
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado";
    header("Location:index.php");
    exit;
}


$_SESSION["ultm_accion"]=time();

?>