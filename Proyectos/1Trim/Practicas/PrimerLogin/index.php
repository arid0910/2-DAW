<?php
session_start();
    require "src/funciones_ctes.php";

    if (isset($_POST["btnCerrarSession"])) {
        session_destroy();
        header("Location:index.php");
        exit;
    }

    if (isset($_SESSION["usuario"])) {
        //Control de baneo
        require "src/seguridad.php";

        //Muestro vista despues de login
        require "vista/vista_logueado.php";

        mysqli_close($conexion);
    } else {
        require "vista/vista_login.php";
    }
?>
