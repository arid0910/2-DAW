<?php
if (isset($_POST["btnEnviar"])) {
    $error_form = $_FILES["fichero"]["error"] ||
        $_FILES["fichero"]["type"] != "text/plain" ||
        $_FILES["fichero"]["size"] > 1024 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    if (isset($_POST["btnEnviar"]) && !$error_form) {
        @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");

        if ($var) {
            echo "El archivo se a subido correctamente";
        } else {
            echo "Error la subir el archivo";
        }
    }

    @$fd = fopen("Horario/horarios.txt", "r");
    if ($fd) {
        echo "<h2>Horario de los profesores</h2>";
    ?>
        <label for="horario">Horario de los profesores: </label>
        <select name="horario" id="horario">
            <?php
                while($linea = fgets($fd)){
                    $opcion = explode("\t", $linea);
                    echo "<option value='".$opcion[0]."'>".$opcion[0]."</option>";
                }
            ?>
        </select>
    <?php
        fclose($fd);
    } else {
    ?>
        <h2>No se encuentra el fichero <em>Horario/horarios.txt</em></h2>
        <form action="ejr4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Introduce un fichero txt no superior a 1MB</label>
                <input type="file" name="fichero" id="fichero" placeholder="Introduce texto" value="<?php if (isset($_POST["txt"])) echo $_POST["txt"] ?>">
                <?php
                if (isset($_POST["btnEnviar"]) && $error_form) {
                    if ($_FILES["fichero"]["name"] == "") {
                        echo "<span class='error'>*No se ha seleccionado ningún archivo*</span>";
                    } elseif ($_FILES["fichero"]["error"]) {
                        echo "<span class='error'>*Error al subir el archivo*</span>";
                    } elseif ($_FILES["fichero"]["type"] != "text/plain") {
                        echo "<span class='error'>*El archivo debe ser un archivo .txt*</span>";
                    } else {
                        echo "<span class='error'>*El archivo supera el tamaño máximo de 1MB*</span>";
                    }
                }
                ?>
            </p>
            <p>
                <button type="submit" name="btnEnviar">Enviar</button>
            </p>

        </form>
    <?php
    }
    ?>

</body>

</html>