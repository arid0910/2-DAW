<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>
    <?php 
        $deportes = ["futbol", "baloncesto", "natación", "tenis"];

        for ($i = 0; $i < count($deportes); $i++) {
            echo "<p>".$deportes[$i]."</p>";
        }

        echo "<p>Valor total: ".count($deportes)."</p>";

        echo "<p>Valor actual:".current($deportes)."</p>";

        echo "<p>Valor siguiente: ".next($deportes)."</p>";

        echo "<p>Valor ultima posicon: ".end($deportes)."</p>";

        echo "<p>Valor anterior: ".prev($deportes)."</p>";
    ?>
</body>
</html>