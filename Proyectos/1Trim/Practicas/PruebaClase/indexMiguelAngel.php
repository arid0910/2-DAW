<!DOCTYPE html>
<?php
    const DIAS_SEMANA = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
    const SEG_DIA = 60*60*24;

    if(isset($_POST["fecha"]) && $_POST["fecha"] != ""){
        $fecha=$_POST["fecha"];   
    } else {
        $fecha=date("Y-m-d"); 
    }

    $segundosFecha = strtotime($fecha);
    $dia_semana = date("w", $segundosFecha);
    $dias_pasados=$dia_semana-1;
    if($dias_pasados == -1){
        $dias_pasados = 6;
    }

    $primer_dia = $segundosFecha - ($dias_pasados*SEG_DIA);
    $ultimo_dia = $primer_dia+(6*SEG_DIA);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Miguel Angel</title>
    <style>
        table,th,td{
            border:1px solid black
        }

        table{
            width: 80%; margin:0 auto; 
            border-collapse:collapse;
            text-align:center;
        }

        th{
            background-color:#CCC;
        }
    </style>
</head>
<body>

    <form action="indexMiguelAngel.php" method="post" form ="fecha_form" id="fecha_form">
        <h1>Reserva de aula</h1>
        <p>
            <label for="fecha">
                <?php
                    echo DIAS_SEMANA[$dia_semana];
                ?>
            </label>
            <input type="date" name="fecha" onchange="document.getElementById('fecha_form').submit();"  value="<?php echo $fecha?>">
        </p>
        <p>
            Semana del <?php echo date("d/m/Y", $primer_dia);?> al <?php echo date("d/m/Y", $ultimo_dia);?>
        </p>
    </form>

    <?php
        $horas[1] = "8:15 - 9:15";
        $horas[] = "9:15 - 10:15";
        $horas[] = "10:15 - 11:15";
        $horas[] = "11:15 - 11:45";
        $horas[] = "11:45 - 12:45";
        $horas[] = "12:45 - 13:45";
        $horas[] = "13:45 - 14:45";

        echo "<table>";
        echo "<tr>";
            echo "<th></th>";
            for ($i=1; $i <= 5; $i++) { 
                echo "<th>".DIAS_SEMANA[$i]."</th>";
            }
        echo "</tr>";

        for ($fila=1; $fila <= 7; $fila++) { 
            echo "<tr>";
                echo "<th>".$horas[$fila]."</th>";
                if($fila == 4){
                    echo "<td colspan='5'>RECREO</td>";
                } else {
                    for ($col=1; $col <= 5; $col++) { 
                        echo "<td></td>";
                    }
                }   
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>