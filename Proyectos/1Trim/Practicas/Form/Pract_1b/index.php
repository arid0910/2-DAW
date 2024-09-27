<?php

if(isset($_POST["btnBorrar"])){
   header("Location:index.php");
   exit;
}

if(isset($_POST["btnEnviar"]))
{
   //compruebo errores formulario
   $error_nombre=$_POST["nombre"]=="";
   $error_apellidos=$_POST["apellidos"]=="";
   $error_clave=$_POST["clave"]=="";
   $error_dni=$_POST["dni"]=="";
   $error_sexo=!isset($_POST["sexo"]);
   $error_comentarios=$_POST["comentarios"]=="";

   $errores_form=$error_nombre||$error_apellidos||$error_clave||$error_dni||$error_sexo|| $error_comentarios;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
    <style>
         .error{color:red}
    </style>
</head>
<body>
   <?php
   if(isset($_POST["btnEnviar"]) && !$errores_form)
   {
      require "vistas/vista_recogida.php";
   }
   else
   {
      require "vistas/vista_formulario.php";
   }
?>
    
</body>
</html>