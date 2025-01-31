<?php


// Me he conectado y ahora hago la consulta para el baneo
try
{
    $consulta="select * from usuarios where lector=? AND clave=?";
    $sentencia=$conexion->prepare($consulta);
    $sentencia->execute([$_SESSION["lector"],$_SESSION["clave"]]);
}
catch(PDOException $e)
{
    $sentencia=null;
    $conexion=null;
    session_destroy();
    die(error_page("Primer Login b","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}


if($sentencia->rowCount()<=0)
{
    $sentencia=null;
    $conexion=null;
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:".$salto);
    exit;
}


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_lector_log=$sentencia->fetch(PDO::FETCH_ASSOC);
$sentencia=null;



// Ahora controlo el tiempo de inactividad

if(time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60)
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:".$salto);
    exit;
}

$_SESSION["ultm_accion"]=time();


?>