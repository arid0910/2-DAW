<?php
function tiene_extension($texto)
{
    $array = explode(".", $texto);
    if (strtolower(end($array)) == "txt") {
        $respuesta = "txt";
    } else {
        $respuesta = false;
    }
    return $respuesta;
}

if (isset($_POST["enviar"])) {
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["size"] > 2500000 || !tiene_extension($_FILES["fichero"]["name"]);
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
    <form action="Ejercicio_4.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Por favor, suba un archivo .txt y un tamaño inferior a 2.5MB: </label>
        <input type="file" name="fichero" id="fichero" accept=".txt">
        <?php
        if (isset($_POST["enviar"]) && $error_fichero) {
            if ($_FILES["fichero"]["name"] == "") {
                echo "<span> * Debes subir un archivo * </span>";
            } elseif ($_FILES["fichero"]["error"]) {
                echo "<span> * No se ha podido subir el archivo al servidor * </span>";
            } elseif (!tiene_extension($_FILES["fichero"]["name"])) {
                echo "<span> * El archivo no tiene la extensión correcta (.txt) * </span>";
            } else {
                echo "<span> * El archivo ha superado el tamaño máximo(2.5MB) * </span>";
            }
        }
        ?>
        </br></br></br>
        <button type="submit" name="enviar">Subir</button>
    </form>
    <?php
    if (isset($_POST["enviar"]) && !$error_fichero) {
        $ruta = $_FILES["fichero"]["tmp_name"];
        @$file = fopen($ruta, "r");
        if (!$file) {
            die("<p> No se ha podido abrir el fichero</p>");
        }
        $palabras = 0;
        while (!feof($file)) {
            $linea = fgets($file);
            if (trim($linea) == "") {
                continue;
            }
            $linea_limpia = str_replace([",", ".", ";"], " ", trim($linea));
            $arr_palabras = explode(" ", trim($linea_limpia));
            $palabras += count($arr_palabras);
        }
        fclose($file);
        echo "<p> El documento es: " . $_FILES["fichero"]["name"] . " tiene " . $palabras . " palabras. </p>";
    }
    ?>
</body>

</html>