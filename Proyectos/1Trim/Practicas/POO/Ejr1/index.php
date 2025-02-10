<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Objetos</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <?php
        require "class_fruta.php";
        
        $pera = new Fruta();
        $pera->setColor("verde");
        $pera->setTamanyo("Mediano");

        echo "<h2>Info sobre mi fruta</h2>";
        echo "<h3>Pera</h3>";
        echo "<p><strong>Color:</strong> ".$pera->getColor()."</p>";
        echo "<p><strong>Tamaño:</strong> ".$pera->getTamanyo()."</p>";
    ?>
</body>
</html>