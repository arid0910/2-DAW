<?php
$clave = "1234";
$usuario = "admin";

$usuParam = $_REQUEST["param"];
$claParam = $_REQUEST["param2"];

$sugerencia = "";
if ($usuParam !== "" && $claParam !== "") {
    if ($clave == $claParam && $usuario == $usuParam) {
        $sugerencia = "Login correcto";
    } else {
        $sugerencia = "Login incorrecto";
    }
}
echo $sugerencia === "" ? "ninguna sugerencia" : $sugerencia;
