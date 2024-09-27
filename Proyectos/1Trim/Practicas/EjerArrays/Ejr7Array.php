<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php
        $x['MD']="Madrid";
        $x['BR']="Barcelona";
        $x['LD']="Londres";
        $x['NY']="New York";
        $x['LA']="Los Ángeles";
        $x['CH']="Chicago";  
 
        foreach ($x as $indice => $ciudad) {
             echo "<p>El indice del array que contiene como valor ".$ciudad." es ".$indice."</p>";    
         }
    ?>
</body>
</html>