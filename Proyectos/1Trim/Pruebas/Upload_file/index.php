<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
</head>
<body>
    <h1>Teoria subir ficheros</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen (Máx 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>

    <?php
    //Con files no se usa $_POST se usa $_FILES
    if (isset($_FILES["foto"])) {
        if ($_FILES["foto"]["error"] == 0) {
            echo "Has seleccionado un archivo"
        } else {
            echo "No se a subido con exito"
        }
    }
?>
</body>
</html>