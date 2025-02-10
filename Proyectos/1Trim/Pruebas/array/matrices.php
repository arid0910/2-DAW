<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $notas["Dani"]["DWESE"]=7;
        $notas["Dani"]["DIWEB"]=6;
        $notas["Tomás"]["DWECLI"]=3;
        $notas["Tomás"]["HLC"]=9;
        $notas["Clara"]["HLC"]=5.5;

        echo "<h1>Notas alumnos 2ºDAW</h1>";

        echo "<ol>";
        foreach ($notas as $alumno => $asignaturas) {       
            echo "<li>".$alumno;
            echo "<ul>";
                foreach ($asignaturas as $asignatura => $nota) {
                    echo "<li>".$asignatura.": ".$nota."</li>";
                }
            echo "</ul>";           
            "</li>";
        }
        echo "</ol>";


    ?>
</body>
</html>