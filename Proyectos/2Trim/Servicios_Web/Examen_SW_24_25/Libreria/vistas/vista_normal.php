<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
        img{height: 150px; width: 150px;}
        ul,li{list-style: none;}
        ul{display: flex; flex-wrap: wrap; justify-content: space-between;}
        li{flex-basis: 33%;flex-grow: 1;}
        li > span {display: flex; flex-direction: column;}
        li > span > span {padding-left: 1.5rem;}
    </style>
</head>
<body>
    <h1>Librería</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["lector"];?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>

    <?php
        require "vista_libros.php"
    ?>

</body>
</html>