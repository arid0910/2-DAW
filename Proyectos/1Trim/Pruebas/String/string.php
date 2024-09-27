<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String</title>
</head>
<body>
    <?php
        $texto1  = "Me llamo Juan";

        //Acceder a las partes del string como un array
        echo $texto1[0];

        //Saber el tamaño de el string
        strlen($texto1);

        //Mayusc
        strtoupper($texto1);

        //Minusc
        strtolower($texto1);

        //implode() pasa un array a string

        //str_word_count cuenta las palbras

        //trim quitar todo de un texto (tabuladores, caracteres especiales...)
    
        //SUBSTRING

        substr($texto1, 3, 5);
    ?>
</body>
</html>