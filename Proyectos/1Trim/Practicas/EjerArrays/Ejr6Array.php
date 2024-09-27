<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
<?php
       $x[]="Madrid";
       $x[]="Barcelona";
       $x[]="Londres";
       $x[]="New York";
       $x[]="Los Ángeles";
       $x[]="Chicago";  

       foreach ($x as $indice => $ciudad) {
            echo "<p>La ciudad con el indice ".$indice." tiene el nombre ".$ciudad."</p>";    
        }
    ?>
</body>
</html>