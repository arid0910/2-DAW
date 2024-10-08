<?php
function buenos_separadores($texto)
{
    return substr($texto,2,1)=="/" && substr($texto,5,1)=="/";
}

function buenos_numeros($texto)
{
    return is_numeric(substr($texto,0,2)) && is_numeric(value: substr($texto,3,2)) && is_numeric(substr($texto,6,4));
}

function fecha_valida($texto)
{
    return checkdate(substr($texto,3,2),substr($texto,0,2),substr($texto,6,4));
}


if(isset($_POST["btnCalcular"]))
{
    //Compruebo errores
    $error_fecha1=$_POST["texto1"]=="" || strlen($_POST["texto1"])!=10 || !buenos_separadores($_POST["texto1"]) || !buenos_numeros($_POST["texto1"]) || !fecha_valida($_POST["texto1"]);
    $error_fecha2=$_POST["texto2"]=="" || strlen($_POST["texto2"])!=10 || !buenos_separadores($_POST["texto2"]) || !buenos_numeros($_POST["texto2"]) || !fecha_valida($_POST["texto2"]);
    $errores_form= $error_fecha1 || $error_fecha2;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Fechas</title>
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
        <form action="fecha1.php" method="post">
            <h2 class="text_centrado">Fechas - Formulario</h2>
            <p>
                <label for="texto1">Introduzca una fecha (DD/MM/AAAA): </label>
                <input type="text" name="texto1" id="texto1" value="<?php if(isset($_POST["texto1"])) echo $_POST["texto1"];?>"/>
                <?php
                    if(isset($_POST["texto1"]) && $error_fecha1)
                    {
                        if($_POST["texto1"]=="")
                        {
                            echo "<span class='error'>* Campo vacío *</span>";
                        }
                        else
                        {
                            echo "<span class='error'>* Fecha no válida *</span>";
                        }
                    }
                ?>
            </p>
            <p>
                <label for="texto2">Introduzca otra fecha (DD/MM/AAAA): </label>
                <input type="text" name="texto2" id="texto2" value="<?php if(isset($_POST["texto2"])) echo $_POST["texto2"];?>"/>
                <?php
                    if(isset($_POST["texto2"]) && $error_fecha2)
                    {
                        if($_POST["texto2"]=="")
                        {
                            echo "<span class='error'>* Campo vacío *</span>";
                        }
                        else
                        {
                            echo "<span class='error'>* Fecha no válida *</span>";
                        }
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
       
        $fecha1_arr=explode("/",$_POST["texto1"]);
        $fecha2_arr=explode("/",$_POST["texto2"]);

        $tiempo1=mktime(0,0,0,$fecha1_arr[1],$fecha1_arr[0],$fecha1_arr[2]);
        $tiempo2=mktime(0,0,0,$fecha2_arr[1],$fecha2_arr[0],$fecha2_arr[2]);

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