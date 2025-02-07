<?php
$url = DIR_SERV . "/obtenerLibros";
$respuesta = consumir_servicios_REST($url, "GET");
$json_todos_libros = json_decode($respuesta, true);

if (!$json_todos_libros) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
}

if (isset($json_todos_libros["error"])) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_todos_libros["error"] . "</p>"));
}

if (isset($_POST["btnAgregar"])) {
    $url = DIR_SERV . "/repetido/libros/referencia/" . $_POST["ref"];
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_repetido = json_decode($respuesta, true);

    if (!$json_repetido) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
    }

    if (isset($json_repetido["error"])) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_repetido["error"] . "</p>"));
    }

    $error_referencia = $_POST["ref"] == "" || !is_numeric($_POST["ref"]) || $json_repetido["repetido"];
    $error_titulo = $_POST["titulo"] == "";
    $error_autor = $_POST["autor"] == "";
    $error_desc = $_POST["desc"] == "";
    $error_precio = $_POST["precio"] == "" || !is_numeric($_POST["ref"]);

    $error_form_agregar = $error_referencia || $error_titulo || $error_autor || $error_desc || $error_precio;

    if (!$error_form_agregar) {


        $url = DIR_SERV . "/login";
        $datos_env["referencia"] = $_POST["ref"];
        $datos_env["titulo"] = $_POST["titulo"];
        $datos_env["autor"] = $_POST["autor"];
        $datos_env["descripcion"] = $_POST["desc"];
        $datos_env["precio"] = $_POST["precio"];
        $datos_env["portada"] = "no_imagen.jpg";
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $json_respuesta = json_decode($respuesta, true);

        if (!$json_respuesta) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
        }

        if (isset($json_respuesta["error"])) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_respuesta["error"] . "</p>"));
        }
    }
}

if(isset($_POST["borrarConf"])){
$url = DIR_SERV . "/borrarLibro".$_POST["borrarConf"];
$respuesta = consumir_servicios_REST($url, "GET");
$json_borrar = json_decode($respuesta, true);

if (!$json_borrar) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
}

if (isset($json_borrar["error"])) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_borrar["error"] . "</p>"));
}

echo $json_borrar["mensaje"];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        table {
            border-collapse: collapse;
            width: 80%;
        }

        table,
        td,
        th {
            border: solid 1px black;
            padding: 1rem;
            text-align: center;
            margin: 0 auto;
        }

        th {
            background-color: lightgray;
        }

        #agregar {
            margin-left: 1rem;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["lector"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>

    <h2>Lista de los libros</h2>

    <table>
        <tr>
            <th>Ref</th>
            <th>Títutlo</th>
            <th>Acción</th>
        </tr>
        <?php
        foreach ($json_todos_libros["libros"] as $libro) {
            echo "<tr>";
            echo "<td>" . $libro["referencia"] . "</td>";
            echo "<td>" . $libro["titulo"] . "</td>";
            echo "<td>
                    <form action='./index.php' method='post' enctype='multipart/form-data'>
                        <button class = 'enlace' type='submit' name='btnEditar' value='" . $libro["referencia"] . "'>Editar</button> 
                        - 
                        <button class = 'enlace' type='submit' name='btnBorrar' value='" . $libro["referencia"] . "'>Borrar</button>
                    </form>
                </td>";
            echo "<tr>";
        }
        ?>
    </table>

    <?php
    if (isset($_POST["btnBorrar"])) {
    ?>
        <h2>Borrar libro <?php echo $_POST["btnBorrar"] ?></h2>
        <p>Estas seguro que quieres borrar el libro</p>
        
        <form action="index.php" method="post" enctype="multipart/form-data">
            <button type="submit" name="borrarConf" value="<?php $_POST["btnBorrar"] ?>">Acpetar</button>
            <button type="submit">Cancelar</button>
        </form>
    <?php
    }
    ?>

    <h2>Agregar un nuevo libro</h2>

    <form action="index.php" method="post" enctype="multipart/form-data" id="agregar">
        <p>
            <label for="ref">Referencia: </label>
            <input type="text" name="ref" id="ref">
            <?php
            if (isset($_POST["btnAgregar"]) && $error_referencia) {
                if ($_POST["ref"] == "") {
                    echo "<span class='error'>* Campo vacio *</span>";
                } elseif (!is_numeric($_POST["ref"])) {
                    echo "<span class='error'>* Solo valor numerico *</span>";
                } else {
                    echo "<span class='error'>* Esta referencia ya existe *</span>";
                }
            }
            ?>
        </p>

        <p>
            <label for="titulo">Título: </label>
            <input type="text" name="titulo" id="titulo">
            <?php
            if (isset($_POST["btnAgregar"]) && $error_titulo) {
                echo "<span class='error'>* Campo vacio *</span>";
            }
            ?>
        </p>

        <p>
            <label for="autor">Autor: </label>
            <input type="text" name="autor" id="autor">
            <?php
            if (isset($_POST["btnAgregar"]) && $error_autor) {
                echo "<span class='error'>* Campo vacio *</span>";
            }
            ?>
        </p>

        <p>
            <label for="desc">Descripción: </label>
            <textarea name="desc" id="desc"></textarea>
            <?php
            if (isset($_POST["btnAgregar"]) && $error_desc) {
                echo "<span class='error'>* Campo vacio *</span>";
            }
            ?>
        </p>

        <p>
            <label for="precio">Precio: </label>
            <input type="text" name="precio" id="precio">
            <?php
            if (isset($_POST["btnAgregar"]) && $error_precio) {
                if ($_POST["precio"] == "") {
                    echo "<span class='error'>* Campo vacio *</span>";
                } else {
                    echo "<span class='error'>* Solo valor numerico *</span>";
                }
            }

            ?>
        </p>

        <p>
            <label for="portada">Portada</label>
            <input type="file" name="portada" id="portada">
        </p>

        <button type="submit" name="btnAgregar" id="btnAgregar">Agregar</button>
    </form>
</body>

</html>