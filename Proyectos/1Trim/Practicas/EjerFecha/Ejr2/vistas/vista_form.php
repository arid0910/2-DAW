<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 2</title>
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
                <p>
                    <label for="fecha1">Introduzca una fecha: (DD/MM/YYYY): </label>
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

                        $anio_actual = date("Y");
                        const N_ANIOS=50;

                        echo"<label for='dia1'>Día</label>";
                        echo"<select name='dia1' id='dia1'>";
                        for ($i=1; $i <=31; $i++) { 
                            echo "<option value ='".$i."'>".sprintf("%02d", $i)."</option>";
                        }
                        echo "</select>";

                        echo"<label for='mes1'>Día</label>"; 
                        echo"<select name='mes1' id='mes1'>";
                        for ($i=1; $i <=12; $i++) { 
                            echo "<option value ='".$i."'>".$array_mes[$i]."</option>";
                        }
                        echo "</select>";
                        
                        echo"<label for='anio1'>Año</label>";
                        echo"<select name='anio1' id='anio1'>";
                        for ($i=$anio_actual-floor(N_ANIOS/2); $i <=$anio_actual-floor(N_ANIOS/2); $i++) { 
                            echo "<option value ='".$i."'>".$i."</option>";
                        }
                        echo "</select>";

                        if (isset($fecha1) && $error_fecha1) {   
                            echo "<p class='error'>*Formato de fecha erróneo*</p>";  
                        }
                    ?>
                </p>

                <p>
                    <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY): </label>
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

                        $anio_actual = date("Y");

                        echo"<label for='dia2'>Día</label>";
                        echo"<select name='dia2' id='dia2'>";
                        for ($i=1; $i <=31; $i++) { 
                            echo "<option value ='".$i."'>".sprintf("%02d", $i)."</option>";
                        }
                        echo "</select>";

                        echo"<label for='mes2'>Día</label>"; 
                        echo"<select name='mes2' id='mes2'>";
                        for ($i=1; $i <=12; $i++) { 
                            echo "<option value ='".$i."'>".$array_mes[$i]."</option>";
                        }
                        echo "</select>";
                        
                        echo"<label for='anio2'>Año</label>";
                        echo"<select name='anio2' id='anio2'>";
                        for ($i=$anio_actual-floor(N_ANIOS/2); $i <=$anio_actual-floor(N_ANIOS/2); $i++) { 
                            echo "<option value ='".$i."'>".$i."</option>";
                        }
                        echo "</select>";

                        if (isset($fecha2) && $error_fecha1) {   
                            echo "<p class='error'>*Formato de fecha erróneo*</p>";  
                        }
                    ?>
                </p>

                </br> </br> 
                <button type="submit" name="btnCalc">Calcular</button>
            </p>
        </form>
    </div>
</body>
</html> 