<?php

const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_horario_exam2";

const DIAS=ARRAY(1=>"Lunes","Martes","Miércoles","Jueves","Viernes");
const HORAS=ARRAY(1=>"8:15 - 9:15","9:15 - 10:15","10:15 - 11:15","11:15 - 11:45","11:45 - 12:45", "12:45 - 13:45" ,"13:45 - 14:45" );
function error_page($title,$body)
{
    $html='<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html.='<title>'.$title.'</title></head>';
    $html.='<body>'.$body.'</body></html>';
    return $html;
}
?>