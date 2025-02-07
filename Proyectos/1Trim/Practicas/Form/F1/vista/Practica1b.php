<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
</head>
<body>

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
        } else {
    ?>
            <h1>Rellena tu CV</h1>
            <form action="Practica1b.php" method="post" enctype="multipart/form-data">
                <label for="nom">Nombre</label> </br>
                <input type="text" name="nom" id="nom"> </br>
        
                <label for="ape">Apellidos</label> </br>
                <input type="text" name="ape" id="ape" size="50"> </br>
        
                <label for="con">Contraseña</label> </br>
                <input type="password" name="con"  id="con">  </br>
         
                <label for="dni">DNI</label> </br> 
                <input type="text" name="dni" id="dni" size="10"> </br>
        
                <label for="sexo">Sexo</label> </br> 
                <input type="radio" name="sexo" id="Hombre" value="Hombre"> <label for="Hombre">Hombre</label></br>
                <input type="radio" name="sexo" id="Mujer" value="Mujer"><label for="Mujer">Mujer</label> </br> </br>
                
                <label for="foto">Incluir mi foto:</label> 
                <input type="file" name="foto" id="foto" accept="image/*"> </br> </br>
        
                <label for="nac">Nacido en:</label>
                <select name="nac" id="nac"> 
                    <option value="Málaga">Málaga</option>
                    <option value="Cadiz">Cadiz</option>
                    <option value="Sevilla">Sevilla</option>
                </select> </br> </br>
                
                <label for="come">Comentarios:</label>
                <textarea name="come" id="come" cols="40" rows="5"></textarea> </br> </br>
        
                <input type="checkbox" name="sub" id="sub">
                <lable for="sub">Subscribirse al boletín de Novedades</label> </br> </br>
                
                <input type="submit" name="btnenviar" value="Guardar cambios" >
                <input type="reset" value="Borrar los datos introducidos" >
            </form> 
    <?php 
        }
    ?>
</body>
</html>