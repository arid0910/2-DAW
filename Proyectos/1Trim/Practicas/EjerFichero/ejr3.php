<?php
    if(isset($_POST["btnMostrar"])){
        $numero = $_POST["numero"];
        $linea_buscar = $_POST["linea"];
        $linea_valida = "";
        $nombre = "tabla_" . $numero . ".txt";
        $ruta = "tabla/" . $nombre;
        $num_lineas = 0;
        
        if (file_exists($ruta)) {
            $file = fopen($ruta, "r");
            while(fgets($file)){
                $num_lineas++;
            }
            fclose($file);
        } 
    
        $error_fichero = !is_numeric($linea_buscar) || $linea_buscar == "" || $linea_buscar < 1 || $linea_buscar > $num_lineas;
        $error_tabla = !is_numeric($numero) || $numero == "" || $numero < 1 || $numero > 10; 
    }
   
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error{color:red}
    </style>
</head>
<body>
    <form action="ejr3.php" method="post" enctype="multipart/form-data">
        <label for="numero">Introduce un número del 1 al 10</label>
        <input type="text" name="numero" id="numero"/> </br>
        <?php
        if(isset($_POST["btnMostrar"]) && $error_tabla){
            if($_POST["numero"] == ""){
                echo "<span class='error'>*Campo Vacio*</br></span>";
            } else {
                echo "<span class='error'>*Solo se permite números entre 1 y 10*</br></span>";
            }
         }  
        ?>

        <label for="linea">Introduce la linea a leer</label>
        <input type="text" name="linea" id="linea"/> </br>
        <?php
        if(isset($_POST["btnMostrar"]) && $error_fichero){
            if($_POST["linea"] == ""){
                echo "<span class='error'>*Campo Vacio*</br></span>";
            } else {
                echo "<span class='error'>*No existe la linea ".$_POST["linea"]."*</br></span>";
            }
         }  
        ?>
        <button type="submit" name="btnMostrar">Mostrar línea</button>
    </form>

    <?php
        if(isset($_POST["numero"])){
            $nombre = "tabla_".$_POST["numero"].".txt";
            $ruta = "tabla/".$nombre;

            if(file_exists($ruta)){
               $file = fopen($ruta, "r");

               if (!$file) {
                    die("<p class='error'>*No se puede abrir el fichero*</p>");
               }

                $linea_actual = 0;
                while($linea = fgets($file)){
                    $linea_actual++;
                    if ($linea_actual == $linea_buscar) {
                        $linea_valida = $linea;
                        break; 
                    }   
                } 

                fclose($file);

                echo "<p>".$linea_valida."</p>";
            } else {
                echo "<p class='error'>*Esta tabla no existe*</br></p>";
            }
        }
        
    ?>
     
</body>
</html>