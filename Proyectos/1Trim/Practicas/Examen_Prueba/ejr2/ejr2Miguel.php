<?php
    if(isset($_POST["btnEnviar"])){
        $error_form = $_FILES["fichero"]["error"] || 
        $_FILES["fichero"]["type"] != "text/plain" || 
        $_FILES["fichero"]["size"] > 1024 * 1024;
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercico 2 Miguel Angel</title>
</head>

<body>
    <h1>Ejercicio 2</h1>

    <form action="ejr1.php" method="post">
        <p>
            <label for="fichero">Introduce un fichero</label>
            <input type="file" name="fichero" id="fichero" placeholder="Introduce texto" value="<?php if (isset($_POST["txt"])) echo $_POST["txt"] ?>">
            <?php
                if(isset($_POST["btnEnviar"]) && $error_form){
                    if($_FILES["fichero"]["name"] == ""){
                        echo "<span class='error'>*No se ha seleccionado ningún archivo*</span>";
                    } elseif($_FILES["fichero"]["error"]){
                        echo "<span class='error'>*Error al subir el archivo*</span>";
                    } elseif($_FILES["fichero"]["type"] != "text/plain"){
                        echo "<span class='error'>*El archivo debe ser un archivo .txt*</span>";
                    } else {
                        echo "<span class='error'>*El archivo supera el tamaño máximo de 1MB*</span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>

    </form>

    <?php
        if(isset($_POST["btnEnviar"]) && !$error_form){
            $nom_fichero= "archivo.txt";

            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "fichero/".$nom_fichero);

            if($var){
                echo "El archivo se a subido correctamente";
            } else {
                echo "Error la subir el archivo";
            }
        }
    ?>
</body>

</html>