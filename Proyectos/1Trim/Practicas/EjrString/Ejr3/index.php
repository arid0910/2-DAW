<?php
    function letra($txt){
        $todo_le = true;
        $regex='/^[a-zA-Z\s]+$/';
        if(!preg_match($regex, $txt)){
            $todo_le = false;
        }
        return $todo_le;
    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $sin_esp = str_replace(" ", "", $txt1);
        $l_txt1 = strlen($sin_esp);

        $error_form = $txt1 == "" || $l_txt1 < 3 || !letra($txt1);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
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