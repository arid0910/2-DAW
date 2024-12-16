<?php

/// Control de Baneo
try {
    $consulta = "select * from usuarios where lector = ? and clave = ?";
    $result_usu_log=$conexion->prepare($consulta);
    $result_usu_log->execute([$_SESSION["lector"], $_SESSION["clave"]]);
} catch (PDOException $e) {
    session_destroy();
    $conexion=null;
    die(error_page("Ter_PDO", "<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p>"));
}

if($result_usu_log->rowCount() < 0)
{
    session_unset();
    $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
    $result_usu_log = null;
    $conexion=null;
    header("Location:".$salto_seg);
    exit;
}

$datos_lector_log=$result_usu_log->fetch(PDO::FETCH_ASSOC);
$result_usu_log=null;


//He pasado el baneo 
//Ahora el control de tiempo

if(time()-$_SESSION["ultima_accion"]>INACTIVIDAD*60)
{
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesión ha expirado";
    $conexion=null;
    header("Location:".$salto_seg);
    exit;
}

$_SESSION["ultima_accion"]=time();

?>