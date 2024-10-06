<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        h2{
            text-align:center;
        }

        body{
            background:beige;
            text-align:justify;
        }

        div{
            padding-left:0.5em; 
            padding-bottom:0.8em;
            margin-bottom:1em;
        }
 
        .error{
            color:red;
        }

        #azul{
            border: 2px solid black;
            background-color:lightblue;
        }

        #verde{
            border: 2px solid black;
            background-color:lightgreen;
        }

        #fecha1, #fecha2{
            margin-bottom:0.5em;
        }
    </style>    
</head>
<body>
    <div id="azul">
        <h2>Fechas - Formulario</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fecha1">Introduzca una fecha: (DD/MM/YYYY): </label>
                <input type="text" name="fecha1" id="fecha1"
                value="<?php if(isset($fecha1)) echo $fecha1 ?>"> </br>

                <?php
                    if(isset($fecha1) && $error_form){
                        if($fecha1 == ""){
                            echo "<p class='error'>*No pudes dejar campos vacio*</p>";
                        } else if (!fechalenght_valida($fecha1)) {
                            echo "<p class='error'>*Formato de fecha erronea*</p>";
                        } else {
                            echo "<p class='error'>*Formato de fecha erronea*</p>";
                        }
                    }  
                ?>

                <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY): </label>
                <input type="text" name="fecha2" id="fecha2"
                value="<?php if(isset($fecha2)) echo $fecha2 ?>">

                <?php
                    if(isset($fecha2) && $error_form){
                        if($fecha2 == ""){
                            echo "<p class='error'>*No pudes dejar campos vacio*</p>";
                        } else if (!fechalenght_valida($fecha2)) {
                            echo "<p class='error'>*Formato de fecha erronea*</p>";
                        } else {
                            echo "<p class='error'>*Formato de fecha erronea*</p>";
                        }
                    }  
                ?>

                </br> </br> 
                <button type="submit" name="btnCalc">Calcular</button>
            </p>
        </form>
    </div>
</body>
</html> 