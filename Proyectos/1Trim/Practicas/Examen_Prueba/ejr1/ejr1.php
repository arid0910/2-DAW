<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form action="ejr1.php" method="post">
        <label for="txt">Introduce un texto</label>
        <input type="text" name="txt" id="txt" placeholder="Introduce texto" value="<?php if(isset($_POST["txt"])) echo $_POST["txt"]?>"></br>
        <button type="submit" name="btnEnviar">Enviar</button>
    </form>

    <?php
        function strlentxt($txt){
            $cont = 0;
                while(isset($txt[$cont])){
                    $cont++;
                }
            return $cont; 
        }

        if(isset($_POST["btnEnviar"])){
            echo "<p>Número letras: ".strlentxt($_POST["txt"])."<p>";
        }
    ?>
</body>
</html>