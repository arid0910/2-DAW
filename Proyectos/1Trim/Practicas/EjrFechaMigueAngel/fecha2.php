<?php



if(isset($_POST["btnCalcular"]))
{
    //Compruebo errores
    $error_fecha1=!checkdate($_POST["mes1"],$_POST["dia1"],$_POST["anyo1"]);
    $error_fecha2=!checkdate($_POST["mes2"],$_POST["dia2"],$_POST["anyo2"]);
    $errores_form= $error_fecha1 || $error_fecha2;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 Fechas</title>
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
        <form action="fecha2.php" method="post">
            <h2 class="text_centrado">Fechas - Formulario</h2>
            <p>
                <label>Introduzca una fecha: </label>
            </p>
            <p>
                <?php

                $array_mes[1]="Enero";
                $array_mes[]="Febrero";
                $array_mes[]="Marzo";
                $array_mes[]="Abril";
                $array_mes[]="Mayo";
                $array_mes[]="Junio";
                $array_mes[]="Julio";
                $array_mes[]="Agosto";
                $array_mes[]="Septiembre";
                $array_mes[]="Octubre";
                $array_mes[]="Noviembre";
                $array_mes[]="Diciembre";
                $anio_actual=date("Y");
                const N_ANIOS=50;


                echo "<label for='dia1'>Día: </label>";
                echo "<select name='dia1' id='dia1'>";
                for($i=1;$i<=31;$i++)
                {
                    if(isset($_POST["dia1"]) && $_POST["dia1"]==$i)
                        echo "<option selected value='".$i."'>".sprintf("%02d",$i)."</option>";
                    else
                        echo "<option value='".$i."'>".sprintf("%02d",$i)."</option>";
                }
                echo "</select>";

                echo "<label for='mes1'> Mes: </label>";
                echo "<select name='mes1' id='mes1'>";
                for($i=1;$i<=12;$i++)
                {
                    if(isset($_POST["mes1"]) && $_POST["mes1"]==$i)
                        echo "<option selected value='".$i."'>".$array_mes[$i]."</option>";
                    else
                        echo "<option value='".$i."'>".$array_mes[$i]."</option>";
                }
                echo "</select>";

                echo "<label for='anyo1'> Año: </label>";
                echo "<select name='anyo1' id='anyo1'>";
                for($i=$anio_actual-floor(N_ANIOS/2);$i<=$anio_actual+floor(N_ANIOS/2);$i++)
                {
                    if(isset($_POST["anyo1"]) && $_POST["anyo1"]==$i)
                        echo "<option selected value='".$i."'>".$i."</option>";
                    else
                        echo "<option value='".$i."'>".$i."</option>";
                }
                echo "</select>";
              
                if(isset($_POST["btnCalcular"]) && $error_fecha1)
                {   
                    echo "<span class='error'>* Fecha no válida *</span>";
                    
                }
                ?>
            </p>
            <p>
                <label>Introduzca otra fecha: </label>
            </p>
            <p>
                <?php

                    echo "<label for='dia2'>Día: </label>";
                    echo "<select name='dia2' id='dia2'>";
                    for($i=1;$i<=31;$i++)
                    {
                        if(isset($_POST["dia2"]) && $_POST["dia2"]==$i)
                            echo "<option selected value='".$i."'>".sprintf("%02d",$i)."</option>";
                        else
                            echo "<option value='".$i."'>".sprintf("%02d",$i)."</option>";
                    }
                    echo "</select>";

                    echo "<label for='mes2'> Mes: </label>";
                    echo "<select name='mes2' id='mes2'>";
                    for($i=1;$i<=12;$i++)
                    {
                        if(isset($_POST["mes2"]) && $_POST["mes2"]==$i)
                            echo "<option selected value='".$i."'>".$array_mes[$i]."</option>";
                        else
                            echo "<option value='".$i."'>".$array_mes[$i]."</option>";
                    }
                    echo "</select>";

                    echo "<label for='anyo2'> Año: </label>";
                    echo "<select name='anyo2' id='anyo2'>";
                    for($i=$anio_actual-floor(N_ANIOS/2);$i<=$anio_actual+floor(N_ANIOS/2);$i++)
                    {
                        if(isset($_POST["anyo2"]) && $_POST["anyo2"]==$i)
                            echo "<option selected value='".$i."'>".$i."</option>";
                        else
                            echo "<option value='".$i."'>".$i."</option>";
                    }
                    echo "</select>";

                    if(isset($_POST["btnCalcular"]) && $error_fecha2)
                    {
                        
                        echo "<span class='error'>* Fecha no válida *</span>";
                        
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
       
        
        $tiempo1=mktime(0,0,0,$_POST["mes1"],$_POST["dia1"],$_POST["anyo1"]);
        $tiempo2=mktime(0,0,0,$_POST["mes2"],$_POST["dia2"],$_POST["anyo2"]);

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