<?php
if (isset($_POST["btnDetalles"])) {
    $url = DIR_SERV . "/producto/" . $_POST["btnDetalles"];
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_detalles = json_decode($respuesta, true);

    if (!$json_detalles) {
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($json_detalles["error"])) {
        die("<p>" . $json_detalles["error"] . "</p></body></html>");
    }
}

if (isset($_POST["btnDetalles"])) {
        echo "<h2>Información del producto: " . $_POST["btnDetalles"] . "</h2>";
        if (isset($json_detalles["mensaje"])) {
            echo "<p>El producto ya no esta en la BD</p>";
        } else {
            echo "<p>";
            echo "<strong>Nombre Corto: </strong>" . $json_detalles["productos"]["nombre_corto"];
            echo "</p>";

            echo "<p>";
            echo "<strong>Descripción: </strong>" . $json_detalles["productos"]["descripcion"];
            echo "</p>";

            echo "<p>";
            echo "<strong>PVP: </strong>" . $json_detalles["productos"]["PVP"];
            echo "</p>";

            echo "<p>";
            echo "<strong>Familia: </strong>" . $json_detalles["productos"]["nombre_familia"];
            echo "</p>";

            echo "<form action='index.php' method='post'>
                    <button type='submit' title='Cerrar'>Cerrar</button>
                 </form>";
        }
}
?>