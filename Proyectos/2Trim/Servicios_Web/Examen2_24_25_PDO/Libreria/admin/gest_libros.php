<?php
session_name("examen2_24_25_PDO");
session_start();

require "../src/funciones_ctes.php";

if(isset($_SESSION["lector"]))
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        session_destroy();
        die(error_page("Examen 2 PDO","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
    }

    $salto_seg="../index.php";
    require "../src/seguridad.php";

    if($datos_lector_log["tipo"]=="admin")
        require "../vistas/vista_admin.php";
    else
    {
        $conexion=null;
        header("Location:../index.php");
        exit;
    }

    $conexion=null;
}
else
{
    header("Location:../index.php");
    exit;
}

?>