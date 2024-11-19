<?php
try
{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    session_destroy();
    die(error_page("Primer Login","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
}
// Me he conectado y ahora hago la consulta
try
{
    $consulta="select * from usuarios where usuario='".$_SESSION["usuario"]."' AND clave='".$_SESSION["clave"]."'";
    $result_select=mysqli_query($conexion,$consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Primer Login","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

if(mysqli_num_rows($result_select)<=0)
{
    mysqli_free_result($result_select);
    session_unset();
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}
else
{
    $datos_usuario_log=mysqli_fetch_assoc($result_select);
    mysqli_free_result($result_select);
}

// He pasado el control de baneo
//Ahora controlo el tiempo de inactividad

if(time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60)
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:index.php");
    exit;
}

$_SESSION["ultm_accion"]=time();


?>