<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>
<body>
    <?php
        $array1 = array("Lagartija");
        array_push($array1, "Araña", "Perro", "Gato", "Ratón");

        $array2 = array("12");
        array_push($array2, "34", "45", "52", "12");

        $array3 = array("Sauce");
        array_push($array3, "Pino", "Naranjo", "Perro", "34");

        $array_nuevo = array_merge($array1, $array2, $array3);

        $array_inverso = array_reverse($array_nuevo);

        foreach ($array_inverso as $value) {
            echo "<p>".$value."</p>";
        }
    ?>
</body>
</html>