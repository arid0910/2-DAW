<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <?php
        $peliculas['Enero']=9;
        $peliculas['Febrero']=12;
        $peliculas['Marzo']=0;
        $peliculas['Abril']=17;

        foreach ($peliculas as $mes => $valor) {
            if ($valor > 0) {
                echo "<p>Mes: ".$mes." Nº peliculas:".$valor."</p>";
            }       
        }
    ?>
</body>
</html>