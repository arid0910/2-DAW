<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 string</title>
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
        <h2>Palíndromo/ Capícuas - Formulario</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>Dime dos palabras o número y te diré si es un palíndromo o un número capicúa.</p>

            <label for="txt1">Primera o número: </label>
            <input type="text" name="txt1" id="txt1"
            value="<?php if(isset($txt1)) echo $txt1 ?>">

            <?php 
                if(isset($txt1) && $error_form){
                    if($txt1 == ""){
                        echo "<span class='error'>Campo vacio</span>";
                    }  elseif($l_txt1<3){
                        echo "<span class='error'>Introduce mas de 3 caracteres</span>";
                    } else {
                        echo "<span class='error'>Debes teclear solo letras o números</span>";
                    }
                }
            ?>

            </br> 
            <button type="submit" name="btnComp">Comprobar</button>
        </form>
    </div>
</body>
</html>