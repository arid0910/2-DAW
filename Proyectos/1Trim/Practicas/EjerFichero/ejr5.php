<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        table, td, th{
            border:1px solid black;
        }

        table{
            border-collapse:collapse; 
            text-align: center;
            margin:0 auto;
            width: 90%;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <?php
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

        if(!$file){
            die("<h3>No se a podido abrir el fichero</h3>");
        }

        echo "<table>";
            echo "<caption>PIB per cápita de los países de la Unión Europea</caption>";
    
            $linea = fgets($file);
            $datos_linea = explode("\t", $linea);
            $numCol = count($datos_linea);

            echo "<tr>";
                for ($i=0; $i < $numCol; $i++) { 
                    echo "<th>".$datos_linea[$i]."</th>";
                }
            echo "</tr>";

            while ($linea = fgets($file)) {
                $datos_linea = explode("\t", $linea);

                echo "<tr>";
                    echo "<th>".$datos_linea[0]."</th>";

                    for ($i = 1; $i < $numCol; $i++) {
                        if(isset($datos_linea[$i])){
                            echo "<td>".$datos_linea[$i]."</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                echo "</tr>";
            }
        echo "</table>";

        fclose($file);
    ?>
</body>
</html>