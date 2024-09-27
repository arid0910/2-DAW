<?php
    if(!isset($_POST["btnenviar"])){
        //Cuando no hay boton la pagina de donde nevio datos se recarga de nuevo
        //Siempre tiene que ir primero 
        header(header: "Location:Pract1.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
</head>
<body>
    <h1>Recogida de datos</h1>
    <?php
        if(isset($_POST["btnenviar"])){
            echo "<p><strong>Nombre:</strong>" .$_POST["nom"]. "</p>";

            echo "<p><strong>Apellido:</strong>" .$_POST["ape"]. "</p>";

            echo "<p><strong>Contraseña:</strong>" .$_POST["con"]. "</p>";

            echo "<p><strong>DNI:</strong>" .$_POST["dni"]. "</p>";

            echo "<p><strong>Sexo:</strong>";
            if(isset($_POST["sexo"])){
                echo $_POST["sexo"];
            }
            
            echo "<p><strong>Nacimineto:</strong>" .$_POST["nac"]. "</p>";

            echo "<p><strong>Comentario:</strong>" .$_POST["come"]. "</p>";

            echo "<p><strong>Subsripción:</strong>";
            if(isset($_POST["sub"])){
                echo "Sí";
            } else {
                echo "No";
            }
        } 
    ?>
</body>
</html>