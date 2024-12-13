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
        require "class_uva.php";
        
        $uva = new Uva("Verde", "Pequeña", false);

        echo "<h2>Info de mis uvas</h2>";

        if($uva->tieneSemilla() == true){
            echo "<p>La uva tiene semilla y además: </p>";
            $uva->imprimir();
        }else{
            echo "<p>La uva no tiene semilla y además: </p>";
            $uva->imprimir();
        }
    ?>
</body>
</html> 