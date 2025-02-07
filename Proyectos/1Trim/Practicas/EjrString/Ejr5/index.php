<?php
    const VALORES=array("M" => 1000, 
                        "D" => 500, 
                        "C" => 100, 
                        "L" => 50, 
                        "X" => 10, 
                        "V" => 5, 
                        "I" => 1);

    function numero($txt){
        $todo_n = true;
        for ($i=0;$i < strlen($txt); $i++){ 
            if(!is_numeric($txt[$i])){
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    } 

    function menor5001($txt){
        $menor = true;
        if($txt > 5000){
            $menor = false;
        }
        return $menor;
    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $txt1_l=strlen($txt1);

        $error_form = $txt1 == ""  || !numero($txt1) || !menor5001($txt1);
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 5</title>
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