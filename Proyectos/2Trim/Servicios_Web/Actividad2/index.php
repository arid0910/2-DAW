<?php
session_name("CRUD-SW");
session_start();

require "src/funciones_ctes.php";

if (isset($_POST["btnAceptarBorrar"])) {
    $url = DIR_SERV . "/producto/borrar/" . $_POST["btnAceptarBorrar"];
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $json_borrar = json_decode($respuesta, true);

    if (!$json_borrar) {
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($json_borrar["error"])) {
        die("<p>" . $json_borrar["error"] . "</p></body></html>");
    }

    $_SESSION["mensaje"] = "Producto borrado con exito";
}

//Siempre esta
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET");
$json_delete = json_decode($respuesta, true);

if (!$json_delete) {
    die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
}

if (isset($json_delete["error"])) {
    die("<p>" . $json_delete["error"] . "</p></body></html>");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - SW (Act2)</title>
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

        .centrado {
            text-align: center;
            margin: 1em auto;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje{
            color:blue;
        }
    </style>
</head>

<body>
    <h1 class="centrado">Productos de la tienda</h1>

    <?php
    if(isset($_POST["btnDetalles"])){
        require "vistas/vista_detalles.php";
    }

    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }

    if(isset($_POST["btnInsertar"])){
        require "vistas/vista_insertar.php";
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
        foreach ($json_delete["productos"] as $tupla) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' name='btnDetalles' title='Ver Detalles' value='" . $tupla["cod"] . "'>" . $tupla["cod"] . "</button></form></td>";
            echo "<td>" . $tupla["nombre_corto"] . "</td>";
            echo "<td>" . $tupla["PVP"] . "</td>";
            echo "<td>
                    <form action='index.php' method='post'>
                        <button class='enlace' type='submit' name='btnBorrar' title='Borrar' value='" . $tupla["cod"] . "'>Borrar</button>
                        - 
                        <button class='enlace' type='submit' name='btnEditar' title='Editar' value='" . $tupla["cod"] . "'>Editar</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    if(isset($_SESSION["mensaje"])){
        echo "<p class='mensaje, centrado'>".$_SESSION["mensaje"]."</p>";
        session_destroy();
    }
    ?>
</body>

</html>