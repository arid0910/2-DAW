<?php
session_name("Examen_SW_24_25");
session_start();
require "src/funciones_ctes.php";


if(isset($_POST["btnSalir"]))
{
    session_destroy();
    header("Location:index.php");
    exit;
}

if(isset($_SESSION["token"]))
{
    require "src/seguridad.php";

    if($datos_usu_log["tipo"]=="admin")
        require "vistas/vista_admin.php";
    else
        require "vistas/vista_normal.php";
}
else
    require "vistas/vista_login.php";




