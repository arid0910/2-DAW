<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de fechas</title>
</head>
<body>
    <h2>Teoria de fechas</h2>
    <?php
        //time() te dice cuanto tiempo a pasado desde enero 1970
        echo "<p>".time()."</p>";

        //date() formatea para que sea el formato que nosotros digamos
        $fecha = date("d/m/Y H:i:s", time());
        echo "<p>".$fecha."</p>";
        echo "<p>".date("d/m/Y H:i:s")."</p>";

        //checkdate(mes, dia , año)
        if(checkdate(2, 29, 2005)){
            echo "<p>La fecha existe</p>";
        } else {
            echo "<p>La no fecha existe</p>";
        }

        //mktime(hora, min, seg, mes, dia, año) como time() pero con una fecha que tu eliges
        echo "<p>".mktime(0, 0, 0, 4, 27, 2004)."</p>";
        echo "<p>".date("d/m/Y", 1083016800)."</p>";

        //strtotime("m/d/y") o ("y/m/d")
        echo "<p>".strtotime("2004/04/27")."</p>";


        
        //Calcular el valor absoluto
        echo "<p>".abs(-8)."</p>"
        
        //Redondea hacia abajo
        echo "<p>".floor(-8)."</p>"

        //Redondea hacia arriba
        echo "<p>".ceil(-8)."</p>"
    ?>
</body>
</html>