<?php
try {
    $consulta = "select * from libros";
    $result_libros=$conexion->prepare($consulta);
    $result_libros->execute();
    $tupla_result_libros->$result_libros->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    session_destroy();
    $conexion=null;
    die(error_page("Ter_PDO", "<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p>"));
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 Php</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
        .contenedor_libros{display:flex;flex-wrap: wrap;}
        .contenedor_libros div{width:30%;text-align:center}
        .contenedor_libros div img{height:150px}
    </style>
</head>
<body>
    <h1>Libreria</h1>
    <div>
        Bienvenido <strong><?php echo $datos_lector_log["lector"];?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSesion">Salir</button></form>
    </div>
    <?php
    require "vistas/libros_tres_en_tres.php";
    ?>
</body>
</html>