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

        $emple1 = new Empleados("Juan", 2000);
        $emple2 = new Empleados("jose", 4000);

        $emple1->imprimir();
        $emple2->imprimir();
    ?>
</body>
</html>