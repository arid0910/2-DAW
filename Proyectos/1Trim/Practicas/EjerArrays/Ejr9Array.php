<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<body>
    <?php
        $lenguaje_cliente[1]='a';
        $lenguaje_cliente[2]='b';
        $lenguaje_cliente[3]='c';
        $lenguaje_cliente[4]='d';
        $lenguaje_cliente[5]='e';

        $lenguaje_servidor['a']='Coche';
        $lenguaje_servidor['b']='Moto';
        $lenguaje_servidor['c']='Árbol';
        $lenguaje_servidor['d']='Perro';
        $lenguaje_servidor['e']='Casa';

        $lenguajes[] = array_merge($lenguaje_cliente, $lenguaje_servidor);

        echo "<tr>";
        foreach ($lenguajes as $indice => $nom) 
            echo "<td>".$nom."</td>";
        echo "</tr>";
       

    ?>
</body>
</html>