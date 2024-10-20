<?php
    if(isset($_POST["btnEnviar"])){
        function tiene_extension($txt){
            $array_nombre = explode(".", $txt);
    
            if (count($array_nombre) <= 1) {
                $resu = false; // Sin extension
            } else {
                $resu = end($array_nombre); //Con extension
            }
    
            return $resu;
        }
        
        function es_txt() {
            return tiene_extension($_FILES["fichero"]["name"]) === "txt";
        }
       

        $error_fichero = 
        $_FILES["fichero"]["name"] == "" ||
        $_FILES["fichero"]["error"] || //si hay error
        !tiene_extension($_FILES["fichero"]["name"]) || //si tiene extension
        !es_txt() || // si no es txt
        $_FILES["fichero"]["size"] > 1024 * 1024; // si supera el tamaño   
    } 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="ejr2.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Incluir mi fichero (Max 1MB):</label>
        <input type="file" name="fichero" id="fichero" accept=".txt"/>
            <?php
                if(isset($_POST["btnEnviar"]) && $error_fichero){
                    if ($_FILES["fichero"]["name"] == "") {
                        echo "<span class='error'>*No se ha seleccionado ningún archivo*</span>";
                    } elseif ($_FILES["fichero"]["error"]) {
                        echo "<span class='error'>*Error al subir el archivo*</span>";
                    } elseif (!tiene_extension($_FILES["fichero"]["name"])) {
                        echo "<span class='error'>*El fichero no tiene una extensión válida*</span>";
                    } elseif (!es_txt()) {
                        echo "<span class='error'>*El archivo debe ser un archivo .txt*</span>";
                    } elseif ($_FILES["fichero"]["size"] > 1024 * 1024) {
                        echo "<span class='error'>*El archivo supera el tamaño máximo de 1MB*</span>";
                    }
              }
              ?>
        <br>
        <button type="submit" name="btnEnviar">Enviar</button>
    </form>

    <?php
        if(isset($_POST["btnEnviar"]) && !$error_fichero){
            $nom_fichero= "archivo.txt";

            //Para mover archivos
            //@ no ver errores
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