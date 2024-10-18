<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
            margin: 0 auto;
            width: 90%;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 6</h1>
    <?php
    @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
    if (!$file) {
        die("<h3>No se a podido abrir el fichero</h3>");
    }

    $linea = fgets($file);
    $datosPriLinea = explode("\t", $linea);
    ?>

    <form action="ejr6.php" method="post">
        <p>
            <label for="pais">Seleciona un país</label>
            <select name="pais" id="pais">
                <?php
                while ($linea = fgets($file)) {
                    $datosLinea = explode("\t", $linea);
                    $datosPriCol = explode(",", $datosLinea[0]);
                
                    if (isset($_POST["pais"]) && $_POST["pais"] == end($datosPriCol)) {
                        echo "<option selected value='" . end($datosPriCol) . "'>" . end($datosPriCol) . "</option>";
                        $datos_a_mostrar = $datosLinea;
                    } else {
                        echo "<option value='" .end($datosPriCol) . "'>" . end($datosPriCol) . "</option>";
                    }
                }
                
                fclose($file);
                ?>
            </select>
        </p>
        <p>
            <button type="submit" name="btnBuscar">Buscar</button>
        </p>
    </form>

    <?php
    if (isset($_POST["btnBuscar"])) {

        $numCol = count($datosPriLinea);

        echo "<h2>PIB per cápita de: ".$_POST["pais"]."</h2>";
        echo "<table>";
            echo "<tr>";
                for ($i=1; $i < $numCol; $i++) { 
                    echo "<th>".$datosPriLinea[$i]."</th>";
                }
            echo "</tr>";
            echo "<tr>";
                for ($i=1; $i < $numCol; $i++) { 
                    if(isset($datos_a_mostrar[$i])){
                        echo "<td>".$datos_a_mostrar[$i]."</td>";
                    } else {
                        echo "<td></td>";
                    }
                }
            echo "</tr>";
        echo "</table>";
    }
    ?>
</body>

</html>