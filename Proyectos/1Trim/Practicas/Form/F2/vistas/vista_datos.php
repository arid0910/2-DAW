<?php
    echo "<h1>Recogida de Datos</h1>";
    echo "<p><strong>El nombre enviado a sido : </strong>".$_POST["nom"]."</p>";
    echo "<p><strong>Ha nacido en : </strong>".$_POST["nac"]. "</p>";
    echo "<p><strong>El sexo es: </strong>".$_POST["sexo"]."</p>";
    
    if(!isset($_POST["aficiones"])){
        echo "<p>No has elegido ni una aficion</p>";
    } else {
        echo "<ol>";
        echo "<p><strong>Las aficines seleccionadas han sido: </strong></p>";
        for ($i=0; $i < count($_POST["aficiones"]); $i++) { 
            if(isset($_POST["aficiones"][$i])){
                echo "<li>".$_POST["aficiones"][$i]."</li>";
            }
        }
        echo "</ol>";
    }

    
    if(isset($_POST["comen"])){
        echo "<p><strong>El comentario enviado a sido: </strong>".$_POST["comen"]."</p>";
    } else {
        echo "No has hecho ningun comentario.";    
    }
    