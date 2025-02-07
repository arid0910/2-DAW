<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer 1</title>
</head>
<body>
    <?php
        const N_PARES=10;

        for ($i=0; $i < N_PARES; $i++)  
            $pares[$i] = $i*2;
        

        echo "<h1> Los diez primeros números </h1>";     
        for ($i=0; $i < N_PARES; $i++) 
           echo "<p>".$pares[$i]."</p>";    
    ?>
</body>
</html>