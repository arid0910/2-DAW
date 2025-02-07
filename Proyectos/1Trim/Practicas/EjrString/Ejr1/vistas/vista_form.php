<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 string</title>
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
        <h2>Ripios - Formulario</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>Dime dos palabras y te diré si riman o no.</p>

            <label for="txt1">Primera palabra: </label>
            <input type="text" name="txt1" id="txt1"
            value="<?php if(isset($txt1)) echo $txt1 ?>">

            <?php 
                if(isset($txt1) && $error_txt1){
                    if($txt1==""){
                        echo "<span class='error'>Campo Vacio</span>";
                    } else if ($l_txt1 < 3) {
                        echo "<span class='error'>Debes teclear almenos 3 letras</span>";
                    } else {
                        echo "<span class='error'>No has tecleado solo letras</span>";
                    }
                }
            ?>

            </br> 
            <label for="txt2">Segunda palabra: </label>
            <input type="text" name="txt2" id="txt2"
            value="<?php if(isset($txt2)) echo $txt2 ?>">
            
            <?php 
                if(isset($txt2) && $error_txt2){
                    if($txt2==""){
                        echo "<span class='error'>Campo Vacio</span>";
                    } elseif ($l_txt2 < 3) {
                        echo "<span class='error'>Debes teclear almenos 3 letras</span>";
                    } else {
                        echo "<span class='error'>No has tecleado solo letras</span>";
                    }
                }
            ?>

            </br> 
            <button type="submit" name="btnComp">Comparar</button>
        </form>
    </div>
</body>
</html>