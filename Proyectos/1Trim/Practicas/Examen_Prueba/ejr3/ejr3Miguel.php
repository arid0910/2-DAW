<?php
if (isset($_POST["btnEnviar"])) {
    $error_form = $_POST["texto"] == "";
}

function my_explode($texto, $separador)
{
    $i = 0;
    $aux = [];
    $len = strlen($texto);

    while ($i < $len && $texto[$i] == $separador) {
        $i++;
    }

    if ($i < $len) {
        $j = 0;
        $aux[$j] = $texto[$i];

        for ($i = $i + 1; $i < $len; $i++) {
            if ($texto[$i] != $separador) {
                $aux[$j] .= $texto[$i];
            } else {
                while ($i < $len && $texto[$i] == $separador) {
                    $i++;
                    if ($i < $len) {
                        $j++;
                        $aux[$j] = $texto[$i];
                    }
                }
            }
        }
    }

    return $aux;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red
        }
    </style>
</head>

<body>
    <form action="ejr3Miguel.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduce texto:</label>
            <input type="text" name="texto" id="texto" placeholder="Escribe aquí..." value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_form) {
                if ($_POST["texto"] == "") {
                    echo "<span class='error'>*No se ha seleccionado ningún archivo*</span>";
                }
            }
            ?>
        </p>

        <p>
            <label for="separador">Selecciona el separador:</label>
            <select name="separador" id="separador">
                <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ",") echo "selected" ?> value=",">,</option>
                <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ";") echo "selected" ?> value=";">;</option>
                <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == " ") echo "selected" ?> value=" ">Espacio</option>
                <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ":") echo "selected" ?> value=":">:</option>
            </select>
        </p>

        <button type="submit" name="btnEnviar">Contar palabras</button>
    </form>

    <?php
    if (isset($_POST["btnEnviar"]) && !$error_form) {
        $texto = $_POST["texto"];
        $sepa = $_POST["separador"];

        $array = my_explode($texto, $sepa);
        echo "<p>Hay " . count($array) . " palabras</p>";
    }
    ?>
</body>

</html>