<?php
    session_name("examen_colegio");
    session_start();
    require "src/funciones_ctes.php";

    //Conexion a BD
    try{
        @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    }catch(Exception $e){
        session_destroy();
        die(error_page("Examen Colegio", "<p>No se a podido conectar a la bd: ".$e->getMessage()."</p>"));
    }

    //Consulta para conseguir los alumnos
    try {
        $consulta = "select * from alumnos";
        $select_datos_alumnos = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Examen Colegio", "<p>No se a podido hacer la consulta: ".$e->getMessage()."</p>"));
    }

    if(isset($_POST["btnVerNotas"])){
        try {
            $consulta = "select notas.cod_asig, notas.nota, denominacion from notas, asignaturas where cod_alu = ".$_POST["selAlumno"].";";
            $select_datos_notas = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Examen Colegio", "<p>No se a podido hacer la consulta: ".$e->getMessage()."</p>"));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index colegio</title>
    <style>
        table{
            border-collapse:collapse;
        }

        th{
            background-color: lightgrey;
        }

        table, tr, th, td{
            border: solid 1px black;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <h1>Notas de los alumnos</h1>
    <?php
        if(mysqli_num_rows($select_datos_alumnos) <= 0){
            echo "<p>En este moemento no hay ningun alumno registrado en la BD</p>";
        } else {
            ?>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <span>Selecciona un alumno: </span>
                <select name="selAlumno" id="selAlumno">
                    <?php
                        while($tupla_alu=mysqli_fetch_assoc($select_datos_alumnos)){
                            if(isset($_POST["btnVerNotas"]) && $_POST["selAlumno"] == $tupla_alu["cod_alu"]){
                                echo "<option value='".$tupla_alu["cod_alu"]."' selected>".$tupla_alu["nombre"]."</options>";
                                $nom_alu_selected = $tupla_alu["nombre"];
                            } else {
                                echo "<option value=".$tupla_alu["cod_alu"].">".$tupla_alu["nombre"]."</options>";
                            }
                            
                        }
                    ?>
                </select>
                <button type="submit" name="btnVerNotas">Notas</button>
            </form>
            <?php
            if(isset($_POST["btnVerNotas"])){
                echo "<h2>Notas del alumno ".$nom_alu_selected."</h2>";
                ?>
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <th>Asignatura</th>
                                <th>Nota</th>
                                <th>Acción</th>
                            </tr>
                            <?php
                                while($tupla_nota=mysqli_fetch_assoc($select_datos_notas)){
                                    echo "<tr>";
                                        echo "<td>".$tupla_nota["denominacion"]."</td>";
                                        echo "<td>".$tupla_nota["nota"]."</td>";
                                        echo "<td>Editar - Borrar</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                    </form>
                <?php
            }

        }
    ?>
</body>
</html>