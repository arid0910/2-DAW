<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
</head>
<body>
    <h1>Esta es mi super página</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nombre:</label>
        <input type="text" name="nom" id="nom" value="<?php if(isset($_POST["nom"])) echo $_POST["nom"]?>"> 
        <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre){
                echo "<span class='error'> * Campo obligatorio * </span>";
            }
        ?>
        </br></br>

        <label for="nac">Nacido en:</label>
        <select name="nac" id="nac">
            <option value="Málaga" <?php if(isset($_POST["nac"]) && $_POST["nac"]=="Málaga") echo "selected"; ?>>Málaga</option>
            <option value="Cádiz" <?php if(isset($_POST["nac"]) && $_POST["nac"]=="Cádiz") echo "selected"; ?>>Cadiz</option>
            <option value="Sevilla" <?php if(isset($_POST["nac"]) && $_POST["nac"]=="Sevilla") echo "selected"; ?>>Sevilla</option>
        </select> </br></br>

        <label for="sexo">Sexo:</label>
        <label for="Hombre">Hombre</label>
        <input type="radio" name="sexo" id="Hombre" value="Hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Hombre") echo "checked"; ?>>
        <label for="Mujer">Mujer</label>
        <input type="radio" name="sexo" id="Mujer" value="Mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Mujer") echo "checked"; ?>>
        <?php
            if(isset($_POST["btnEnviar"]) && $error_sexo){
                echo "<span class='error'> * Campo obligatorio * </span>";
            }
        ?>
        </br> </br>

        <label for="aficiones">Aficiones:</label>
        <label for="deportes">Deportes</label>
        <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes"  <?php if(isset($_POST["aficiones"]) && mi_in_array("Deportes", $_POST["aficiones"])) echo "checked";?>>
        <label for="lectura">Lectura</label>
        <input type="checkbox" name="aficiones[]" id="lectura" value="Lectura"<?php if(isset($_POST["aficiones"]) && mi_in_array("Lectura", $_POST["aficiones"])) echo "checked";?>>
        <label for="otros">Otros</label>
        <input type="checkbox" name="aficiones[]" id="otros" value="Otros" <?php if(isset($_POST["aficiones"]) && mi_in_array("Otros", $_POST["aficiones"])) echo "checked";?>> 
    </br></br>

        <label for="comen">Comentarios:</label>
        <textarea name="comen" id="comen"  cols="30" rows="3" ><?php if(isset($_POST["comen"])) echo $_POST["comen"]?></textarea> </br></br>

        <button type="submit" name="btnEnviar">Enviar</button>
    </form>
</body>
</html>