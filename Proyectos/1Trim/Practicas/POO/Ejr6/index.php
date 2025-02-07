<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 Objectos</title>
</head>
<body>
    <h2>Ejercicio 5</h2>
    <?php
        require "class_menu.php";

        $menu = new Menu();
        $menu->cargar("https://www.marca.com/","Marca");
        $menu->cargar("https://www.sony.es/","Sony");
        $menu->cargar("https://www.samsung.com/es/","Samsung");

        $menu->vertical();
        $menu->horizontal();
    ?>
</body>
</html>