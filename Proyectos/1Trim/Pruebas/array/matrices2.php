<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td, th {
            border:1px solid black;
        }

        table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
        $notas["Dani"]=7;
        $notas["Tomás"]=93;
        $notas["Clara"]=5.5;

        echo "<h1>Notas alumnos 2ºDAW en una asigantura DWESE</h1>";

        echo "<table>";
            echo "<tr>";
                echo "<th> Alumno </th>"; echo "<th> Nota </th>";
            echo "</tr>";
            foreach($notas as $nombre => $valor_nota){
                echo "<tr>";
                    echo "<td>".$nombre."</td>"; 
                    echo "<td>".$notas."</td>";
                echo "</tr>";
            }
        echo "</table>";

        //Otra forma
        /* 
         echo "<table>";
            echo "<tr>";
                echo "<th> Alumno </th>"; echo "<th> Nota </th>";
            echo "</tr>";
            while(current($notas))
                echo "<tr>";
                    echo "<td>".key($notas)."</td>"; 
                    echo "<td>".current($notas)."</td>";
                echo "</tr>";
                next($notas);
            }
        echo "</table>";
        
        */

    ?>
</body>
</html>