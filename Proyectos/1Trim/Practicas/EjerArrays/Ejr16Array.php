<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>
    <?php
        $numeros = array(5 => 1, 12 => 2, 13 => 56, "x" => 42);

        echo "<h3>Muestra de contenido</h3>";
        foreach ($numeros as $key => $value) {
            echo "<p>".$value."</p>";
        }

        echo "<h3>Numero de elementos</h3>";
        echo "<p>".count($numeros)."</p>";

        echo "<h3>Numero de elementos sin posición 5</h3>";
        unset($numeros[5]);
        foreach ($numeros as $key => $value) {
            echo "<p>".$value."</p>";
        }


    ?>
</body>
</html>