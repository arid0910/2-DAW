<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>
    <?php
        $array1[] = "Lagartija" ;
        $array1[] = "Araña" ;
        $array1[] = "Perro" ;
        $array1[] = "Gato" ;
        $array1[] = "Ratón" ;

        $array2[] = "12" ;
        $array2[] = "34" ;
        $array2[] = "45" ;
        $array2[] = "52" ;
        $array2[] = "12" ;

        $array3[] = "Sauce" ;
        $array3[] = "Pino" ;
        $array3[] = "Naranjo" ;
        $array3[] = "Chopo" ;
        $array3[] = "Perro" ;
        $array3[] = "34" ;

        $array_junto [] = array_merge($array1, $array2, $array3);

        print_r($array_junto);
    ?>
</body>
</html>