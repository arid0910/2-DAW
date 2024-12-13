<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 Objetos</title>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <?php
        require "class_fruta.php";
        
        echo "<h2>Info sobre mi fruta</h2>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        echo "<p>Creando una pera... </p>";

        $pera = new Fruta("Verde", "Mediano");

        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        echo "<p>Creando una sandia y manzana... </p>";

        $sandia = new Fruta("Verde", "Grande");
        $manzana = new Fruta("Roja", "Mediano");

        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
        echo "<p>Creando una uva... </p>";

        $uva = new Fruta("Verde", "Pequeño");

        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";

        // unset($uva);
        $uva=null;
        echo "<p>Destruyendo una uva... </p>";
        echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    ?>
</body>
</html> 