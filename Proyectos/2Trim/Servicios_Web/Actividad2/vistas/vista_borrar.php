<?php
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

if (isset($_POST["btnBorrar"])) {
        echo "<div class='centrado'>";
        echo "<p>Se dispone usted a borrar el producto: " . $_POST["btnBorrar"] . "</p>";
        echo "<p>¿Estás Seguro?</p>";
        echo "<form action='index.php' method='post'>
                <button type='submit' title='Cancelar'>Cancelar</button>
                <button type='submit' name='btnAceptarBorrar' title='Aceptar' value='" . $_POST["btnBorrar"] . "'>Aceptar</button>
            </form>";
        echo "</div>";
}
?>