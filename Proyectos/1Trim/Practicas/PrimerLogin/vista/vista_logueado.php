<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .enLinea{
            display: inline;
        }

        .enlace{
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Primer Login</h1>

    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"] ?> - </strong> <form class="enLinea"  action="index.php" method="post" enctype="multipart/form-data"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
    </div>
</body>
</html>