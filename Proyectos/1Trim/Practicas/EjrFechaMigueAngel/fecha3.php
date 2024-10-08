<?php

if(isset($_POST["btnCalcular"]))
{
    //Compruebo errores
    $error_fecha1=$_POST["texto1"]=="";
    $error_fecha2=$_POST["texto2"]=="";
    $errores_form= $error_fecha1 || $error_fecha2;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 Fechas</title>
    <style>
        .cuadrado{
            border:3px solid black;padding:5px;margin-top:1em;
        }
        .celeste{
            background-color: lightblue;
        }
        .verdoso{
            background-color: lightgreen;
        }
        .text_centrado{
            text-align:center;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <div class="cuadrado celeste">
        <form action="fecha3.php" method="post">
            <h2 class="text_centrado">Fechas - Formulario</h2>
            <p>
                <label for="texto1">Seleccione una fecha: </label>
                <input type="date" name="texto1" id="texto1" value="<?php if(isset($_POST["texto1"])) echo $_POST["texto1"];?>"/>
                <?php
                    if(isset($_POST["texto1"]) && $error_fecha1)
                    {
                        echo "<span class='error'>* Debes seleccionar una fecha*</span>";
                    }
                ?>
            </p>
            <p>
                <label for="texto2">Seleccione otra fecha: </label>
                <input type="date" name="texto2" id="texto2" value="<?php if(isset($_POST["texto2"])) echo $_POST["texto2"];?>"/>
                <?php
                    if(isset($_POST["texto2"]) && $error_fecha2)
                    {
                        echo "<span class='error'>* Debes seleccionar una fecha*</span>";
                    }
                ?>
            </p>
            <p>
                <button type="submit" name="btnCalcular">Calcular</button>
            </p>
        </form>
    </div>

    <?php
    if(isset($_POST["btnCalcular"]) && !$errores_form)
    {
       
        

        $tiempo1=strtotime($_POST["texto1"]);
        $tiempo2=strtotime($_POST["texto2"]);

        $dif_segundos=abs($tiempo1 -$tiempo2);
        $dias_pasados=$dif_segundos/(60*60*24);

        echo "<div class='cuadrado verdoso'>";
        echo "<h2 class='text_centrado'>Fechas - Respuesta</h2>";
        echo "<p>La diferencia en días entre las dos fechas introducidas es de: ".sprintf("%d",floor($dias_pasados))."<p>";
        echo "</div>";
    }
    ?>
</body>
</html>