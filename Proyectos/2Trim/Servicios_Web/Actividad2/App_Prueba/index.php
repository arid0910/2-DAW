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
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            padding: .5rem;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }

        th {
            background-color: #CCC
        }

        h1 {
            text-align: center;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }
    </style>
</head>

<body>
    <h1>Productos de la tienda</h1>
    <?php

    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);

    if (!$obj) {
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($obj["error"])) {
        die("<p>" . $obj["error"] . "</p></body></html>");
    }

    ?>

    <?php
        // Consultas
        if(isset($_POST["btnDetalles"])){
            require "../vistas/vista_detalle.php";
        }
    ?>

    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>PVP</th>
            <th>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <button class='enlace' type='submit' name='btnInsertar' title='Inseratar'>Producto+</button>
                </form>
            </th>
            
        </tr>
        <?php
        foreach ($obj["productos"] as $tupla) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' name='btnDetalles' title='Ver Detalles' value='".$tupla["cod"]."'>".$tupla["cod"] ."</button></form></td>";
            echo "<td>" . $tupla["nombre_corto"] . "</td>";
            echo "<td>" . $tupla["PVP"] . "</td>";
            echo "<td>
                    <form action='index.php' method='post'>
                        <button class='enlace' type='submit' name='btnBorrar' title='Borrar' value='".$tupla["cod"]."'>Borrar</button>
                        - 
                        <button class='enlace' type='submit' name='btnEditar' title='Editar' value='".$tupla["cod"]."'>Editar</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>