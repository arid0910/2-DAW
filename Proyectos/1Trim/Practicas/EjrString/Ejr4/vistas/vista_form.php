<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 string</title>
    <style>
        h2{
            text-align:center;
        }

        body{
            background:beige;
            text-align:justify;
        }

        div{
            padding-left:0.5em; 
            padding-bottom:0.8em;
            margin-bottom:1em;
        }

        .error{
            color:red;
        }

        #azul{
            border: 2px solid black;
            background-color:lightblue;
        }

        #verde{
            border: 2px solid black;
            background-color:lightgreen;
        }

        #txt1, #txt2{
            margin-bottom:0.5em;
        }
    </style>    
</head>
<body>
    <div id="azul">
        <h2>Romanos a árabes - Formulario</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>Dime una número en romano y lo convertiré a cifras árabes.</p>

            <label for="txt1">Número: </label>
            <input type="text" name="txt1" id="txt1"
            value="<?php if(isset($txt1)) echo $txt1 ?>">

            <?php  
                if(isset($txt1) && $error_form){
                    if($txt1 == ""){
                        echo "<span class='error'>Campo vacio</span>";
                    }  else {
                        echo "<span class='error'>No has introducido un número romano en notación antigia correctamente</span>";
                    } 
                }
            ?>

            </br> 
            <button type="submit" name="btnComp">Comprobar</button>
        </form>
    </div>
</body>
</html> 