<?php
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_cv";

const NOMBRE_IMAGEN_DEFECTO_BD="no_imagen.jpg";

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

function repetido($conexion,$tabla,$columna,$valor,$columna_clave=null,$valor_clave=null)
{
    try
    {
        if(isset($columna_clave))
            $consulta="select ".$columna." from ".$tabla." where ".$columna."='".$valor."' AND ".$columna_clave."<>'".$valor_clave."'";
        else
            $consulta="select ".$columna." from ".$tabla." where ".$columna."='".$valor."'";

            
        $usuario_repetido=mysqli_query($conexion,$consulta);
        $respuesta=mysqli_num_rows($usuario_repetido)>0;
    }
    catch(Exception $e)
    {
        $respuesta="No se ha podido realizar la consulta: ".$e->getMessage();
    }

    return $respuesta;
}


function tiene_extension($texto)
{
    $array_nombre=explode(".",$texto);
    if(count($array_nombre)<=1)
        $respuesta=false;
    else
        $respuesta=end($array_nombre);

    return $respuesta;

}
function LetraNIF($dni) 
{  
     return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1); 
} 

function dni_valido($texto)
{
   $dni=strtoupper($texto);
   return LetraNIF(substr($dni,0,8))==substr($dni,-1);
}

function dni_bien_escrito($texto)
{
   $dni=strtoupper($texto);
   return strlen($dni)==9 && is_numeric(substr($dni,0,8)) && substr($dni,-1)>="A" && substr($dni,-1)<="Z";
}

?>