<?php
    const VALORES=array("M" => 1000, 
                        "D" => 500, 
                        "C" => 100, 
                        "L" => 50, 
                        "X" => 10, 
                        "V" => 5, 
                        "I" => 1);

    function letra_correcto($txt){
        $correcto = true;

        for ($i=0; $i < strlen($txt); $i++) { 
            if(!isset(VALORES[$txt[$i]])){
                $correcto = false;
                break;
            }
        }
        return $correcto;
    }

    function orden_bueno($txt){
        $bueno = true;

        for ($i=0; $i < strlen($txt)-1; $i++) { 
            if(VALORES[$txt[$i]] < VALORES[$txt[$i+1]]){
                $bueno = false;
                break;
            }
        }
        return $bueno;
    }

    function repite_bien($txt){
        $cont["M"] = 4;
        $cont["D"] = 1;
        $cont["C"] = 4;
        $cont["L"] = 1;
        $cont["X"] = 4;
        $cont["V"] = 1;
        $cont["I"] = 4;
        
        $bien = true;
        
        for ($i=0; $i < strlen($txt); $i++) { 
            $cont[$txt[$i]]--;
            if($cont[$txt[$i]] < 0){
                $bien=false;
                break;
            }
        }

        return $bien;
    }

    function bien_escrito($txt){
        return letra_correcto($txt) && orden_bueno($txt)  && repite_bien($txt);
    }

    if(isset($_POST["btnComp"])){
        $txt1=trim($_POST["txt1"]);
        $txt1_l=strlen($txt1);
        $txt1_m = strtoupper($txt1);

        $error_form = $txt1 == ""  || !bien_escrito($txt1_m);
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