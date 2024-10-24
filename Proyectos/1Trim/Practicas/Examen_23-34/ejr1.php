<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejr 1</h1>
    <form action="ejr1.php" method="get">
        <button type="submit" name="btnGen">Generar</button>
    </form>
    <?php
        if(isset($_POST["btnGen"])){
            echo "<h1>Respuesta</h1>";

            @$fd=fopen("claves_cesar.txt", "w");
            if(!$fd){
                echo "<p>No tienes los permisos para crear o abrir el fichero 'claves_cesar.txt'</p>";
            } else {

                $primera_linea = "Letra/Desplazamiento";
                for ($i=1; $i < ord("Z") - ord("A") +1 ; $i++) { 
                    $primera_linea .= ";".$i;
                }
                fputs($fd, $primera_linea.PHP_EOL);

                for ($i=ord("A"); $i <= ord("Z"); $i++) { 
                    $linea = chr($i);

                    for ($i=1; $i < ord("Z") - ord("A") +1 ; $i++) { 
                        if($i+$j <= ord("Z")){
                            $linea .= ";".chr($i + $j);
                        } else {
                            $linea .= ";".ord("A")-1+($i+$j)-ord("Z");
                        }
                    }
                }
                fclose($fd);

                echo "<textarea>".file_get_contents("claves_cesar.txt")."</textarea>";
                echo "<p>Fichero generado con exito</p>";
            }


            
        }
    ?>
</body>
</html>