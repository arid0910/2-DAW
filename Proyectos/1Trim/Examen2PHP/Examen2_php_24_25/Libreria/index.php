<?php
session_start();
require "src/funciones_cte.php";

//Coxexion a la BD
try {
    @$conexion = mysqli_connect(SERVIDOR_NOM, USUARIO_NOM, CLAVE_NOM, BD_NOM);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
}

//Al pulsar boton entrar del login
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_clave || $error_usuario;
    $usuario_valido = false;

    //Si no hay errores
    if (!$error_form) {
        try {
            $consulta = "select * from `usuarios` where lector = '" . $_POST["usuario"] . "' and clave = '" . md5($_POST["clave"]) . "'";
            $select_datos_usuario = mysqli_query($conexion, $consulta);
            $tupla_usuario_login = mysqli_fetch_assoc($select_datos_usuario);
            $n_tupla = mysqli_num_rows($select_datos_usuario);
            if ($n_tupla <= 0) {
                $usuario_valido = false;
            } else {
                $_SESSION["usuario"] = $_POST["usuario"];
                $_SESSION["clave"] = $_POST["clave"];
                $_SESSION["tipo"] = $tupla_usuario_login["tipo"];
                $_SESSION["inactividad"] = time();
                $usuario_valido = true;
            }
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Examen PHP 2", "Error al conectar a la BD: " . $e . ""));
        }
    }
}

//Par pode mostrar los mensajes de acccion
if(isset($_SESSION["mensaje_accion"])){
    //echo "<p>".$_SESSION["mensaje_accion"]."</p>";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen PHP 2</title>
    <style>
        .error {
            color: red;
        }

        img {
            width: 15rem;
        }

        #contenedor {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            gap: 5rem;
        }

        .itemCont {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 0 0 30%;
        }
    </style>
</head>

<body>
    <?php
    
    require "vistas/vista_principal_login.php";

    if (isset($_POST["btnEntrar"]) && isset($_SESSION["usuario"])) {
        if ($tupla_usuario_login["tipo"] == "normal") {
            header("Location: vistas/vista_normal.php");
            exit;
        } else {
            header("Location: admin/gest_libros.php");
            exit;
        }
    }

    require "vistas/vista_lista_libros.php";
    ?>
</body>

</html>