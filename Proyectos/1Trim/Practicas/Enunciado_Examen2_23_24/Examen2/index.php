<?php
require "src/funciones_ctes.php";

try{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e){
    die(error_page("Horario Exam","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
}

try{
    $consulta = "select * from `usuarios`;";
    $datos_usuario = mysqli_query($conexion, $consulta);
}catch(Exception $e){
    mysqli_close($conexion);
    die(error_page("Horarios Exam","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Examen2 PHP</title>
        <style>
             table, th, td{
                border:1px solid black;
                padding: 1rem;
            }

            th{
                background-color: lightgrey;
            }

            table {
                border-collapse:collapse;
                margin: 0 auto;
                width: 70%;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <h1>Examen2 PHP</h1>
        <h2>Horario de los Profesores</h2>

        <form action="index.php" method="post" enctype="multipart/form-data">
            <span>Horario del profesor: </span>
            <select name="sel_nom_prof" id="sel_nom_prof">
                <?php
                    while($tupla_usuario = mysqli_fetch_assoc($datos_usuario)){
                        if (isset($_POST["btnVerHorario"]) && $_POST["sel_nom_prof"] == $tupla_usuario["id_usuario"]){
                            $nombre_seleccinado = $tupla_usuario["nombre"];
                            echo "<option selected value='".$tupla_usuario["id_usuario"]."'>".$tupla_usuario["nombre"]."</option>";
                        } else {
                            echo "<option value='".$tupla_usuario["id_usuario"]."'>".$tupla_usuario["nombre"]."</option>";
                        }
                    } 
                ?>
            </select>
            
            
            <button type="submit" name="btnVerHorario">Ver Horario</button>
        </form>

        <?php
            if(isset($_POST["btnVerHorario"])){
                echo "<h2>Horario del profesor: ".$nombre_seleccinado ."</h2>";

                echo "<table>";
                    echo "<tr>"; 
                        echo "<th></th>";
                        for ($i=0; $i < count(DIAS); $i++) { 
                            echo "<th>".DIAS[$i]."</th>";
                        }
                    echo "</tr>";

                   
                for ($i=0; $i < count(HORAS); $i++) {
                    echo "<tr>"; 
                        echo "<th>".HORAS[$i]."</th>";
                        for ($i=0; $i < count(DIAS); $i++) { 
                            echo "<td>
                                    <span><a href='#'>Edit</span>
                                  </td>";
                        }
                    echo "</tr>";
                }
                    
                echo "<table>";
            }
        ?>
    </body>
</html>