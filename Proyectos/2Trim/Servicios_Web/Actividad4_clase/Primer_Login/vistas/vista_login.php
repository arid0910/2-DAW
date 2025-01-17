<?php
if (isset($_POST["btnLogin"])) {
    //compruebo errores
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form_login = $error_usuario || $error_clave;
    if (!$error_form_login) {
        $url = DIR_SERV . "/login";
        $datos_env["usuario"] = $_POST["usuario"];
        $datos_env["clave"] = md5($_POST["clave"]);
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $obj = json_decode($respuesta, true);

        if (!$obj) {
            die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");
        }

        if (isset($obj["error"])) {
            die("<p>" . $obj["error"] . "</p></body></html>");
        }


        //El usuario se encuentra registrado y tengo que iniciar session
        $_SESSION["usuario"] = $obj["usuario"];
        $_SESSION["clave"] = md5($obj["clave"]);
        $_SESSION["ultm_accion"] = time();

        header("Location:index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .error {
            color: red
        }

        .mensaje {
            color: blue;
            font-size: 1.25rem
        }
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p><button name="btnLogin" type="submit">Login</button></p>
        <?php
        if(isset($_POST["btnLogin"])){
            var_dump($respuesta);
            var_dump($_POST);
        }
        ?>
    </form>
    <?php
    if (isset($_SESSION["mensaje_seguridad"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje_seguridad"] . "</p>";
        session_destroy();
    }
    ?>
</body>

</html>