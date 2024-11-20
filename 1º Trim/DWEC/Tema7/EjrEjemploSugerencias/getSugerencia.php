<?php
// Array de nombres de ciudades
$arr[] = "Casares";
$arr[] = "Barcelona";
$arr[] = "Alcorcón";
$arr[] = "Málaga";
$arr[] = "Fuengirola";
$arr[] = "Marbella";
$arr[] = "Río de Janeiro";
$arr[] = "Gijón";
$arr[] = "Gibraltar";
$arr[] = "Oviedo";
$arr[] = "Cáceres";
$arr[] = "Mérida";
$arr[] = "Estepona";
$arr[] = "París";

$param = $_REQUEST["param"];
$sugerencia = "";
if ($param !== "") {
    $param = strtolower($param); //convierte el parámetro recibido a minúscula
    $len=strlen($param); //determinamos la longitud del parámetro recibido
    foreach($arr as $nombre) {
        if (stristr($param, substr($nombre, 0, $len))) {
            if ($sugerencia === "") {
                $sugerencia = $nombre;
            // primera sugerencia
            } else {
                $sugerencia .= ", $nombre"; //segunda y siguientes sugerencias
            }
        }
    }
}
echo $sugerencia === "" ? "ninguna sugerencia" : $sugerencia; 
?>