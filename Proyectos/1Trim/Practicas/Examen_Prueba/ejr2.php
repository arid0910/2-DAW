<?php
    $error_file = 
    $_FILES["fichero"]["name"] == "" && 
    ($_FILES["fichero"]["error"] || //si hay error
    !tiene_extension($_FILES["fichero"]["name"]) || //si tiene extension
    !getimagesize($_FILES["fichero"]["tmp_name"]) || //si es un imagen
    $_FILES["fichero"]["size"] > 500*1024); // si supera el tamaño
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <form action="ejr1.php" method="post">
    <label for="fichero">Incluir mi fichero (Max 500Kb):</label>
            <input type="file" name="fichero" id="fichero"/>
            <?php
                if(isset($_POST["btnEnviar"]) && $error_foto){
                  if ($_FILES["fichero"]["error"]) {
                      echo "<span class='error'>*No se ha subido el archivo seleccionado*</span>";
                  } elseif (!tiene_extension($_FILES["fichero"]["name"])) {
                      echo "<span class='error'>*Has seleccionado un fichero sin extensión*</span>";
                  } elseif (!getimagesize($_FILES["fichero"]["tmp_name"])) {
                      echo "<span class='error'>*No has seleccionado un archivo imagen*</span>";
                  } else {
                      echo "<span class='error'>*Archivo seleccionado supera a 500KB*</span>";
                  }
              }
              ?>
        <button type="submit" name="btnEnviar">Enviar</button>
    </form>

    <?php
        function strlentxt($txt){
            $cont = 0;
                while(isset($txt[$cont])){
                    $cont++;
                }
            return 0;
        }

        if(isset($_POST["btnEnviar"])){
            echo strlentxt($_POST["txt"]);
        }
    ?>
</body>
</html>