<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
        $estadio_futbol = array(
            "Barcelona" => "Camp Nou",
            "Real Madrid" => "Santiago Bernabeu",
            "Valencia" => "Mestalla",
            "Real Sociedad" => "Anoeta"
        );

        echo "<table>";
            echo "<tr>";
                echo "<th>Equipo</th>";
                echo "<th>Estadio</th>";
            echo "</tr>";
            foreach ($estadio_futbol as $key => $value) {
                echo "<tr>";  
                    echo "<td>".$key."</td>";    
                    echo "<td>".$value."</td>";  
                echo "</tr>";
            }
        echo "</table>";

        unset($estadio_futbol["Real Madrid"]);

        echo "<ol>";
        foreach ($estadio_futbol as $key => $value) {
            echo "<li>Equipo: ".$key."  Estadio: ".$value."</li>";
        }
        echo "</ol>";
    ?>
</body>
</html>
