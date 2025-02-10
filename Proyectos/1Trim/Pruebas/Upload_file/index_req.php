<?php
    function tiene_extension($txt){
        $array_nombre = explode(".", $txt);

        if (count($array_nombre) <= 1) {
            $resu = false; // Sin extension
        } else {
            $resu = end($array_nombre); //Con extension
        }

        return $resu;
    }

    if(isset($_POST["btnEnviar"])){
        $error_foto = 
        $_FILES["foto"]["name"] == "" && 
        ($_FILES["foto"]["error"] || //si hay error
        !tiene_extension($_FILES["foto"]["name"]) || //si tiene extension
        !getimagesize($_FILES["foto"]["tmp_name"]) || //si es un imagen
        $_FILES["foto"]["size"] > 500*1024); // si supera el tamaño
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <style>
        .error{color:red}
        p img{
            height:200px;
        }
    </style>
</head>
<body>
    <h1>Teoria subir ficheros</h1>
    <form action="index_req.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen con extensión(Máx 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
            <?php
                if(isset($_POST["btnEnviar"]) && $error_foto){
                    if ($_FILES["foto"]["error"]) {
                        echo "<span class='error'>*No se ha subido el archivo seleccionado*</span>";
                    } elseif (!tiene_extension($_FILES["foto"]["name"])) {
                        echo "<span class='error'>*Has seleccionado un fichero sin extensión*</span>";
                    } elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {
                        echo "<span class='error'>*No has seleccionado un archivo imagen*</span>";
                    } else {
                        echo "<span class='error'>*Archivo seleccionado supera a 500KB*</span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>
    
    <?php
        if (isset($_POST["btnEnviar"]) && !$error_foto && $_FILES["foto"]["name"] != "") {
            echo "<h1>Información de imagen subida</h1>";
            $num_unico = md5(uniqid(uniqid(), true)); //genera un numero unico
            $ext = tiene_extension($_FILES["foto"]["name"]);
            $nom_imagen = "img_".$num_unico.".".$ext;

            //Para mover archivos
            //@ no ver errores
            @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/".$nom_imagen);

            if (!$var) {
                echo "<p>No se a podido mover a la carpeta destino</p>";
            } else {
                echo "<p><strong>Nombre original: </strong>".$_FILES["foto"]["name"]."</p>";
                echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
                echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
                echo "<p><strong>Archivo subido temporalmente en: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
                echo "<p><img src='images/".$nom_imagen."' alt='Imagen Subida' tittle='Imagen Subida'</p>";
            }
        }
    ?>
</body>
</html>