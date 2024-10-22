<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt" </h1>
    <form action="ejr1.php" method="post">
        <button type="submit" name="btnGen">Generar</button><br>
        <?php
        const ARCHIVO = "claves_cesar.txt";

        if (isset($_POST["btnGen"])) {
            //Generación de numeros
            $linea1 = "Letras/Desplazamiento";
            for ($i = 1; $i < 27; $i++) {
                $linea1 .= ";" . $i;
            }
            echo $linea1;
            
            $letraIni = "A";
            for ($i=0; $i < 27; $i++) { 
                
            }

            $fd = fopen("claves_cesar.txt", "r");

            if (!$fd) {
                die("<span class='error'>Error al abrir el fichero<span>");
            }

            $fichero = file_get_contents("claves_cesar.txt");
            echo "<br><textarea cols='87' rows='50' name='respuesta' id='respuesta'>" . $fichero . "</textarea>";
            fclose($fd);
        }
        ?>
    </form>
</body>

</html>