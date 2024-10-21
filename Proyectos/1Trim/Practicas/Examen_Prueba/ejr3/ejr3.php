<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <form action="ejr3.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduce texto:</label>
        <input type="text" name="texto" id="texto" placeholder="Escribe aquí...">
        <br><br>

        <label for="separador">Selecciona el separador:</label>
        <select name="separador" id="separador">
            <option value=",">,</option>
            <option value=";">;</option>
            <option value=" ">Espacio</option>
            <option value=":">:</option>
        </select>
        <br><br>

        <button type="submit" name="btnEnviar">Contar palabras</button>
    </form>
 
    <?php
        if (isset($_POST["btnEnviar"])) {
            $texto = $_POST["texto"];  
            $separador = $_POST["separador"];  

            if (empty(trim($texto))) {
                echo "<p style='color: red;'>Error: No has introducido ningún texto.</p>";
            } else {
                $palabras = explode($separador, $texto);

                $numero_palabras = count($palabras);

                echo "<p>El número de palabras es: $numero_palabras</p>";
            }
        }
    ?>
</body>
</html>
