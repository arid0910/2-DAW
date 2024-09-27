<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad array</title>
</head>
<body>
    <?php
        //Escalar
        $nota[0]=5;
        $nota[1]=9;
        $nota[2]=8;
        $nota[3]=5;
        $nota[4]=6;
        $nota[5]=7;

        //Con count
        echo "<h3>Count</h3>";
        echo"<p>El número de elementos que tiene el array nota es :".count($nota)."</p>";
        echo "</br>";

        //Con lista y for
        echo "<h3>For y lista</h3>";
        echo"<h2>Elemetos del array notas </h2>";
        echo "<ol>";
        for($i=0;$i<count($nota); $i++){
            echo "<li>".$nota[$i]."</li>";
        }
        echo "</ol>";
        echo "</br>";

        //Formas de imprimir array
        var_dump($nota);
        echo "</br>";
        print_r($nota);
        echo "</br>";

        //Se puede poner numero y sigue de alli pnes el [10] y sigue por el [11]
        //Se pouede poner string tambien
        //Se pueden poner varios tipos de datos en un array
        $nota[13]=5;
        $nota[]="Texto";
        $nota[23]=8;
        $nota["Juan"]=5;
        $nota[]=6;
        $nota[]=7;

        echo "</br>";
        print_r($nota);

        //Con froeach viendo el valor
        echo "<h3>foreach viendo valor</h3>";
        echo "<ul>";
        foreach ($nota as $valor) {
            echo "<li>".$valor."</li>";
        }
        echo "</ul>";

        //Con froeach viendo el indice
        echo "<h3>foreach viendo valor y key</h3>";
        echo "<ul>";
        foreach ($nota as $key => $valor) {
            echo "<li>Clave: ".$key." Valor:".$valor."</li>";
        }
        echo "</ul>";
        
        //Otra forma de inicializar un array
        $nota1=array(5,9,8,5,6,7);
        $nota2=array(0=>5, 1=>9, 8=>8); // especificar posición

    ?>
</body>
</html>