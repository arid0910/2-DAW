<?php
session_name("primer_login");
session_start();
require "../src/funciones_ctes.php";

if(isset($_SESSION["usuario"])){
    require "../src/seguridad.php";

    if($datos_usuario_log["tipo"] == "normal"){
        header("Location: ../index.php");
        exit;
    } 
    
} else {
    header("Location: ../index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
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
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> - <form class="enlinea" action="../index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
        <h3>Eres Admin</h3>
    </div>
    <?php
        
    ?>
</body>

</html>