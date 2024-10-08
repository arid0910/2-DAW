<?php
function diaTxt($fecha) {
    $variable = date("w", $fecha);
    $dia = "";
    switch ($variable) {
        case 0: $dia = "Domingo"; break;
        case 1: $dia = "Lunes"; break;
        case 2: $dia = "Martes"; break;
        case 3: $dia = "Miercoles"; break;
        case 4: $dia = "Jueves"; break;
        case 5: $dia = "Viernes"; break;
        default: $dia = "Sabado"; break;
    }
    return $dia;
}

if (isset($_POST["btnCam"])) {
    $fecha = $_POST["fecha"];
    $fechaSeg = strtotime($fecha);
    
    $ini = date("d-m-Y", strtotime("last Monday", $fechaSeg));
    $end = date("d-m-Y", strtotime("next Sunday", $fechaSeg));

} else {
    $fechaSeg = time();
    $ini = date("d-m-Y", strtotime("last Monday", $fechaSeg));
    $end = date("d-m-Y", strtotime("next Sunday", $fechaSeg));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba clase date</title>
</head>
<body>
    <h1>Reserva de aula</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        
        <label for="diaSem">
            <?php
                echo diaTxt($fechaSeg);
            ?>
        </label>
        
        <input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d", $fechaSeg) ?>">
        
        <?php
            echo "<p> La semana es desde " . $ini . " hasta " . $end . "</p>";
        ?>
        
        <button type="submit" name="btnCam">Cambiar</button>
    </form>
</body>
</html>
