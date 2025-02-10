<?php

const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_libreria_exam";

const INACTIVIDAD=2;//MINUTOS

function error_page($title,$body)
{
    $html='<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html.='<title>'.$title.'</title></head>';
    $html.='<body>'.$body.'</body></html>';
    return $html;
}

function repetido($conexion, $tabla, $columna, $valor)
{
    try {
        $consulta = "select ? from ? where ? = '?'";
        $result_consulta=$conexion->prepare($consulta);
        $result_consulta->execute([$columna, $tabla, $columna, $valor]);
        $respuesta=$result_consulta->rowCount()>0;
        $result_consulta=null;
    } catch (PDOException $e) {
        $respuesta=$e->getMessage();
    }

    return $respuesta;
}

function extension($name)
{
    $array_trozos=explode(".",$name);
    if (count($array_trozos)>1)
        $respuesta=end($array_trozos);
    else
        $respuesta=false;

    return $respuesta;
}
?>