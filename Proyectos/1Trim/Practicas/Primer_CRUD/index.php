<?php
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_foro";

function error_page($title,$body)
{
    return '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
    </head>
    <body>'.$body.'</body></html>';

}

try
{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    die(error_page("Primer CRUD","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
}

if(isset($_POST["btnContAgregar"]))
{


    //Compruebo errores
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_email = $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $error_form= $error_clave || $error_nombre || $error_usuario || $error_email;

    //Si no los hay inserto en la tabla e informo de la acción

    try
    {
        $consulta= "insert into `usuarios`(`id_usuario`, `nombre`, `usuario`, `clave`, `email`) 
        values ('','".$_POST["nombre"]."','".$_POST["usuario"]."','".$_POST["clave"]."','".$_POST["email"]."')";
        mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_usuario=$_POST["btnDetalles"];
    else
        $id_usuario=$_POST["btnBorrar"];

    try
    {
        $consulta="select * from usuarios where id_usuario='".$id_usuario."'";
        $detalle_usuario=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


if(isset($_POST["btnContBorrar"]))
{
    try
    {
        $consulta="delete from usuarios where id_usuario='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
        $mensaje_accion="Usuario borrado con éxito";
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


try
{
    $consulta="select * from usuarios";
    $datos_usuarios=mysqli_query($conexion,$consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table,td, th{border:1px solid black}
        table{border-collapse:collapse; text-align: center;}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        .btn_img{border:none;background:none;cursor:pointer}
        .mensaje{font-size:1.25rem; color:blue}
    </style>
</head>
<body>
    <h1>Listado de los Usuarios</h1>
    <?php

    require "vistas/vista_tabla_principal.php";

    if(isset($mensaje_accion))
        echo "<p class='mensaje'>".$mensaje_accion."</p>";

    if(isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if(isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if(isset($_POST["btnAgregar"]) || isset($_POST["btnContAgregar"]) && $error_form)
        require "vistas/vista_agregar.php";

    ?>
</body>
</html>