<?php
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_foro4";

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

//A partir de aquí tengo conexión con mi BD


if(isset($_POST["btnContEditar"]))
{
    //Compruebo errores
    $error_nombre=$_POST["nombre"]=="";
    $error_usuario=$_POST["usuario"]=="";
    if(!$error_usuario)
    {
        try
        {
            $consulta="select usuario from usuarios where usuario='".$_POST["usuario"]."' AND id_usuario<>'".$_POST["btnContEditar"]."'";
            $usuario_repetido=mysqli_query($conexion,$consulta);
            $error_usuario=(mysqli_num_rows($usuario_repetido)>0);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    $error_email=$_POST["email"]==""||!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
    if(!$error_email)
    {
        try
        {
            $consulta="select email from usuarios where email='".$_POST["email"]."' AND id_usuario<>'".$_POST["btnContEditar"]."'";
            $email_repetido=mysqli_query($conexion,$consulta);
            $error_email=(mysqli_num_rows($email_repetido)>0);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    $error_form_editar=$error_nombre||$error_usuario||$error_email;

    //Si no hay errores edito en la tabla e informo de la acción
    if(!$error_form_editar)
    {
        //Edito y mensaje
        try
        {
            if($_POST["clave"]=="")
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', email='".$_POST["email"]."' where id_usuario='".$_POST["btnContEditar"]."'";
            else
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', clave='".md5($_POST["clave"])."', email='".$_POST["email"]."' where id_usuario='".$_POST["btnContEditar"]."'";

            $resultado_editar=mysqli_query($conexion,$consulta);
            $mensaje_accion="Usuario editado con éxito";
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

}



if(isset($_POST["btnContAgregar"]))
{
    //Compruebo errores
    $error_nombre=$_POST["nombre"]=="";
    $error_usuario=$_POST["usuario"]=="";
    if(!$error_usuario)
    {
        try
        {
            $consulta="select usuario from usuarios where usuario='".$_POST["usuario"]."'";
            $usuario_repetido=mysqli_query($conexion,$consulta);
            $error_usuario=(mysqli_num_rows($usuario_repetido)>0);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }
    $error_clave=$_POST["clave"]=="";
    $error_email=$_POST["email"]==""||!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
    if(!$error_email)
    {
        try
        {
            $consulta="select email from usuarios where email='".$_POST["email"]."'";
            $email_repetido=mysqli_query($conexion,$consulta);
            $error_email=(mysqli_num_rows($email_repetido)>0);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    $error_form_agregar=$error_nombre||$error_usuario||$error_clave||$error_email;

    //Si no hay errores inserto en la tabla e informo de la acción
    if(!$error_form_agregar)
    {
        //inserto BD y mensaje de acción
        try
        {
            $consulta="insert into usuarios (nombre,usuario,clave,email) values('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".$_POST["email"]."')";
            $resultado_agregar=mysqli_query($conexion,$consulta);
            $mensaje_accion="Usuario insertado con éxito";
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

}


//Obtengo los detalles del usuario tanto al pulsar detalles cómo en el borrar cómo en Editar
if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_usuario=$_POST["btnDetalles"];
    elseif(isset($_POST["btnBorrar"]))
        $id_usuario=$_POST["btnBorrar"];
    else
        $id_usuario=$_POST["btnEditar"];

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


///Por último hago la consulta para listar los usuarios de la tabla principal
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
        .error{color:red}
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

    if(isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form_agregar))
        require "vistas/vista_agregar.php";

    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"])&& $error_form_editar))
        require "vistas/vista_editar.php";
    ?>
</body>
</html>