<?php

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

define("DIR_SERV", "http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad1/servicios_rest");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los servicos Actividad 1</title>
</head>

<body>
    <h1>Productos de la tienda</h1>
    <?php
    
    $url=DIR_SERV."/productos";
    $respuesta=consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);

    if(!$obj){
        die("<p>Error consumiendo el servicio web <strong>".$url."</strong></p></body></html>");
    }

    if(isset($obj["error"])){
        die("<p>".$obj["error"]."</p></body></html>");
    }

    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nombre Corto</th>
            <th>PVP</th>
        </tr>
        <?php
        foreach($obj["productos"] as $tupla){
            echo "<tr>";
                echo "<td>".$tupla["cod"]."</td>";
                echo "<td>".$tupla["nombre_corto"]."</td>";
                echo "<td>".$tupla["PVP"]."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>