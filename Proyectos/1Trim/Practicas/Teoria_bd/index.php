<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD</title>
    <style>
        table,
        tr,
        th,
        td {
            border: solid 1px black;
            padding: 1em;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Teoría BD</h1>

    <?php
        const SERVIDOR_BD = "localhost";
        const USUARIO_BD = "jose";
        const PASSWORD_BD = "josefa";
        const NOMBRE_BD = "bd_teoria";

        try {
            @$conexion = mysqli_connect(hostname: SERVIDOR_BD, username: USUARIO_BD, password: PASSWORD_BD, database: NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die("<p>No se a podido conectar a la BD: " . $e->getMessage() . "</p></body></html>");
        }

        echo "<h2>Conexión bien</h2>";
        try {
            $consulta = "select * from t_alumnos";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>No se a podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
        }

        echo "<h2>Consulta bien</h2>";

        $n_tuplas = mysqli_num_rows($resultado);
        echo "<p>El numero de alumnos en la tabla t_alumnos es ahora mismo: " . $n_tuplas . "</p>";

        echo "<h3>Mostrando las tuplas</h3>";

        $tupla = mysqli_fetch_assoc($resultado);
        echo "<p>El nombre del primer alumno obtenido es: " . $tupla["nombre"] . "</p>";

        $tupla = mysqli_fetch_row($resultado);
        echo "<p>El teléfono del segundo alumno obtenido es: " . $tupla[2] . "</p>";

        $tupla = mysqli_fetch_object($resultado);
        echo "<p>El código postal del tercer alumno obtenido es: " . $tupla->cp . "</p>";


        mysqli_data_seek($resultado, 1); //Para ir a una tupla en especifico
        $tupla = mysqli_fetch_array($resultado);
        echo "<p>El nombre del segundo alumno obtenido es: " . $tupla[1] . " y el teléfono es: " . $tupla["telefono"] . "</p>";

        //Tabla que muestre info de los alumnos
        mysqli_data_seek($resultado, 0); //volver al primcipio de las tuplas
        echo "<table>";
            echo "<tr>";
                echo "<th>cod_alu</th>";
                echo "<th>Nombre</th>";
                echo "<th>Telefono</th>";
                echo "<th>cod_post</th>";
            echo "</tr>";
        while ($tupla = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
                echo "<td>".$tupla["cod_alu"]."</td>";
                echo "<td>".$tupla["nombre"]."</td>";
                echo "<td>".$tupla["telefono"]."</td>";
                echo "<td>".$tupla["cp"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        
        
        //Tabla de notas
        try {
            $consulta = "select * from `t_alumnos` 
                         join t_notas on t_notas.cod_alu = t_alumnos.cod_alu 
                         join t_asignaturas on t_notas.cod_asig = t_asignaturas.cod_asig 
                         where t_asignaturas.denominacion = 'HLC'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>No se a podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
        }

        echo "<table>";
            echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Asignatura</th>";
                echo "<th>Nota</th>";
            echo "</tr>";
        while ($tupla = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
                echo "<td>".$tupla["nombre"]."</td>";
                echo "<td>".$tupla["denominacion"]."</td>";
                echo "<td>".$tupla["nota"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        mysqli_free_result($resultado); //Para liberar el resultado, se usa cuando usamos un cansulta de select
        mysqli_close($conexion);
        echo "<h2>Cierre de conexión</h2>";

    ?>
</body>

</html>