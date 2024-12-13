<?php
    session_start();

    require "../src/funciones_cte.php";

    //Coxexion a la BD
    try {
        @$conexion = mysqli_connect(SERVIDOR_NOM, USUARIO_NOM, CLAVE_NOM, BD_NOM);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
    }

    //consulta datos libro
    try {
        $consulta = "select * from `libros`";
        $select_datos_libro = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
    }


    //Elminar libro
    if(isset($_POST["btnBorrar"])){
        try {
            $consulta = "delete from `libros` where referencia = ".$_POST["btnBorrar"]."";
            mysqli_query($conexion, $consulta);
            $_SESSION["mensaje_accion"] = "El libro con Referencia ".$_POST["btnBorrar"]." ha sido borrado/editado con éxito";
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
        }
    }

    //que no pueda entart un tipo normla
    if($_SESSION["tipo"] == "normal"){
        header("Location: ../index.php");
        exit;
        $_SESSION["mensaje_accion"] = "No eres admin no te puedes colar";
        session_unset();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        table, th, td, tr{
            border: solid 1px black;
            padding: 1rem;
        }

        th{
            background-color: lightgray;
        }

        table{
            border-collapse: collapse;
            margin:0 auto;
        }

        .enlace{
            border: none;
            background-color: white;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Librería</h1>
    <?php
        echo "<form action='../index.php' method='post' enctype='multipart/form-data'>
                        Bienvenido " . $_SESSION["usuario"] . "
                        <button type='submit' name='btnSalir' class='enlace'>Salir</button>
                    </form>";
        
        if(isset($_SESSION["mensaje_accion"])){
            echo "<p>".$_SESSION["mensaje_accion"]."</p>";
        }
    ?>
    <h2>Listado de los libros</h2>
    <table>
        <tr>
            <th>Ref</th>
            <th>Título</th>
            <th>Acción</th>
        </tr>
        
        <?php
            while($tupla_libro=mysqli_fetch_assoc($select_datos_libro)){
                echo "<tr>";
                    echo "<td>".$tupla_libro["referencia"]."</td>";
                    echo "<td>".$tupla_libro["titulo"]."</td>";
                    echo "<td>
                        <form action='gest_libros.php' method='post' enctype='multipart/form-data'>
                            <button type='submit' name='btnEditar' class='enlace' value='".$tupla_libro["referencia"]."'>Editar</button> 
                            -
                            <button type='submit' name='btnBorrar' class='enlace' value='".$tupla_libro["referencia"]."'>Borrar</button>
                        </form>
                    </td>";
                echo "<tr>";
            }
        ?>
    </table>

    <h2>Agregar un nuevo usuario</h2>
    <form action="gest_libros.php" method="post" enctype="multipart/form-data">
        <label for="ref">Referencia: </label>
        <input type="text" name="ref" id="ref">
        <br><br>
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo" id="titulo">
        <br><br>
        <label for="autor">Autor: </label>
        <input type="text" name="autor" id="autor">
        <br><br>
        <label for="desc">Descripcion: </label>
        <input type="text" name="desc" id="desc">
        <br><br>
        <label for="Precio">Precio: </label>
        <input type="text" name="precio" id="precio">
        <br><br>
        <label for="portada">Portada: </label>
        <input type="file" name="portada" id="portada">
        <br><br>
        <button type="submit" name="agregar">Agregar</button>
    </form>
</body>
</html>