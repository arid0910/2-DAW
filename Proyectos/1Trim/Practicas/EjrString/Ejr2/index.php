<?php
    function letra($txt){
        $todo_l = true;
        for ($i=0;$i < strlen($txt); $i++){ 
            if(ord($txt[$i])<ord("A") || ord($txt[$i])>ord("z")){
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    function numeros($txt){
        $todo_n = true;
        for ($i=0;$i < strlen($txt); $i++){ 
            if(!is_numeric($txt[$i])){
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $l_txt1 = strlen($txt1);

        $error_form= $txt1 == "" || $l_txt1 < 3 || (!letra($txt1) && !numeros($txt1));
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