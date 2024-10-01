<?php
    function letra($txt){
        $txt_u = strtoupper($txt);
        $patron = '/^MDCLXVI/';
        $resu = true;
        for ($i=0; $i < strlen($txt_u ); $i++) { 
            if(!preg_match($patron, $txt_u )){
                $resu = false;
                break;
            }
        }
        return $resu;
    }

    function repeticion($txt){

    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $sin_esp = str_replace(" ", "", $txt1);
        $l_txt1 = strlen($sin_esp);

        $error_form = $txt1 == ""  || !letra($txt1) ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4</title>
</head>
<body> 
<?php
   if(isset($_POST["btnComp"]) && !$error_form)
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