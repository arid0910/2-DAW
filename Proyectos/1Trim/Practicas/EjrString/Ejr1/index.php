<?php
    function todo_letras($txt){
        $todo_l = true;

        for ($i=0;$i < strlen($txt); $i++){ 
            if(ord($txt[$i])<ord("A") || ord($txt[$i])>ord("z")){
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $txt2=trim($_POST["txt2"]);
        $l_txt1 = strlen($txt1);
        $l_txt2 = strlen($txt2);

        $error_txt1= $txt1 == "" || $l_txt1< 3 || !todo_letras($txt1);
        $error_txt2= $txt2 == "" || $l_txt2 < 3 || !todo_letras($txt2);

        $error_form = $error_txt1 || $error_txt2;
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