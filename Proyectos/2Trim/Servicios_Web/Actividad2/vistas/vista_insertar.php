<?php
if (isset($_POST["btnEnviar"])) {
    $error_cod = $_POST["cod"] == "";
    $error_nombre = $_POST["nombre"] == "";
    $error_nombre_corto = $_POST["nombre_corto"] == "";
    $error_descripcion = $_POST["descripcion"] == "";
    $error_PVP = $_POST["PVP"] == "" || !is_numeric($_POST["PVP"]);

    $error_form = $error_cod ||
        $error_nombre ||
        $error_nombre_corto ||
        $error_descripcion ||
        $error_PVP;
}

if (isset($_POST["btnInsertar"])) {
    $url = DIR_SERV . "/familias";
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_familia = json_decode($respuesta, true);

    if (!$json_familia) {
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($json_familia["error"])) {
        die("<p>" . $json_familia["error"] . "</p></body></html>");
    }
}
?>

<h2>Creando un Producto</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="cod">Código: </label>
        <input type="text" name="cod" id="cod"> <br /><br />
        <?php
        if (isset($_POST["btnEmviar"]) && $error_cod)
            echo "<span class='error'>* Campo vacio *</span>"
        ?>
    </p>

    <p>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre"> <br /><br />
        <?php
        if (isset($_POST["btnEmviar"]) && $error_nombre)
            echo "<span class='error'>* Campo vacio *</span>"
        ?>
    </p>

    <p>
        <label for="nombre_corto">Nombre Corto: </label>
        <input type="text" name="nombre_corto" id="nombre_corto"> <br /><br />
        <?php
        if (isset($_POST["btnEmviar"]) && $error_nombre_corto)
            echo "<span class='error'>* Campo vacio *</span>"
        ?>
    </p>

    <p>
        <label for="descripcion">Descripciòn: </labe>
            <textarea name="descripcion" id="descripcion"></textarea> <br><br>
            <?php
            if (isset($_POST["btnEmviar"]) && $error_descripcion)
                echo "<span class='error'>* Campo vacio *</span>"
            ?>
    </p>

    <p>
        <label for="PVP">PVP: </label>
        <input type="text" name="PVP" id="PVP"> <br><br>
        <?php
        if (isset($_POST["btnEmviar"]) && $_POST["PVP"] == "") {
            echo "<span class='error'>* Campo vacio *</span>";
        } else if (isset($_POST["btnEnviar"]) && !is_numeric($_POST["PVP"])) {
            echo "<span class='error'>* Intorduce un valor numerico *</span>";
        }
        ?>
    </p>

    <p>
        <label for="familia">Familia: </label>
        <select name="familia" id="familia">
            <?php
            foreach ($json_familia["familia"] as $tupla) {
                echo "<option value='" . $tupla["cod"] . "'>" . $tupla["nombre"] . "</option>";
            }
            ?>
        </select>
    </p>

    <p>
        <button type="submit" name="btnEnviar" id="btnEnviar">Enviar</button>
        <button type="submit" name="btnVolver" id="btnVolver">Volver</button>
    </p>
</form>