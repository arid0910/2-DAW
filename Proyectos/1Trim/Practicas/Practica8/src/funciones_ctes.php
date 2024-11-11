<?php
    const SERVIDOR_BD="localhost";
    const USUARIO_BD="jose";
    const CLAVE_BD="josefa";
    const NOMBRE_BD="bd_cv";

    function error_page($title,$body){
        return '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$title.'</title>
        </head>
        <body>'.$body.'</body></html>';
    }

    try{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion,"utf8");
    }catch(Exception $e){
        die(error_page("Primer CRUD","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
    }

    try{
        $consulta="select * from usuarios";
        $datos_usuarios=mysqli_query($conexion,$consulta);
    }catch(Exception $e){
        mysqli_close($conexion);
        die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
?>