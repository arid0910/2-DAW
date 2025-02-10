<?php
    $error_nombre = $_POST["nom"] == "";
    $error_apellido = $_POST["ape"] == "";
    $error_clave = $_POST["con"] == "";
    $error_dni = $_POST["dni"] == "";
    $error_sexo = !isset($_POST["sexo"]);
    $error_comentario = $_POST["come"] == "";

    $errores_form = $error_nombre || $error_apellido || $error_clave || $error_dni || $error_sexo || $error_comentario
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST["btnenviar"])){
        require "vista/vista_recogida.php";
    } else {
        require "vista/vista_form.php";
    }

    ?>
</body>
</html>