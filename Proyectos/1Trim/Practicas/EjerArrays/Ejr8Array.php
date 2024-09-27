<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
    <?php
        $per[]='Pedro';
        $per[]='Ismael';
        $per[]='Sonia';
        $per[]='Clara';
        $per[]='Susana';
        $per[]='Alfonso';
        $per[]='Teresa';

        echo "<h2> El array contiene ".count($per)." elementos </h2>";

        echo "<ul>";
        foreach ($per as $indice => $nom) 
            echo "<li>".$nom."</li>";
        echo "</ul>";
    ?>
</body>
</html>