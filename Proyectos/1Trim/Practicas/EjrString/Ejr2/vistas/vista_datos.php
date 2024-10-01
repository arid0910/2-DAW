<div id="verde">
    <h2>Palíndromo/ Capícuas - Resultado</h2>
    <?php
        $txt1_m = strtoupper($txt1);
        
        $i = 0;
        $j = $l_txt1-1;
        $resultado = true;

        while($i < $j){
            if($txt1_m[$i] != $txt1_m[$j]){
                $resultado = false;
                break;
            } 
            $i++; $j--;
        }
        
        if (letra($txt1)) {
            if($resultado){
                echo "<p>".$txt1. " es un palíndromo </p>";
            } else {
                echo "<p>".$txt1. " no es un palíndromo </p>";
            }
        } else if (numeros($txt1)) {
            if($resultado){
                echo "<p>".$txt1. " es un capicúa </p>";
            } else {
                echo "<p>".$txt1. " no es un capicúa </p>";
            }
        }

    ?>
</div> 