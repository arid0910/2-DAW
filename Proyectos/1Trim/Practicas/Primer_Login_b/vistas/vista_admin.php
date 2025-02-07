<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login b</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
    </style>
</head>
<body>
    <h1>Primer Login b</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - <form class="enlinea" action="../index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
    </div>
    <h3>Eres Admin</h3>
</body>
</html>