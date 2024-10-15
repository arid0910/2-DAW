<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría ficheros de texto</title>
</head>
<body>
    <?php
        // abrir fichero (ruta, modo(r,w,a))
        //Con w si existe el fichero lo remplza vacio y si no existe lo crea
        @$file = fopen("prueba.txt", "r");

        if(!$file){
            //Para salirse
            die("<p>Fichero no abierto</p>");
        } 

        //coge cad linea y avanza el puntero a la l¡siguiente linea
        //recorrer todo 1.0
        while(!feof($file)){
            $linea = fgets($file);
            echo "<p>".$linea."</p>";
        }
        echo "<p>Fin de fichero</p>",

        //Para ir al principio del fichero
        fseek($file,0);

        //recorrer todo 2.0
        //si se puede seguir asignando sigue
        while( $linea = fgets($file)){
            echo "<p>".$linea."</p>";
        }
        echo "<p>Fin de fichero</p>";

        //cunado se abre un fichero hay que cerrarlo
        fclose($file);


        //Añadir línea a fichero
        @$file = fopen("prueba.txt", "w");
        if(!$file){
            //Para salirse
            die("<p>Fichero no abierto</p>");
        }

        //Escribir fichero 1.0
        //PHP_EOL para dar enter
        fputs($file, PHP_EOL."Cuarta línea");
        //Escribir fichero 2.0
        fwrite($file, PHP_EOL."Quinta línea");

        fclose($file);


        //Leer fichero entero y guardar en string
        echo "<h2>Lectura completa de un fichero</h2>";
        $todo = file_get_contents("prueba.txt");
        //pre leer exatamente igual
        echo "<pre>".$todo."</pre>";
        //Cuando haya un salto de linea lo pone a br
        echo nl2br($todo);


        //Leer una web
        echo "<h2>Lectura de una web</h2>";
        $web = file_get_contents("https://www.google.es");
        echo $web;
    ?>
</body>
</html>