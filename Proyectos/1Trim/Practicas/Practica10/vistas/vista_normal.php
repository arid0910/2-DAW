<?php
try {
    $consulta = "select dia,hora,nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.usuario='" . $datos_usuario_log["id_usuario"] . "'";
    $result_horario_profe = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

while ($tupla = mysqli_fetch_assoc($result_horario_profe)) {
    if (isset($horario[$tupla["dia"]][$tupla["hora"]]))
        $horario[$tupla["dia"]][$tupla["hora"]] .= " / " . $tupla["nombre"];
    else
        $horario[$tupla["dia"]][$tupla["hora"]] = $tupla["nombre"];
}
mysqli_free_result($result_horario_profe);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .centrado {
            text-align: center
        }

        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 90%
        }

        th {
            background-color: #CCC
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
        <h3>Eres Normal</h3>
        <?php

        echo "<h3 class='centrado'>Horario del Profesor:" . $datos_usuario_log["nombre"] . "</h3>";
        echo "<table class='centrado'>";
        echo "<tr>";
        echo "<th></th>";
        for ($i = 1; $i <= count(DIAS); $i++)
            echo "<th>" . DIAS[$i] . "</th>";
        echo "</tr>";

        for ($hora = 1; $hora <= count(HORAS); $hora++) {
            echo "<tr>";
            echo "<th>" . HORAS[$hora] . "</th>";
            if ($hora == 4) {
                echo "<td colspan='5'>RECREO</td>";
            } else {
                for ($dia = 1; $dia <= count(DIAS); $dia++) {
                    echo "<td>";
                        if (isset($horario[$dia][$hora])) {
                            echo $horario[$dia][$hora];
                        }
                    echo "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>

</html>