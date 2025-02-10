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

    try {
        $consulta = "select * from `libros`";
        $select_datos_libro = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 15rem;
        }

        #contenedor{
            display: flex;
            flex-flow:row wrap;
            align-items: center;
            gap:5rem;
        }

        .itemCont{
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 0 0 30%;
        }


    </style>
</head>
<body>
<h1>Librería</h1>
<?php
    echo "<form action='../index.php' method='post' enctype='multipart/form-data'>
                Bienvenido " . $_SESSION["usuario"] . "
                <button type='submit' name='btnSalir'>Salir</button>
            </form>";

    echo "<h2>Lista de libros</h2>";
    
    echo "<div id='contenedor'>";
    while ($tupla_libros = mysqli_fetch_assoc($select_datos_libro)) {
        echo "<div class='itemCont'>";
        echo "<img src='../Images/" . $tupla_libros["portada"] . "' alt='Portada'>";
        echo "<p>" . $tupla_libros["titulo"] . " - " . $tupla_libros["precio"] . "</p>";
        echo "</div>";
    }
    echo "<div>";
?>
</body>
</html>

