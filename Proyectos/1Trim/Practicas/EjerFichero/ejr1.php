<?php
    if(isset($_POST["btnCrear"])){
        $error_form = !is_numeric($_POST["numero"]) || $_POST["numero"] == "" || $_POST["numero"] < 1 || $_POST["numero"] > 10; 
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        .error{color:red}
    </style>
</head>
<body>
    <form action="ejr1.php" method="post" enctype="multipart/form-data">
        <label for="numero">Introduce un número del 1 al 10</label>
        <input type="text" name="numero" id="numero"/> </br>
        <?php
        if(isset($_POST["btnCrear"]) && $error_form){
            if($_POST["numero"] == ""){
                echo "<span class='error'>*Campo Vacio*</br></span>";
            } else {
                echo "<span class='error'>*Solo se permite números entre 1 y 10*</br></span>";
            }
         }  
        ?>
        <button type="submit" name="btnCrear">Crear tabla</button>
    </form>

    <?php
        if(isset($_POST["numero"])){
            $nombre = "tabla_".$_POST["numero"].".txt";
            $ruta = "tabla/".$nombre;

            if(!file_exists($ruta)){
                @$file = fopen($ruta, "w");
                
                if(!$file){
                    die("<p class='error'>*Fichero no abierto*</p>");
                }
                
                for ($i=1; $i <= 10; $i++) { 
                    $resultado = $_POST["numero"] * $i;
                    fwrite($file, $_POST["numero"]." x ".$i." = ".$resultado.($i == 10 ? '' : PHP_EOL));
                }
        
                fclose($file);
            } else {
                echo "<p class='error'>*Esta tabla ya existe*</br></p>";
            }
        }
    ?>
     
</body>
</html>