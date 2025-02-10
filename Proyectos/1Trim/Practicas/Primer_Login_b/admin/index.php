<?php
session_name("Primer_login_b_24_25");
session_start();
require "../src/funciones_ctes.php";

if(isset($_SESSION["usuario"]))
{
    $salto="../index.php";
    require "../src/seguridad.php";

    //Hasta aquí seguridad
    if($datos_usuario_log["tipo"]=="admin")
    {
        require "../vistas/vista_admin.php";
    }
    else
    {
        header("Location:../index.php");
        exit; 
    }

}
else
{
   header("Location:../index.php");
   exit; 
}
?>

