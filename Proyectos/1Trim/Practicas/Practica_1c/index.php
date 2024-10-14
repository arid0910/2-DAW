<?php
   function tiene_extension($txt){
      $array_nombre = explode(".", $txt);

      if (count($array_nombre) <= 1) {
          $resu = false; // Sin extension
      } else {
          $resu = end($array_nombre); //Con extension
      }

      return $resu;
  }

   function LetraNIF($dni) {  
       return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1); 
   }
   
   function dni_valido($dni){
      $valido = true;
      $solo_N = "";

      if (strlen($dni) != 9) {
         $valido = false;
      } else {
         for ($i=0; $i < strlen($dni)-1; $i++) { 
            if(!is_numeric($dni[$i])){
               $valido = false;
               break;
            } 
               
            $solo_N .= $dni[$i];
         }
      }

      if(!LetraNIF($solo_N) == strtoupper($dni[strlen($dni)-1])){
         $valido = false;
      }

      return $valido;
   }

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
      $error_dni= $_POST["dni"]=="" || !dni_valido($_POST["dni"]);
      $error_sexo=!isset($_POST["sexo"]);
      $error_comentarios=$_POST["comentarios"]=="";

      $error_foto = 
      $_FILES["foto"]["name"] == "" && 
      ($_FILES["foto"]["error"] || //si hay error
      !tiene_extension($_FILES["foto"]["name"]) || //si tiene extension
      !getimagesize($_FILES["foto"]["tmp_name"]) || //si es un imagen
      $_FILES["foto"]["size"] > 500*1024); // si supera el tamaño

      $errores_form=$error_nombre||$error_apellidos||$error_clave||$error_dni||$error_sexo|| $error_comentarios ;
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