<?php
   

    if (isset($_POST["btnCalc"])) {
        $fecha1 = trim($_POST["fecha1"]);
        $fecha2 = trim($_POST["fecha2"]);

        $error_fecha1 = !lenght($fecha1) || !separadores($fecha1) || !numeros($fecha1) || !check($fecha1);
        $error_fecha2 = !lenght($fecha2) || !separadores($fecha2) || !numeros($fecha2) || !check($fecha2);

        $error_form = $fecha1 == "" || $fecha2 == "" || $error_fecha1 || $error_fecha2;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 2</title>
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