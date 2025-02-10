<?php
$url=DIR_SERV."/login";
$datos_env["usuario"]=$_SESSION["usuario"];
$datos_env["clave"]=$_SESSION["clave"];
$respuesta=consumir_servicios_REST($url,"POST",$datos_env);
$json_login=json_decode($respuesta,true);
if(!$json_login)
{
    session_destroy();
    die(error_page("Login con SW","<p>Error consumiendo el Servicio Web: <strong>".$url."</strong></p>"));
}

if(isset($json_login["error"]))
{
    session_destroy();
    die(error_page("Login con SW","<p>".$json_login["error"]."</p>"));
}


if(isset($json_login["mensaje"]))
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log=$json_login["usuario"];


// Ahora controlo el tiempo de inactividad

if(time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60)
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:index.php");
    exit;
}

$_SESSION["ultm_accion"]=time();


?>