<?php
session_name("primer_login");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnCerrarSession"]))
{
    session_destroy();
    header("Location:index.php");
    exit;
}

if(isset($_SESSION["usuario"]))
{
    //Control de baneo  
    //consulta a la BD y si está inicio sesión y salto a index
    $salto="../index.php";
    require "src/seguridad.php";

    if ($datos_usuario_log["tipo"] == "normal") {
        require "vistas/vista_normal.php";
    } else {
        $conexion=null;
        header("Location: admin/index.php");
        exit;
    }

    $conexion=null;
}
else
{
    require "vistas/vista_login.php";
}


