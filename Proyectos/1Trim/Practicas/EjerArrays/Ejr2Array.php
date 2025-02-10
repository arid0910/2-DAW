<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
   <?php

   $v[1]=90;
   $v[30]=7;
   $v['e']=99;
   $v['hola']=43;

   foreach ($v as $key => $valor) {
        echo "<p>Clave: ".$key." Valor:".$valor."</p>";
    }
  

   ?>
</body>
</html>