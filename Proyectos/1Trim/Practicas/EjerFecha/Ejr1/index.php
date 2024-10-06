<?php
    function fechalenght_valida($fecha){
        $valido = true;

        if(!strlen($fecha) !== 10){
           $valido = false;
        } 
        return $valido;
    }

    function fechaformato_valida($fecha){
        $valido = true;

        if(substr($fecha,2,1) !== "/" && substr($fecha,5,1) !== "/"){
            $valido = false;
        } 
        if (!checkdate((substr($fecha,3,2)), substr($fecha,0,2), substr($fecha,6,4))){
            $valido = false;
        }

        return $valido;
    }

   if(isset($_POST["btnCalc"])){
    $fecha1 = trim($_POST["fecha1"]);
    $fecha2 = trim($_POST["fecha2"]);

    $error_fecha1 =  !fechalenght_valida($fecha1) || !fechaformato_valida($fecha1);
    $error_fecha2 =  !fechalenght_valida($fecha2) || !fechaformato_valida($fecha2);
    $error_form = $fecha1 == "" || $fecha2 == "" || $error_fecha1 || $error_fecha2;
   }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 1</title>
</head>
<body> 
<?php
   if(isset($_POST["btnCalc"]) && !$error_form)
   {    
      require "vistas/vista_form.php";
      require "vistas/vista_datos.php";
   }
   else
   {
      require "vistas/vista_form.php";
   }
?>
</body>
</html>